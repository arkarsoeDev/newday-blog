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
                <x-dashboard.count-card :route="route('dashboard.comment.index')" :payload="$personalCommentCount" title="Totla Personal Comments" icon="bi-chat">
                </x-dashboard.count-card>
            </div>
        @endif
    </div>

</x-dashboard-layout>