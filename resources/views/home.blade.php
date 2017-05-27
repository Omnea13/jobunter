<!DOCTYPE html>
<html>
    <head>
        <!-- Title -->
        <title>Jobunter</title>
        
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="FiveFighters" />
        
        <!-- Styles -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:500,400,300' rel='stylesheet' type='text/css'>
        

        <link href="{{ asset('public/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('public/plugins/fontawesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css"/>

        <!-- Register Modal -->
        <link href="{{ asset('public/plugins/pricing-tables/css/style.css') }}" rel="stylesheet" type="text/css">
        <!-- Slim Photo -->
        <link href="{{ asset('public/plugins/slim/slim.min.css') }}">
        <!-- Mobile Input -->
        <link href="{{ asset('public/css/intlTelInput.css') }}">

        <link href="{{ asset('public/css/landing.css') }}" rel="stylesheet" type="text/css"/>
        
        <style>
            .slim {
                width: 200px;
                height: 200px;
                border-radius: 50%;
                margin: 0 auto;
            }
            .pl-0 {
                padding-left: 0;
            }
            .intl-tel-input {
                width: 100%;
            }
        </style>
    </head>
    <body data-spy="scroll" data-target="#header">
        

        <!--================================
        =            Navigation            =
        =================================-->
        <nav id="header" class="navbar navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="fa fa-bars"></span>
                    </button>
                    <a class="navbar-brand" href="#">EmployMe</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#founders">Founders</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--====  End of Navigation  ====-->
        

        <!--==================================
        =            Home Section            =
        ===================================-->
        <div class="home" id="home">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="home-text col-md-8">
                        <img src="{{ asset('public/img/jobunterlogo.png') }}">
                        <hr style="width:40%">
                        <p class="lead wow fadeInDown" data-wow-delay="2s" data-wow-duration="1.5s" data-wow-offset="10">Your dream job has already begun.</p>
                        @if(Auth::guest())
                            <button data-toggle="modal" data-target="#register-modal" class="btn btn-default btn-rounded btn-lg wow fadeInUp" data-wow-delay="2.5s" data-wow-duration="1.5s" data-wow-offset="10">Register</button>
                            <button data-toggle="modal" data-target="#login-modal" class="btn btn-primary btn-rounded btn-lg wow fadeInUp" data-wow-delay="2.5s" data-wow-duration="1.5s" data-wow-offset="10">Login</button>
                        @else
                            @if(Auth::user()->type == 'company')
                                <a href="{{ url('company') }}" class="btn btn-primary btn-rounded wow fadeInUp">Dashboard</a>
                            @elseif(Auth::user()->type == 'jobseeker')
                                <a href="{{ url('jobseeker') }}" class="btn btn-primary btn-rounded wow fadeInUp"> <i class="fa fa-user"></i> Profile</a>
                            @elseif(Auth::user()->type == 'admin')
                                <a href="{{ url('admin') }}" class="btn btn-primary btn-rounded wow fadeInUp"> <i class="fa fa-secret"></i> Dashboard</a>
                            @elseif(Auth::user()->type == 'examiner')
                                <a href="{{ url('examiner') }}" class="btn btn-primary btn-rounded wow fadeInUp"> <i class="fa fa-secret"></i> Dashboard</a>
                            @else
                                
                            @endif
                        @endif
                    </div>
                    <div class="scroller">
                        <div class="mouse"><div class="wheel"></div></div>
                    </div>
                </div>
            </div>
        </div>
        <!--====  End of Home Section  ====-->
        

        <!--=====================================
        =            Feature Section            =
        ======================================-->
        <div id="features">
            <div class="container">
                <div class="row features-list">
                    <h1 style="margin-bottom: 40px; text-align: center;"> 
                        How it works? 
                    </h1>
                        <div class="col-sm-4 wow fadeInLeft" data-wow-duration="1.5s" data-wow-offset="10" data-wow-delay="0.5s">
                            <div class="feature-icon">
                                <i class="fa fa-building"></i>
                            </div>
                            <h2>For Companies</h2>
                            <p>Hire the QUALIFIED ones in no time.</p>
                        </div>
                        <div class="col-sm-4 wow fadeInLeft" data-wow-duration="1.5s" data-wow-offset="10" data-wow-delay="0.7s">
                            <div class="feature-icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <h2>For Job seekers</h2>
                            <p>Take the test and add your skills.</p>
                        </div>
                        <div class="col-sm-4 wow fadeInLeft" data-wow-duration="1.5s" data-wow-offset="10" data-wow-delay="0.9s">
                            <div class="feature-icon">
                                <i class="fa fa-graduation-cap"></i>
                            </div>
                            <h2>Learning Paths</h2>
                            <p>Are made for whom they are passionate about boosting their career up.</p>
                        </div>
                 </div>
            </div>    
        </div>
        <!--====  End of Feature Section  ====-->
        

        <!--===================================
        =            Power Section            =
        ====================================-->
        <section id="section-1">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 wow fadeInLeft" data-wow-delay="0.5s" data-wow-duration="1.5s" data-wow-offset="10">
                        <img src="{{ asset('public/img/power.jpg') }}" class="img-responsive iphone-img" alt="">
                    </div>
                    <div class="col-sm-8 wow fadeInRight" data-wow-delay="0.5s" data-wow-duration="1.5s" data-wow-offset="10">
                        <h1>The Power You Need</h1>
                        <ul class="list-unstyled features-list-2">
                            <li><i class="fa fa-building-o icon-state-success text-primary m-r-xs icon-md"></i>Well-known Companies</li>
                            <li><i class="fa fa-users icon-state-success m-r-xs text-primary icon-md"></i>Qualified Job seekers</li>
                            <li><i class="fa fa-money icon-state-success m-r-xs text-primary icon-md"></i>The price in your hands</li>
                        </ul>
                        <p>For companies, <a>subscribe now</a> for 50$/month and enjoy a 14 days trial period.</p>
                    </div>
                </div>
            </div>
        </section>
        <!--====  End of Power Section  ====-->
        

        <!--==========================================
        =            Testimonials Section            =
        ===========================================-->
        <section id="section-3">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 wow fadeInUp" data-wow-delay="0.5s" data-wow-duration="1.5s" data-wow-offset="10">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <div class="row">
                                        <div class="col-md-8 col-sm-offset-2">
                                            <p class="text-white">“we at Savvy Arabia appreciate new ideas and startup, and we hope that your app will achieve a great success.”</p>
                                            <span>- AbdelMalek Mohamed, Savvy Arabia Team</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="row">
                                        <div class="col-md-8 col-sm-offset-2">
                                            <p class="text-white">“I'll be always available and ready to support you to the best of my capabilities.”</p>
                                            <span>- Eng.Asmaa Ahmed, OTS Team</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="row">
                                        <div class="col-md-8 col-sm-offset-2">
                                            <p>“I liked the idea.”</p>
                                            <span>- Hazem Torab, enozom CEO</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </section>
        <!--====  End of Testimonials Section  ====-->
        
        
        <!--=====================================
        =            Contact Section            =
        ======================================-->
        <div id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3" data-wow-duration="1.5s" data-wow-offset="10" data-wow-delay="0.5s">
                        <a href="#contact" class="btn btn-primary btn-lg btn-rounded contact-button"><i class="fa fa-envelope-o"></i></a>
                        <h2>Let's keep in touch</h2>
                        <form class="m-t-md">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control input-lg contact-name" placeholder="Name">
                                    </div>
                                    <div class="col-sm-6">      
                                        <input type="email" class="form-control input-lg" placeholder="Email">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control input-lg" placeholder="Subject">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="4=6" placeholder="Message"></textarea>
                            </div>
                            <button type="submit" class="btn btn-default btn-lg">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--====  End of Contact Section  ====-->
        

        <!--====================================
        =            Footer Section            =
        =====================================-->
        <footer>
            <div class="container">
                <p class="text-center no-s"> Made with <i class="text-danger fa fa-heart"></i> and  <i class="fa fa-coffee"></i> | 2017 &copy; FiveFighters.</p>
                {{-- <p class="text-center no-s">2017 &copy; FiveFighters.</p> --}}
            </div>
        </footer>
        <!--====  End of Footer Section  ====-->

        <!--=================================
        =            Login Modal            =
        ==================================-->
        <div class="modal fade" id="login-modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title text-center">Welcome Back <i class="fa fa-smile"></i></h4>
                    </div>
                    <div class="modal-body clearfix">
                        <div class="col-xs-12">
                            <form action="#" method="POST" id="login-form">
                                {{ csrf_field() }}
                                <div class="alert alert-danger" style="display: none;" id="alert" role="alert">
                                    <ul></ul>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                        <input type="email" name="email" class="form-control" placeholder="E-mail Address">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Keep me logged in
                                        </label>
                                        <a href="#" class="text-primary pull-right">Forgot Password?!</a>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====  End of Login Modal  ====-->

        <!--====================================
        =            Register Modal            =
        =====================================-->
        <div class="modal fade" id="register-modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="cd-pricing-container">
                        <div class="cd-pricing-switcher">
                            <p class="fieldset">
                                <input type="radio" class="no-uniform" name="duration-1" value="jobseeker" id="jobseeker" checked>
                                <label for="jobseeker">Jobseeker</label>
                                <input type="radio" class="no-uniform" name="duration-1" value="company" id="company">
                                <label for="company">company</label>
                                <span class="cd-switch"></span>
                            </p>
                        </div>
                        <ul class="cd-pricing-list cd-bounce-invert p-0">
                            <li>
                                <ul class="cd-pricing-wrapper">
                                    
                                    <li data-type="jobseeker" class="is-visible">
                                        <form action="#" method="POST" id="jobseeker">
                                            {{ csrf_field() }}
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="hidden" name="type" value="jobseeker">
                                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                        <input type="text" name="name" class="form-control" id="name" placeholder="Username">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                                        <input type="email" name="email" class="form-control" id="email" placeholder="E-mail Address">
                                                    </div>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <div class="col-md-6 pl-0">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 p-0">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm Password">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <input type="submit" value="Create Profile" class="btn btn-primary btn-block">
                                                </div>
                                            </div>
                                        </form>
                                    </li>

                                    <li data-type="company" class="is-hidden">
                                        <form action="#" method="POST" id="company">
                                            {{ csrf_field() }}
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="hidden" name="type" value="company">
                                                        <span class="input-group-addon"><i class="fa fa-hospital-o" aria-hidden="true"></i></span>
                                                        <input type="text" name="name" class="form-control" id="name" placeholder="Company Name">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                                        <input type="email" name="email" class="form-control" id="email" placeholder="E-mail Address">
                                                    </div>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <div class="col-md-6 pl-0">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 p-0">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm Password">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <input type="submit" value="Create Profile" class="btn btn-primary btn-block">
                                                </div>
                                            </div>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--====  End of Register Modal  ====-->
                
        <!-- Javascripts -->
        <script src="{{ asset('public/plugins/jquery/jquery-2.1.3.min.js') }}"></script>
        <script src="{{ asset('public/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('public/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('public/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset('public/plugins/wow/wow.min.js') }}"></script>
        <!-- Regiter Modal -->
        <script src="{{ asset('public/plugins/pricing-tables/js/modernizr.js') }}"></script>
        <script src="{{ asset('public/plugins/pricing-tables/js/main.js') }}"></script>
        <!-- Slim Photo -->
        <script src="{{ asset('public/plugins/slim/slim.kickstart.min.js') }}"></script>
        <!-- Mobile Input -->
        <script src="{{ asset('public/js/intlTelInput.min.js') }}"></script>
        <script src="{{ asset('public/js/landing.js') }}"></script>

        <script>
            $(document).ready(function(){
                var telInput = $("#phone");

                telInput.intlTelInput({
                    initialCountry: "auto",
                    geoIpLookup: function(callback) {
                        $.get('http://ipinfo.io', function() {}, "jsonp").always(function(resp) {
                        var countryCode = (resp && resp.country) ? resp.country : "";
                        callback(countryCode);
                        });
                    },
                    utilsScript: "./js/utils.js" // just for formatting/placeholders etc
                });
            });
        </script>
        <script>
            $(function(){
                var ajax = function(form) {
                    $.ajax({
                        url: 'register',
                        data: $(form).serialize(),
                        type: "POST",
                        success: function(response) {
                            // console.log(response);
                            window.location = response.url;
                        },
                        error: function(response) {
                            var errors = response.responseJSON;
                            $.each(errors, function(name, error) {
                                $(form+" input[name='"+name+"']").parents('.form-group').addClass('has-error').append("<p class='text-danger error'>"+error+"</p>");
                            });

                            $('p.error').delay(2000).slideUp();
                        },
                        beforeSend: function() {

                        }
                    });
                }

                $("form#jobseeker").on('submit', function(event) {
                    event.preventDefault();
                    ajax("form#jobseeker");
                });

                $("form#company").on("submit", function(event) {
                    event.preventDefault();
                    ajax("form#company");
                });

                $("form#login-form").on("submit", function(event) {
                    event.preventDefault();

                    $.ajax({
                        url: 'login',
                        type: 'POST',
                        data: $(this).serialize(),
                        success: function(response) {
                            if (response.success) {
                                window.location =response.url;                            
                            }
                        },
                        error: function(response) {
                            console.log(response);
                            var errors = response.responseJSON;
                            $("#alert ul").empty();
                            $.each(errors, function(name, error) {
                                $("#alert ul").append("<li>"+error[0]+"</li>");
                                $("#alert").show();
                            });
                            $("#alert").delay(2000).slideUp();
                        },
                        beforeSend: function() {

                        }
                    });
                });
            });
        </script>
    </body>
</html>