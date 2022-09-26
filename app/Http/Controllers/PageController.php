<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $latestPosts = Post::latest('id')->with(['user','category'])->take(4)->get();
        // return $latestPosts;
        return view('front.index',compact('latestPosts'));
    }

    public function posts()
    {
        $categories = Category::all();
        $posts = Post::filter(request(['search','user','category']))->latest('id')->with(['user','category'])->paginate(8)->withQueryString();
        return view('front.posts',compact('posts','categories'));
    }

    public function post(Post $post)
    {
        $relatedPosts = Post::where('category_id',$post->category_id)->whereNot('id',$post->id)->take(3)->get();
        return view('front.post',compact('post','relatedPosts'));
    }   

    public function dashboard()
    {
        return view('dashboard.index');
    }
}