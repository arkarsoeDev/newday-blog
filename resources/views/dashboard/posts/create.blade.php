<x-dashboard-layout>
    <x-dashboard.heading>Post Management</x-dashboard.heading>

    <x-dashboard.layouts.form-create-edit title="Post">
        <div class="post-create">
            <form action="{{ route('dashboard.post.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <x-dashboard.form.input-layout id="title" name="title" title="Title">
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title') }}" id="title" placeholder="Title" />
            </x-dashboard.form.input-layout>

            <x-dashboard.form.input-layout id="description" name="description" title="Description">
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                    rows="5">{{ old('description') }}</textarea>
            </x-dashboard.form.input-layout>

            <div class="mb-3">
                <label for="editor" class="mb-3">
                    Body
                </label>
                <textarea id="editor" name="body" rows="12">{!! old('body') !!}</textarea>
            </div>

            <x-dashboard.form.input-layout id="category" name="category" title="Category">
                <select class="form-select @error('category') is-invalid @enderror" id="category" name="category"
                    aria-label="Default select example">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id === old('category') ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
            </x-dashboard.form.input-layout>

            <div class="mb-3">
                <label for="featuredImage" class="form-label">Featured Image</label>
                <input type="file" class="form-control @error('featured_image') is-invalid @enderror"
                    name="featured_image" id="featuredImage" placeholder="Title" />
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary text-white">
                    Submit
                </button>
            </div>
        </form>
        </div>
    </x-dashboard.layouts.form-create-edit>

    @push('scripts')
        <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>

        @include('dashboard.ckeditor')
        <script>
            ClassicEditor
                .create(document.querySelector('#editor'), {
                    extraPlugins: [SimpleUploadAdapterPlugin],
                    // ...
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endpush
</x-dashboard-layout>
