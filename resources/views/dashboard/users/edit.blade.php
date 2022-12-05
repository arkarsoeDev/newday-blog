<x-dashboard-layout>
    <x-dashboard.heading>User Management</x-dashboard.heading>

    <x-dashboard.layouts.form-create-edit title="User" control="Edit">
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

            <x-dashboard.form.input-layout id="email" name="email" title="Email">
                <input type="email" value="{{ old('email', $user->email) }}"
                    class="form-control @error('email')
                    is-invalid                              
                @enderror"
                    id="email" name="email" placeholder="email" />
            </x-dashboard.form.input-layout>


            <x-dashboard.form.input-layout id="role" name="role" title="Role">
                <select class="form-select" name="role" id="role"
                    aria-label="Default select example">
                    @foreach ($roles as $key => $role)
                        <option value="{{ $key }}"
                            {{ $key == old('role', $user->role) ? 'selected' : '' }}>
                            {{ $role }}</option>
                    @endforeach
                </select>
            </x-dashboard.form.input-layout>

            <x-dashboard.form.input-layout id="password" name="password" title="Password">
                <input type="password" value="{{ old('password') }}"
                    class="form-control @error('password')
                            is-invalid                              
                        @enderror"
                    id="password" name="password" placeholder="Password" />
            </x-dashboard.form.input-layout>

            <div class="text-end">
                <button type="submit" class="btn btn-primary text-white">
                    Submit
                </button>
            </div>
        </form>
    </x-dashboard.layouts.form-create-edit>
                
</x-dashboard-layout>
