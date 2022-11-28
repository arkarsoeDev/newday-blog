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
                        <img src="{{ asset('storage/' . $post->featured_image) }}"
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
                            <div class="bg-dark rounded-circle p-3 me-2 post__profile"></div>
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
                    {!! $post->description !!}
                </p>
                <div class="post__body">
                    {!! json_decode($post->body) !!}
                </div>
                <p id="testinner">
                    this iss upper
                    <img style="width:200px" src="{{ asset('storage/image-not-available.png') }}" alt="">
                    this is inner
                </p>
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
                            <div href="">
                                <div class="d-inline-flex justify-content-start align-items-center mb-2">
                                    <div class="bg-dark rounded-circle p-3 me-2 c-card__profile"></div>
                                    <span class="fw-bold c-card__author">{{ $comment->user->name }}</span>
                                </div>
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
            <div class="row">
                @foreach ($relatedPosts as $post)
                    <div class="col-12">
                        <div class="c-card c-card--small my-3">
                            <div class="c-card__body">
                                <a href="{{ route('page.post', $post->slug) }}">
                                    <p class="c-card__title">
                                        {{ $post->title }}
                                    </p>
                                </a>
                                <p class="c-card__excert">
                                    {{ $post->excerpt }}
                                </p>
                            </div>
                        </div>
                        <div class="spacer"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="spacer d-none d-lg-block"></div>
    @push('scripts')
        <script>
            let inner = document.querySelector('#testinner');
            console.log(inner.innerText);
        </script>
    @endpush
</x-front-layout>   
