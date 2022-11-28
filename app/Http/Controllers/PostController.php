<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Photo;
use App\Models\PostView;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::when(request()->user()->isAuthor(), function ($q) {
            $q->where("user_id", request()->user()->id);
        })->when(request('keyword'), function ($q) {
            $q->where(function ($query) {
                $keyword = request('keyword');
                $query->orwhere('title', "like", "%$keyword%")->orWhere("description", "like", "%$keyword%");
            });
        })->latest('id')->with(['category', 'user'])->paginate(15)->withQueryString();

        return view('dashboard.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $dom = new \DomDocument();
        @$dom->loadHtml($request->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');

        $imageNames = [];
        foreach ($imageFile as $item => $image) {
            $data = $image->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $imageData = base64_decode($data);
            $imageExtension = explode('/', $type)[1];
            $image_name = uniqid() . "_photos." . "$imageExtension";
            $image_name_with_storage = "/storage/" .$image_name;
            $imageNames[] = $image_name;
            $path = public_path() . "/storage/" . $image_name;
            file_put_contents($path, $imageData);

            $image->removeAttribute('src');
            $image->setAttribute('src', $image_name_with_storage);
        }

        $body = $dom->saveHTML();

        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description, 50, ' ...');
        $post->body = json_encode($body);
        $post->user_id = Auth::id();
        $post->category_id = $request->category;

        if ($request->hasFile('featured_image')) {
            $newName = uniqid() . "_featured_image." . $request->file('featured_image')->extension();

            $thumbName = 'small_' . $newName;
            $img = $request->file('featured_image');
            $imgFile = Image::make($img->getRealPath());
            $destinationPath = public_path('storage/thumbnails/' . $thumbName);
            $imgFile->resize(480, 300)->save($destinationPath);

            $request->file('featured_image')->storeAs('public', $newName);
            $post->featured_image = $newName;
        }

        $post->save();

        foreach ($imageNames as $name) {
            Photo::create([
                "post_id" => $post->id,
                "name" => $name
            ]);
        }

        return redirect()->route('dashboard.post.index')->with([
            "message" => $post->title . " is added successfully.",
            "status" => "success"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $postViewers = PostView::with(['user'])->where('post_id', $post->id)->paginate(8, ['*'], 'views')->withQueryString();
        $comments = Comment::where('post_id', $post->id)
            ->when(
                request('commentKeyword'),
                function ($q) {
                    $keyword = request('commentKeyword');
                    $q->where("body", "like", "%$keyword%");
                }
            )
            ->paginate(8, ['*'], 'comments')->withQueryString();
        return view('dashboard.posts.show', compact('post', 'comments', 'postViewers'));
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
        $photos = Photo::select('name')->where('post_id', $post->id)->get();
        $existedPhotos = collect($photos)->map(function ($photo) {
            return '/storage/'.$photo->name;
        });

        $request->body = $this->teaser($request->body);

        $dom = new \DomDocument();
        @$dom->loadHtml($request->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');
        $imageNames = [];
        $imageNotToDelete = [];
        foreach ($imageFile as $item => $image) {
            $data = $image->getAttribute('src');
            if (!in_array($data, $existedPhotos->toArray())) {
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $imageData = base64_decode($data);
                $imageExtension = explode('/', $type)[1];
                $image_name = uniqid() . "_photos." . "$imageExtension";
                $image_name_with_storage = "/storage/" . $image_name;
                $imageNames[] = $image_name;
                $path = public_path() . "/storage/" . $image_name;
                file_put_contents($path, $imageData);

                $image->removeAttribute('src');
                $image->setAttribute('src', $image_name_with_storage);
            } else {
                $imageNotToDelete[] = $data;
            }
        }

        $body = $dom->saveHTML();

        // add new image to db
        foreach ($imageNames as $name) {
            Photo::create([
                "post_id" => $post->id,
                "name" => $name
            ]);
        }

        // delete if photo doesn't exist
        foreach($existedPhotos as $photo){
            if(!in_array($photo,$imageNotToDelete)) {
                $photo = explode('/storage/',$photo)[1];
                // delete photo from storage
                Storage::delete('public/' . $photo);
                //delte from table
                $photo = Photo::where('name',$photo)->first();
                $photo->delete();
            }
        }

        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description, 50, ' ...');
        $post->body = json_encode($body);
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

        return redirect()->route('dashboard.post.index')->with([
            "message" => $post->title . " is updated successfully.",
            "status" => "success"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $photos = Photo::where('post_id',$post->id)->get();

        $existedPhotos = collect($photos)->map(function ($photo) {
            return '/public/'.$photo->name;
        });

        if($existedPhotos) {
            Storage::delete($existedPhotos->toArray());
        }
        
        $title = $post->title;

        if (isset($post->featured_image)) {
            Storage::delete('public/' . $post->featured_image);
        }
        $post->delete();
        return redirect()->route('dashboard.post.index')->with([
            "message" => $title . ' is deleted Successfully',
            "status" => "success"
        ]);
    }

    private function teaser($html)
    {
        $html = str_replace('&nbsp;', ' ', $html);
        do {
            $tmp = $html;
            $html = preg_replace(
                '#<([^ >]+)[^>]*>[[:space:]]*</\1>#',
                '',
                $html
            );
        } while ($html !== $tmp);

        return $html;
    }
}
