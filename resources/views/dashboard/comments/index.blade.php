<x-dashboard-layout>
    <x-dashboard.heading>Comment Management</x-dashboard.heading>

    <div class="row">
        <div class="col-12 col-lg-10">
            <div class="card c-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h2 class="h4 text-dark mb-3 mb-sm-0">
                            Comments List
                        </h2>
                        <div class="flex-fill"></div>
                        <form action="{{ route('dashboard.comment.index') }}"
                            class="d-sm-inline-block mb-3 mb-sm-0">
                            <div class="input-group w-auto">
                                <input type="text" class="form-control" name="keyword" placeholder="Search keyword"
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
                                        Post Id
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
                                            {{ $comment->post_id }}
                                        </td>
                                        <td class="text-nowrap">
                                            {{ $comment->user->name }}
                                        </td>
                                        <td class="text-nowrap">
                                            <a href="{{ route('dashboard.comment.show', $comment->id) }}"
                                                class="btn btn-sm btn-outline-info"><i
                                                    class="bi bi-info-circle"></i></a>
                                            <form action="{{ route('dashboard.comment.destroy', $comment->id) }}"
                                                class="d-inline-block" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"><i
                                                        class="bi bi-trash"></i></button>
                                            </form>
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
                                    <p>There is no user yet.</p>
                                @endforelse
                            </tbody>
                        </table>
                        <div>{{ $comments->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>