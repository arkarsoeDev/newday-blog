<x-dashboard-layout>
    <x-dashboard.heading>Profile</x-dashboard.heading>

    <div class="profile">
        <div class="profile__inner-container">
            <div class="row justify-content-center justify-content-lg-start">
                <div class="col-12 col-sm-8 col-lg-6 col-xxl-4">
                    <div class="card c-card mb-3">
                        <div class="card-body">
                            <div class="profile__img-container">
                                @if ($user->profile_image)
                                    <img class="profile__img" src="{{ asset('storage/thumbnails/small_' . $user->profile_image) }}" alt="">
                                @else
                                    <div class="profile__img-icon">
                                        <x-icons.user></x-icons.user>
                                    </div>
                                @endif
                            </div>
                            <div class="profile__info-container">
                                <form action="{{ route('dashboard.profile.update', $user->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="profile__title d-flex fw-bold display-6 mb-3">
                                        Profile Info
                                    </div>
                                    <x-dashboard.form.input-layout class="mb-3">
                                        <x-slot name="name">username</x-slot>
                                        <x-slot name="id">username</x-slot>
                                        <x-slot name="title">Usernmae</x-slot>
                                        <input type="text" value="{{ old('username', $user->name) }}"
                                            class="form-control @error('username')
                                            is-invalid                              
                                            @enderror"
                                            id="username" name="username" placeholder="username" />
                                    </x-dashboard.form.input-layout>
                                    <x-dashboard.form.input-layout class="mb-3">
                                        <x-slot name="name">profile_image</x-slot>
                                        <x-slot name="id">profileImage</x-slot>
                                        <x-slot name="title">Profile Image</x-slot>
                                        <input type="file"
                                            class="form-control @error('profile_image') is-invalid @enderror"
                                            name="profile_image" id="profileImage" />
                                    </x-dashboard.form.input-layout>
                                    <button type="submit" class="d-block btn btn-primary w-100">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-8 col-lg-6 col-xxl-4">
                    <div class="card c-card mb-3">
                        <div class="card-body">
                            <div>
                                <form action="{{ route('dashboard.profile.updateEmail', $user->id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <div class="profile__title d-flex fw-bold display-6 mb-3">
                                        Update Email
                                    </div>
                                    <x-dashboard.form.input-layout class="mb-3">
                                        <x-slot name="name">email</x-slot>
                                        <x-slot name="id">email</x-slot>
                                        <x-slot name="title">Email</x-slot>
                                        <input type="text" value="{{ old('email', $user->email) }}"
                                            class="form-control @error('email')
                                            is-invalid                              
                                            @enderror"
                                            id="email" name="email" placeholder="email" />
                                    </x-dashboard.form.input-layout>
                                    <x-dashboard.form.input-layout id="emailCurrentPassword" name="email_current_password"
                                        title="Current Password">
                                        <input type="password" value="{{ old('email_current_password') }}"
                                            class="form-control @error('email_current_password')
                                            is-invalid                              
                                            @enderror"
                                            id="email_current_password" name="email_current_password"
                                            placeholder="Current Password" />
                                    </x-dashboard.form.input-layout>
                                    <button class="d-block btn btn-primary w-100">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-8 col-lg-6 col-xxl-4">
                    <div class="card c-card mb-3">
                        <div class="card-body">
                            <div>
                                <form action="{{ route('dashboard.profile.updatePassword', $user->id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <div class="profile__title d-flex fw-bold display-6 mb-3">
                                        Change Password
                                    </div>
                                    <x-dashboard.form.input-layout class="mb-3">
                                        <x-slot name="name">password_current_password</x-slot>
                                        <x-slot name="id">PasswordCurrentPassword</x-slot>
                                        <x-slot name="title">Current Password</x-slot>
                                        <input type="password" value="{{ old('password_current_password') }}"
                                            class="form-control @error('password_current_password')
                                            is-invalid                              
                                            @enderror"
                                            id="passwordCurrentPassword" name="password_current_password"
                                            placeholder="Current Password" />
                                    </x-dashboard.form.input-layout>
                                    <x-dashboard.form.input-layout id="newPassword" name="new_password"
                                        title="New Password">
                                        <input type="password" value="{{ old('new_password') }}"
                                            class="form-control @error('new_password')
                                            is-invalid                              
                                            @enderror"
                                            id="newPassword" name="new_password"
                                            placeholder="Current Password" />
                                    </x-dashboard.form.input-layout>
                                    <x-dashboard.form.input-layout id="newPasswordConfirmation"
                                        name="new_password_confirmation" title="Repeat New Password">
                                        <input type="password" value="{{ old('new_password_confirmation') }}"
                                            class="form-control @error('new_password_confirmation')
                                            is-invalid                              
                                            @enderror"
                                            id="newPasswordConfirmation" name="new_password_confirmation"
                                            placeholder="Repeat new password" />
                                    </x-dashboard.form.input-layout>
                                    <button class="d-block btn btn-primary w-100">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
