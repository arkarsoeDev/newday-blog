<x-dashboard-layout>

    <x-dashboard.heading>Post Views</x-dashboard.heading>
    <div class="row post-list">
        <div class="col-12 col-lg-10">
            <div class="card c-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h2 class="h4 text-dark mb-3 mb-sm-0">
                            Post Views List
                        </h2>
                        <div class="flex-fill"></div>
                        <form action="{{ route('dashboard.post-view.index') }}"
                            class="d-sm-inline-block me-sm-3 mb-3 mb-sm-0">
                            <div class="input-group w-auto">
                                <input type="text" class="form-control" placeholder="Search keyword" name="keyword"
                                    value="{{ request('keyword') }}" aria-label="search keyword"
                                    aria-describedby="postViewSearchBtn" />
                                <button class="btn btn-primary" type="submit" id="postViewSearchBtn">
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
                                        Post slug
                                    </th>
                                    <th scope="col">
                                        User name
                                    </th>
                                    <th>Control</th>
                                    <th>
                                        Created At
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($views as $view)
                                    <tr>
                                        <th scope="row">{{ $view->id }}</th>
                                        <td class="c-mw-2">
                                            {{ $view->slug }}
                                        </td>
                                        <td class="text-nowrap">
                                            {{ $view->user->name ?? 'guest' }}
                                        </td>
                                        <td class="text-nowrap">
                                            @canany(['show', 'delete'], $view)
                                            <a href="{{ route('dashboard.post-view.show', $view->id) }}"
                                                    class="btn btn-sm btn-outline-info"><i
                                                        class="bi bi-info-circle"></i></a>
                                                <form id="deleteForm{{ $view->id }}" action="{{ route('dashboard.post-view.destroy', $view->id) }}"
                                                    class="d-inline-block" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button data-form="deleteForm{{ $view->id }}" type="button"
                                                        data-post-id="{{ $view->id }}"  class="deleteSubmit btn btn-sm btn-outline-danger"><i
                                                            class="bi bi-trash"></i></button>
                                                </form>
                                            @else
                                                <span class="text-warning">Not authorize</span>
                                            @endcanany
                                        </td>
                                        <td class="text-nowrap">
                                            <p class="small mb-1 text-black-50">
                                                <i class="bi bi-calendar"></i>
                                                {{ $view->created_at->format('d M Y') }}
                                            </p>
                                            <p class="small mb-0 text-black-50">
                                                <i class="bi bi-clock"></i>
                                                {{ $view->created_at->format('h : m A') }}
                                            </p>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">There is no views yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div>
                        {{ $views->links() }}
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
                            title: `Are you sure to delete this post view id(${this.dataset.postId})?`,
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
