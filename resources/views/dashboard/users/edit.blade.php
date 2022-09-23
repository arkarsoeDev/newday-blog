<x-dashboard-layout>
    <x-dashboard.heading>User Management</x-dashboard.heading>

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card c-card">
                <div class="card-body">
                    <h2 class="h4">User Edit</h2>
                    <hr />
                    <form action="{{ route('dashboard.user.update', $user->id) }}" method="post">
                        @csrf
                        @method('put')
                        <x-dashboard.form.input-layout id="username" name="username" title="Username">
                            <input type="text" value="{{ old('username', $user->name) }}"
                                class="form-control @error('username')
                                is-invalid                              
                            @enderror"
                                id="username" name="username" placeholder="Username" />
                        </x-dashboard.form.input-layout>


                        <x-dashboard.form.input-layout id="role" name="role" title="Role">
                            <select class="form-select" name="role" id="role"
                                aria-label="Default select example">
                                @foreach ($roles as $key => $role)
                                    <option value="{{ $key }}"
                                        {{ $key === old('role', $user->role) ? 'selected' : '' }}>
                                        {{ $role }}</option>
                                @endforeach
                            </select>
                        </x-dashboard.form.input-layout>

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
