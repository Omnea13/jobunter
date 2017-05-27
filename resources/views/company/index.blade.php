@extends('layouts.company')

@section('styles')
    <link rel="stylesheet" href="{{ asset('public/plugins/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/countrySelect.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/slim/slim.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/tagsinput/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/timepicker/jquery-ui-timepicker-addon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/sweetalert/sweetalert.css') }}">
    <style>
        .pr-0 {
            padding-right: 0!important;
        }
        .pl-0 {
            padding-left: 0!important;
        }
        .country-select.inside {
            width: 100%;
        }
        #ui-datepicker-div {
            z-index: 999999!important;
            background: #eee;
            padding: 10px;
            border-radius: 10px;
        }
        .ui-datepicker-calendar {
            width: 100%;
        }
        .bootstrap-tagsinput {
            display: block;
        }
        .slim.img-responsive {
            height: 170px!important;
        }
        .company-cover {
            position: relative;
        }
        .company-cover .edit {
            position: absolute;
            top: 5px;
            right: 5px;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
        }
        li.list-group-item.paper-shadow:hover .job-hover {
            display: inline-block;
        }
        .job-hover {
            position: absolute;
            left: 0;
            right: 0;
            margin: 0 auto;
            text-align: center;
            width: 200px;
            display: none;
        }
        a.remove-job {
            background: rgba(242, 14, 15, 0.67);
            width: 30px;
            line-height: 30px;
            font-size: 18px;
            height: 30px;
            display: inline-block;
            color: #fff;
        }
        a.edit-job {
            background: #4ab157;
            width: 30px;
            line-height: 30px;
            font-size: 18px;
            height: 30px;
            display: inline-block;
            color: #fff;
        }
        a.open-job {
            background: #5783ff;
            width: 30px;
            line-height: 30px;
            font-size: 18px;
            height: 30px;
            display: inline-block;
            color: #fff;   
        }
        .social-media-heading {
            border-top: 4px solid #0c80df;
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
    </style>
@endsection

@section('content')
    @if(isset(Auth::user()->company->cover))
        <div class="overflow-hidden height-220 page-section company-cover third" style="background: url(public/img/cover/{{ Auth::user()->company->cover }}) no-repeat center center /cover">
    @else
        <div class="overflow-hidden height-220 page-section company-cover third" style="background-color: #ccc;">
    @endif
        <span class="edit" data-toggle="modal" data-target="#edit-company-cover-modal"><i class="fa fa-edit"></i></span>
        <div class="container">
            <div class="media v-middle company-card">
                <div class="col-md-2">
                    @if(isset(Auth::user()->company->logo))
                        <img src="public/img/logo/{{ Auth::user()->company->logo }}" alt="{{ Auth::user()->name }}" class="img-responsive img-center" />
                    @else
                        <img src="http://placehold.it/145x145" alt="">
                    @endif
                </div>
                <div class="col-md-10">
                    <h1 class="text-display margin-v-0"> {{ title_case(Auth::user()->name) }}
                        <div class="dropdown pull-right">
                            <button class="btn-transparent ropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="fa fa-ellipsis-h fa-1" aria-hidden="true"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="javascript:;" data-toggle="modal" data-target="#edit-company-info-modal">Edit</a></li>
                            </ul>
                        </div>
                    </h1>
                    <ul class="list-inline mt-20">
                        @if(isset(Auth::user()->company->industry))
                            <li><i class="fa fa-bolt"></i> {{ Auth::user()->company->industry }}</li>
                        @endif
                        @if(isset(Auth::user()->company->company_size))
                            <li><i class="fa fa-users"></i> {{ Auth::user()->company->company_size }}</li>
                        @endif
                        @if(isset(Auth::user()->company->country))
                            <li><i class="fa fa-map-marker"></i> {{ Auth::user()->company->country }}</li>
                        @endif
                        @if(isset(Auth::user()->company->city))
                            , {{ Auth::user()->company->city }}</li>
                        @endif
                    </ul>
                    <ul class="list-inline">
                        <li><i class="fa fa-envelope"></i> {{ Auth::user()->email }}</li>
                        @if(isset(Auth::user()->company->phone))
                            <li><i class="fa fa-phone-square"></i> {{ Auth::user()->company->phone }}</li>
                        @endif

                        @if(isset(Auth::user()->company->fax))
                            <li><i class="fa fa-fax"></i> {{ Auth::user()->company->fax }}</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container pt-80">
        <div class="page-section">
            <div class="row">
                <div class="col-md-9">
                    <div class="panel panel-default">
                        <div class="media v-middle">
                            @if(Auth::user()->company->type == 'trial')
                                <div class="media-left">
                                    <div class="bg-green-400 text-white">
                                        <div class="panel-body">
                                            <i class="fa fa-credit-card fa-fw fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading margin-v-5-3">
                                        Your Trial Period ends on 
                                        <span>{{ App\Helpers\Helper::after()['day'] }}</span>
                                        After 
                                        <span>{{ App\Helpers\Helper::after()['days'] }} Days - {{ App\Helpers\Helper::after()['hours'] }} Hours - {{ App\Helpers\Helper::after()['minutes'] }} Minutes</span>
                                    </p>
                                </div>
                                <div class="media-right media-padding">
                                    <a class="btn btn-white paper-shadow relative" data-z="0.5" data-hover-z="1" data-animated href="{{ URL('company/checkout/upgrade') }}">
                                        Upgrade
                                    </a>
                                </div>
                            @else
                                <div class="media-left">
                                    <div class="bg-green-400 text-white">
                                        <div class="panel-body">
                                            <i class="fa fa-credit-card fa-fw fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading margin-v-5-3">
                                        Your Subscription ends on 
                                        <span>{{ App\Helpers\Helper::after()['day'] }}</span>
                                        After 
                                        <span>{{ App\Helpers\Helper::after()['days'] }} Days - {{ App\Helpers\Helper::after()['hours'] }} Hours - {{ App\Helpers\Helper::after()['minutes'] }} Minutes</span>
                                    </p>
                                </div>

                                @if(App\Helpers\Helper::after()['days'] <= 5)
                                    <div class="media-right media-padding">
                                        <a class="btn btn-white paper-shadow relative" data-z="0.5" data-hover-z="1" data-animated href="{{ URL('company/checkout/upgrade') }}">
                                            Renew
                                        </a>
                                    </div>
                                @endif
                            
                            @endif
                        </div>
                    </div>
                    <div class="row" data-toggle="isotope">
                        <div class="item col-xs-12">
                            <div class="panel panel-default paper-shadow" data-z="0.5">
                                <div class="panel-heading">
                                    <h4 class="text-headline margin-none">About us
                                        <div class="dropdown pull-right">
                                            <button class="btn-transparent ropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <i class="fa fa-ellipsis-h fa-1" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                <li><a href="javascript:;" data-toggle="modal" data-target="#edit-about-us-modal">Edit</a></li>
                                            </ul>
                                        </div>
                                    </h4>
                                </div>
                                @if(isset(Auth::user()->company->about))
                                    <div class="panel-body about-company">
                                        <p>{{ Auth::user()->company->about }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="item col-xs-12">
                            <div class="panel panel-default paper-shadow">
                                <div class="panel-heading">
                                    <h4 class="text-headline">Available Posted Jobs
                                        <div class="dropdown pull-right">
                                            <a href="{{ url('company/jobs/new') }}" class="btn-transparent ropdown-toggle btn btn-lg btn-primary">
                                                <i class="fa fa-plus fa-1" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </h4>
                                </div>
                                <ul class="list-group relative paper-shadow" data-hover-z="0.5" data-animated>
                                    
                                    @foreach($jobs as $job)
                                        <li class="list-group-item paper-shadow">  
                                            <div class="media job-container v-middle">
                                                <div class="job-hover">
                                                    <a href="{{ URL('company/jobs') }}/{{ $job->id }}" class="open-job" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="Show Job Details"><i class="fa fa-external-link" aria-hidden="true"></i></a>
                                                    <a href="#" class="remove-job" data-id="{{ $job->id }}" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="Remove Job"><i class="fa fa-remove"></i></a>
                                                    <a href="{{ URL('company/jobs') }}/{{ $job->id }}/edit" class="edit-job" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="Edit Job"><i class="fa fa-edit"></i></a>
                                                </div>
                                                <div class="media-body">
                                                    <a href="{{ URL('company/jobs') }}/{{ $job->id }}" class="text-subhead job-details link-text-color" data-id="{{ $job->id }}">{{ $job->name }}</a> 
                                                    <i class="fa fa-clock-o"></i> <span class="text-caption text-light">{{ $job->created_at->diffForHumans() }}</span>
                                                    <div class="text-light">
                                                        <i class="fa fa-map-marker"></i> {{ $job->location }} 
                                                        <i class="fa fa-money"></i> {{ $job->salary }} EGP
                                                    </div>
                                                </div>
                                                <div class="media-right">
                                                    <div class="width-200 text-right">
                                                        <a class="paper-shadow relative"  href="#" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="jobseeker 1">
                                                            <img src="public/img/jobseekers/1.jpg" alt="jobseeker name" class="width-20 img-circle">
                                                        </a>
                                                        <a class="paper-shadow relative"  href="#" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="jobseeker 2">
                                                            <img src="public/img/jobseekers/2.jpg" alt="jobseeker name" class="width-20 img-circle">
                                                        </a>
                                                        <a class="paper-shadow relative"  href="#" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="jobseeker 3">
                                                            <img src="public/img/jobseekers/3.jpg" alt="jobseeker name" class="width-20 img-circle">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <br/>
                
                </div>
                
                <div class="col-md-3">
                    <div class="item col-xs-12">
                        <div class="panel panel-default paper-shadow" data-z="0.5">
                            <div class="panel-heading">
                                <h4 class="text-headline"><i class="fa fa-paper-plane" aria-hidden="true"></i>Social Media
                                    <div class="dropdown pull-right">
                                        <button class="btn-transparent ropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa fa-ellipsis-h fa-1" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a href="#" data-toggle="modal" data-target="#edit-company-social-modal">Edit</a></li>
                                        </ul>
                                    </div>
                                </h4>
                            </div>
                            
                            @if(Auth::user()->socialmedia)
                                <div class="panel-body">
                                    @if(isset(Auth::user()->socialmedia->website))
                                        <a class="btn btn-default text-grey-400 btn-lg btn-circle paper-shadow relative" target="_blank" href="{{ Auth::user()->socialmedia->website }}" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="Website">
                                            <i class="fa fa-link"></i>
                                        </a>
                                    @endif
                                    @if(isset(Auth::user()->socialmedia->facebook))
                                        <a class="btn btn-default text-grey-400 btn-lg btn-circle paper-shadow relative" target="_blank" href="{{ Auth::user()->socialmedia->facebook }}" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="Facebook">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    @endif
                                    @if(isset(Auth::user()->socialmedia->twitter))
                                        <a class="btn btn-default text-grey-400 btn-lg btn-circle paper-shadow relative" target="_blank" href="{{ Auth::user()->socialmedia->twitter }}" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="Twitter">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    @endif
                                    @if(isset(Auth::user()->socialmedia->linkedin))
                                        <a class="btn btn-default text-grey-400 btn-lg btn-circle paper-shadow relative" target="_blank" href="{{ Auth::user()->socialmedia->linkedin }}" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="LinkedIn">
                                            <i class="fa fa-linkedin"></i>
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="item col-xs-12">
                        <div class="panel panel-default paper-shadow" data-z="0.5">
                            <div class="panel-body list-group">
                                <ul class="list-group list-group-menu">
                                    <li class="list-group-item">
                                        <a class="link-text-color" href="{{ URL('company/payments') }}">Payments History</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="item col-xs-12">
                        <div class="panel panel-default paper-shadow" data-z="0.5">
                            <div class="panel-heading">
                                <h4 class="text-headline">Location</h4>
                            </div>
                            <div class="panel-body">
                                <form action="#" method="POST" id="location-form">
                                    <div class="input-group">
                                        <span class="input-group-addon"> <i class="fa fa-map-marker"></i></span>
                                        <input type="text" placeholder="Company Location" name="searchbox" class="form-control" id="searchbox">
                                    </div>
                                </form>
                                <div id="company_map" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <strong>EmployMe</strong> v1.0.0 &copy; Copyright 2017
    </footer>
    <!-- // Footer -->


    <!--=============================================
    =            Edit Company Info Modal            =
    ==============================================-->
    <div class="modal fade" id="edit-company-info-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" method="POST" id="edit-company-info-form">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title text-center">Edit Company Information</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company-name">Company Name</label>
                                        <input type="text" name="company_name" class="form-control" id="company-name" placeholder="Company name" disabled value="{{ Auth::user()->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="company-industry">Company Industry</label>
                                        @if(isset(Auth::user()->company->industry))
                                            <input type="text" name="company_industry" id="company-industry" class="form-control" placeholder="Company Industry" value="{{ Auth::user()->company->industry }}">
                                        @else
                                            <input type="text" name="company_industry" id="company-industry" class="form-control" placeholder="Company Industry">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="company-size">Company Size <span class="mandatory">*</span></label>
                                        @if(isset(Auth::user()->company->company_size))
                                            <select name="company_size" id="company-size" class="form-control">
                                                {{-- <option selected disabled>Your Company Size</option> --}}
                                                <option @if(Auth::user()->company->company_size == '1-10 employees') {{ 'selected' }} @endif value="1-10 employees">1-10 employees</option>
                                                <option @if(Auth::user()->company->company_size == '11-50 employees') {{ 'selected' }} @endif value="11-50 employees">11-50 employees</option>
                                                <option @if(Auth::user()->company->company_size == '51-200 employees') {{ 'selected' }} @endif value="51-200 employees">51-200 employees</option>
                                                <option @if(Auth::user()->company->company_size == '201-500 employees') {{ 'selected' }} @endif value="201-500 employees">201-500 employees</option>
                                                <option @if(Auth::user()->company->company_size == '501-1000 employees') {{ 'selected' }} @endif value="501-1000 employees">501-1000 employees</option>
                                                <option @if(Auth::user()->company->company_size == '1001-5000 employees') {{ 'selected' }} @endif value="1001-5000 employees">1001-5000 employees</option>
                                                <option @if(Auth::user()->company->company_size == '5001-10,000 employees') {{ 'selected' }} @endif value="5001-10,000 employees">5001-10,000 employees</option>
                                                <option @if(Auth::user()->company->company_size == '10,001+ employees') {{ 'selected' }} @endif value="10,001+ employees">10,001+ employees</option>
                                            </select>
                                        @else
                                            <select name="company_size" id="company-size" class="form-control">
                                                <option selected disabled>Your Company Size</option>
                                                <option value="1-10 employees">1-10 employees</option>
                                                <option value="11-50 employees">11-50 employees</option>
                                                <option value="51-200 employees">51-200 employees</option>
                                                <option value="201-500 employees">201-500 employees</option>
                                                <option value="501-1000 employees">501-1000 employees</option>
                                                <option value="1001-5000 employees">1001-5000 employees</option>
                                                <option value="5001-10,000 employees">5001-10,000 employees</option>
                                                <option value="10,001+ employees">10,001+ employees</option>
                                            </select>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="logo">Company Logo</label>
                                    <div class="slim"
                                        data-label="Drop your company logo"
                                        data-size="240,240"
                                        data-ratio="1:1" style="height: 190px;">
                                        <input type="file" id="logo" name="logo">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label for="company-email">Company e-mail</label>
                                    <input type="email" name="company_email" disabled id="company-email" placeholder="Company email" class="form-control" value="{{ Auth::user()->email }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company-phone">Company Phone <span class="mandatory">*</span></label>
                                        <input type="text" name="phone" value="{{ (isset(Auth::user()->company->phone) ? Auth::user()->company->phone : '') }}" id="company-phone" placeholder="company phone" class="form-control">
                                        <input type="hidden" name="company_phone" id="hidden">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company-fax">Company Fax <span class="mandatory">*</span></label>
                                        <input type="text" name="company_fax" value="{{ (isset(Auth::user()->company->fax) ? Auth::user()->company->fax : '') }}" id="company-fax" placeholder="Company Fax" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="col-md-6 pl-0">
                                    <div class="form-group">
                                        <label for="company-country">Company Country <span class="mandatory">*</span></label>
                                        <input type="text" name="company_country" value="{{ (isset(Auth::user()->company->country) ? Auth::user()->company->country : '') }}" id="company-country" placeholder="Company Country" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 pr-0">
                                    <div class="form-group">
                                        <label for="company-city">Company City <span class="mandatory">*</span></label>
                                        <input type="text" name="company_city" value="{{ (isset(Auth::user()->company->city) ? Auth::user()->company->city : '') }}" id="company-city" placeholder="Company City" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--====  End of Edit Company Info Modal  ====-->
    
    <!--==============================================
    =            Edit Company Cover Modal            =
    ===============================================-->
    <div class="modal fade" id="edit-company-cover-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" method="POST" id="edit-company-cover-form">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title text-center">Edit Company Cover</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group clearfix">
                            <div class="col-xs-12">
                                <div class="slim"
                                    data-label="Drop your company cover"
                                    data-size="1192,220"
                                    data-ratio="6:1">
                                    <input type="file" name="cover">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--====  End of Edit Company Cover Modal  ====-->
    

    <!--=============================================
    =            Edit Social Media Modal            =
    ==============================================-->
    <div class="modal fade" id="edit-company-social-modal" tabindex="-1">
        <div class="modal-dialog">
           	<form action="#" id="social-media-form">
	            {{ csrf_field() }}
	            {{ method_field('PUT') }}
	            <div class="modal-content">
	                <div class="modal-header">
	                    <button type="button" class="close" data-dismiss="modal">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                    <h4 class="modal-title text-center">Edit Company Social Media</h4>
	                </div>
	                <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="company-website">Company Website</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-link"></i></span>
                                        <input type="url" value="{{ (isset(Auth::user()->socialmedia->website)) ? Auth::user()->socialmedia->website : '' }}" name="website" class="form-control" id="company-website" placeholder="Company Website">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="company-facebook">Company Facebook</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-facebook"></i></span>
                                        <input type="url" value="{{ (isset(Auth::user()->socialmedia->facebook) ? Auth::user()->socialmedia->facebook : '') }}" name="facebook" placeholder="Facebook" id="company-facebook" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="company-twitter">Company Twitter</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-twitter"></i></span>
                                        <input type="url" value="{{ (isset(Auth::user()->socialmedia->twitter) ? Auth::user()->socialmedia->twitter : '') }}" name="twitter" class="form-control" id="company-twitter" placeholder="Twitter">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="company-linkedin">Company LinkedIn</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-linkedin"></i></span>
                                        <input type="url" value="{{ (isset(Auth::user()->socialmedia->linkedin) ? Auth::user()->socialmedia->linkedin : '') }}" name="linkedin" class="form-control" id="company-linkedin" placeholder="LinkedIn">
                                    </div>
                                </div>
                            </div>
                        </div>
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	                    <button type="submit" class="btn btn-primary">Save changes</button>
	                </div>
	            </div>
	        </form>
        </div>
    </div>
    <!--====  End of Edit Social Media Modal  ====-->    

    <!--=========================================
    =            Edit About-Us Modal            =
    ==========================================-->
    <div class="modal fade" id="edit-about-us-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" method="POST" id="about-us-form">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title text-center">Edit About-Us</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            @if(isset(Auth::user()->company->about))
                                <textarea name="about_us" id="about-us" class="form-control">
                                    {{ Auth::user()->company->about }}
                                </textarea>
                            @else
                                <textarea placeholder="About Your Company" name="about_us" id="about-us" class="form-control"></textarea>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--====  End of Edit About-Us Modal  ====-->

@endsection


@section('scripts')
    <script src="{{ asset('public/js/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('public/js/countrySelect.min.js') }}"></script>
    <script src="{{ asset('public/plugins/slim/slim.kickstart.min.js') }}"></script>
    <script src="{{ asset('public/plugins/tagsinput/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('public/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('public/plugins/timepicker/jquery-ui-timepicker-addon.min.js') }}"></script>
    <script src="{{ asset('public/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            var telInput = $("#company-phone");

            telInput.intlTelInput({
                initialCountry: "auto",
                geoIpLookup: function(callback) {
                    $.get('http://ipinfo.io', function() {}, "jsonp").always(function(resp) {
                        var countryCode = (resp && resp.country) ? resp.country : "";
                        callback(countryCode);
                    });
                },
                utilsScript: "./public/js/utils.js" // just for formatting/placeholders etc
            });
        });
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQxU6cjr773oEg2e9z1cBK3jBvzFz5kTA&libraries=places&callback=initMap"></script>
    <script>

        $("#company-country").countrySelect({
            preferredCountries: ['eg', 'gb', 'us']
        });

        $('.datetimepicker').datetimepicker({
            timeFormat: "HH:mm:ss"
        });
        /*========================================
        =            Company Location            =
        ========================================*/
        $("form#location-form").on('submit', function(event) {
            event.preventDefault();
        });

        function initMap() {
            var map = new google.maps.Map(document.getElementById('company_map'), {
                center: {
                    lat: {{ (isset(Auth::user()->company->latitude)) ? Auth::user()->company->latitude : 27.72 }},
                    lng: {{ (isset(Auth::user()->company->langtude)) ? Auth::user()->company->langtude : 85.36 }}
                },
                zoom: 15
            });
            var marker = new google.maps.Marker({
                position: {
                    lat: {{ (isset(Auth::user()->company->latitude)) ? Auth::user()->company->latitude : 27.72 }},
                    lng: {{ (isset(Auth::user()->company->langtude)) ? Auth::user()->company->langtude : 85.36 }}  
                },
                map: map,
                draggable: true
            });

            var input = document.getElementById('searchbox'),
                searchBox = new google.maps.places.SearchBox(input);
            
            google.maps.event.addListener(searchBox,'places_changed',function() {
                var places = searchBox.getPlaces();
                var bounds = new google.maps.LatLngBounds();
                var i, place;
                for (i = 0; place = places[i]; i++) {
                    bounds.extend(place.geometry.location);
                    marker.setPosition(place.geometry.location);
                }
                map.fitBounds(bounds);
                map.setZoom(15);
            });

            google.maps.event.addListener(marker,'position_changed',function() {
                var latitude = marker.getPosition().lat,
                    langtude = marker.getPosition().lng;

                $.ajax({
                    url: '{{ URL('company/company_location') }}',
                    type: 'POST',
                    data: {_token: '{{ csrf_token() }}', latitude: latitude, langtude: langtude},
                    success: function(response) {

                    }
                });
            });
        }
        /*=====  End of Company Location  ======*/
        
        /*=====================================
        =            Company Cover            =
        =====================================*/
        $("form#edit-company-cover-form").on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: '{{ URL('company/company-cover') }}',
                data: new FormData(this),
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(response) {
                    window.location.reload();
                },
                error: function(response) {

                },
                beforeSend: function() {

                }
            });
        });
        /*=====  End of Company Cover  ======*/
        

        /*====================================
        =            Company Info            =
        ====================================*/
        $("form#edit-company-info-form").on('submit', function(event) {
            event.preventDefault();
            $("#hidden").val($("#company-phone").intlTelInput("getNumber"));
            $.ajax({
                url: '{{ URL('company/company_info') }}',
                data: new FormData(this),
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(response) {
                    location.reload();

                },
                error: function(response) {
                    console.log(response);
                },
                beforeSend: function() {

                }
            });
        });  
        /*=====  End of Company Info  ======*/
    
        /*=====================================
        =            About Company            =
        =====================================*/
        $("form#about-us-form").on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: '{{ URL('company/company_about') }}',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    location.reload();
                },
                error: function(response) {

                },
                beforeSend: function() {

                }
            });
        });
        /*=====  End of About Company  ======*/
        

		/*====================================
		=            Social Media            =
		====================================*/
		$("form#social-media-form").on('submit', function(event) {
			event.preventDefault();

			$.ajax({
				url: '{{ URL('social_media') }}',
				type: 'POST',
				data: $(this).serialize(),
				success: function(response) {
                    location.reload();
                },
				error: function(response) {
                    var errors = response.responseJSON;
                    $.each(errors, function(name, error) {
                        $("#social-media-form input[name='"+name+"']").parents('.form-group').addClass('has-error').append("<p class='text-danger error'>"+error+"</p>");
                    });
                    $('p.error').delay(2000).slideUp();
				},
				beforeSend: function() {

				}
			});
		});
		/*=====  End of Social Media  ======*/

        /*==================================
        =            Delete Job            =
        ==================================*/
        $(".remove-job").on('click', function(event) {
            event.preventDefault();

            var id = $(this).data('id');

            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this Job!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function(){
                $.ajax({
                    url: '{{ URL('company/deleteJob') }}',
                    data: {id: id, _token: '{{ csrf_token() }}', _method: 'DELETE'},
                    type: 'POST',
                    success: function(response) {
                        swal("Deleted!", "Your Job has been deleted.", "success");
                        window.location.reload();
                    }
                });
            });
        });
        /*=====  End of Delete Job  ======*/

	</script>
@endsection