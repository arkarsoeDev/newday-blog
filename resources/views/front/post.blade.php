<x-front-layout>
    <x-slot name="breadcrumb">
        <x-front.breadcrumb>
            <li class="breadcrumb-item">
                <a href="{{ route('page.posts') }}">Posts</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ $post->title }}
            </li>
        </x-front.breadcrumb>
    </x-slot>

    <div class="row my-3 my-lg-5 gx-lg-5">
        <div class="col-12 col-lg-8">
            <div class="post">
                <figure class="figure">
                    <img src="{{ asset('storage/uploads/' . $post->featured_image) }}"
                        class="figure-img img-fluid post__img" alt="..." />
                    <figcaption class="figure-caption">
                        A caption for the above image.
                    </figcaption>
                </figure>
                <div class="post__info-container">
                    <a href="{{ route('page.posts', ['category' => $post->category->slug]) }}"><span
                            class="badge bg-primary rounded-4 post__category mb-3 mb-sm-0">{{ $post->category->title }}</span></a>
                    <div class="d-flex justify-content-end justify-content-sm-between align-items-center flex-wrap">

                        <div class="d-flex justify-content-between align-items-center me-lg-3 mb-3 mb-sm-0">
                            <div
                                class="post__profile-img-container d-flex align-items-center justify-content-center me-1">
                                @if ($post->user->profile_image)
                                    <img src="{{ asset('storage/thumbnails/small_' . $post->user->profile_image) }}"
                                        class="post__profile-img me-3" alt="">
                                @else
                                    <div class="post__profile-img-icon">
                                        <x-icons.user></x-icons.user>
                                    </div>
                                @endif
                            </div>
                            <span class="fw-bold post__author">{{ $post->user->name }}</span>
                        </div>

                        <div class="dash d-none"></div>

                        <span class="fw-bold post__date d-inline-block ms-3 mb-3 mb-sm-0"><i class="bi bi-calendar"></i>
                            {{ $post->created_at->format('d M Y') }}</span>

                    </div>
                </div>
                <h1 class="post__title">
                    {{ $post->title }}
                </h1>
                <p class="post__para">
                    {{ $post->description }}
                </p>
                <div class="post__body mb-3">
                    {!! $post->body !!}
                </div>
            </div>
            <div class="spacer"></div>
            <div class="comment-form my-3 my-lg-4">
                @guest
                    <div class="fs-5 fw-bold"><span>Want to leave a comment ? Please <a
                                href="{{ route('login') }}">Login</a> or <a
                                href="{{ route('register') }}">Register</a></span></div>
                @endguest
                @auth
                    <form action="{{ route('dashboard.comment.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="mb-3">
                            <label for="comment" class="form-label">Write Comment</label>
                            <textarea class="form-control" id="comment" rows="6" name="body"></textarea>
                        </div>
                        <div class="w-100 text-end">
                            <button type="submit" class="btn btn-primary text-white">
                                Submit
                            </button>
                        </div>
                    </form>
                @endauth
            </div>
            <div class="spacer"></div>
            <div class="mt-3 mt-lg-5">
                <h3 class="h3 mb-4">
                    Comments
                    <span class="badge bg-primary">{{ $post->comments->count() }}</span>
                </h3>
                <div class="comments">
                    @forelse ($post->comments as $key=>$comment)
                        <div class="comment">
                            @can('delete', $comment)
                                <form action="{{ route('dashboard.comment.destroy', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="comment__delete rounded-circle shadow border border-1"><i
                                            class="bi bi-x fs-4"></i></button>
                                </form>
                            @endcan
                            <div>
                                <div class="d-inline-flex justify-content-start align-items-center mb-2">
                                    <div
                                        class="comment__profile-img-container d-flex align-items-center justify-content-center me-1">
                                        
                                        @if ($comment->user->profile_image)
                                            <img src="{{ asset('storage/thumbnails/small_' . $comment->user->profile_image) }}"
                                                class="comment__profile-img me-3" alt="">
                                        @else
                                            <div class="comment__profile-img-icon">
                                                <x-icons.user></x-icons.user>
                                            </div>
                                        @endif
                                    </div>
                                    <span class="fw-bold comment__author">{{ $comment->user->name }}</span>
                                </div>
                                <div class="comment__content">
                                    <p class="comment__text">
                                        {{ $comment->body }}
                                    </p>
                                </div>

                                <div class="comment__date">
                                    <span>{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>There is no comment yet</p>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="spacer d-lg-none"></div>
        <div class="col-12 col-lg-4">
            <h2 class="my-3 mb-lg-3 mt-lg-0 h3 c-title">
                Related Post
            </h2>
            <div class="row mb-3">
                @foreach ($relatedPosts as $relatedPost)
                    <div class="col-12">
                        <div class="c-card c-card--small my-3">
                            <div class="c-card__body">
                                <a href="{{ route('page.post', $relatedPost->slug) }}">
                                    <p class="c-card__title">
                                        {{ $relatedPost->title }}
                                    </p>
                                </a>
                                <p class="c-card__excert">
                                    {{ $relatedPost->excerpt }}
                                </p>
                            </div>
                        </div>
                        <div class="spacer"></div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="post__tags">
                        <p class="fs-5 fw-bold">Tags</p>
                        @forelse ($post->tags as $tag)
                            <a href="{{ route('page.posts', ['tag' => $tag->slug, ...request()->query()]) }}"
                                class="btn text-decoration-none post__tag-btn me-1 mb-2 {{ request('tag') == $tag->slug ? 'btn-primary' : 'btn-outline-primary' }}">{{ $tag->title }}</a>
                        @empty
                            <div class="flex justify-content-center align-items-center">
                                <span>No tags is attach</span>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="spacer d-block"></div>
</x-front-layout>
