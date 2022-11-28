<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/sass/front/app.scss', 'resources/js/front.js'])
</head>

<body>
    @include('front.layouts.navbar')
    {{ $head ?? '' }}
    {{ $breadcrumb ?? '' }}
    <div class="container">
        {{ $slot }}
        <footer>
            <div class="row py-5 text-center">
                <div class="footer">
                    <span> © New Day all Rights Reserved </span>
                </div>
            </div>
        </footer>
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
        @endif
    </script>
    @stack('scripts')
</body>

</html>
