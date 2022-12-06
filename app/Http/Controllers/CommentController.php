<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    public function __construct()
    {
        return $this->authorizeResource(Comment::class,'comment');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('list') && request('list') == 'personal') {
            $comments = request()->user()->comments()->with(['user'])->paginate(10)->withQueryString();
            return view('dashboard.comments.index', compact('comments'));
        }
        $comments = Comment::when(request()->user()->isAuthor(), function ($q) {
            $q->where(function($q) {
                $q->where('user_id','!=',request()->user()->id)->
                whereHas('post', function ($q) {
                    $q->where('user_id', request()->user()->id);
                });
            });
        })->when(request('keyword'), function ($q) {
            $keyword = request('keyword');  
            $q->where("body", "like", "%$keyword%");
        })->latest('id')->with(['user'])->paginate(10)->withQueryString();

        return view('dashboard.comments.index', compact('comments'));
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
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request)
    {
        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->user_id = $request->user()->id;
        $comment->body = $request->body;
        $comment->excerpt = Str::words($request->body, 50, ' ...');
        $comment->save();

        return redirect()->back()->with([
            "message" => 'Comment is added Successfully',
            "status" => "success"
        ]);;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return view('dashboard.comments.comment',compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->back()->with([
            "message" => 'Comment is deleted Successfully',
            "status" => "success"
        ]);
    }
}