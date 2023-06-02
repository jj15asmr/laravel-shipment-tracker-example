<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Track Item | PoŝtaLoĝistiko</title>

    {{-- Meta Tags --}}
    <meta name="title" content="Track Item | PoŝtaLoĝistiko">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="author" content="Jacob Prunkl">
    <meta name="theme-color" content="#208336">

    {{-- Favicons --}}
    <link rel="icon" type="image/png" href="{{ asset('img/favicons/32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ asset('img/favicons/16x16.png') }}" sizes="16x16" />

    {{-- Bootstrap 5.2.1 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    {{-- Bunny Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=nunito:400,500" rel="stylesheet" />

    {{-- FontAwesome 6.4.0 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Animate.css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    {{-- Livewire CSS --}}
    <livewire:styles />
</head>
<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-light bg-light shadow-sm py-3">
        <div class="container px-md-5">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('img/logo.svg') }}" width="265">
            </a>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="https://github.com/jj15asmr/laravel-shipment-tracker-example">
                        {{-- Small Devices --}}
                        <span class="d-inline-block d-md-none"><i class="fa-brands fa-github"></i></span>

                        {{-- Larger Devices --}}
                        <span class="d-none d-md-inline-block"><i class="fa-brands fa-github"></i> View on GitHub</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    {{ $slot }}

    {{-- Bootstrap 5.2.1 JS w/ Popper.js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>

    {{-- Livewire JS --}}
    <livewire:scripts />
</body>
</html>