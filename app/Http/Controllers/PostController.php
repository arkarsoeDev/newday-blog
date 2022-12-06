<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\PostView;
use App\Models\Tag;
use Faker\Provider\Uuid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
        // I'll find another way to delete the image
        $medias = Media::where('temp_model_id', request()->user()->id)->get();
        if (count($medias) >= 1) {
            Media::destroy($medias);
        }
        $tags = Tag::all();
        $categories = Category::all();
        return view('dashboard.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        // get medias which are connected with temp premade model id
        $medias = Media::where('temp_model_id', $request->user()->id)->get();

        $existedUrlArr = [];
        $bodyUrlArr = [];
        $toDeleteMediaIdArr = [];
        $toUpdateMediaIdArr = [];

        // collect existed url in db
        foreach ($medias as $image) {
            $existedUrlArr[] = $image->id . '/' . $image->file_name;
        }

        //collect body url arr
        $dom = new \DomDocument();
        @$dom->loadHtml($request->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');

        foreach ($imageFile as $item => $image) {
            $data = $image->getAttribute('src');
            $data = explode('storage/', $data)[1];
            $bodyUrlArr[] = $data;
        }

        //check media should be delete or update
        foreach ($existedUrlArr as $url) {
            [$id, $name] = explode('/', $url);
            if (!in_array($url, $bodyUrlArr)) {
                $toDeleteMediaIdArr[] = $id;
            } else {
                $toUpdateMediaIdArr[] = $id;
            }
        }

        Media::destroy($toDeleteMediaIdArr);

        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description, 50, ' ...');
        $post->body = clean($request->body, array('Attr.EnableID' => true));
        $post->user_id = Auth::id();
        $post->category_id = $request->category;

        if ($request->hasFile('featured_image')) {
            $newName = uniqid() . "_featured_image." . $request->file('featured_image')->extension();

            $thumbName = 'small_' . $newName;
            $img = $request->file('featured_image');
            $imgFile = Image::make($img->getRealPath());

            $thumbName = 'small_' . $newName;
            $destinationPath = public_path('storage/thumbnails/' . $thumbName);
            $imgFile->resize(100, 100)->save($destinationPath);

            $thumbName = 'medium_' . $newName;
            $destinationPath = public_path('storage/thumbnails/' . $thumbName);
            $imgFile->resize(480, 300)->save($destinationPath);

            $request->file('featured_image')->storeAs('public/uploads', $newName);
            $post->featured_image = $newName;
        }

        $post->save();
        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }
        Media::whereIn('id', $toUpdateMediaIdArr)->update(['model_id' => $post->id, 'temp_model_id' => null]);

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
        $postViewers = PostView::with(['user'])->where('post_id', $post->id)->when(request('viewKeyword'), function ($q) {
            $q->where(function ($query) {
                $keyword = request('viewKeyword');
                $query->orwhere('id', "like", "%$keyword%")->orWhereHas("user", function ($query) use ($keyword) {
                    $query->where("name", "like", "%$keyword%");
                });
            });
        })->paginate(8, ['*'], 'views')->withQueryString();
        
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
        // I'll find another way to delete the images
        $medias = Media::where('temp_model_id', request()->user()->id)->get();
        if (count($medias) >= 1) {
            Media::destroy($medias);
        }
        $categories = Category::all();
        $tags = Tag::all();
        $postTags = $post->tags->map(function ($tag) {
            return $tag->id;
        })->toArray();
        return  view('dashboard.posts.edit', compact("post", "categories", "tags", "postTags"));
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
        // get old medias
        $medias = $post->getMedia('images');

        // get new medias which are connected with temp premade model id
        $newMedias = Media::where('temp_model_id', request()->user()->id)->get();

        $medias = [...$medias, ...$newMedias];

        $existedUrlArr = [];
        $bodyUrlArr = [];
        $toDeleteMediaIdArr = [];
        $toUpdateMediaIdArr = [];

        // collect existed url in db
        foreach ($medias as $image) {
            $existedUrlArr[] = $image->id . '/' . $image->file_name;
        }

        //collect body url arr
        $dom = new \DomDocument();
        @$dom->loadHtml($request->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');

        foreach ($imageFile as $item => $image) {
            $data = $image->getAttribute('src');
            $data = explode('storage/', $data)[1];
            $bodyUrlArr[] = $data;
        }

        //check media should be delete or update
        foreach ($existedUrlArr as $url) {
            [$id, $name] = explode('/', $url);
            if (!in_array($url, $bodyUrlArr)) {
                $toDeleteMediaIdArr[] = $id;
            } else {
                $toUpdateMediaIdArr[] = $id;
            }
        }

        Media::destroy($toDeleteMediaIdArr);
        Media::whereIn('id', $toUpdateMediaIdArr)->update(['model_id' => $post->id, 'temp_model_id' => null]);

        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description, 50, ' ...');
        $post->body = clean($request->body, array('Attr.EnableID' => true));
        $post->user_id = Auth::id();
        $post->category_id = $request->category;

        if ($request->hasFile('featured_image')) {

            $photos = [
                'public/uploads/' . $post->featured_image,
                'public/thumbnails/medium_' . $post->featured_image,
                'public/thumbnails/small_' . $post->featured_image,
            ];
            // delete photo from storage
            Storage::delete($photos);

            // add photo
            $newName = uniqid() . "_featured_image." . $request->file('featured_image')->extension();

            $img = $request->file('featured_image');
            $imgFile = Image::make($img->getRealPath());

            $thumbName = 'small_' . $newName;
            $destinationPath = public_path('storage/thumbnails/' . $thumbName);
            $imgFile->resize(100, 100)->save($destinationPath);

            $thumbName = 'medium_' . $newName;
            $destinationPath = public_path('storage/thumbnails/' . $thumbName);
            $imgFile->resize(480, 300)->save($destinationPath);

            $request->file('featured_image')->storeAs('public/uploads', $newName);
            $post->featured_image = $newName;
        }
        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
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
        $title = $post->title;

        if (isset($post->featured_image) && $post->featured_image != 'image-not-available.png') {
            $photos = [
                'public/uploads/' . $post->featured_image,
                'public/thumbnails/medium_' . $post->featured_image,
                'public/thumbnails/small_' . $post->featured_image,
            ];
            Storage::delete($photos);
        }

        $post->delete();
        return redirect()->route('dashboard.post.index')->with([
            "message" => $title . ' is deleted Successfully',
            "status" => "success"
        ]);
    }
}
