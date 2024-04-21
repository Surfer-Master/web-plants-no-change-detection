<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap" />
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/all.min.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/styles.min.css') }}">
</head>

<body>
    <section class="bg-gray-50 dark:bg-gray-900 h-screen flex">
        <div class="flex-1 hidden md:block">
            <div class="flex h-screen items-center justify-center">
                <dotlottie-player src="{{ asset('dotlottie/ZVeyQfBhu0.lottie') }}" background="transparent"
                    speed="1" style="width: auto; height: auto;" loop autoplay></dotlottie-player>
            </div>
        </div>
        <div class="flex-1 flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen">
            <a href="/" class="flex items-center mb-6 text-3xl font-semibold text-gray-900 dark:text-white">
                <img class="w-8 h-8 mr-2 rounded-full" src="{{ asset('img/smart-farming-rounded.png') }}"
                    alt="logo">
                Smart Farming
            </a>
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Sign in to your account
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="group @error('email') is-invalid @enderror">
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white group-[.is-invalid]:text-red-600">Email</label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center ps-3.5 pointer-events-none group-[.is-invalid]:text-red-600">
                                    <i class="fa-solid fa-envelope "></i>
                                </div>
                                <input type="email" name="email" id="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 group-[.is-invalid]:text-red-600 group-[.is-invalid]:border-red-300 group-[.is-invalid]:focus:ring-red-600 group-[.is-invalid]:focus:border-red-600 group-[.is-invalid]:placeholder-red-600"
                                    placeholder="Masukkan Email" value="{{ old('email') }}" autocomplete="email"
                                    required>
                            </div>
                            @error('email')
                                <div class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                        class="font-medium">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="group @error('password') is-invalid @enderror">
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white group-[.is-invalid]:text-red-600">Password</label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center ps-3.5 pointer-events-none group-[.is-invalid]:text-red-600">
                                    <i class="fa-solid fa-lock"></i>
                                </div>
                                <input type="password" name="password" id="password" placeholder="Masukkan Password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 group-[.is-invalid]:text-red-600 group-[.is-invalid]:border-red-300 group-[.is-invalid]:focus:ring-red-600 group-[.is-invalid]:focus:border-red-600 group-[.is-invalid]:placeholder-red-600"
                                    autocomplete="off" required>
                                <div class="absolute inset-y-0 right-0 flex items-center pe-3.5 cursor-pointer">
                                    <i class="fa-solid fa-eye-slash"></i>
                                </div>
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                        class="font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input name="remember" id="remember" aria-describedby="remember" type="checkbox"
                                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                                </div>
                            </div>
                            <a href="#"
                                class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot
                                password?</a>
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign
                            in</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Don’t have an account yet? <a href="#"
                                class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    {{-- <script src="{{ asset('vendor/dotlottie/player-component/dist/dotlottie-player.mjs') }}" type="module"></script> --}}
    {{-- <script src="{{ asset('vendor/dotlottie/player-component/dist/dotlottie-player.js') }}"></script> --}}
    <script type="module" src="https://unpkg.com/@dotlottie/player-component@2.3.0/dist/dotlottie-player.mjs"></script>
    <script src="{{ asset('js/scripts.min.js') }}"></script>
</body>

</html>
