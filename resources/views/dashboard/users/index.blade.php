<x-dashboard-layout>
    <x-dashboard.heading>User Management</x-dashboard.heading>

    <div class="row">
        <div class="col-12 col-lg-10">
            <div class="card c-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h2 class="h4 text-dark mb-3 mb-sm-0">
                            Users List
                        </h2>
                        <div class="flex-fill"></div>
                        <form action="{{ route('dashboard.user.index') }}" class="d-sm-inline-block me-sm-3 mb-3 mb-sm-0">
                            <div class="input-group w-auto">
                                <input type="text" class="form-control" name="keyword" placeholder="Search keyword"
                                    value="{{ request('keyword') }}" aria-label="search keyword"
                                    aria-describedby="userSearchBtn" />
                                <button class="btn btn-primary" type="submit" id="userSearchBtn">
                                    <i class="bi bi-search text-gray-300"></i>
                                </button>
                            </div>
                        </form>
                        <div class="d-none d-sm-block">
                            <a href="{{ route('dashboard.user.create') }}" class="btn btn-outline-primary"><i
                                    class="bi bi-plus-circle"></i></a>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-hover align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">
                                        Username
                                    </th>
                                    <th scope="col">
                                        Email
                                    </th>
                                    <th scope="col">
                                        Role
                                    </th>
                                    <th>Control</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <th scope="row">{{ $user->id }}</th>
                                        <td class="text-nowrap">
                                            {{ $user->name }}
                                        </td>
                                        <td class="text-nowrap">
                                            {{ $user->email }}
                                        </td>
                                        <td class="text-nowrap">
                                            {{ ucwords($roles[$user->role]) }}
                                        </td>
                                        <td class="text-nowrap">
                                            <a href="{{ route('dashboard.user.edit', $user->id) }}"
                                                class="btn btn-sm btn-outline-success"><i
                                                    class="bi bi-pencil-square"></i></a>
                                            <form id="deleteForm{{ $user->id }}"
                                                action="{{ route('dashboard.user.destroy', $user->id) }}"
                                                class="d-inline-block" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button data-form="deleteForm{{ $user->id }}" type="button"
                                                    data-user-id="{{ $user->id }}"
                                                    data-user-name="{{ $user->name }}"
                                                    class="deleteSubmit btn btn-sm btn-outline-danger"><i
                                                        class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                        <td class="text-nowrap">
                                            <p class="small mb-1 text-black-50">
                                                <i class="bi bi-calendar"></i>
                                                {{ $user->created_at->format('d M Y') }}
                                            </p>
                                            <p class="small mb-0 text-black-50">
                                                <i class="bi bi-clock"></i>
                                                {{ $user->created_at->format('h : m A') }}
                                            </p>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">There is no user yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div>{{ $users->links() }}</div>
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
                        console.log(form)
                        Swal.fire({
                            title: `Are you sure to delete ${this.dataset.userName}?`,
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
