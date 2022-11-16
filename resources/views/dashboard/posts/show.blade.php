<x-dashboard-layout>

    <x-dashboard.heading>Post Management</x-dashboard.heading>

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card c-card">
                <div class="card-body">
                    <div class="post-show">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="h4">Post Detail</h2>
                            <a href="{{ url()->previous() }}"
                                class="btn btn-primary text-white fw-bold text-decoration-none"><i
                                    class="bi bi-chevron-left me-1"></i> Back</a>
                        </div>
                        <hr>
                        <div class="mb-3 d-flex align-items-start flex-column flex-md-row ">
                            <span class="fw-bold post-detail__label">Post Id</span> <span
                                class="post-detail__info">{{ $post->id }}</span>
                        </div>
                        <div class="mb-3 d-flex align-items-start flex-column flex-md-row ">
                            <span class="fw-bold post-detail__label">Title</span> <span
                                class="post-detail__info">{{ $post->title }}</span>
                        </div>
                        <div class="mb-3 d-flex align-items-start flex-column flex-nowrap flex-md-row ">
                            <span class="fw-bold post-detail__label">Description</span> <span
                                class="post-detail__description">{{ $post->description }}</span>
                        </div>
                        <div class="mb-3 d-flex align-items-start flex-column flex-md-row ">
                            <span class="fw-bold post-detail__label">Category Id</span> <span
                                class="post-detail__info">{{ $post->category_id }}</span>
                        </div>
                        <div class="mb-3 d-flex align-items-start flex-column flex-md-row ">
                            <span class="fw-bold post-detail__label">Category Name</span> <span
                                class="post-detail__info">{{ $post->category->title }}</span>
                        </div>
                        <div class="mb-3 d-flex align-items-start flex-column flex-md-row ">
                            <span class="fw-bold post-detail__label">User Id</span> <span
                                class="post-detail__info">{{ $post->user_id }}</span>
                        </div>
                        <div class="mb-3 d-flex align-items-start flex-column flex-md-row ">
                            <span class="fw-bold post-detail__label">User Name</span> <span
                                class="post-detail__info">{{ $post->user->name }}</span>
                        </div>
                        <div class="mb-3 d-flex align-items-start flex-column flex-md-row  ">
                            <span class="fw-bold post-detail__label">Featured Image</span>
                            @isset($post->featured_image)
                                @if ($post->featured_image !== 'image-not-available.png')
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" height="200"
                                        class="post-detail__featured-img rounded" alt="">
                                @endif
                            @endisset
                        </div>
                        <div class="mb-3 d-flex align-items-start flex-column flex-md-row ">
                            <span class="fw-bold post-detail__label">Created At</span> <span>

                                <span class="post-detail__info"><i class="bi bi-calendar"></i>
                                    {{ $post->created_at->format('d M Y') }}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
