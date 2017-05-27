<!DOCTYPE html>
<html class="transition-navbar-scroll top-navbar-xlarge bottom-footer" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Employ Me | {{ title_case(Auth::user()->name) }}</title>
    
    <!-- styles -->
    <link href="{{ asset('public/css/vendor.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/theme-core.min.css') }}" rel="stylesheet">

    <link href="{{ asset('public/css/module-essentials.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/module-material.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/module-layout.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/module-navbar.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/module-carousel-slick.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/module-colors-background.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/module-colors-buttons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/module-colors-text.min.css') }}" rel="stylesheet">

    <!-- <link href="{{ asset('public/fonts/module-carousel-slick.min.css') }}" rel="stylesheet"> -->
    
    <style>
        @import url('https://fonts.googleapis.com/css?family=Overlock');
        body {
            font-family: Overlock;
        }
        .bg-blue-400 {
            background-image: url("https://farm8.staticflickr.com/7288/9167365008_d0e3ab0127_k.jpg"); 
            /*min-height: 200px;*/
            /*float: left;*/
            /*position: absolute;*/
        }
        .page-section {
            padding: 20px;
        }
        #profile {
            background-color: #fff;
            margin-top:80px;
            padding: 0 30px 30px 30px;
            /*margin: -300px auto;*/
            z-index: 10;
            width: 82%;
            height: auto;
            border: 1px solid transparent;
            border-color: #e2e9e6;
            /*border-radius: 50%;*/
            box-shadow: 0 0 0 .5px rgba(0, 0, 0, .1), 0 2px 2px rgba(0,0,0,.15);
        }
        #profile img{
            background-color: #fff;
            z-index: 10;
            border: 2px solid transparent;
            border-color: #e2e9e6;
            box-shadow: 0 1px 1px rgba(0,0,0,.2);
        }
        #profile p{
            padding-top: 15px;
        }
        #photo {
            margin-top: -60px;
        }
        h1 {
            color: rgba(0,0,0,.7);
            font-weight: 200;
        }
        #social-media-heading {
            border-bottom: 4px solid #0c80df;
        }
        a:hover i.fa-facebook  { 
            color: #3B5998; 
        }
        a:hover i.fa-linkedin { 
            color: #0084bf; 
        }
        a:hover i.fa-google-plus { 
            color: #d34836; 
        }
        a:hover i.fa-twitter { 
            color: #4099FF; 
        }
        a:hover i.fa-plus { 
            color: #bd362f; 
        }
        h4 .fa {
            padding: 7px;
        }
        .edit:hover {
        background-color: #ccc; 
        /*border-radius: 50%; */
        }
        #edit li {
            padding: 0 15px;
        }
        #education-heading {
            border-bottom: 5px solid #81c784;
            border-radius: 1.7px;
        }
        #certificates-heading {
            border-bottom: 5px solid #ba68c8!important;
            border-radius: 1.7px;
        }
        #section img {
            width: 100%;
            overflow: hidden;
        }
        .certificate-img {
            height: 100px;
            width: 150px;
            margin: 9px;
            overflow: hidden;
            border: 2px solid transparent;
            border-color: #e2e9e6;
            box-shadow: 0 1px 1px rgba(0,0,0,.2);
        }
        .section-item {
            padding: 5px;
            border-bottom: 1px solid #ccc;
            overflow: hidden;
        }
        .section-item img {
            border: 2px solid transparent;
            border-color: #e2e9e6;
            box-shadow: 0 1px 1px rgba(0,0,0,.2);
            width: 100%;
            overflow: hidden;
        }
        .section-item:last-child {
            border-bottom: 1px solid transparent;
        }
        .panel {
            box-shadow: 0 2px 2px rgba(0,0,0,.15);
        }
        #skills-heading {
            border-bottom: 5px solid #e57373;
            border-radius: 1.7px;
        }
        #experience-heading {
            border-bottom: 5px solid #FF8A65;
            border-radius: 1.7px;
        }
        .btn-default {
            background-color: inherit;
        }
        .btn-default:hover {
            background-color: rgba(200,200,200,.1);
        }
    </style>

    @yield('styles')

</head>
<body>
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
            
            <div class="collapse navbar-collapse" id="main-nav">
                <div class="navbar-right">
                    <ul class="nav navbar-nav navbar-nav-margin-right">
                        <li class="dropdown user active">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                @if(isset(Auth::user()->jobseeker->avatar))
                                    <img src="{{ asset('public/img/jobseekers') }}/{{ Auth::user()->jobseeker->avatar }}" alt="{{ Auth::user()->name }}" class="img-circle">
                                @else
                                    <img src="http://placehold.it/145x145" alt="{{ Auth::user()->name }}" class="img-circle">
                                @endif
                                {{ Auth::user()->name }}
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
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


    <footer class="footer">
        <strong>EmployMe</strong> v1.0.0 &copy; Copyright 2017
    </footer>
    <!-- // Footer -->

    <!-- Separate Vendor Script Bundles -->
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