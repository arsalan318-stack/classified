<!doctype html>
<html class="no-js" lang="">


<!-- Mirrored from radiustheme.com/demo/html/classipost/classipost/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 16 Nov 2022 11:05:26 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ClassiPost | Home 1</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    <!-- Font-awesome CSS-->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <!-- Owl Caousel CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/OwlCarousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/OwlCarousel/owl.theme.default.min.css') }}">
    <!-- Main Menu CSS -->
    <link rel="stylesheet" href="{{ asset('css/meanmenu.min.css') }}">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <!-- Magnific CSS -->
    <link rel="stylesheet" type="{{ asset('text/css" href="css/magnific-popup.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    @livewireStyles
    @vite(['resources/js/app.js'])
</head>

<body>
    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an
        <strong>outdated</strong> browser. Please
        <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.
    </p>
    <![endif]-->
    <!-- Add your site or application content here -->
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper">
        <!-- Header Area Start Here -->
        <header>
            <div id="header-three" class="header-style1 header-fixed">
                <div class="header-top-bar top-bar-style1 bg-white">
                    <div class="container">
                        <div class="row no-gutters">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-8">
                                <div class="top-bar-left">
                                    <a href="post-ad.html" class="cp-default-btn d-lg-none">Post Your Ad</a>
                                    <p class="d-none d-lg-block text-dark">
                                        <i class="fa fa-life-ring" aria-hidden="true"></i>Have any questions? +088
                                        199990 or mail@classipost
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-4">
                                <div class="top-bar-right">
                                    @if (Route::has('login'))
                                        <nav class="flex items-center justify-end gap-4">
                                            @auth
                                                <!-- Settings Dropdown -->
                                                <div class="ms-3 relative">
                                                    <x-dropdown align="right" width="48">
                                                        <x-slot name="trigger">
                                                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                                <button
                                                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                                    @if(Auth::user()->profile_photo_path)
                                                                        <img class="size-8 rounded-full object-cover"
                                                                            src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                                                                            alt="{{ Auth::user()->name }}" />
                                                                            @else
                                                                    <img class="size-8 rounded-full object-cover"
                                                                        src="{{ Auth::user()->profile_photo_url }}"
                                                                        alt="{{ Auth::user()->name }}" />
                                                                        @endif
                                                                </button>
                                                            @else
                                                                <span class="inline-flex rounded-md">
                                                                    <button type="button"
                                                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                                        {{ Auth::user()->name }}

                                                                        <svg class="ms-2 -me-0.5 size-4"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            fill="none" viewBox="0 0 24 24"
                                                                            stroke-width="1.5" stroke="currentColor">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                                        </svg>
                                                                    </button>
                                                                </span>
                                                            @endif
                                                        </x-slot>

                                                        <x-slot name="content">
                                                            <!-- Account Management -->
                                                            <div class="block px-4 py-2 mr-50 text-xs text-gray-400">
                                                                {{ __('Manage Account') }}
                                                            </div>

                                                            <x-dropdown-link href="{{ route('profile.show') }}">
                                                                {{ __('Profile') }}
                                                            </x-dropdown-link>

                                                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                                                    {{ __('API Tokens') }}
                                                                </x-dropdown-link>
                                                            @endif

                                                            <div class="border-t border-gray-200"></div>

                                                            <!-- Authentication -->
                                                            <form method="POST" action="{{ route('logout') }}" x-data>
                                                                @csrf

                                                                <x-dropdown-link href="{{ route('logout') }}"
                                                                    @click.prevent="$root.submit();">
                                                                    {{ __('Log Out') }}
                                                                </x-dropdown-link>
                                                            </form>
                                                            <x-dropdown-link href="{{ route('my_ads') }}">
                                                                My Ads
                                                            </x-dropdown-link>
                                                             <x-dropdown-link href="{{route('favorites_ad')}}">
                                                               Favorites Ads
                                                             </x-dropdown-link>
                                                        </x-slot>
                                                    </x-dropdown>
                                                </div>
                                                <li class="hidden-mb">
                                                    <a class="login-btn" href="{{route('chat')}}">
                                                        <i class="fa fa-comments-o" aria-hidden="true"></i>Live Chat
                                                    </a>
                                                </li>
                                            @else
                                                <ul>
                                                    <li>
                                                        <button type="button" class="login-btn" data-toggle="modal"
                                                            data-target="#myModal">
                                                            <i class="fa fa-lock" aria-hidden="true"></i>Login
                                                        </button>
                                                    </li>
                                                    @if (Route::has('register'))
                                                        <li>
                                                            <button type="button" class="login-btn" data-toggle="modal"
                                                                data-target="#register">
                                                                <i class="fa fa-lock" aria-hidden="true"></i>Sign Up
                                                            </button>
                                                        </li>
                                                    @endif
                                                </ul>


                                            @endauth
                                        </nav>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-menu-area bg-dark" id="sticker">
                    <div class="container">
                        <div class="row no-gutters d-flex align-items-center">
                            <div class="col-lg-2 col-md-2 col-sm-3">
                                <div class="logo-area">
                                    <a href="index.html" class="img-fluid">
                                        <img src="{{asset('img/logo.png')}}" alt="logo">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-6 possition-static">
                                <div class="cp-main-menu">
                                    <nav>
                                        <ul>
                                            <li><a href="{{url('/')}}">Home</a>
                                                <ul class="cp-dropdown-menu">
                                                    
                                                </ul>
                                            </li>
                                             <!-- ✅ NEW ALL CATEGORIES ITEM -->
                                            <li class="menu-justify"><a href="#">All Categories</a>
                                                <div class="rt-dropdown-mega container">
                                                    <div class="rt-dropdown-inner bg-white">
                                                        <div class="row">
                                                         @foreach ($categories as $category)
                                                            <div class="col-sm-3">
                                                                <ul class="rt-mega-items">
                                                                    <li class="text-dark"><strong>{{$category->name}}</strong></li>
                                                                    @if($category->subcategories->count())
                                                                    @foreach ($category->subcategories as $subcategory)
                                                                        <li>
                                                                            <a class="text-secondary" href="{{route('product_with_subcategory', $subcategory->id)}}">
                                                                                {{ $subcategory->name }}
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                           @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- ✅ END ALL CATEGORIES ITEM -->
                                            @foreach ($subcategories as $subcategory)
                                            <li><a href="#">{{$subcategory->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-3 text-right">
                                <a href="{{route('post_ad')}}" class="cp-default-btn">Post Your Ad</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu Area Start -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul>
                                        <li><a href="#">All Categories</a>
                                            <ul>
                                                @foreach ($categories as $category)
                                                    <li><a href="#">{{ $category->name }}</a>
                                                        <ul>

                                                            @if ($category->subcategories->count())
                                                                @foreach ($category->subcategories as $subcategory)
                                                                    <li><a href="#">{{ $subcategory->name }}</a>
                                                                    </li>
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                    </li>
                                                @endforeach
                                            </ul>

                                        </li>

                                        <li><a href="#">Home</a>
                            
                                        </li>
                                        @foreach ($subcategories as $subcategory)
                                        <li><a
                                                href="#">{{ $subcategory->name }}</a>
                                        </li>
                                    @endforeach                                       
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu Area End -->
        </header>
        <!-- Header Area End Here -->
        <!-- Search Area Start Here -->
        <section class="search-layout1 bg-body full-width-border-bottom fixed-menu-mt">
            <div class="container">
                <form method="GET" action="{{ route('search') }}" enctype="multipart/form-data"
                    id="cp-search-form">
                    @csrf
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="form-group search-input-area input-icon-location">
                                <select name="location" id="location" class="select2">
                                    <option class="first" value="0">Select Location</option>
                                   @foreach($cities as $city)
                                   <option class="first" value="{{$city}}">{{$city}}</option>
                                   @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="form-group search-input-area input-icon-category">

                                <select name="category" id="categories" class="select2">
                                    <option class="first" value="0">Select Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="form-group search-input-area input-icon-keywords">
                                <input placeholder="Enter Keywords here ..." value="" name="key-word"
                                    type="text">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12 text-right text-left-mb">
                            <button class="cp-search-btn" type="submit">

                                <i class="fa fa-search" aria-hidden="true"></i>Search

                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- Search Area End Here -->
       @yield('content')
        <!-- Footer Area Start Here -->
        <footer>
            <div class="footer-area-top s-space-equal">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="footer-box">
                                <h3 class="title-medium-light title-bar-left size-lg">About us</h3>
                                <ul class="useful-link">
                                    <li>
                                        <a href="about.html">About us</a>
                                    </li>
                                    <li>
                                        <a href="#">Career</a>
                                    </li>
                                    <li>
                                        <a href="#">Terms &amp; Conditions</a>
                                    </li>
                                    <li>
                                        <a href="#">Privacy Policy</a>
                                    </li>
                                    <li>
                                        <a href="#">Sitemap</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="footer-box">
                                <h3 class="title-medium-light title-bar-left size-lg">How to sell fast</h3>
                                <ul class="useful-link">
                                    <li>
                                        <a href="#">How to sell fast</a>
                                    </li>
                                    <li>
                                        <a href="#">Buy Now on Classipost</a>
                                    </li>
                                    <li>
                                        <a href="#">Membership</a>
                                    </li>
                                    <li>
                                        <a href="#">Banner Advertising</a>
                                    </li>
                                    <li>
                                        <a href="#">Promote your ad</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="footer-box">
                                <h3 class="title-medium-light title-bar-left size-lg">Help &amp; Support</h3>
                                <ul class="useful-link">
                                    <li>
                                        <a href="#">Live Chat</a>
                                    </li>
                                    <li>
                                        <a href="faq.html">FAQ</a>
                                    </li>
                                    <li>
                                        <a href="#">Stay safe on classipost</a>
                                    </li>
                                    <li>
                                        <a href="contact.html">Contact us</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="footer-box">
                                <h3 class="title-medium-light title-bar-left size-lg">Follow Us On</h3>
                                <ul class="folow-us">
                                    <li>
                                        <a href="#">
                                            <img src="img/footer/follow1.jpg" alt="follow">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="img/footer/follow2.jpg" alt="follow">
                                        </a>
                                    </li>
                                </ul>
                                <ul class="social-link">
                                    <li class="fa-classipost">
                                        <a href="#">
                                            <img src="img/footer/facebook.jpg" alt="social">
                                        </a>
                                    </li>
                                    <li class="tw-classipost">
                                        <a href="#">
                                            <img src="img/footer/twitter.jpg" alt="social">
                                        </a>
                                    </li>
                                    <li class="yo-classipost">
                                        <a href="#">
                                            <img src="img/footer/youtube.jpg" alt="social">
                                        </a>
                                    </li>
                                    <li class="pi-classipost">
                                        <a href="#">
                                            <img src="img/footer/pinterest.jpg" alt="social">
                                        </a>
                                    </li>
                                    <li class="li-classipost">
                                        <a href="#">
                                            <img src="img/footer/linkedin.jpg" alt="social">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-area-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 text-center-mb">
                            <p>Copyright © classipost</p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 text-right text-center-mb">
                            <ul>
                                <li>
                                    <img src="img/footer/card1.jpg" alt="card">
                                </li>
                                <li>
                                    <img src="img/footer/card2.jpg" alt="card">
                                </li>
                                <li>
                                    <img src="img/footer/card3.jpg" alt="card">
                                </li>
                                <li>
                                    <img src="img/footer/card4.jpg" alt="card">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Area End Here -->
    </div>
    <!--Login Modal Start-->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="title-default-bold mb-none">Login</div>
                </div>
                <div class="modal-body">
                    <x-guest-layout>
                        <x-authentication-card>
                            <x-slot name="logo">
                                <x-authentication-card-logo />
                            </x-slot>

                            <x-validation-errors class="mb-4" />

                            @session('status')
                                <div class="mb-4 font-medium text-sm text-green-600">
                                    {{ $value }}
                                </div>
                            @endsession
                            <a href="{{ route('google.login') }}" class="btn btn-danger w-full">
                                <i class="fa fa-google"></i> Login with Google
                            </a>
                            
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div>
                                    <x-label for="email" value="{{ __('Email') }}" />
                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                        :value="old('email')" required autofocus autocomplete="username" />
                                </div>

                                <div class="mt-4">
                                    <x-label for="password" value="{{ __('Password') }}" />
                                    <x-input id="password" class="block mt-1 w-full" type="password"
                                        name="password" required autocomplete="current-password" />
                                </div>

                                <div class="block mt-4">
                                    <label for="remember_me" class="flex items-center">
                                        <x-checkbox id="remember_me" name="remember" />
                                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                    </label>
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    @if (Route::has('password.request'))
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                            href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    @endif

                                    <x-button class="ms-4 bg-info">
                                        {{ __('Log in') }}
                                    </x-button>
                                </div>
                            </form>
                        </x-authentication-card>
                    </x-guest-layout>

                </div>
            </div>
        </div>
    </div>
    <!--Login Modal End-->

<!--Register Modal Start-->
<div class="modal fade" id="register" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="title-default-bold mb-none">Register</div>
            </div>
            <div class="modal-body">
                <x-guest-layout>
                    <x-authentication-card>
                        <x-slot name="logo">
                            <x-authentication-card-logo />
                        </x-slot>

                        <x-validation-errors class="mb-4" />

                        @session('status')
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ $value }}
                            </div>
                        @endsession
                        <a href="{{ route('google.login') }}" class="btn btn-danger w-full">
                            <i class="fa fa-google"></i> Register with Google
                        </a>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                
                            <div>
                                <x-label for="name" value="{{ __('Name') }}" />
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            </div>
                
                            <div class="mt-4">
                                <x-label for="email" value="{{ __('Email') }}" />
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            </div>
                
                            <div class="mt-4">
                                <x-label for="password" value="{{ __('Password') }}" />
                                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                            </div>
                
                            <div class="mt-4">
                                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                            </div>
                
                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="mt-4">
                                    <x-label for="terms">
                                        <div class="flex items-center">
                                            <x-checkbox name="terms" id="terms" required />
                
                                            <div class="ms-2">
                                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </x-label>
                                </div>
                            @endif
                
                            <div class="flex items-center justify-end mt-4">
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a>
                
                                <x-button class="ms-4 bg-info">
                                    {{ __('Register') }}
                                </x-button>
                            </div>
                        </form>
                    </x-authentication-card>
                </x-guest-layout>

            </div>
        </div>
    </div>
</div>
<!--Register Modal End-->

    <!-- Report Abuse Modal Start-->
    <div class="modal fade" id="report_abuse" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content report-abuse-area radius-none">
                <div class="gradient-wrapper">
                    <div class="gradient-title">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h2 class="item-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>There's
                            Something Wrong With This Ads?</h2>
                    </div>
                    <div class="gradient-padding reduce-padding">
                        <form id="report-abuse-form">
                            <div class="form-group">
                                <label class="control-label" for="first-name">Your E-mail</label>
                                <input type="text" id="first-name" class="form-control"
                                    placeholder="Type your mail here ...">
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="control-label" for="first-name">Your Reason</label>
                                    <textarea placeholder="Type your reason..." class="textarea form-control" name="message" id="form-message"
                                        rows="7" cols="20" data-error="Message field is required" required></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="cp-default-btn-sm">Submit Now!</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Report Abuse Modal End-->
    <!-- jquery-->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <!-- jQuery Zoom -->
    <script src="{{ asset('js/jquery.zoom.min.js') }}"></script>
    <!-- Popper js -->
    <script src="{{ asset('js/popper.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Owl Cauosel JS -->
    <script src="{{ asset('vendor/OwlCarousel/owl.carousel.min.js') }}"></script>
    <!-- Meanmenu Js -->
    <script src="{{ asset('js/jquery.meanmenu.min.js') }}"></script>
    <!-- Srollup js -->
    <script src="{{ asset('js/jquery.scrollUp.min.js') }}"></script>
    <!-- jquery.counterup js -->
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <!-- Select2 Js -->
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <!-- Isotope js -->
    <script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
    <!-- Magnific Popup -->
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('js/main.js') }}"></script>
    <!-- Google Map js -->
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <!-- Validator js -->
    <script src="{{ asset('js/validator.min.js') }}"></script>
    @stack('scripts')
    @livewireScripts
</body>


<!-- Mirrored from radiustheme.com/demo/html/classipost/classipost/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 16 Nov 2022 11:06:15 GMT -->

</html>
