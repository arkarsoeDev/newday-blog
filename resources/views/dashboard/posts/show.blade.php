<x-dashboard-layout>

    <x-dashboard.heading>Post Management</x-dashboard.heading>

    <div class="post-show">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card c-card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="h4">Post Detail</h2>
                            <a href="{{ url()->previous() }}"
                                class="btn btn-primary text-white fw-bold text-decoration-none"><i
                                    class="bi bi-chevron-left me-1"></i> Back</a>
                        </div>
                        <hr>
                        <div class="mb-3 ">
                            <span class="fw-bold post-detail__label">Front panel post link</span> <a href="{{ route('page.post',$post->slug) }}"
                                class="post-detail__info">{{ $post->slug }}</a>
                        </div>
                        <div class="mb-3 ">
                            <span class="fw-bold post-detail__label">Post Id</span> <span
                                class="post-detail__info">{{ $post->id }}</span>
                        </div>
                        <div class="mb-3 ">
                            <span class="fw-bold post-detail__label">Title</span> <span
                                class="post-detail__info">{{ $post->title }}</span>
                        </div>
                        <div class="mb-3">
                            <span class="fw-bold post-detail__label">Description</span> <span
                                class="post-detail__description">{{ $post->description }}</span>
                        </div>
                        <div class="mb-3 ">
                            <span class="fw-bold post-detail__label">Created At</span> <span>

                                <span class="post-detail__info"><i class="bi bi-calendar"></i>
                                    {{ $post->created_at->format('d M Y') }}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card c-card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Featured Image
                                </h5>
                                <div class="post-show__img-container d-flex align-items-center justify-content-center">
                                    @isset($post->featured_image)
                                        @if ($post->featured_image !== 'image-not-available.png')
                                            <img src="{{ asset('storage/' . $post->featured_image) }}" height="200"
                                                class="post-show__featured-img rounded" alt="">
                                        @else
                                            <div>
                                                No image is uploaded yet.
                                            </div>
                                        @endif
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card c-card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Category
                                </h5>
                                <div class="post-show__partial">
                                    <div class="post-show__partial-item mb-2">
                                        <span class="label">Id</span>
                                        <span>{{ $post->category->id }}</span>
                                    </div>
                                    <div class="post-show__partial-item">
                                        <span class="label">Title</span>
                                        <span>{{ $post->category->title }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card c-card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">
                                    User
                                </h5>
                                <div class="post-show__user">
                                    <div class="post-show__partial-item mb-2">
                                        <span class="label">Id</span>
                                        <span>{{ $post->user->id }}</span>
                                    </div>
                                    <div class="post-show__partial-item">
                                        <span class="label">Title</span>
                                        <span>{{ $post->category->title }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-10">
                <div class="card c-card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="d-flex align-items-center mb-3 mb-sm-0">
                                <h2 class="h4 text-dark me-3 mb-0">
                                Comments List
                                </h2>
                                <span class="fw-bold px-2 p-1 bg-info rounded">{{ $comments->count() }}</span>
                            </div>
                            <div class="flex-fill"></div>
                            <form action="{{ route('dashboard.post.show',$post->slug) }}" class="d-sm-inline-block mb-3 mb-sm-0">
                                <div class="input-group w-auto">
                                    <input type="text" class="form-control" name="commentKeyword" placeholder="Search keyword" value="{{ request('commentKeyword') }}"
                                        aria-label="search keyword" aria-describedby="commentSearchBtn" />
                                    <button class="btn btn-primary" type="submit" id="commentSearchBtn">
                                        <i class="bi bi-search text-gray-300"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">
                                            Comment
                                        </th>
                                        <th scope="col" class="text-nowrap">
                                            Owner
                                        </th>
                                        <th>Control</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($comments as $comment)
                                        <tr>
                                            <th scope="row">{{ $comment->id }}</th>
                                            <td class="mw-2">
                                                {{ $comment->excerpt }}
                                            </td>
                                            <td class="text-nowrap">
                                                {{ $comment->user->name }}
                                            </td>
                                            <td class="text-nowrap">
                                                <a href="{{ route('dashboard.comment.show', $comment->id) }}"
                                                    class="btn btn-sm btn-outline-info"><i
                                                        class="bi bi-info-circle"></i></a>
                                                @can('delete', $comment)
                                                    <form id="deleteForm{{ $comment->id }}"
                                                        action="{{ route('dashboard.comment.destroy', $comment->id) }}"
                                                        class="d-inline-block" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button id="deleteSubmit{{ $comment->id }}"
                                                            data-form="deleteForm{{ $comment->id }}" type="button"
                                                            data-comment-id="{{ $comment->id }}"
                                                            class="deleteSubmit btn btn-sm btn-outline-danger"><i
                                                                class="bi bi-trash"></i></button>
                                                    </form>
                                                @endcan
                                            </td>
                                            <td class="text-nowrap">
                                                <p class="small mb-1 text-black-50">
                                                    <i class="bi bi-calendar"></i>
                                                    {{ $comment->created_at->format('d M Y') }}
                                                </p>
                                                <p class="small mb-0 text-black-50">
                                                    <i class="bi bi-clock"></i>
                                                    {{ $comment->created_at->format('h : m A') }}
                                                </p>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="6">There is no comment yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div>{{ $comments->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-10">
                <div class="card c-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="d-flex align-items-center mb-3 mb-sm-0">
                                <h2 class="h4 text-dark me-3 mb-0">
                                Views List
                                </h2>
                                <span class="fw-bold px-2 p-1 bg-info rounded">{{ $postViewers->count() }}</span>
                            </div>
                            <div class="flex-fill"></div>
                            {{-- <form action="{{ route('dashboard.post.show',$post->slug) }}" class="d-sm-inline-block mb-3 mb-sm-0">
                                <div class="input-group w-auto">
                                    <input type="text" class="form-control" name="commentKeyword" placeholder="Search keyword" value="{{ request('commentKeyword') }}"
                                        aria-label="search keyword" aria-describedby="commentSearchBtn" />
                                    <button class="btn btn-primary" type="submit" id="commentSearchBtn">
                                        <i class="bi bi-search text-gray-300"></i>
                                    </button>
                                </div>
                            </form> --}}
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">
                                            User id
                                        </th>
                                        <th>User name</th>
                                        <th>IP address</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($postViewers as $viewer)
                                        <tr>
                                            <th scope="row">{{ $viewer->id }}</th>
                                            <td class="text-nowrap">
                                                {{ $viewer->user_id }}
                                            </td>
                                            <td class="text-nowrap">
                                                {{ $viewer->user->name }}
                                            </td>
                                            <td class="text-nowrap">
                                                {{ $viewer->ip }}
                                            </td>
                                            <td class="text-nowrap">
                                                <p class="small mb-1 text-black-50">
                                                    <i class="bi bi-calendar"></i>
                                                    {{ $comment->created_at->format('d M Y') }}
                                                </p>
                                                <p class="small mb-0 text-black-50">
                                                    <i class="bi bi-clock"></i>
                                                    {{ $comment->created_at->format('h : m A') }}
                                                </p>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="6">There is no viewer yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div>{{ $postViewers->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
