<x-dashboard-layout>
    <x-dashboard.heading>Tag Management</x-dashboard.heading>

    <div class="row">
        <div class="col-12 col-lg-10">
            <div class="card c-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h2 class="h4 text-dark mb-3 mb-sm-0">
                            Tag List
                        </h2>
                        <div class="flex-fill"></div>
                        @can('create', App\Models\Tag::class)
                            <div class="d-none d-sm-block">
                                <a href="{{ route('dashboard.tag.create') }}" class="btn btn-outline-primary"><i
                                        class="bi bi-plus-circle"></i></a>
                            </div>
                        @endcan
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-hover align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">
                                        Title
                                    </th>
                                    <th>Owner</th>
                                    <th>Control</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tags as $tag)
                                    <tr>
                                        <th scope="row">{{ $tag->id }}</th>
                                        <td class="text-nowrap">
                                            {{ $tag->title }}
                                        </td>
                                        <td>
                                            {{ $tag->user->name }}
                                        </td>
                                        <td class="text-nowrap">
                                            @canany(['update', 'delete'], $tag)
                                                <a href="{{ route('dashboard.tag.edit', $tag->id) }}"
                                                    class="btn btn-sm btn-outline-success"><i
                                                        class="bi bi-pencil-square"></i></a>
                                                <form id="deleteForm{{ $tag->id }}" action="{{ route('dashboard.tag.destroy', $tag->id) }}"
                                                    class="d-inline-block" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button data-form="deleteForm{{ $tag->id }}" type="button"
                                                        data-tag-id="{{ $tag->id }}" class="deleteSubmit btn btn-sm btn-outline-danger"><i
                                                            class="bi bi-trash"></i></button>
                                                </form>
                                            @else
                                                <span class="text-bg-warning">Not authorize</span>
                                            @endcanany
                                        </td>
                                        <td class="text-nowrap">
                                            <p class="small mb-1 text-black-50">
                                                <i class="bi bi-calendar"></i>
                                                {{ $tag->created_at->format('d M Y') }}
                                            </p>
                                            <p class="small mb-0 text-black-50">
                                                <i class="bi bi-clock"></i>
                                                {{ $tag->created_at->format('h : m A') }}
                                            </p>

                                        </td>
                                    </tr>
                                @empty
                                    <p>There is no tag yet.</p>
                                @endforelse
                            </tbody>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            let deleteSubmits = document.querySelectorAll(".deleteSubmit");
            if(deleteSubmits) {
                [...deleteSubmits].map(submit => {
                submit.addEventListener("click", function(event) {
                    event.preventDefault()
                    let form = document.querySelector(`#${this.dataset.form}`)
                    Swal.fire({
                        title: `Are you sure to delete this tag id(${this.dataset.tagId})?`,
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();                               
                        }
                    })
                });
            })
            }
        </script>
    @endpush
</x-dashboard-layout>
