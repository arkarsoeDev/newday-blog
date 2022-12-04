<x-dashboard-layout>
    <x-dashboard.heading>Tag Management</x-dashboard.heading>

    <x-dashboard.layouts.form-create-edit title="Tag" control="Edit">
        <form action="{{ route('dashboard.tag.update', $tag->id) }}" method="post">
            @csrf
            @method('put')
            <x-dashboard.form.input-layout id="title" name="title" title="Title">
                <input type="text" value="{{ old('title', $tag->title) }}"
                    class="form-control @error('title')
                                is-invalid                              
                            @enderror"
                    id="title" name="title" placeholder="Title" />
            </x-dashboard.form.input-layout>
    
            <div class="text-end">
                <button type="submit" class="btn btn-primary text-white">
                    Update
                </button>
            </div>
        </form>
    </x-dashboard.layouts.form-create-edit>
</x-dashboard-layout>
