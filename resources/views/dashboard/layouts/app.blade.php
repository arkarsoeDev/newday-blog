<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    @yield('extra-css')
    <!-- Scripts -->
    @vite(['resources/sass/dashboard/app.scss', 'resources/js/dashboard.js'])
</head>

<body>
    <div class="main-wrapper toggled">
        @include('dashboard.layouts.sidebar')
        <div class="content-wrapper d-flex flex-column">
            <div class="content">
                <div class="container-fluid bg-white shadow px-4">
                    @include('dashboard.layouts.topbar')
                </div>
                <!-- Page Content -->
                <main>
                    <div class="container-fluid px-4 mb-4">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
        <div class="backdrop hide"></div>
    </div>
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const Toast = window.Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        @if(session()->has('message'))
            Toast.fire({
            icon: "{{ session()->get('status') }}",
            title: "{{ session()->get('message') }}"
            })
            {{ session()->forget('message') }}
        @endif
    </script>
    @stack('scripts')
</body>

</html>
