<x-dashboard-layout>
    <x-dashboard.heading>Post Management</x-dashboard.heading>

    <x-dashboard.layouts.form-create-edit title="Post">
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
                <label for="summernote" class="mb-3">
                    Body
                </label>
                <textarea id="summernote" name="body"></textarea>
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
    </x-dashboard.layouts.form-create-edit>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
        </script>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        <script>
            $.summernote.dom.emptyPara = "<div><br/></div>";
            $('#summernote').summernote({
                placeholder: 'Hello stand alone ui',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
            
        </script>
    @endpush
</x-dashboard-layout>
