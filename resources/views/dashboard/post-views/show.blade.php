<x-dashboard-layout>

    <x-dashboard.heading>Post View Management</x-dashboard.heading>

    <div class="view-show">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card c-card mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h2 class="h4">Post View Detail</h2>
                        </div>
                        <hr>
                        <div class="mb-3 ">
                            <span class="fw-bold value-detail__label">View Id</span> <span
                                class="value-detail__info">{{ $view->id }}</span>
                        </div>
                        <div class="mb-3 ">
                            <span class="fw-bold value-detail__label">Post Slug</span> <span
                                class="value-detail__info">{{ $view->slug }}</span>
                        </div>
                        <div class="mb-3 ">
                            <span class="fw-bold value-detail__label">Post Url</span> <a
                                href="{{ $view->url }}" class="value-detail__info">{{ $view->url }}</a>
                        </div>
                        <div class="mb-3 ">
                            <span class="fw-bold value-detail__label">Country</span> <span
                                class="value-detail__info">{{ $view->country->name }}</span>
                        </div>
                        <div class="mb-3 ">
                            <span class="fw-bold value-detail__label">Created At</span> <span>
                                <span class="value-detail__info"><i class="bi bi-calendar"></i>
                                    {{ $view->created_at->format('d M Y') }}</span>
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
                                    Post
                                </h5>
                                <div class="value-detail__partial">
                                    <div class="value-detail__partial-item mb-2">
                                        <span class="label">Id</span>
                                        <span>{{ $view->post->id }}</span>
                                    </div>
                                    <div class="value-detail__partial-item">
                                        <span class="label">Title</span>
                                        <span>{{ $view->post->title }}</span>
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
                                    @if($view->user)
                                        <div class="value-detail__partial-item mb-2">
                                        <span class="label">Id</span>
                                        <span>{{ $view->user->id }}</span>
                                    </div>
                                    <div class="value-detail__partial-item">
                                        <span class="label">Name</span>
                                        <span>{{ $view->user->name }}</span>
                                    </div>
                                    @else
                                    <div class="value-detail__partial-item">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="fw-bold">User is a guest</span>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
