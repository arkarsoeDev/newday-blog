<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\PostView;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostViewController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(PostView::class, 'post_view');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $views = PostView::with(['user'])->when(request()->user()->isAuthor(), function ($q) {
            $q->whereHas('post', function ($q) {
                $q->where('user_id', request()->user()->id);
            });
        })->when(request('keyword'), function ($q) {
            $q->where(function ($query) {
                $keyword = request('keyword');
                $query->orwhere('slug', "like", "%$keyword%")->orWhereHas("user", function ($query) use ($keyword) {
                    $query->where("name", "like", "%$keyword%");
                });
            });
        })->latest('id')->paginate(8)->onEachSide(1)->withQueryString();
        return view('dashboard.post-views.index', compact('views'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostView  $postView
     * @return \Illuminate\Http\Response
     */
    public function show(PostView $postView)
    {
        $view = PostView::with(['user', 'post', 'country'])->findOrFail($postView->id);
        return view('dashboard.post-views.show', compact('view'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostView  $postView
     * @return \Illuminate\Http\Response
     */
    public function edit(PostView $postView)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostView  $postView
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostView $postView)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostView  $postView
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostView $postView)
    {
        $id = $postView->id;
        $postView->delete();
        return redirect()->route('dashboard.post.index')->with([
            "message" => 'Post view id ' . $id . ' is deleted Successfully',
            "status" => "success"
        ]);
    }

    /**
     * Display listing of views by country.
     *
     * @return \Illuminate\Http\Response
     */
    public function postViewsByCountry()
    {
        $views = PostView::select(DB::raw('country_id,id'), DB::raw('count(*) as count'))->when(request('keyword'), function ($q) {
            $keyword = request('keyword');
            $q->whereHas("country", function ($query) use ($keyword) {
                $query->where("name", "like", "%$keyword%");
            });
        })->when(request()->user()->isAuthor(), function ($q) {
            $q->whereHas('post', function ($q) {
                $q->where('user_id', request()->user()->id);
            });
        })->with(['country:id,name'])->groupBy('country_id')->orderBy('count', 'DESC')->paginate(8)->withQueryString()->onEachSide(1);

        return view('dashboard.post-views.by-country', compact('views'));
    }

    /**
     * Display listing of views by date.
     *
     * @return \Illuminate\Http\Response
     */
    public function postViewsByDate()
    {
        $now = Carbon::now()->addDays(1)->toDateString();
        $operator = '<=';

        $views = PostView::select('id', DB::raw('DATE(created_at) AS date'), DB::raw('count(*) as count'))->whereDate('created_at', '<=', $now)
            ->when(request('to') && request('from'), function ($q) {
                $from = request('from');
                $to = request('to');
                $q->whereDateBetween('created_at', $from, $to);
            })
            ->when(request('to') && (request('from') == null), function ($q) {
                $to = request('to');
                $q->whereDate('created_at', '<=', $to);
            })
            ->when(request('from') && (request('to') == null), function ($q) {
                $from = request('from');
                $q->whereDate('created_at', '>=', $from);
            })->when(request()->user()->isAuthor(), function ($q) {
                $q->whereHas('post', function ($q) {
                    $q->where('user_id', request()->user()->id);
                });
            })
            ->groupBy('date')->paginate(8)->withQueryString()->onEachSide(1);
        return view('dashboard.post-views.by-date', compact('views'));
    }
}
