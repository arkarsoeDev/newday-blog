<x-dashboard-layout>
    <x-dashboard.heading>Category Management</x-dashboard.heading>

    <div class="row">
        <div class="col-12 col-lg-10">
            <div class="card c-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h2 class="h4 text-dark mb-3 mb-sm-0">
                            Category List
                        </h2>
                        <div class="flex-fill"></div>
                        <div class="d-none d-sm-block">
                            <a href="{{ route('dashboard.category.create') }}" class="btn btn-outline-primary"><i
                                    class="bi bi-plus-circle"></i></a>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-hover align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">
                                        Title
                                    </th>
                                    <th>Owner</th>
                                    <th>Control</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <th scope="row">{{ $category->id }}</th>
                                        <td class="text-nowrap">
                                            {{ $category->title }}
                                        </td>
                                        <td>
                                            {{ $category->user->name }}
                                        </td>
                                        <td class="text-nowrap">
                                            <a href="{{ route('dashboard.category.edit', $category->id) }}"
                                                class="btn btn-sm btn-outline-success"><i
                                                    class="bi bi-pencil-square"></i></a>
                                            <form action="{{ route('dashboard.category.destroy', $category->id) }}"
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
                                                {{ $category->created_at->format('d M Y') }}
                                            </p>
                                            <p class="small mb-0 text-black-50">
                                                <i class="bi bi-clock"></i>
                                                {{ $category->created_at->format('h : m A') }}
                                            </p>

                                        </td>
                                    </tr>
                                @empty
                                    <p>There is no category yet.</p>
                                @endforelse
                            </tbody>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
