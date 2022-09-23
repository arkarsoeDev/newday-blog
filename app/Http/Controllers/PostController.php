<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest('id')->with(['category', 'user'])->paginate(15);
        return view('dashboard.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description, 50, ' ...');
        $post->user_id = Auth::id();
        $post->category_id = $request->category;

        if ($request->hasFile('featured_image')) {
            $newName = uniqid() . "_featured_image." . $request->file('featured_image')->extension();
            $request->file('featured_image')->storeAs('public', $newName);
            $post->featured_image = $newName;
        }

        $post->save();

        return redirect()->route('dashboard.post.index')->with("status", $post->title . " is added successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return  view('dashboard.posts.edit', compact("post"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description, 50, ' ...');
        $post->user_id = Auth::id();
        $post->category_id = $request->category;

        if ($request->hasFile('featured_image')) {

            // delete photo from storage
            Storage::delete('public/' . $post->featured_image);


            // add photo
            $newName = uniqid() . "_featured_image." . $request->file('featured_image')->extension();
            $request->file('featured_image')->storeAs('public', $newName);
            $post->featured_image = $newName;
        }

        $post->update();

        return redirect()->route('dashboard.post.index')->with("status", $post->title . " is updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $title = $post->title;
        if (isset($post->featured_image)) {
            Storage::delete('public/' . $post->featured_image);
        }
        $post->delete();
        return redirect()->route('dashboard.post.index')->with("status", $title . ' is deleted Successfully');
    }
}