<x-dashboard-layout>

    <x-dashboard.heading>Post Views</x-dashboard.heading>
    <div class="row post_view">
        <div class="col-12 col-lg-10">
            <div class="card c-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h2 class="h4 text-dark mb-3 mb-lg-0">
                            Post Views By Date
                        </h2>
                        <div class="flex-fill"></div>

                        <form action="{{ route('dashboard.post-view.by-date') }}"
                            class="d-sm-inline-block me-sm-3 post-view__filter">
                            <div class="d-flex align-items-center">
                                <a href="{{ route('dashboard.post-view.by-date') }}"
                                    class="btn btn-primary me-3 text-decoration-none">Reset</a>
                                <div class="input w-auto me-3">
                                    <input type="date" class="form-control" placeholder="Search date from"
                                        name="from" value="{{ request('from') }}" aria-label="search date from"
                                        aria-describedby="postViewSearchBtn" />
                                </div>
                                <div class="me-3">
                                    <i class="bi bi-arrow-right fw-bold"></i>
                                </div>
                                <div class="input w-auto me-3">
                                    <input type="date" class="form-control" placeholder="Search date to"
                                        name="to" value="{{ request('to') }}" aria-label="search date to"
                                        aria-describedby="postViewSearchBtn" />
                                </div>
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
                                        Date
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
                                            {{ $view->date }}
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
