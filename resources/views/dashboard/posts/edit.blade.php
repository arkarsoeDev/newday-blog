<x-dashboard-layout>

    <x-dashboard.heading>Post Management</x-dashboard.heading>
    <x-dashboard.layouts.form-create-edit title="Post" control="Edit">
        <div class="post-edit">
            <form action="{{ route('dashboard.post.update', $post->slug) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <x-dashboard.form.input-layout id="title" name="title" title="Title">
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $post->title) }}"
                    id="title" placeholder="Title" />
            </x-dashboard.form.input-layout>

            <x-dashboard.form.input-layout id="description" name="description" title="Description">
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="5">{{ old('description', $post->description) }}</textarea>
            </x-dashboard.form.input-layout>

            <x-dashboard.form.input-layout id="category" name="category" title="Category">
                <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" aria-label="Default select example">
                    @foreach (\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}"
                            {{ $category->id === old('category_id', $post->category_id) ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
            </x-dashboard.form.input-layout>

            <x-dashboard.form.input-layout id="featuredImage" name="featured_image" title="Featured Image">
                <input type="file" class="form-control @error('featured_image') is-invalid @enderror" id="featuredImage" name="featured_image" />
            </x-dashboard.form.input-layout>


            <div>
                @isset($post->featured_image)
                    @if($post->featured_image !== 'image-not-available.png')
                    <img src="{{ asset('storage/' . $post->featured_image) }}" height="200"
                        class="featured-img rounded" alt="">
                    @endif
                @endisset
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary text-white">
                    Update
                </button>
            </div>
        </form>
        </div>
    </x-dashboard.layouts.form-create-edit>
                

</x-dashboard-layout>
