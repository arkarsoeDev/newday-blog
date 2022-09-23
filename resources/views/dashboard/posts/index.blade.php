<x-dashboard-layout>

    <x-dashboard.heading>Post Management</x-dashboard.heading>
    <div class="row post-list">
        <div class="col-12 col-lg-10">
            <div class="card c-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h2 class="h4 text-dark mb-3 mb-sm-0">
                            Posts List
                        </h2>
                        <div class="flex-fill"></div>
                        <form action="{{ route('dashboard.post.index') }}" class="d-sm-inline-block me-sm-3 mb-3 mb-sm-0">
                            <div class="input-group w-auto">
                                <input type="text" class="form-control" placeholder="Search keyword" name="keyword"
                                    value="{{ request('keyword') }}" aria-label="search keyword"
                                    aria-describedby="postSearchBtn" />
                                <button class="btn btn-primary" type="submit" id="postSearchBtn">
                                    <i class="bi bi-search text-gray-300"></i>
                                </button>
                            </div>
                        </form>
                        <div class="d-none d-sm-block">
                            <a href="{{ route('dashboard.post.create') }}" class="btn btn-outline-primary"><i
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
                                    <th scope="col">
                                        Category
                                    </th>
                                    <th scope="col">
                                        Owner
                                    </th>
                                    <th>Control</th>
                                    <th>
                                        Created At
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($posts as $post)
                                    <tr>
                                        <th scope="row">{{ $post->id }}</th>
                                        <td class="c-mw-2">
                                            {{ $post->title }}
                                        </td>
                                        <td class="text-nowrap">
                                            {{ $post->category->title }}
                                        </td>
                                        <td class="text-nowrap">
                                            {{ $post->user->name }}
                                        </td>
                                        <td class="text-nowrap">
                                            @canany(['update', 'delete'], $post)
                                                <a href="{{ route('dashboard.post.edit', $post->slug) }}"
                                                    class="btn btn-sm btn-outline-success"><i
                                                        class="bi bi-pencil-square"></i></a>
                                                <form action="{{ route('dashboard.post.destroy', $post->slug) }}"
                                                    class="d-inline-block" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i
                                                            class="bi bi-trash"></i></button>
                                                </form>
                                            @else
                                                <span class="text-warning">Not authorize</span>
                                            @endcanany
                                        </td>
                                        <td class="text-nowrap">
                                            <p class="small mb-1 text-black-50">
                                                <i class="bi bi-calendar"></i>
                                                {{ $post->created_at->format('d M Y') }}
                                            </p>
                                            <p class="small mb-0 text-black-50">
                                                <i class="bi bi-clock"></i>
                                                {{ $post->created_at->format('h : m A') }}
                                            </p>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">There is no post yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div>
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-dashboard-layout>
