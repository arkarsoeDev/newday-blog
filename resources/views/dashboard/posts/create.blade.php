<x-dashboard-layout>
    <x-dashboard.heading>Post Management</x-dashboard.heading>

    <x-dashboard.layouts.form-create-edit title="Post">
        <div class="post-create">
            <form id="createPost" action="{{ route('dashboard.post.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <x-dashboard.form.input-layout>
                    <x-slot name="name">title</x-slot>
                    <x-slot name="id">title</x-slot>
                    <x-slot name="title">Title</x-slot>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title') }}" id="title" placeholder="Title" />
                </x-dashboard.form.input-layout>

                <x-dashboard.form.input-layout>
                    <x-slot name="name">description</x-slot>
                    <x-slot name="id">description</x-slot>
                    <x-slot name="title">Description</x-slot>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                        rows="5">{{ old('description') }}</textarea>
                </x-dashboard.form.input-layout>

                <x-dashboard.form.input-layout>
                    <x-slot name="name">body</x-slot>
                    <x-slot name="id">editor</x-slot>
                    <x-slot name="title">Body</x-slot>
                    <textarea class="form-control @error('body') is-invalid @enderror" id="editor" name="body" rows="5">{!! old('body') !!}</textarea>
                </x-dashboard.form.input-layout>
            </form>
        </div>

        <x-slot name="rightSide">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card c-card mb-3">
                    <div class="card-body">
                        <label for="featuredImage" class="form-label h5 mb-3">Featured Image</label>
                        <x-dashboard.form.input-layout>
                            <x-slot name="name">featured_image</x-slot>
                            <input form="createPost" type="file"
                                class="form-control @error('featured_image') is-invalid @enderror" name="featured_image"
                                id="featuredImage" />
                        </x-dashboard.form.input-layout>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card c-card mb-3">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="category" class="form-label h5">Category</label>
                        </div>
                        <x-dashboard.form.input-layout>
                            <x-slot name="name">category</x-slot>
                            <select form="createPost" class="form-select @error('category') is-invalid @enderror"
                                id="category" name="category" aria-label="Default select example">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id === old('category') ? 'selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                        </x-dashboard.form.input-layout>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card c-card mb-3">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="category" class="form-label h5">Tags</label>
                        </div>
                        <x-dashboard.form.input-layout>
                            <x-slot name="nameArr">tags</x-slot>
                            <div class="post-create__tags-container">
                                @foreach ($tags as $key => $tag)
                                    <div class="form-check">
                                        <input name="tags[]" form="createPost" class="form-check-input" type="checkbox"
                                            value="{{ $tag->id }}" @checked(is_array(old('tags')) and in_array($tag->id, old('tags')))
                                            id="{{ $tag->id }}">
                                        <label class="form-check-label" for="{{ $tag->id }}">
                                            {{ $tag->title }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </x-dashboard.form.input-layout>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-dashboard.layouts.form-create-edit>

    <div class="row mb-3">
        <div class="col-12">
            <div class="text-end">
                <button form="createPost" type="submit" class="btn btn-primary px-5 text-white">
                    Submit
                </button>
            </div>
        </div>
    </div>

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
