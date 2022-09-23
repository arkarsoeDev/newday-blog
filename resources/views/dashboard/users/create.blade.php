<x-dashboard-layout>
    <x-dashboard.heading>User Management</x-dashboard.heading>

    <x-dashboard.layouts.form-create-edit title="User">
        <form action="{{ route('dashboard.user.store') }}" method="post">
            @csrf
            <x-dashboard.form.input-layout id="username" name="username" title="Username">
                <input type="text" value="{{ old('username') }}"
                    class="form-control @error('username')
                                is-invalid                              
                            @enderror"
                    id="username" name="username" placeholder="Username" />
            </x-dashboard.form.input-layout>

            <x-dashboard.form.input-layout id="email" name="email" title="Email">
                <input type="email" value="{{ old('email') }}"
                    class="form-control @error('email')
                            is-invalid                              
                        @enderror"
                    id="email" name="email" placeholder="Email" />
            </x-dashboard.form.input-layout>

            <x-dashboard.form.input-layout id="password" name="password" title="Password">
                <input type="password"
                    class="form-control @error('password')
                            is-invalid                              
                        @enderror"
                    id="password" name="password" placeholder="Password" />
            </x-dashboard.form.input-layout>

            <x-dashboard.form.input-layout id="role" name="role" title="Role">
                <select class="form-select" name="role" id="role" aria-label="Default select example">
                    @foreach ($roles as $key => $role)
                        <option value="{{ $key }}" {{ $key === old('role', 2) ? 'selected' : '' }}>
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
    </x-dashboard.layouts.form-create-edit>
</x-dashboard-layout>
