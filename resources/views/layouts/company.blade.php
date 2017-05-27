<!DOCTYPE html>
<html class="transition-navbar-scroll top-navbar-xlarge bottom-footer" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>EmployMe | {{ title_case(Auth::user()->name) }}</title>
    
    <!-- styles -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    
    <link href="{{ asset('public/css/vendor.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/theme-core.min.css') }}" rel="stylesheet">
    
    <link href="{{ asset('public/css/module-essentials.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/module-material.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/module-layout.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/module-navbar.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/module-carousel-slick.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/module-colors-background.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/module-colors-buttons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/module-colors-text.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/intlTelInput.css') }}" rel="stylesheet">
    <style>
        .height-220 {
            min-height: 220px;
        }
        .media.v-middle {
            background-color: #fff;
            padding: 10px;
            position: relative;
            transition: all 0.5s ease-in-out;
        }
        .media.v-middle:hover .v-middle-hover{
            opacity: 1;
        }
        .v-middle-hover {
            position: absolute;
            right: 0;
            left: 0;
            top: 0;
            bottom: 0;
            background: rgba(245, 245, 245, 0.88);
            z-index: 2;
            opacity: 0;
            transition: all 0.5s ease-in-out;
            text-align: center;
            line-height: 70px;
        }
        .img-center {
            text-align: center;
            margin: 0 auto;
        }
        .text-display {
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 26px;
            color: rgba(0,0,0,.85);
        }
        .about-company p {
            color: rgba(0,0,0,.7);
            line-height: 22px;
            font-size: 16px;
        }
        #map {
            height: 400px;
            width: 100%;
        }
        .mt-20 {
            margin-top: 20px;
            color: rgba(0,0,0,0.6);
        }
        .btn-transparent {
            width: 30px;
            background: transparent;
            border: 0;
            transition: all 0.6s ease-in-out;
            border-radius: 50%;
            height: 30px;
            line-height: 35px;
            padding: 0;
        }
        .btn-transparent:hover {
            background-color: rgba(230, 230, 230, 1);
            border-radius: 50%
        }
        .fa-1 {
            font-size: 20px;
            color: rgba(66, 66, 66, 0.74);
        }
        .page-section.third {
            position: relative;
            overflow: inherit;
        }
        .company-card {
            position: absolute!important;
            width: 83.7%;
            top: 70%;
            color: rgba(0,0,0,0.6);
        }
        .pt-80 {
            padding-top: 80px;
        }
        span.mandatory{
            color: #42a5f5;
            font-size: 16px;
        }
        .prl-20 {
            padding: 0 20px!important;
        }
        .intl-tel-input {
            width: 100%;
        }
        .white-card {
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
        }
        .fs-16 {
            font-size: 16px;
        }
        .tagcloud {
            line-height: 35px;
        }
        .tag-skill {
            background: #eee;
            padding: 10px;
            border-radius: 30px;
            font-size: 16px;
            cursor: default;
        }
        .mb-20 {
            margin-bottom: 20px;
        }
    </style>

    @yield('styles')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries
        WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!-- If you don't need support for Internet Explorer <= 8 you can safely remove these -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top navbar-size-large navbar-size-xlarge paper-shadow" data-z="0" data-animated role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-brand navbar-brand-logo">
                    <a href="{{ url('/') }}">EmployMe</a>
                </div>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="main-nav">
                
                <!-- <ul class="nav navbar-nav navbar-nav-margin-left">
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages</a>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Courses</a>
                    </li>
                    <li class="dropdown active">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Student</a>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Instructor</a>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">UI</a>
                    </li>
                </ul> -->
                
                <div class="navbar-right">
                    <ul class="nav navbar-nav navbar-nav-margin-right">
                        <li class="dropdown user active">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                @if(isset(Auth::user()->company->logo))
                                    <img src='{{ asset("public/img/logo") }}/{{ Auth::user()->company->logo }}' alt="{{ Auth::user()->name }}" class="img-circle">
                                @else
                                    <img src="http://placehold.it/145x145" class="img-circle" alt="{{ Auth::user()->name }}">
                                @endif
                                {{ title_case(Auth::user()->name) }}
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                {{-- <li class="active">
                                    <a href="#">
                                        <i class="fa fa-bar-chart-o"></i> Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-mortar-board"></i> My Courses
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user"></i> Profile
                                    </a>
                                </li> --}}
                                <li>
                                     <a href="{{ route('logout') }}">
                                        <i class="fa fa-sign-out"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    @yield('content')
    

    <!-- Inline Script for colors and config objects; used by various external scripts; -->
    <script src="{{ asset('public/js/vendor-core.min.js') }}"></script>
    
    <script src="{{ asset('public/js/vendor-forms.min.js') }}"></script>
    <script src="{{ asset('public/js/vendor-carousel-slick.min.js') }}"></script>
    <script src="{{ asset('public/js/vendor-nestable.min.js') }}"></script>
    <script src="{{ asset('public/js/module-essentials.min.js') }}"></script>
    <script src="{{ asset('public/js/module-material.min.js') }}"></script>
    <script src="{{ asset('public/js/module-layout.min.js') }}"></script>
    <script src="{{ asset('public/js/module-sidebar.min.js') }}"></script>

    <script src="{{ asset('public/js/module-carousel-slick.min.js') }}"></script>
    
    @yield('scripts')
</body>
</html>