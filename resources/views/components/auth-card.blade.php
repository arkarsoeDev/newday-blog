<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        {{ $logo }} 
    </div>

    @if(request()->routeIs('login'))
        <div class="mt-3">
        <span>Don't have an account?<a href="{{ route('register') }}" class="text-blue-700 underline-offset-3 hover:underline"> Register</a></span>
    </div>
    @endif

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
