<x-dashboard-layout>

    <x-dashboard.heading>Post Management</x-dashboard.heading>
    <x-dashboard.layouts.form-create-edit title="Post" control="Edit">
        <div class="post-edit">
            <form id="editPost" action="{{ route('dashboard.post.update', $post->slug) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <x-dashboard.form.input-layout>
                    <x-slot name="name">title</x-slot>
                    <x-slot name="id">title</x-slot>
                    <x-slot name="title">Title</x-slot>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title', $post->title) }}" id="title" placeholder="Title" />
                </x-dashboard.form.input-layout>

                <x-dashboard.form.input-layout>
                    <x-slot name="name">description</x-slot>
                    <x-slot name="id">description</x-slot>
                    <x-slot name="title">Description</x-slot>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                        rows="5">{{ old('description', $post->description) }}</textarea>
                </x-dashboard.form.input-layout>

                <input type="hidden" name="body" value="" id="textBody">

                <div class="overflow-hidden">
                    <x-dashboard.form.input-layout>
                    <x-slot name="name">body</x-slot>
                    <x-slot name="id">editor</x-slot>
                    <x-slot name="title">Body</x-slot>
                    <div id="toolbar-container"></div>

                    <div id="editor">{!! old('body',$post->body) !!}</div>
                </x-dashboard.form.input-layout>
                </div>
            </form>
        </div>
        <x-slot name="rightSide">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card c-card mb-3">
                    <div class="card-body">
                        <label for="featuredImage" class="form-label h5">Featured Image</label>
                        <div class="post-edit__img-container d-flex align-items-center justify-content-center mb-3">
                            @isset($post->featured_image)
                                @if ($post->featured_image !== 'image-not-available.png')
                                    <img class="post-edit__img"
                                        src="{{ asset('storage/uploads/' . $post->featured_image) }}" alt="">
                                @else
                                    <div>
                                        No image is uploaded yet.
                                    </div>
                                @endif
                            @endisset
                        </div>

                        <x-dashboard.form.input-layout>
                            <x-slot name="name">featured_image</x-slot>
                            <input form="editPost" type="file"
                                class="form-control @error('featured_image') is-invalid @enderror" id="featuredImage"
                                name="featured_image" />
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
                            <select form="editPost" class="form-select @error('category') is-invalid @enderror"
                                id="category" name="category" aria-label="Default select example">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id === old('category_id', $post->category_id) ? 'selected' : '' }}>
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
                            <div class="post-edit__tags-container">
                                @foreach ($tags as $key => $tag)
                                    <div class="form-check">
                                        <input name="tags[]" form="editPost" class="form-check-input" type="checkbox"
                                            value="{{ $tag->id }}" @checked((is_array(old('tags')) and in_array($tag->id, old('tags'))) || in_array($tag->id, $postTags))
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
                <button form="editPost" type="submit" class="btn btn-primary px-5 text-white">
                    Update
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            let uploadUrl = "{{ route('dashboard.image.store') }}";
            let editor;
        </script>
        {{-- <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script> --}}
        @vite('resources/js/ckeditor.js')
        <script>
            let createPost = document.querySelector('#editPost');
            createPost.addEventListener('submit', function(event) {
                event.preventDefault();
                let textBody = document.querySelector('#textBody');
                const editorData = editor.getData();
                textBody.value = editorData;
                this.submit();
            })
        </script>
    @endpush
</x-dashboard-layout>
