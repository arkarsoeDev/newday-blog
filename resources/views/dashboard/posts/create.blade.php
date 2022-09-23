<x-dashboard-layout>

    <x-dashboard.heading>Post Management</x-dashboard.heading>

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card c-card">
                <div class="card-body">
                    <h2 class="h4">Post Create</h2>
                    <hr />
                    <form action="{{ route('dashboard.post.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <x-dashboard.form.input-layout id="title" name="title" title="Title">
                            <input type="text" name="title"
                                class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}"
                                id="title" placeholder="Title" />
                        </x-dashboard.form.input-layout>

                        <x-dashboard.form.input-layout id="description" name="description" title="Description">
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                rows="5">{{ old('description') }}</textarea>
                        </x-dashboard.form.input-layout>

                        <x-dashboard.form.input-layout id="category" name="category" title="Category">
                            <select class="form-select @error('category') is-invalid @enderror" id="category"
                                name="category" aria-label="Default select example">
                                @foreach (\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id === old('category') ? 'selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                        </x-dashboard.form.input-layout>

                        <div class="mb-3">
                            <label for="featuredImage" class="form-label">Featured Image</label>
                            <input type="file" class="form-control @error('featured_image') is-invalid @enderror" name="featured_image" id="featuredImage"
                                placeholder="Title" />
                        </div>

                        

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary text-white">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-dashboard-layout>
