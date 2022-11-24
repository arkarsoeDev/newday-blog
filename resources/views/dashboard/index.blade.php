<x-dashboard-layout>

    <x-dashboard.heading>Dashboard</x-dashboard.heading>

    <div class="row">
        @if (isset($userCount))
            <div class="col-xl-3 col-md-6 mb-4">
                <x-dashboard.count-card :route="route('dashboard.user.index')" :payload="$userCount" title="Total Users" icon="bi-people">
                </x-dashboard.count-card>
            </div>
        @endif
        <div class="col-xl-3 col-md-6 mb-4">
            <x-dashboard.count-card :route="route('dashboard.post.index')" :payload="$postCount" title="Total Posts" icon="bi-newspaper">
            </x-dashboard.count-card>
        </div>
        @if (isset($commentCount))
            <div class="col-xl-3 col-md-6 mb-4">
                <x-dashboard.count-card :route="route('dashboard.comment.index')" :payload="$commentCount" title="Total Comments" icon="bi-chat">
                </x-dashboard.count-card>
            </div>
        @endif
        @if (isset($personalCommentCount))
            <div class="col-xl-3 col-md-6 mb-4">
                <x-dashboard.count-card :route="route('dashboard.comment.index')" :payload="$personalCommentCount" title="Totla Personal Comments"
                    icon="bi-chat">
                </x-dashboard.count-card>
            </div>
        @endif
        @if (isset($postViewCount))
            <div class="col-xl-3 col-md-6 mb-4">
                <x-dashboard.count-card :route="route('dashboard.comment.index')" :payload="$postViewCount" title="Totla View Count" icon="bi-eye">
                </x-dashboard.count-card>
            </div>
        @endif

        <div class="col-xl-6 col-md-12 mb-4">
            <div class="card shadow h-100 py-2 recent-list">
                <div class="card-body">
                    <h4 class="card-title text-primary mb-3"><span class="me-3">Recent Posts</span> <i
                            class="bi bi-newspaper">
                        </i></h4>
                    <ul class="list-group rounded-0 mb-3">
                        @foreach ($recentPosts as $post)
                            <a href="{{ route('dashboard.post.show', $post->slug) }}" class="list-group-item list-group-item-action fw-bold ">
                                <div class="d-flex justify-content-between align-items-center recent-list__list-container">
                                    <div
                                        class="d-flex align-items-center justify-content-start recent-list__list">
                                        <img src="{{ asset('storage/thumbnails/' . $post->featured_image) }}"
                                            class="recent-list__list-img me-3" alt="">
                                        <div class="d-flex flex-column recent-list__list-right-container">
                                            <span class="recent-list__list-title mb-3 mb-md-2">{{ $post->title }}</span>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="recent-list__list-owner">{{ $post->user->name }}</span>
                                                <span
                                                    class="recent-list__list-date">{{ $post->created_at->format('d M Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </ul>
                    <div class="text-center">
                        <a class="d-inline-block" href="{{ route('dashboard.post.index') }}">View all</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-12 mb-4">
            <div class="card shadow h-100 py-2 recent-card">
                <div class="card-body">
                    <h4 class="card-title text-warning mb-3"><span class="me-3">Recent Comments</span> <i
                            class="bi bi-chat">
                        </i></h4>
                    <ul class="list-group rounded-0 mb-3 recent-list">
                        @foreach ($recentComments as $comment)
                            <a href="{{ route('dashboard.comment.show', $comment->id) }}" class="list-group-item list-group-item-action fw-bold ">
                                <div class="d-flex justify-content-between align-items-center recent-list__list-container">
                                    <div class="d-flex flex-column recent-list__list">
                                        <span class="recent-list__list-title mb-3 mb-md-2">{{ $comment->excerpt }}</span>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="recent-list__list-owner">{{ $comment->user->name }}</span>
                                            <span
                                                class="recent-list__list-date">{{ $comment->created_at->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </ul>
                    <div class="text-center">
                        <a class="d-inline-block" href="{{ route('dashboard.comment.index') }}">View all</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-dashboard-layout>
