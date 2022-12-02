<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Country;
use App\Models\Post;
use App\Models\PostView;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class PageController extends Controller
{
    public function index()
    {
        $latestPosts = Post::latest('id')->with(['user', 'category'])->take(4)->get();
        // return $latestPosts;
        return view('front.index', compact('latestPosts'));
    }

    public function posts()
    {
        $categories = Category::all();
        $posts = Post::filter(request(['search', 'user', 'category']))->latest('id')->with(['user', 'category'])->paginate(8)->withQueryString();
        return view('front.posts', compact('posts', 'categories'));
    }

    public function post(Post $post)
    {
        if (!($post->showPost())) {
            $post->increment('views');
            PostView::createViewLog($post);
        }
        $relatedPosts = Post::where('category_id', $post->category_id)->whereNot('id', $post->id)->take(3)->get();
        return view('front.post', compact('post', 'relatedPosts'));
    }
    
    public function dashboard(Request $request)
    {
        $postCount = Post::when($request->user()->isAdmin(), function ($q) {
            $q;
        })
        ->when($request->user()->isAuthor(), function ($q) {
            $q->where('user_id', request()->user()->id);
        })
        ->count();

        $recentPosts = Post::latest('id')->when($request->user()->isAuthor(), function($q) {
            $q->where('user_id', request()->user()->id);
        })->with(['user'])->take(5)->get();

        $recentComments = Comment::latest('id')->when(request()->user()->isAuthor(), function ($q) {
            $q->whereHas('post', function ($q) {
                $q->where('user_id', request()->user()->id);
            });
        })->take(5)->get();

        $views = PostView::select(DB::raw('country_id'), DB::raw('count(*) as count'))->when(request()->user()->isAuthor(), function ($q) {
            $q->whereHas('post', function ($q) {
                $q->where('user_id', request()->user()->id);
            });
        })->with(['country:id,name'])->groupBy('country_id')->orderBy('count', 'DESC')->take(4)->get();

        $from = Carbon::now()->subDays(8);
        $to = Carbon::now();
        $viewsByDate =
            PostView::select('id', DB::raw('DATE(created_at) AS date'), DB::raw('count(*) as count'))->where(function ($q) use ($to) {
                $q->when(request()->user()->isAuthor(), function ($q) {
                    $q->whereHas('post', function ($q) {
                        $q->where('user_id', request()->user()->id);
                    });
                })->whereDate('date', '<=', $to);
            })->groupBy('date')->get();

        $totalDate = 8;
        $dateArr = [];
        for ($i = 0; $i <= $totalDate; $i++) {
            $date = Carbon::now()->subDays($i);
            $dateArr[] = $date;
            if (!isset($viewsByDate[$i])) {
                $object = new stdClass();
                $object->count = '0';
                $object->date = $date;
                $viewsByDate[$i] = $object;
            }
            $viewsByDate[$i]->date = $date;
        }

        if ($request->user()->isAdmin() || $request->user()->isEditor()) {
            $recentUsers = User::latest('id')->take(5)->get();

            $userCount = User::count();

            $commentCount = Comment::count();

            $postViewCount = PostView::count();

            return view('dashboard.index', compact('postCount', 'userCount', 'commentCount', 'postViewCount', 'recentPosts', 'recentComments', 'recentUsers','views', 'viewsByDate'));
        }

        if($request->user()->isAuthor()) {

            $commentCount = Comment::whereHas('post', function($q) {
                $q->where('user_id',request()->user()->id);
            })->count();

            $personalCommentCount = $request->user()->comments()->count();

            $postViewCount = PostView::whereHas('post', function($q) {
                $q->where('user_id', request()->user()->id);
            })->count();
        }

        return view('dashboard.index', compact('postCount', 'commentCount','personalCommentCount', 'recentPosts', 'recentComments','views', 'postViewCount', 'viewsByDate'));
    }
}
