<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>testing</title>
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
</body>

</html>
