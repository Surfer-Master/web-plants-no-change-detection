<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @stack('meta')
    <title>{{ $title }}</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/all.min.css') }}" rel="stylesheet">
    @stack('css')
    @stack('style')
    @stack('head-js')
    @stack('head-script')
</head>

<body id="page-top">
    @include('layouts.partials.sidebar')
    @include('layouts.partials.navbar')
    <div class="pt-24 pb-14 max-w-screen-xl mx-auto">
        <div class="px-2">
            @yield('content')
        </div>
    </div>
    @include('layouts.partials.footer')

    {{-- <!-- back to top button --> --}}
    <a href="#page-top"
        class="back-to-top page-scroll fixed bottom-3 right-3 z-[9999] hidden h-11 w-11 items-center justify-center rounded-full bg-slate-700 p-4 hover:bg-slate-950 "
        title="Back to Top">
        <i class="fa-solid fa-angle-up fa-xl text-gray-50"></i>
    </a>
    {{-- <!-- end of back to top button --> --}}

    @include('sweetalert::alert')
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    @stack('body-js')
    @stack('body-script')
</body>

</html>
