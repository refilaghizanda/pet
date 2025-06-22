<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'Petcare Ngunut')</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Favicons -->
    <link href="{{ asset('medicio/assets/img/logo3.png') }}" rel="icon">
    <link href="{{ asset('medicio/assets/img/logo3.png') }}" rel="apple-touch-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('medicio/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('medicio/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('medicio/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('medicio/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('medicio/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('medicio/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <!-- Main CSS File -->
    <link href="{{ asset('medicio/assets/css/main.css') }}" rel="stylesheet">
    @stack('styles')
</head>

<body class="index-page">
    <!-- header  -->
    @include('frontend.layouts.header')
    <main class="main">
        @yield('content')
    </main>
    <!-- footer  -->
    @include('frontend.layouts.footer')
    <!-- scroll top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <!-- preloader -->
    <div id="preloader"></div>
    <!-- vendor js file -->
    <script src="{{ asset('medicio/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('medicio/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('medicio/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('medicio/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('medicio/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('medicio/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <!-- main js file -->
    <script src="{{ asset('medicio/assets/js/main.js') }}"></script>

    {{-- script eye --}}
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordField.type === 'password') {
                passwordField.type = 'text'; // Show password
                eyeIcon.classList.remove('bi-eye-slash'); // Ganti ikon
                eyeIcon.classList.add('bi-eye');
            } else {
                passwordField.type = 'password'; // Hide password
                eyeIcon.classList.remove('bi-eye');
                eyeIcon.classList.add('bi-eye-slash');
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
