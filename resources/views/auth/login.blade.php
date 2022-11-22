<x-guest-layout>

    <div id="testModal" class="fixed h-screen z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div id="testModalBackdrop" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity z-10"></div>

        <div class="relative h-screen w-screen">
            <div class="absolute z-20 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div
                        class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="mb-3 p-3 bg-gray-200 rounded">
                                <span class="mb-2 inline-block">Admin Account</span>
                                <div class="flex flex-col bg-white p-3 mb-3">
                                    <div class="flex">
                                        <span class="mr-3 font-bold">Email</span>
                                        <span>admin@admin.com</span>
                                    </div>
                                    <div class="flex">
                                        <span class="mr-3 font-bold">Password</span>
                                        <span>password</span>
                                    </div>
                                </div>
                                <span class="mb-2 inline-block">Editor Account</span>
                                <div class="flex flex-col bg-white p-3 mb-3">
                                    <div class="flex">
                                        <span class="mr-3 font-bold">Email</span>
                                        <span>editor@editor.com</span>
                                    </div>
                                    <div class="flex">
                                        <span class="mr-3 font-bold">Password</span>
                                        <span>password</span>
                                    </div>
                                </div>
                                <span class="mb-2 inline-block">Author Account</span>
                                <div class="flex flex-col bg-white p-3 mb-3">
                                    <div class="flex">
                                        <span class="mr-3 font-bold">Email</span>
                                        <span>author@author.com</span>
                                    </div>
                                    <div class="flex">
                                        <span class="mr-3 font-bold">Password</span>
                                        <span>password</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button id="testModalClose" type="button"
                                class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-auth-card>

        <x-slot name="logo">
            <a href="{{ route('page.index') }}" class="text-blue-500 text-2xl font-bold">
                New Day Blog
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ml-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
        <x-slot name="testModalToggle">
            <button id="testModalToggle" class="bg-white border p-3 hover:bg-gray-50 rounded-sm">Test Accounts</button>
        </x-slot>
    </x-auth-card>

</x-guest-layout>
