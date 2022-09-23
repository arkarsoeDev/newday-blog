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
                        {{-- <form class="d-sm-inline-block me-sm-3 mb-3 mb-sm-0">
                            <div class="input-group w-auto">
                                <input type="text" class="form-control" placeholder="notification"
                                    aria-label="Recipient's username" aria-describedby="button-addon2" />
                                <button class="btn btn-primary" type="button" id="button-addon2">
                                    <i class="bi bi-search text-gray-300"></i>
                                </button>
                            </div>
                        </form> --}}
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
                                            <form action="{{ route('dashboard.user.destroy', $user->id) }}"
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
                                                {{ $user->created_at->format('d M Y') }}
                                            </p>
                                            <p class="small mb-0 text-black-50">
                                                <i class="bi bi-clock"></i>
                                                {{ $user->created_at->format('h : m A') }}
                                            </p>

                                        </td>
                                    </tr>
                                @empty
                                    <p>There is no user yet.</p>
                                @endforelse
                            </tbody>
                        </table>
                        <div>{{ $users->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
