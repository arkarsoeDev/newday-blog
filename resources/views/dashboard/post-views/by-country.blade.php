<x-dashboard-layout>

    <x-dashboard.heading>Post Views</x-dashboard.heading>
    <div class="row post-list">
        <div class="col-12 col-lg-10">
            <div class="card c-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h2 class="h4 text-dark mb-3 mb-sm-0">
                            Post Views By Country List
                        </h2>
                        <div class="flex-fill"></div>
                        <form action="{{ route('dashboard.post-view.by-country') }}"
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
                                        Country
                                    </th>
                                    <th scope="col">
                                        View counts
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($views as $view)
                                    <tr>
                                        <th scope="row">{{ $view->id }}</th>
                                        <td class="c-mw-2">
                                            {{ $view->country->name }}
                                        </td>
                                        <td class="text-nowrap">
                                            {{ $view->count }}
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
