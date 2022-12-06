<x-dashboard-layout>

    <x-dashboard.heading>Post Management</x-dashboard.heading>

    <div class="post-show">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card c-card mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h2 class="h4 mb-0">Post Detail</h2>
                            <div class="flex-fill"></div>
                            @can('update', $post)
                                <a href="{{ route('dashboard.post.edit', $post->slug) }}"
                                    class="btn btn-sm btn-outline-success">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            @endcanany
                        </div>
                        <hr>
                        <div class="mb-3 ">
                            <span class="fw-bold value-detail__label">Front panel post link</span> <a
                                href="{{ route('page.post', $post->slug) }}"
                                class="value-detail__info">{{ $post->slug }}</a>
                        </div>
                        <div class="mb-3 ">
                            <span class="fw-bold value-detail__label">Post Id</span> <span
                                class="value-detail__info">{{ $post->id }}</span>
                        </div>
                        <div class="mb-3 ">
                            <span class="fw-bold value-detail__label">Title</span> <span
                                class="value-detail__info">{{ $post->title }}</span>
                        </div>
                        <div class="mb-3">
                            <span class="fw-bold value-detail__label">Description</span> <span
                                class="post-detail__description">{{ $post->description }}</span>
                        </div>
                        <div class="mb-3">
                            <span class="fw-bold value-detail__label">Body</span> <span
                                class="post-detail__body">{!! $post->body !!}</span>
                        </div>
                        <div class="mb-3 ">
                            <span class="fw-bold value-detail__label">Created At</span> <span>

                                <span class="value-detail__info"><i class="bi bi-calendar"></i>
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
                                            <img src="{{ asset('storage/uploads/' . $post->featured_image) }}"
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
                                <div class="value-detail__partial">
                                    <div class="value-detail__partial-item mb-2">
                                        <span class="label">Id</span>
                                        <span>{{ $post->category->id }}</span>
                                    </div>
                                    <div class="value-detail__partial-item">
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
                                    Tags
                                </h5>
                                <div class="value-detail__partial">
                                    <div class="value-detail__tags-container">
                                        @forelse($post->tags as $tag)
                                            <div class="value-detail__partial-item text-decoration-none me-1 mb-2 ">
                                                {{ $tag->title }}</div>
                                        @empty
                                            <div class="d-flex align-items-center justify-content-center">
                                                <p>No tag is attached yet.</p>
                                            </div>
                                        @endforelse
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
                                <div class="value-detail__user">
                                    <div class="value-detail__partial-item mb-2">
                                        <span class="label">Id</span>
                                        <span>{{ $post->user->id }}</span>
                                    </div>
                                    <div class="value-detail__partial-item">
                                        <span class="label">Name</span>
                                        <span>{{ $post->user->name }}</span>
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
                            <form action="{{ route('dashboard.post.show', $post->slug) }}"
                                class="d-sm-inline-block mb-3 mb-sm-0">
                                <div class="input-group w-auto">
                                    <input type="text" class="form-control" name="commentKeyword"
                                        placeholder="Search keyword" value="{{ request('commentKeyword') }}"
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
                                                    <form id="deleteCommentForm{{ $comment->id }}"
                                                        action="{{ route('dashboard.comment.destroy', $comment->id) }}"
                                                        class="d-inline-block" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button id="deleteComment{{ $comment->id }}"
                                                            data-form="deleteCommentForm{{ $comment->id }}" type="button"
                                                            data-comment-id="{{ $comment->id }}"
                                                            class="deleteComment btn btn-sm btn-outline-danger"><i
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
                            <form action="{{ route('dashboard.post.show', $post->slug) }}"
                                class="d-sm-inline-block mb-3 mb-sm-0">
                                <div class="input-group w-auto">
                                    <input type="text" class="form-control" name="viewKeyword"
                                        placeholder="Search keyword" value="{{ request('viewKeyword') }}"
                                        aria-label="search keyword" aria-describedby="viewSearchBtn" />
                                    <button class="btn btn-primary" type="submit" id="viewSearchBtn">
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
                                            User id
                                        </th>
                                        <th>User name</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($postViewers as $viewer)
                                        <tr>
                                            <th scope="row">{{ $viewer->id }}</th>
                                            <td class="text-nowrap">
                                                {{ $viewer->user_id ?? 'Guest' }}
                                            </td>
                                            <td class="text-nowrap">
                                                {{ $viewer->user->name ?? 'Guest' }}
                                            </td>
                                            <td class="text-nowrap">
                                                <p class="small mb-1 text-black-50">
                                                    <i class="bi bi-calendar"></i>
                                                    {{ $viewer->created_at->format('d M Y') }}
                                                </p>
                                                <p class="small mb-0 text-black-50">
                                                    <i class="bi bi-clock"></i>
                                                    {{ $viewer->created_at->format('h : m A') }}
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

    @push('scripts')
        <script>
            let deleteComments = document.querySelectorAll(".deleteComment");
            if (deleteComments) {
                [...deleteComments].map(submit => {
                    submit.addEventListener("click", function(event) {
                        event.preventDefault()
                        let form = document.querySelector(`#${this.dataset.form}`)
                        Swal.fire({
                            title: `Are you sure to delete this comment id(${this.dataset.commentId})?`,
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        })
                    });
                })
            }
        </script>
    @endpush
</x-dashboard-layout>
