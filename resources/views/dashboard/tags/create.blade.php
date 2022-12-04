<x-dashboard-layout>
    <x-dashboard.heading>Tag Management</x-dashboard.heading>

    <x-dashboard.layouts.form-create-edit title="Tag">
        <form action="{{ route('dashboard.tag.store') }}" method="post">
            @csrf
            <x-dashboard.form.input-layout id="title" name="title" title="Title">
                <input type="text" value="{{ old('title') }}"
                    class="form-control @error('title')
                is-invalid                              
            @enderror"
                    id="title" name="title" placeholder="Title" />
            </x-dashboard.form.input-layout>

            <div class="text-end">
                <button type="submit" class="btn btn-primary text-white">
                    Submit
                </button>
            </div>
        </form>
    </x-dashboard.layouts.form-create-edit>


</x-dashboard-layout>
