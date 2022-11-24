<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\PostView;
use App\Models\User;
use Illuminate\Http\Request;

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
        $recentPosts = Post::latest('id')->with(['user'])->take(5)->get();
        $recentComments = Comment::latest('id')->take(5)->get();
        $recentUsers = User::latest('id')->take(5)->get();

        $postCount = Post::when($request->user()->isAdmin(), function ($q) {
            $q;
        })
            ->when($request->user()->isAuthor(), function ($q) {
                $q->where('user_id', request()->user()->id);
            })
            ->count();

        $userCount = User::count();

        if ($request->user()->isAuthor()) {
            $personalCommentCount = $request->user()->comments()->count();
        }

        $commentCount = Comment::count();

        $postViewCount = PostView::count();

        if ($request->user()->isAdmin()) {
            return view('dashboard.index', compact('postCount', 'userCount', 'commentCount', 'postViewCount', 'recentPosts', 'recentComments', 'recentUsers'));
        }

        return view('dashboard.index', compact('postCount', 'personalCommentCount'));
    }
}
