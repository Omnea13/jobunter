@extends('layouts.jobseeker')

@section('styles')
    <link href="{{ asset('public/plugins/slim/slim.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/intlTelInput.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/countrySelect.min.css') }}">
    <style>
        .opacity-40 {
            opacity: 0.4;
        }
        .btn-transparent {
            background: transparent;
            border: 0;
        }
        .intl-tel-input, .country-select {
            width: 100%;
        }
        .prl-20 {
            padding: 0 20px!important;
        }
        .pl-0 {
            padding-left: 0!important;
        }
        h4.text-light {
            margin: 3px 0;
        }
        span.badge-info {
            background-color: rgba(0, 136, 0, 0.74);
            color: #fff;
        }
        .p-0 {
            padding: 0!important;
        }
    </style>
@endsection

@section('content')

    <div class="container parallax-layer" data-z="0.5" id="profile" data-opacity="true">
        <div class="media v-middle" id="photo">
            <div class="media-center text-center">
                @if(isset(Auth::user()->jobseeker->avatar))
                    <img src="public/img/jobseekers/{{ Auth::user()->jobseeker->avatar }}" alt="{{ Auth::user()->name }}" class="img-circle width-120">
                @else
                    <img src="http://placehold.it/145x145" alt="{{ Auth::user()->name }}" class="img-circle">
                @endif
            </div>
            <div class="media-body text-center">
                <h1 class=" text-display-1 margin-v-0">
                    {{ Auth::user()->name }}
                </h1>
                <div class="dropdown pull-right">
                    <button class="btn-transparent ropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="fa fa-ellipsis-h fa-lg" aria-hidden="true"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:;" data-toggle="modal" data-target="#edit-jobseeker-info-modal">Edit</a></li>
                    </ul>
                </div>
                <h4 class="text-light">
                    <i class="fa fa-envelope" aria-hidden="true"></i> {{ Auth::user()->email }} 
                    @if(isset(Auth::user()->jobseeker->phone))
                        &nbsp; - &nbsp; 
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        {{ Auth::user()->jobseeker->phone }}
                    @endif
                </h4>
                
                @if(isset(Auth::user()->jobseeker->country))
                    <h4 class="text-light"> {{ Auth::user()->jobseeker->country }} @if(isset(Auth::user()->jobseeker->city)) {{ '- '. Auth::user()->jobseeker->city }} @endif</h4>
                @endif

                @if(isset(Auth::user()->jobseeker->gender))
                    @if(Auth::user()->jobseeker->gender == 'male')
                        <h4>
                            <i class="fa fa-male"></i> {{ Auth::user()->jobseeker->gender }}
                        </h4>
                    @elseif(Auth::user()->jobseeker->gender == 'female')
                        <h4>
                            <i class="fa fa-female"></i> {{ Auth::user()->jobseeker->gender }}
                        </h4>
                    @else
                        <h4>
                            {{ Auth::user()->jobseeker->gender }}
                        </h4>
                    @endif
                @endif
                
                @if(isset(Auth::user()->jobseeker->summary))
                    <p class="text-subhead">{{ Auth::user()->jobseeker->summary }}</p>
                @endif
                
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="page-section">
            <div class="row">
                <div class="col-md-9">
                    <div class="row" data-toggle="isotope">
                        <div class="item section col-xs-12 col-lg-12" id="education-section">
                            <div class="panel panel-default paper-shadow" data-z="0.5" >
                                <div class="panel-heading" id="education-heading">
                                    <h4 class="text-headline margin-none">
                                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>Education
                                        <a class="btn btn-default text-grey-400 btn-circle paper-shadow relative plus pull-right" data-animated href="javascript:;" data-toggle="modal" data-target="#add-education-item-modal">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </a>
                                    </h4>
                                </div>
                                
                                @if(isset($educations))
                                    <div class="panel-body p-0">
                                        @foreach($educations as $education)
                                            <div class="section-item">
                                                <h3> {{ $education->school }}  
                                                    @if(isset($education->grade))
                                                        - <span class="badge badge-info">{{ $education->grade }}</span>
                                                    @endif
                                                    <div class="dropdown pull-right">
                                                        <button class="btn-transparent ropdown-toggle" type="button" data-toggle="dropdown">
                                                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="edit-education-item" href="javascript:;" data-edit="{{ $education->id }}" >Edit</a></li>
                                                        </ul>
                                                    </div>
                                                </h3>
                                                <div class="col-md-12">
                                                    @if(isset($education->major))
                                                        <div class="col-md-6 pl-0">
                                                            <h4 class="text-light"><b>Major :</b> {{ $education->major }}</h4>
                                                        </div>
                                                    @endif
                                                    @if(isset($education->minor))
                                                        <div class="col-md-6">
                                                            <h4 class="text-light"><b>Minor :</b> {{ $education->minor }}</h4>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-12">
                                                    @if(isset($education->description))
                                                        <h4 class="text-light"><b>Description : </b> {{ $education->description }}</h4>
                                                    @endif
                                                </div>
                                                <div class="col-md-12 pl-0">
                                                    @if(isset($education->start_date))
                                                        <div class="col-md-6 pl-0">
                                                            <h4 class="text-light"><b><i class="fa fa-calendar"></i> Start Date : </b> {{ $education->start_date }}</h4>
                                                        </div>                                               
                                                    @endif
                                                    @if(isset($education->end_date))
                                                        <div class="col-md-6">
                                                            <h4 class="text-light"><b><i class="fa fa-calendar"></i> End Date : </b> {{ $education->end_date }}</h4>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                            </div>
                        </div>

                        <div class="item section col-xs-12 col-lg-12" id="certificates-section">
                            <div class="panel panel-default paper-shadow" data-z="0.5" >
                                <div class="panel-heading" id="certificates-heading">
                                    <h4 class="text-headline margin-none">
                                        <i class="fa fa-certificate" aria-hidden="true"></i>Certificates
                                        <a class="btn btn-default text-grey-400 btn-circle paper-shadow relative plus pull-right" data-animated href="javascript:;" data-toggle="modal" data-target="#add-certificate-item-modal">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </a>
                                    </h4>
                                </div>

                                @if(isset($certificates))
                                    <div class="panel-body p-0">
                                        @foreach($certificates as $certificate)
                                            <div class="section-item">
                                                <div class="pull-left certificate-img">
                                                    @if(isset($certificate->certificate))
                                                        <img class="img-responsive" src="public/img/jobseekers/certificate/{{ $certificate->certificate }}">
                                                    @endif
                                                </div>
                                                <h3> {{ $certificate->name }}
                                                    <div class="dropdown pull-right" id="edit">
                                                        <button class="btn-transparent ropdown-toggle" type="button" data-toggle="dropdown">
                                                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="edit-certificate-item" href="javascript:;" data-edit="{{ $certificate->id }}" >Edit</a></li>
                                                        </ul>
                                                    </div>
                                                </h3>
                                                <h4 class="text-light"><b><i class="fa fa-hospital-o" aria-hidden="true"></i> Organization : </b>{{ $certificate->organization }}</h4>
                                                @if(isset($certificate->start_date))
                                                    <h4 class="text-light"><b><i class="fa fa-calendar"></i> </b> {{ $certificate->start_date }}</h4>
                                                @endif
                                                @if(isset($certificate->url))
                                                    <h4 class="text-light"><b><i class="fa fa-link"></i> </b><a target="_blank" href="{{ $certificate->url }}">{{ $certificate->url }}</a></h4>
                                                @endif
                                                @if(isset($certificate->description))
                                                    <h4 class="text-light">{{ $certificate->description }}</h4>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                            </div>
                        </div> 

                        <div class="item section col-xs-12 col-lg-12" id="experience-section">
                            <div class="panel panel-default paper-shadow" data-z="0.5">
                                <div class="panel-heading" id="experience-heading">
                                    <h4 class="text-headline margin-none">
                                        <i class="fa fa-bookmark" aria-hidden="true"></i>Experience
                                        <a class="btn btn-default text-grey-400 btn-circle paper-shadow relative plus pull-right" data-animated href="javascript:;" data-toggle="modal" data-target="#add-experience-item-modal"><i class="fa fa-plus" aria-hidden="true"></i>
                                        </a>
                                    </h4>
                                </div>

                                @if(isset($experiences))
                                    <div class="panel-body p-0">
                                        @foreach($experiences as $experience)
                                            <div class="section-item">
                                                <h3> {{ $experience->title }}
                                                    <div class="dropdown pull-right" id="edit">
                                                        <button class="btn-transparent ropdown-toggle" type="button" data-toggle="dropdown">
                                                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="edit-experience-item" href="javascript:;" data-edit="{{ $experience->id }}" >Edit</a></li>
                                                        </ul>
                                                    </div>
                                                </h3>
                                                {{-- @if(isset($experience->company_name)) --}}
                                                <ul class="list-inline">
                                                    @if(isset($experience->company_name))
                                                        <li>
                                                            <h4 class="text-light"><i class="fa fa-hospital-o"></i> <b>Company Name : </b>{{ $experience->company_name }}</h4>
                                                        </li>
                                                    @endif
                                                    @if(isset($experience->type))
                                                        <li>
                                                            <h4 class="text-light"><i class="fa fa-exclamation"></i> <b>Company Type : </b>{{ $experience->type }}</h4>
                                                        </li>
                                                    @endif
                                                </ul>
                                                <ul class="list-inline">
                                                    @if(isset($experience->start_date))
                                                        <li>
                                                            <h4 class="text-light"><i class="fa fa-clock-o"></i> <b>Start Date : </b> {{ $experience->start_date }}</h4>
                                                        </li>
                                                    @endif
                                                    @if(isset($experience->end_date))
                                                        <li>
                                                            <h4 class="text-light"><i class="fa fa-clock-o"></i> <b>End Date : </b> {{ $experience->end_date }}</h4>
                                                        </li>
                                                    @endif
                                                </ul>
                                                @if(isset($experience->url))
                                                    <h4 class="text-light"> <i class="fa fa-link"></i> <b>Link : </b>
                                                        <a target="_blank" href="{{ $experience->url }}">{{ $experience->url }}</a>
                                                    </h4>
                                                @endif
                                                @if(isset($experience->description))
                                                    <h4 class="text-light"> <i class="fa fa-align-left"></i> <b>Describtion : </b> {{ $experience->description }}</h4>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            
                            </div>
                        </div>   

                        <div class="item section col-xs-12 col-lg-12" id="skills-section">
                            <div class="panel panel-default paper-shadow" data-z="0.5">
                                <div class="panel-heading" id="skills-heading">
                                    <h4 class="text-headline margin-none"><i class="fa fa-star" aria-hidden="true"></i>Skills</h4>
                                </div>
                                
                                @if(isset($skills))    
                                    <ul class="list-group">
                                        @foreach($skills as $skill)
                                            <li class="list-group-item media v-middle">
                                                <div class="media-body">
                                                    <!-- 
                                                        /**
                                                            TODO:
                                                            - Get Category name using relation
                                                        */
                                                    -->
                                                    <h4>{{ App\Category::find($skill->category_id)->name }}</h4>
                                                </div>
                                                <div class="media-right">
                                                    @if($skill->percentage >= 85)
                                                        <div class="progress progress-large width-500 margin-none">
                                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ $skill->percentage }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ $skill->percentage  }}%;">
                                                                {{ $skill->percentage }}%
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="progress progress-large opacity-40 width-500 margin-none">
                                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="{{ $skill->percentage }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ $skill->percentage  }}%;">
                                                                {{ $skill->percentage }}%
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                                <div class="panel-footer text-right">
                                    <a href="javascript:;" data-toggle="modal" data-target="#choose-new-skill" class="btn btn-white paper-shadow relative" data-z="0" data-hover-z="1" data-animated href="#"> Add New Skill</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <br/>
                </div>
                <div class="section col-md-3" id="social-media-section">
                    <div class="panel panel-default paper-shadow" data-z="0.5">
                        <div class="panel-heading" id="social-media-heading">
                            <h4 class="text-headline"><i class="fa fa-paper-plane" aria-hidden="true"></i>Social Media
                                <div class="dropdown pull-right">
                                    <button class="btn-transparent ropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i class="fa fa-ellipsis-h fa-1" aria-hidden="true"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <li><a href="javascript:;" data-toggle="modal" data-target="#edit-jobseeker-social-modal">Edit</a></li>
                                    </ul>
                                </div>
                            </h4>
                        </div>
                        
                        <div class="panel-body text-center">

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
                    </div>
                </div>

                <div class="section col-md-3" id="recommended-courses-section">
                    <div class="panel panel-default" data-toggle="panel-collapse" data-open="true">
                        <div class="panel-heading panel-collapse-trigger">
                            <h4 class="panel-title">My Account</h4>
                        </div>
                        <div class="panel-body list-group">
                            <ul class="list-group list-group-menu">
                                <li class="list-group-item">
                                    <a class="link-text-color" href="{{ URL('jobseeker/jobs') }}">Available Jobs</a>
                                </li>
                                <li class="list-group-item">
                                    <a class="link-text-color" href="{{ URL('jobseeker/courses') }}">Learning Paths</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    @if(isset($courses) && count($courses) > 0)
                        <h4>Recommended Courses</h4>
                        <div class="slick-basic slick-slider" data-items="1" data-items-lg="1" data-items-md="1" data-items-sm="1" data-items-xs="1">
                            
                            @foreach($courses as $course)
                                <div class="item">
                                    <div class="panel panel-default paper-shadow" data-z="0.5" data-hover-z="1" data-animated>
                                        <div class="panel-body">
                                            <div class="media media-clearfix-xs">
                                                <div class="media-left">
                                                    <div class="cover width-90 width-100pc-xs overlay cover-image-full hover">
                                                        <span class="img icon-block s90 bg-default"></span>
                                                        <span class="overlay overlay-full padding-none icon-block s90 bg-default">
                                                            <span class="v-center">
                                                                {{-- <i class="fa fa-github"></i> --}}
                                                                <img src="{{ asset('public/img/courses') }}/{{ $course->image }}" class="img-responsive" alt="{{ $course->name }}">
                                                            </span>
                                                        </span>
                                                        <a href="{{ $course->link }}" target="_blank" class="overlay overlay-full overlay-hover overlay-bg-white">
                                                            <span class="v-center">
                                                                <span class="btn btn-circle btn-white btn-lg">
                                                                    <i class="fa fa-graduation-cap"></i>
                                                                </span>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading margin-v-5-3"><a href="{{ $course->link }}" target="_blank">{{ $course->name }}</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!--============================================
    =            Choose New Skill Modal            =
    =============================================-->
    <div class="modal fade" id="choose-new-skill" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ URL('jobseeker/take-exam') }}" method="POST" id="new-skill-form">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title text-center">Choose New Skill</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exam-category">Exam Category</label>
                                    <select name="category" id="exam-category" class="form-control select2">
                                        <option disabled selected>Select Exam Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Start Exam</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--====  End of Choose New Skill Modal  ====-->
    


    <!--=============================================
    =            Edit Social Media Modal            =
    ==============================================-->
    <div class="modal fade" id="edit-jobseeker-social-modal" tabindex="-1">
        <div class="modal-dialog">
            <form action="#" id="social-media-form">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title text-center">Edit Social Media</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="jobseeker-website">jobseeker Website</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-link"></i></span>
                                        <input type="url" value="{{ (isset(Auth::user()->socialmedia->website)) ? Auth::user()->socialmedia->website : '' }}" name="website" class="form-control" id="jobseeker-website" placeholder="jobseeker Website">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="jobseeker-facebook">jobseeker Facebook</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-facebook"></i></span>
                                        <input type="url" value="{{ (isset(Auth::user()->socialmedia->facebook) ? Auth::user()->socialmedia->facebook : '') }}" name="facebook" placeholder="Facebook" id="jobseeker-facebook" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="jobseeker-twitter">jobseeker Twitter</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-twitter"></i></span>
                                        <input type="url" value="{{ (isset(Auth::user()->socialmedia->twitter) ? Auth::user()->socialmedia->twitter : '') }}" name="twitter" class="form-control" id="jobseeker-twitter" placeholder="Twitter">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="jobseeker-linkedin">jobseeker LinkedIn</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-linkedin"></i></span>
                                        <input type="url" value="{{ (isset(Auth::user()->socialmedia->linkedin) ? Auth::user()->socialmedia->linkedin : '') }}" name="linkedin" class="form-control" id="jobseeker-linkedin" placeholder="LinkedIn">
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


    <!--===============================================
    =            Edit JobSeeker Info Modal            =
    ================================================-->
    <div class="modal fade" id="edit-jobseeker-info-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" method="POST" id="edit-jobseeker-info-form">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title text-center">Edit jobseeker Information</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group clearfix">
                            <div class="col-xs-4 col-xs-offset-4">
                                <div class="slim"
                                    data-label="Drop Your Avatar"
                                    data-size="240,240"
                                    data-ratio="1:1">
                                    <input type="file" name="avatar">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jobseeker-name">jobseeker Name</label>
                                        <input type="text" name="jobseeker_name" class="form-control" id="jobseeker-name" placeholder="jobseeker name" disabled value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jobseeker-gender">jobseeker gender <span class="mandatory">*</span></label>
                                        <select name="jobseeker_gender" id="jobseeker-gender" class="form-control">
                                            <option selected disabled>Your Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label for="jobseeker-email">jobseeker e-mail</label>
                                    <input type="email" name="jobseeker_email" disabled id="jobseeker-email" placeholder="jobseeker email" class="form-control" value="{{ Auth::user()->email }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jobseeker-phone">jobseeker Phone <span class="mandatory">*</span></label>
                                        <input type="text" name="phone" value="{{ (isset(Auth::user()->jobseeker->phone) ? Auth::user()->jobseeker->phone : '') }}" id="jobseeker-phone" placeholder="jobseeker phone" class="form-control">
                                        <input type="hidden" name="jobseeker_phone" id="hidden">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jobseeker-fax">Date Of Birth <span class="mandatory">*</span></label>
                                        <input name="date_of_birth" value="{{ (isset(Auth::user()->jobseeker->date_of_birth)) ? Auth::user()->jobseeker->date_of_birth : '' }}" type="text" class="form-control datepicker">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="col-md-6 pl-0">
                                    <div class="form-group">
                                        <label for="jobseeker-country">jobseeker Country <span class="mandatory">*</span></label>
                                        <input type="text" name="jobseeker_country" value="{{ (isset(Auth::user()->jobseeker->country) ? Auth::user()->jobseeker->country : '') }}" id="jobseeker-country" placeholder="jobseeker Country" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 pr-0">
                                    <div class="form-group">
                                        <label for="jobseeker-city">jobseeker City <span class="mandatory">*</span></label>
                                        <input type="text" name="jobseeker_city" value="{{ (isset(Auth::user()->jobseeker->city) ? Auth::user()->jobseeker->city : '') }}" id="jobseeker-city" placeholder="jobseeker City" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label for="summary">Summary</label>
                                    <textarea name="summary" id="summary" placeholder="Summary" class="form-control">{{ (isset(Auth::user()->jobseeker->summary)) ? Auth::user()->jobseeker->summary : '' }}</textarea>
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
    <!--====  End of Edit jobseeker Info Modal  ====-->


    <!--===============================================
    =            Add Education Item Modal             =
    ================================================--> 
    <div class="modal fade" id="add-education-item-modal" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" id="add-education-item-form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add new Education</h4>
                    </div>
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label>School:</label>
                                    <input type="text" class="form-control" name="school" placeholder="Your School">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Major:</label>
                                        <input type="text" class="form-control" name="major" placeholder="Your Major Subject">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Minor:</label>
                                        <input type="text" class="form-control" name="minor" placeholder="Your Minor Subject">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label>Grade:</label>
                                    <input type="text" class="form-control" name="grade" placeholder="Your Grade">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start Date:</label>
                                        <input type="date" class="form-control" name="start-date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>End Date:</label>
                                        <input type="date" class="form-control" name="end-date">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Describtion:</label>
                                    <textarea type="text" class="form-control" name="description" placeholder=""></textarea>
                                </div>
                            </div>
                        </div>                                          
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--====  End of Add Education Item Modal   ====-->


    <!--================================================
    =            Edit Education Item Modal             =
    =================================================--> 
    <div class="modal fade" id="edit-education-item-modal" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" id="edit-education-item-form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit Education</h4>
                    </div>
                    {{ csrf_field() }}
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label>School:</label>
                                    <input type="text" class="form-control" name="school">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Major:</label>
                                        <input type="text" class="form-control" name="major">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Minor:</label>
                                        <input type="text" class="form-control" name="minor">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label>Grade:</label>
                                    <input type="text" class="form-control" name="grade">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start Date:</label>
                                        <input type="date" class="form-control" name="start-date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>End Date:</label>
                                        <input type="date" class="form-control" name="end-date">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Describtion:</label>
                                    <textarea type="text" class="form-control" name="description"></textarea>
                                </div>
                            </div>
                        </div>                                          
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--====  End of Edit Education Item Modal   ====-->


    <!--===============================================
    =            Add Experience Item Modal            =
    ================================================--> 
    <div class="modal fade" id="add-experience-item-modal" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="#" method="POST" id="add-experience-item-form">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title text-center">Add New Experience</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label for="jobseeker-name">Title <span class="mandatory">*</span></label>
                                    <input type="text" name="title" class="form-control" id="experience-title" placeholder="Job Title">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="experience-type">Job Type <span class="mandatory">*</span></label>
                                        <select name="type" id="experience-type" class="form-control">
                                            <option selected disabled>Choose Job Type</option>
                                            <option value="company">Organization/Company</option>
                                            <option value="freelancing">Freelancing</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="experience-start-date">Date <span class="mandatory">*</span></label>
                                        <input type="date" name="start-date" class="form-control" class="form-control" id="experience-start-date">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label for="experience-company">Company/Organization name</label>
                                    <input type="text" name="company-name" class="form-control" id="experience-company-name" placeholder="if job type isn't freelancing">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label for="experience-end-date">End Date (If until now leave it empty)</label>
                                    <input type="date" name="end-date" class="form-control" class="form-control" id="experience-end-date" placeholder="End Date">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label for="experience-url">Link (If available)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-link"></i></span>
                                        <input type="url" name="url" id="experience-url" placeholder="url" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label for="experience-description">Description</label>
                                    <textarea name="description" id="experience-description" placeholder="Description" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--====  End of Add Experience Item Modal  ====-->


    <!--================================================
    =            Edit Experience Item Modal            =
    =================================================--> 
    <div class="modal fade" id="edit-experience-item-modal" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" id="edit-experience-item-form">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title text-center">Edit Experience</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label for="jobseeker-name">Title <span class="mandatory">*</span></label>
                                    <input type="text" name="title" class="form-control" id="experience-title">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="experience-type">Job Type <span class="mandatory">*</span></label>
                                        <select name="type" id="experience-type" class="form-control">
                                            <option selected disabled>Choose Job Type</option>
                                            <option value="company">Organization/Company</option>
                                            <option value="freelancing">Freelancing</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="experience-start-date">Date <span class="mandatory">*</span></label>
                                        <input name="start-date" type="date" class="form-control" id="experience-start-date">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label for="experience-company">Company/Organization name</label>
                                    <input type="text" name="company-name" class="form-control" id="experience-company-name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label for="experience-end-date">End Date (If until now leave it empty)</label>
                                    <input type="date" class="form-control" name="end-date" id="experience-end-date">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label for="experience-url">Link (If available)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-link"></i></span>
                                        <input type="url" name="url" id="experience-url" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label for="experience-description">Description</label>
                                    <textarea name="description" id="experience-description" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
    <!--====  Edit of Add Experience Item Modal  ====-->


    <!--=================================================
    =            Add Certificate Item Modal             =
    ==================================================--> 
    <div class="modal fade" id="add-certificate-item-modal" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="#" method="POST" id="add-certificate-item-form">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title text-center">Add Certificate</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label for="certificate-name">Certificate Name <span class="mandatory">*</span></label>
                                    <input type="text" name="name" class="form-control" id="jobseeker-name" placeholder="Ex: IELTS">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="col-md-6 pl-0">
                                    <div class="form-group">
                                        <label for="certificate-organization">Organization/Authority <span class="mandatory">*</span></label>
                                        <input type="text" name="organization" id="certificate-organization" placeholder="Ex:British Council" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="certificate-start-date">Date </label>
                                        <input name="start-date" type="date" class="form-control" id="certificate-start-date" placeholder="Date of Certification">
                                    </div>
                                    <div class="form-group">
                                        <label for="certificate-url">Link (If available)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-link"></i></span>
                                            <input type="url" name="url" id="certificate-url" placeholder="url" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 pr-0">
                                    <div class="form-group clearfix">
                                        <label for="certificate">Certificate Image: </label>
                                        <div class="slim"
                                            data-label="Drop Your certificate"
                                            data-size="240,240"
                                            data-ratio="1:1" style="height: 185px;">
                                            <input type="file" name="certificate" id="certificate">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label for="certificate-description">Description</label>
                                    <textarea name="certificate-description" id="certificate-description" placeholder="Description" class="form-control"></textarea>
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
    <!--====  End of Add Certificate Item Modal   ====-->


    <!--==================================================
    =            Edit Certificate Item Modal             =
    ===================================================--> 
    <div class="modal fade" id="edit-certificate-item-modal" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" id="edit-certificate-item-form">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title text-center">Edit Certificate</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label for="certificate-name">Certificate Name <span class="mandatory">*</span></label>
                                    <input type="text" name="name" class="form-control" id="jobseeker-name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 prl-20">
                                <div class="form-group">
                                    <label for="certificate-organization">Organization/Authority <span class="mandatory">*</span></label>
                                    <input type="text" name="organization" id="certificate-organization" class="form-control">
                                </div>
                                
                                <div class="form-group">
                                    <label for="certificate-start-date">Date </label>
                                    <input type="date" class="form-control" name="start-date" id="certificate-start-date">
                                </div>

                                <div class="form-group">
                                    <label for="certificate-url">Link (If available)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-link"></i></span>
                                        <input type="url" name="url" id="certificate-url" class="form-control">
                                    </div>
                                </div>
                            
                            </div>

                            <div class="col-md-6">
                                <div class="form-group clearfix">
                                    <label for="certificate">Certificate Image: </label>
                                    <div class="slim img-responsive"
                                        data-label="Drop Your certificate"
                                        data-size="240,240"
                                        data-ratio="1:1" style="height: 185px;">
                                        <input type="file" name="certificate" id="certificate">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label for="certificate-description">Description</label>
                                    <textarea name="description" id="certificate-description" class="form-control"></textarea>
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
    <!--====  Edit of Add Certificate Item Modal   ====-->

@endsection


@section('scripts')
    <script src="{{ asset('public/js/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('public/js/countrySelect.min.js') }}"></script>
    <script src="{{ asset('public/plugins/slim/slim.kickstart.min.js') }}"></script>
    <script src="{{ asset('public/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $("#exam-category").select2({
                placeholder: 'Select Exam Category'
            });
            
            var telInput = $("#jobseeker-phone");

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

        $("#jobseeker-country").countrySelect({
            preferredCountries: ['eg', 'gb', 'us']
        });

        $("form#social-media-form").on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: 'social_media',
                data: $(this).serialize(),
                type: 'POST',
                success: function(response) {
                    window.location.reload();
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

        $("form#edit-jobseeker-info-form").on('submit', function(event) {
            event.preventDefault();
            $("#hidden").val($("#jobseeker-phone").intlTelInput("getNumber"));
            $.ajax({
                url: '{{ URL('jobseeker/jobseeker_info') }}',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    window.location.reload();
                }
            });
        });

        $("form#add-education-item-form").on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: '{{ URL('jobseeker/add-education') }}',
                data: $("form#add-education-item-form").serialize(),
                type: "POST",
                success: function(response) {
                    window.location = response.url;
                },
                error: function(response) {
                    var errors = response.responseJSON;
                    $.each(errors, function(name, error) {
                        $("form#add-education-item-form input[name='"+name+"']").parents('.form-group').addClass('has-error').append("<p class='text-danger'>"+error+"</p>");
                    });
                },
                beforeSend: function() {
                }
            });
        });

        $(".edit-education-item").on("click", function() {
            var id = $(this).data('edit');
            $.ajax({
                url: '{{ URL('jobseeker/edit-education') }}',
                data: {id: id, user_id: {{ Auth::id() }} },
                type: "GET",
                success: function(response) {
                    $("form#edit-education-item-form input[name='id']").val(response.id);
                    $("form#edit-education-item-form input[name='school']").val(response.school);
                    $("form#edit-education-item-form input[name='major']").val(response.major);
                    $("form#edit-education-item-form input[name='minor']").val(response.minor);
                    $("form#edit-education-item-form input[name='grade']").val(response.grade);
                    $("form#edit-education-item-form input[name='start-date']").val(response.start_date);
                    $("form#edit-education-item-form input[name='end-date']").val(response.end_date);
                    $("form#edit-education-item-form textarea[name='description']").val(response.description);
                    $("#edit-education-item-modal").modal('show');
                },
                error: function(response) {

                },
                beforeSend: function() {
                }
            });
        });

        $("form#edit-education-item-form").on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: '{{ URL('jobseeker/edit-education') }}',
                data: $("form#edit-education-item-form").serialize(),
                type: "POST",
                success: function(response) {
                    window.location = response.url;
                },
                error: function(response) {
                    var errors = response.responseJSON;
                    $.each(errors, function(name, error) {
                        $("form#edit-education-item-form input[name='"+name+"']").parents('.form-group').addClass('has-error').append("<p class='text-danger'>"+error+"</p>");
                    });
                },
                beforeSend: function() {
                }
            });
        });

        $("form#add-experience-item-form").on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: '{{ URL('jobseeker/add-experience') }}',
                data: $(this).serialize(),
                type: "POST",
                success: function(response) {
                    window.location = response.url;
                },
                error: function(response) {
                    var errors = response.responseJSON;
                    $.each(errors, function(name, error) {
                        $("form#add-experience-item-form input[name='"+name+"']").parents('.form-group').addClass('has-error').append("<p class='text-danger'>"+error+"</p>");
                    });
                },
                beforeSend: function() {
                }
            });
        });

        $(".edit-experience-item").on("click", function() {
            var id = $(this).data('edit');
            $.ajax({
                url: '{{ URL('jobseeker/edit-experience') }}',
                data: {id: id, user_id: {{ Auth::id() }} },
                type: "GET",
                success: function(response) {
                    $("form#edit-experience-item-form input[name='id']").val(response.id);
                    $("form#edit-experience-item-form input[name='title']").val(response.title);
                    $("form#edit-experience-item-form select[name='type']").val(response.type);
                    $("form#edit-experience-item-form input[name='company-name']").val(response.company_name);
                    $("form#edit-experience-item-form input[name='start-date']").val(response.start_date);
                    $("form#edit-experience-item-form input[name='end-date']").val(response.end_date);
                    $("form#edit-experience-item-form input[name='url']").val(response.url);
                    $("form#edit-experience-item-form textarea[name='description']").val(response.description);
                    $("#edit-experience-item-modal").modal('show');
                },
                error: function(response) {

                },
                beforeSend: function() {
                }
            });
        });

        $("form#edit-experience-item-form").on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: '{{ URL('jobseeker/edit-experience') }}',
                data: $("form#edit-experience-item-form").serialize(),
                type: "POST",
                success: function(response) {
                    window.location = response.url;
                },
                error: function(response) {
                    var errors = response.responseJSON;
                    $.each(errors, function(name, error) {
                        $("form#edit-experience-item-form input[name='"+name+"']").parents('.form-group').addClass('has-error').append("<p class='text-danger'>"+error+"</p>");
                    });
                },
                beforeSend: function() {
                }
            });
        });

        $("form#add-certificate-item-form").on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: '{{ URL('jobseeker/add-certificate') }}',
                data: new FormData(this),
                processData: false,
                contentType: false,
                type: "POST",
                success: function(response) {
                    window.location = response.url;
                },
                error: function(response) {
                    var errors = response.responseJSON;
                    $.each(errors, function(name, error) {
                        $("form#add-certificate-item-form input[name='"+name+"']").parents('.form-group').addClass('has-error').append("<p class='text-danger'>"+error+"</p>");
                    });
                },
                beforeSend: function() {
                }
            });
        });

        $(".edit-certificate-item").on("click", function() {
            var id = $(this).data('edit');
            $.ajax({
                url: '{{ URL('jobseeker/edit-certificate') }}',
                data: {id: id, user_id: {{ Auth::id() }} },
                type: "GET",
                success: function(response) {
                    $("form#edit-certificate-item-form input[name='id']").val(response.id);
                    $("form#edit-certificate-item-form input[name='name']").val(response.name);
                    $("form#edit-certificate-item-form input[name='certificate']").val(response.certificate);
                    $("form#edit-certificate-item-form input[name='organization']").val(response.organization);
                    $("form#edit-certificate-item-form input[name='start-date']").val(response.start_date);
                    $("form#edit-certificate-item-form input[name='end-date']").val(response.end_date);
                    $("form#edit-certificate-item-form input[name='url']").val(response.url);
                    // $("form#edit-certificate-item-form .slim img").attr('src', 'public/img/jobseekers/certificate/'+response.certificate);
                    $("form#edit-certificate-item-form textarea[name='description']").val(response.description);
                    $("#edit-certificate-item-modal").modal('show');
                },
                error: function(response) {

                },
                beforeSend: function() {
                }
            });
        });

        $("form#edit-certificate-item-form").on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: '{{ URL('jobseeker/edit-certificate') }}',
                data: new FormData(this),
                processData: false,
                contentType: false,
                type: "POST",
                success: function(response) {
                    window.location = response.url;
                },
                error: function(response) {
                    var errors = response.responseJSON;
                    $.each(errors, function(name, error) {
                        $("form#edit-certificate-item-form input[name='"+name+"']").parents('.form-group').addClass('has-error').append("<p class='text-danger'>"+error+"</p>");
                    });
                },
                beforeSend: function() {
                }
            });
        });
    </script>
@endsection