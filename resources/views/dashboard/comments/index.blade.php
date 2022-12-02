<x-dashboard-layout>
    <x-dashboard.heading>Comment Management</x-dashboard.heading>

    <div class="row comment">
        <div class="col-12 col-lg-10">
            <div class="card c-card">
                <div class="card-body">
                    <div class="d-flex justify-content-start justify-content-sm-between align-items-start align-items-sm-center flex-column flex-sm-row flex-wrap">
                        <h2 class="h4 text-dark mb-3 mb-lg-0">
                            Comments List
                        </h2>
                        <div class="flex-fill"></div>

                        <form action="{{ route('dashboard.comment.index') }}" class="d-sm-inline-block mb-3 mb-sm-0">
                            <div class="d-flex flex-column flex-sm-row">
                                <div class="dropdown comment__dropdown mb-3 mb-sm-0 me-3">
                                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        {{ request('list') ?? 'others' }}
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('dashboard.comment.index', ['list' => 'others']) }}">
                                                <i class="bi bi-speedometer me-3">
                                                </i>
                                                others
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('dashboard.comment.index', ['list' => 'personal']) }}">
                                                <i class="bi bi-speedometer me-3">
                                                </i>
                                                personal
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="input-group w-auto">
                                    <input type="text" class="form-control" name="keyword"
                                        placeholder="Search keyword" aria-label="search keyword"
                                        aria-describedby="commentSearchBtn" />
                                    <button class="btn btn-primary" type="submit" id="commentSearchBtn">
                                        <i class="bi bi-search text-gray-300"></i>
                                    </button>
                                </div>
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
                        <div>{{ $comments->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            let deleteSubmits = document.querySelectorAll(".deleteSubmit");
            if (deleteSubmits) {
                [...deleteSubmits].map(submit => {
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
