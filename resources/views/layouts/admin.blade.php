<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>EmployMe | {{ title_case($active) }}</title>
        
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/plugins/fontawesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset('public/plugins/slim/slim.min.css') }}">
        <link href="{{ asset('public/css/layout.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/css/darkblue.min.css') }}" rel="stylesheet" type="text/css" id="style_color" />

        @yield('styles')
    
    </head>

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <div class="page-wrapper">
            <div class="page-header navbar navbar-fixed-top">
                <div class="page-header-inner ">
                    <div class="page-logo">
                        <a href="{{ URL('/') }}">
                          <h3 style="margin-top: 10px;">EmployMe</h3>
                        </a>
                        <div class="menu-toggler sidebar-toggler">
                            <span></span>
                        </div>
                    </div>
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"></a>
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            @if(Auth::user()->type == 'admin')
                                <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                        <i class="icon-settings text-danger"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="external">
                                            <h3>
                                                <span class="bold">All Settings</span>
                                            </h3>
                                            <a href="{{ url('admin/settings') }}">view all</a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            
                            <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-bell"></i>
                                    <span class="badge badge-default"> 7 </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="external">
                                        <h3>
                                            <span class="bold">12 pending</span> notifications</h3>
                                        <a href="page_user_profile_1.html">view all</a>
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">just now</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-success">
                                                            <i class="fa fa-plus"></i>
                                                        </span> New user registered.
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">3 mins</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Server #12 overloaded.
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">10 mins</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-warning">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span> Server #2 not responding.
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">14 hrs</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-info">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </span> Application error.
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">2 days</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Database overloaded 68%.
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">3 days</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> A user IP blocked.
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">4 days</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-warning">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span> Storage Server #4 not responding dfdfdfd.
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">5 days</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-info">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </span> System Error.
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">9 days</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Storage server failed.
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <span class="username username-hide-on-mobile">{{ Auth::user()->name }}</span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="#">
                                            <i class="icon-user"></i> My Profile 
                                        </a>
                                    </li>
                                    {{-- <li>
                                        <a href="app_inbox.html">
                                            <i class="icon-envelope-open"></i> My Inbox
                                            <span class="badge badge-danger"> 3 </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="app_todo.html">
                                            <i class="icon-rocket"></i> My Tasks
                                            <span class="badge badge-success"> 7 </span>
                                        </a>
                                    </li> --}}
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="{{ route('logout') }}">
                                            <i class="icon-key"></i> Log Out
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            <li class="dropdown dropdown-quick-sidebar-toggler">
                                <a href="{{ route('logout') }}" class="dropdown-toggle">
                                    <i class="icon-logout"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="clearfix"></div>
            
            <div class="page-container">
                <div class="page-sidebar-wrapper">
                    <div class="page-sidebar navbar-collapse collapse">
                        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                            <li class="sidebar-toggler-wrapper hide">
                                <div class="sidebar-toggler">
                                    <span></span>
                                </div>
                            </li>
                            <li class="nav-item start active open">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-home"></i>
                                    <span class="title">Dashboard</span>
                                    <span class="selected"></span>
                                    <span class="arrow open"></span>
                                </a>
                                <ul class="sub-menu">
                                    @if(Auth::user()->type == 'examiner')
                                        <li class="nav-item start @if($active == 'dashboard') {{ 'active' }} @endif">
                                            <a href="{{ url('examiner') }}" class="nav-link ">
                                                <i class="fa fa-user"></i>
                                                <span class="selected"></span>
                                                <span class="title">Dashboard</span>
                                            </a>
                                        </li>
                                        <li class="nav-item start @if($active == 'exams') {{ 'active' }} @endif">
                                            <a href="{{ url('examiner/exams') }}" class="nav-link ">
                                                <i class="fa fa-check"></i>
                                                <span class="title">Exams Dashboard </span>
                                            </a>
                                        </li>
                                    @else
                                        <li class="nav-item start @if($active == 'dashboard') {{ 'active' }} @endif">
                                            <a href="{{ url('admin') }}" class="nav-link ">
                                                <i class="fa fa-user"></i>
                                                <span class="selected"></span>
                                                <span class="title">Dashboard</span>
                                            </a>
                                        </li>
                                        <li class="nav-item start @if($active == 'admins') {{ 'active' }} @endif">
                                            <a href="{{ url('admin/admins') }}" class="nav-link ">
                                                <i class="fa fa-user"></i>
                                                <span class="selected"></span>
                                                <span class="title">Admins</span>
                                            </a>
                                        </li>
                                        <li class="nav-item start @if($active == 'jobseekers') {{ 'active' }} @endif">
                                            <a href="{{ url('admin/jobseekers') }}" class="nav-link ">
                                                <i class="fa fa-group"></i>
                                                <span class="title">Job Seekers</span>
                                            </a>
                                        </li>
                                        <li class="nav-item start @if($active == 'companies') {{ 'active' }} @endif">
                                            <a href="{{ url('admin/companies') }}" class="nav-link ">
                                                <i class="fa fa-building-o"></i>
                                                <span class="title">Companies</span>
                                            </a>
                                        </li>
                                        <li class="nav-item start @if($active == 'examiners') {{ 'active' }} @endif"">
                                            <a href="{{ url('admin/examiners') }}" class="nav-link ">
                                                <i class="fa fa-suitcase"></i>
                                                <span class="title">Examiners </span>
                                            </a>
                                        </li>
                                        <li class="nav-item start ">
                                            <a href="{{ url('admin/courses') }}" class="nav-link ">
                                                <i class="fa fa-book"></i>
                                                <span class="title">Courses Dashboard </span>
                                            </a>
                                        </li>
                                        <li class="nav-item start ">
                                            <a href="#" class="nav-link ">
                                                <i class="fa fa-check"></i>
                                                <span class="title">Exams Dashboard </span>
                                            </a>
                                        </li>
                                        <li class="nav-item start ">
                                            <a href="{{ url('admin/categories') }}" class="nav-link ">
                                                <i class="fa fa-tags"></i>
                                                <span class="title">Categories Dashboard </span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="page-content-wrapper">
                    <div class="page-content">
                        <div class="page-bar">
                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="{{ url('admin') }}">Home</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>{{ title_case($active) }}</span>
                                </li>
                            </ul>
                        </div>
                        @yield('content')
                        
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="page-footer">
            <div class="page-footer-inner"> 2016 &copy; Metronic Theme By
                <a target="_blank" href="http://keenthemes.com">Keenthemes</a> &nbsp;|&nbsp;
                <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a>
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div> -->
        
        {{-- <nav class="quick-nav">
            <a class="quick-nav-trigger" href="#0">
                <span aria-hidden="true"></span>
            </a>
            <ul>
                <li>
                    <a href="https://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" target="_blank" class="active">
                        <span>Purchase Metronic</span>
                        <i class="icon-basket"></i>
                    </a>
                </li>
                <li>
                    <a href="https://themeforest.net/item/metronic-responsive-admin-dashboard-template/reviews/4021469?ref=keenthemes" target="_blank">
                        <span>Customer Reviews</span>
                        <i class="icon-users"></i>
                    </a>
                </li>
                <li>
                    <a href="http://keenthemes.com/showcast/" target="_blank">
                        <span>Showcase</span>
                        <i class="icon-user"></i>
                    </a>
                </li>
                <li>
                    <a href="http://keenthemes.com/metronic-theme/changelog/" target="_blank">
                        <span>Changelog</span>
                        <i class="icon-graph"></i>
                    </a>
                </li>
            </ul>
            <span aria-hidden="true" class="quick-nav-bg"></span>
        </nav> --}}
        
        {{-- <div class="quick-nav-overlay"></div> --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        {{-- <script src="{{ asset('public/plugins/jquery/jquery.min.js') }}" type="text/javascript"></script> --}}
        {{-- <script src="{{ asset('public/plugins/jquery-ui/jquery-ui.min.js') }}"></script> --}}
        <script src="{{ asset('public/plugins/slim/slim.kickstart.min.js') }}"></script>
        <script src="{{ asset('public/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        @yield('scripts')
    
    </body>
</html>