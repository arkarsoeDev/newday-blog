<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

    <div class="mb-3 p-3 bg-gray-200">
        <span class="mb-3">Admin Account</span>
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
                <span class="mb-3">Editor Account</span>
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
                <span class="mb-3">Author Account</span>
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

    <div>
        {{ $logo }}
    </div>

    @if (request()->routeIs('login'))
        <div class="mt-3">
            <span>Don't have an account?<a href="{{ route('register') }}"
                    class="text-blue-700 underline-offset-3 hover:underline"> Register</a></span>
        </div>
    @endif

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
