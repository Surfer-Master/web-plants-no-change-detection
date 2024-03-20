<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- <!-- SEO Meta Tags --> --}}
    {{-- <meta name="description"
        content="Pavo is a mobile app Tailwind CSS HTML template created to help you present benefits, features and information about mobile apps in order to convince visitors to download them" />
    <meta name="author" content="Your name" /> --}}

    {{-- <!-- OG Meta Tags to improve the way the post looks when you share the page on Facebook, Twitter, LinkedIn --> --}}
    {{-- <meta property="og:site_name" content="" /> <!-- website name -->
    <meta property="og:site" content="" /> <!-- website link -->
    <meta property="og:title" content="" /> <!-- title shown in the actual shared post -->
    <meta property="og:description" content="" /> <!-- description shown in the actual shared post -->
    <meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content="" /> <!-- where do you want your post to link to -->
    <meta name="twitter:card" content="summary_large_image" /> <!-- to have large image post format in Twitter --> --}}

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
    {{-- <!-- Navigation --> --}}
    <nav class="navbar fixed-top">
        <div class="container sm:px-4 lg:px-8 flex flex-wrap items-center justify-between lg:flex-nowrap">
            <!-- Text Logo - Use this if you don't have a graphic logo -->
            <!-- <a class="text-gray-800 font-semibold text-3xl leading-4 no-underline page-scroll" href="index.html">Pavo</a> -->

            <!-- Image Logo -->
            <a class="inline-block mr-4 py-0.5 text-xl whitespace-nowrap hover:no-underline focus:no-underline"
                href="index.html">
                <img src="images/logo.svg" alt="alternative" class="h-8" />
            </a>

            <button
                class="background-transparent rounded text-xl leading-none hover:no-underline focus:no-underline lg:hidden lg:text-gray-400"
                type="button" data-toggle="offcanvas">
                <i class="fa-solid fa-bars fa-lg"></i>
            </button>

            <div class="navbar-collapse offcanvas-collapse lg:flex lg:flex-grow lg:items-center"
                id="navbarsExampleDefault">
                <ul class="pl-0 mt-3 mb-2 ml-auto flex flex-col list-none lg:mt-0 lg:mb-0 lg:flex-row">
                    <li>
                        <a class="nav-link page-scroll active" href="#header">Home <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li>
                        <a class="nav-link page-scroll" href="#features">Features</a>
                    </li>
                    <li>
                        <a class="nav-link page-scroll" href="#details">Details</a>
                    </li>
                    {{-- <li>
                        <a class="nav-link page-scroll" href="#pricing">Pricing</a>
                    </li> --}}
                    {{-- <li class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Drop</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown01">
                            <a class="dropdown-item page-scroll" href="article.html">Article Details</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item page-scroll" href="terms.html">Terms Conditions</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item page-scroll" href="privacy.html">Privacy Policy</a>
                        </div>
                    </li>
                    <li>
                        <a class="nav-link page-scroll" href="#download">Download</a>
                    </li> --}}
                </ul>


                <span class="block lg:ml-3.5">

                    <a class="font-semibold bg-indigo-600 text-white border border-indigo-600 hover:bg-transparent hover:text-indigo-600 rounded-full px-7 py-2"
                        href="{{ route('login') }}">Login <i class="fa-solid fa-right-to-bracket"></i></a>
                    {{-- <a class="no-underline" href="#your-link">
                        <i
                            class="fab fa-apple text-indigo-600 hover:text-pink-500 text-xl transition-all duration-200 mr-1.5"></i>
                    </a>
                    <a class="no-underline" href="#your-link">
                        <i
                            class="fab fa-android text-indigo-600 hover:text-pink-500 text-xl transition-all duration-200"></i>
                    </a> --}}
                </span>
            </div>
            <!-- end of navbar-collapse -->
        </div>
        <!-- end of container -->
    </nav>

    {{-- <!-- end of navbar --> --}}

    <!-- Header -->
    <header id="header" class="header py-28 text-center md:pt-36 lg:text-left xl:pt-44 xl:pb-32">
        <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-2 lg:gap-x-8">
            <div class="mb-16 lg:mt-32 xl:mt-40 xl:mr-12">
                <h1 class="h1-large mb-5">Team management mobile application</h1>
                <p class="p-large mb-8">Start getting things done together with your team based on Pavo's revolutionary
                    team management features</p>
                <a class="btn-solid-lg" href="#your-link"><i class="fab fa-apple"></i>Download</a>
                <a class="btn-solid-lg secondary" href="#your-link"><i class="fab fa-google-play"></i>Download</a>
            </div>
            <div class="xl:text-right">
                <img class="inline" src="images/header-smartphone.png" alt="alternative" />
            </div>
        </div> <!-- end of container -->
    </header>
    <!-- end of header -->

    <!-- Introduction -->
    <div class="pt-4 pb-14 text-center">
        <div class="container px-4 sm:px-8 xl:px-4">
            <p class="mb-4 text-gray-800 text-3xl leading-10 lg:max-w-5xl lg:mx-auto"> Team management mobile apps don’t
                get better than Pavo. It’s probably the best app in the world for this purpose. Don’t hesitate to give
                it a try today and you will fall in love with it</p>
        </div> <!-- end of container -->
    </div>
    <!-- end of introduction -->

    <!-- Features -->
    <div id="features" class="cards-1">
        <div class="container px-4 sm:px-8 xl:px-4">

            <!-- Card -->
            <div class="card">
                <div class="card-image">
                    <img src="images/features-icon-1.svg" alt="alternative" />
                </div>
                <div class="card-body">
                    <h5 class="card-title">Platform Integration</h5>
                    <p class="mb-4">You sales force can use the app on any smartphone platform without compatibility
                        issues</p>
                </div>
            </div>
            <!-- end of card -->

            <!-- Card -->
            <div class="card">
                <div class="card-image">
                    <img src="images/features-icon-2.svg" alt="alternative" />
                </div>
                <div class="card-body">
                    <h5 class="card-title">Easy On Resources</h5>
                    <p class="mb-4">Works smoothly even on older generation hardware due to our optimization efforts
                    </p>
                </div>
            </div>
            <!-- end of card -->

            <!-- Card -->
            <div class="card">
                <div class="card-image">
                    <img src="images/features-icon-3.svg" alt="alternative" />
                </div>
                <div class="card-body">
                    <h5 class="card-title">Great Performance</h5>
                    <p class="mb-4">Optimized code and innovative technology insure no delays and ultra-fast
                        responsiveness</p>
                </div>
            </div>
            <!-- end of card -->

            <!-- Card -->
            <div class="card">
                <div class="card-image">
                    <img src="images/features-icon-4.svg" alt="alternative" />
                </div>
                <div class="card-body">
                    <h5 class="card-title">Multiple Languages</h5>
                    <p class="mb-4">Choose from one of the 40 languages that come pre-installed and start selling
                        smarter</p>
                </div>
            </div>
            <!-- end of card -->

            <!-- Card -->
            <div class="card">
                <div class="card-image">
                    <img src="images/features-icon-5.svg" alt="alternative" />
                </div>
                <div class="card-body">
                    <h5 class="card-title">Free Updates</h5>
                    <p class="mb-4">Don't worry about future costs, pay once and receive all future updates at no
                        extra cost</p>
                </div>
            </div>
            <!-- end of card -->

            <!-- Card -->
            <div class="card">
                <div class="card-image">
                    <img src="images/features-icon-6.svg" alt="alternative" />
                </div>
                <div class="card-body">
                    <h5 class="card-title">Community Support</h5>
                    <p class="mb-4">Register the app and get acces to knowledge and ideas from the Pavo online
                        community</p>
                </div>
            </div>
            <!-- end of card -->

        </div> <!-- end of container -->
    </div> <!-- end of cards-1 -->
    <!-- end of features -->

    <!-- Details 1 -->
    <div id="details" class="pt-12 pb-16 lg:pt-16">
        <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-12 lg:gap-x-12">
            <div class="lg:col-span-5">
                <div class="mb-16 lg:mb-0 xl:mt-16">
                    <h2 class="mb-6">Results driven ground breaking technology</h2>
                    <p class="mb-4">Based on our team's extensive experience in developing line of business
                        applications and constructive customer feedback we reached a new level of revenue.</p>
                    <p class="mb-4">We enjoy helping small and medium sized tech businesses take a shot at
                        established Fortune 500 companies</p>
                </div>
            </div> <!-- end of col -->
            <div class="lg:col-span-7">
                <div class="xl:ml-14">
                    <img class="inline" src="images/details-1.jpg" alt="alternative" />
                </div>
            </div> <!-- end of col -->
        </div> <!-- end of container -->
    </div>
    <!-- end of details 1 -->

    {{-- <!-- Footer --> --}}
    <div class="footer">
        <div class="container px-4 sm:px-8">
            <h4 class="mb-8 lg:max-w-3xl lg:mx-auto">Pavo is a mobile application for marketing automation and you can
                reach the team at <a class="text-indigo-600 hover:text-gray-500"
                    href="mailto:email@domain.com">email@domain.com</a></h4>
            <div class="social-container">
                <span class="fa-stack">
                    <a href="#your-link">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-facebook-f fa-stack-1x"></i>
                    </a>
                </span>
                <span class="fa-stack">
                    <a href="#your-link">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-twitter fa-stack-1x"></i>
                    </a>
                </span>
                <span class="fa-stack">
                    <a href="#your-link">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-pinterest-p fa-stack-1x"></i>
                    </a>
                </span>
                <span class="fa-stack">
                    <a href="#your-link">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-instagram fa-stack-1x"></i>
                    </a>
                </span>
                <span class="fa-stack">
                    <a href="#your-link">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-youtube fa-stack-1x"></i>
                    </a>
                </span>
            </div>
        </div>
    </div>
    {{-- <!-- end of footer --> --}}

    {{-- <!-- Copyright --> --}}
    <div class="copyright">
        <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-3">
            <ul class="mb-4 list-unstyled p-small">
                <li class="mb-2"><a href="article.html">Article Details</a></li>
                <li class="mb-2"><a href="terms.html">Terms & Conditions</a></li>
                <li class="mb-2"><a href="privacy.html">Privacy Policy</a></li>
            </ul>
            <p class="pb-2 p-small statement">Copyright © <a href="#your-link" class="no-underline">Your name</a></p>

            <p class="pb-2 p-small statement">Distributed by :<a href="https://themewagon.com/"
                    class="no-underline">Themewagon</a></p>
        </div>
    </div>
    {{-- <!-- end of copyright --> --}}

    {{-- <!-- back to top button --> --}}
    <a href="#header"
        class="back-to-top page-scroll fixed bottom-3 right-3 z-[9999] hidden h-11 w-11 items-center justify-center rounded-full bg-slate-700 p-4 hover:bg-slate-950 "
        title="Back to Top">
        <i class="fa-solid fa-angle-up fa-xl text-gray-50"></i>
    </a>
    {{-- <!-- end of back to top button --> --}}

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/scripts.min.js') }}"></script>
</body>

</html>
