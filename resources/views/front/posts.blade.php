<x-front-layout>
    <x-slot name="breadcrumb">
        <x-front.breadcrumb>
            <li class="breadcrumb-item active" aria-current="page">
                Posts
            </li>
        </x-front.breadcrumb>
    </x-slot>

    <div class="row my-3 my-lg-5 gx-lg-5 flex-column-reverse flex-lg-row">
        <div class="col-12 col-lg-8">
            <div class="row px-0 mb-5 justify-content-center">
                @forelse($posts as $post)
                    <div class="col-12 col-sm-6 col-lg-12">
                        <x-front.post-card :post="$post" class="c-card--horizontal">
                            <x-slot name="imgSrc">{{ asset('storage/uploads/' . $post->featured_image) }}</x-slot>
                        </x-front.post-card>
                    </div>
                @empty
                    <p class="text-center">There is no post yet.</p>
                @endforelse
            </div>
            {{ $posts->onEachSide(1)->links() }}
        </div>
        <div class="col-12 col-lg-4">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-sm-inline-block me-sm-3 mb-3 mb-sm-0 w-100">
                        <form action="{{ route('page.posts') }}">
                            @if (request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search" name="search"
                                    value="{{ request('search') }}" aria-label="Search"
                                    aria-describedby="postSearchBtn" />
                                <button class="btn btn-primary" type="submit" id="postSearchBtn">
                                    <i class="bi bi-search text-gray-300"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <p class="fs-5 fw-bold">Categories</p>
                    <div class="list-group">
                        <a href="{{ route('page.posts', ['search' => request('search')]) }}"
                            class="list-group-item list-group-item-action {{ request('category') ? '' : 'active' }}">All</a>
                        @foreach ($categories as $category)
                            <a href="{{ route('page.posts', ['category' => $category->slug, 'search' => request('search')]) }}"
                                {{ request('category') === $category->slug ? 'aria-current="true"' : '' }}
                                class="list-group-item list-group-item-action {{ request('category') === $category->slug ? 'active' : '' }}">{{ $category->title }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="spacer"></div>

</x-front-layout>
