@extends('layouts.company')

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
    </style>
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
            border: 2px solid transparent;
            border-color: #e2e9e6;
            box-shadow: 0 1px 1px rgba(0,0,0,.2);
            width: 100%;
        }
        .certificate-img {
            height: 100px;
            width: 150px;
            margin-top: 9px;
            padding-right: 10px;
        }
        .section-item {
            padding: 5px;
            border-bottom: 1px solid #ccc;
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
@endsection

@section('content')

    <div class="container parallax-layer" data-z="0.5" id="profile" data-opacity="true">
        <div class="media v-middle" id="photo">
            <div class="media-center text-center">
                @if(isset($user->jobseeker->avatar))
                    <img src="{{ asset('public/img/jobseekers') }}/{{ $user->jobseeker->avatar }}" alt="{{ $user->name }}" class="img-circle width-120">
                @else
                    <img src="http://placehold.it/145x145" alt="{{ $user->name }}" class="img-circle">
                @endif
            </div>
            <div class="media-body text-center">
                <h1 class=" text-display-1 margin-v-0">
                    {{ $user->name }}
                </h1>
                <h4 class="text-light">
                    <i class="fa fa-envelope" aria-hidden="true"></i> {{ $user->email }} 
                    @if(isset($user->jobseeker->phone))
                        &nbsp; - &nbsp; 
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        {{ $user->jobseeker->phone }}
                    @endif
                </h4>
                
                @if(isset($user->jobseeker->country))
                    <h4 class="text-light"> {{ $user->jobseeker->country }}, {{ $user->jobseeker->city }}</h4>
                @endif

                @if(isset($user->jobseeker->gender))
                    <h4>
                        <i class="fa fa-venus-mars"></i> {{ $user->jobseeker->gender }}
                    </h4>
                @endif
                
                @if(isset($user->jobseeker->summary))
                    <p class="text-subhead">{{ $user->jobseeker->summary }}</p>
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
                                    </h4>
                                </div>
                                <div class="panel-body">

                                @foreach($user->education as $education)
                                    <div class="section-item">
                                        <h3> {{ $education->school }}  
                                            @if(isset($education->grade))
                                                - <span class="badge badge-info">{{ $education->grade }}</span>
                                            @endif
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
                            </div>
                        </div>

                        <div class="item section col-xs-12 col-lg-12" id="certificates-section">
                            <div class="panel panel-default paper-shadow" data-z="0.5" >
                                <div class="panel-heading" id="certificates-heading">
                                    <h4 class="text-headline margin-none">
                                        <i class="fa fa-certificate" aria-hidden="true"></i>Certificates
                                    </h4>
                                </div>
                                <div class="panel-body">
                                @foreach($user->certificate as $certificate)
                                    <div class="section-item">
                                        <div class="pull-left certificate-img">
                                            @if(isset($certificate->certificate))
                                                <img class="img-responsive" src="public/img/jobseekers/certificate/{{ $certificate->certificate }}">
                                            @endif
                                        </div>
                                        <h3>{{ $certificate->name }}</h3>
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
                            </div>
                        </div> 

                        <div class="item section col-xs-12 col-lg-12" id="experience-section">
                            <div class="panel panel-default paper-shadow" data-z="0.5">
                                <div class="panel-heading" id="experience-heading">
                                    <h4 class="text-headline margin-none">
                                        <i class="fa fa-bookmark" aria-hidden="true"></i>Experience
                                    </h4>
                                </div>
                                <div class="panel-body">
                                @foreach($user->experience as $experience)
                                    <div class="section-item">
                                        <h3> {{ $experience->title }}</h3>
                                        <h4 class="text-light">{{ $experience->type }}</h4>
                                        @if(isset($experience->start_date))
                                            <h4 class="text-light">Date: {{ $experience->start_date }}</h4>
                                        @endif
                                        @if(isset($experience->end_date))
                                            <h4 class="text-light">End Date: {{ $experience->end_date }}</h4>
                                        @endif
                                        @if(isset($experience->url))
                                            <h4 class="text-light">Link:
                                                <a target="_blank" href="{{ $experience->url }}">{{ $experience->url }}</a>
                                            </h4>
                                        @endif
                                        @if(isset($experience->description))
                                            <h4 class="text-light">Describtion: {{ $experience->description }}</h4>
                                        @endif
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        </div>   

                        <div class="item section col-xs-12 col-lg-12" id="skills-section">
                            <div class="panel panel-default paper-shadow" data-z="0.5">
                                <div class="panel-heading" id="skills-heading">
                                    <h4 class="text-headline margin-none"><i class="fa fa-star" aria-hidden="true"></i>Skills</h4>
                                </div>
                                <ul class="list-group">
                                    @foreach($user->skills as $skill)
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
                            </div>
                        </div>
                    </div>
                    <br/>
                    <br/>
                </div>
                <div class="section col-md-3" id="social-media-section">
                    <div class="panel panel-default paper-shadow" data-z="0.5">
                        <div class="panel-heading" id="social-media-heading">
                            <h4 class="text-headline"><i class="fa fa-paper-plane" aria-hidden="true"></i>Social Media</h4>
                        </div>
                        <div class="panel-body">

                            @if(isset($user->socialmedia->website))
                                <a class="btn btn-default text-grey-400 btn-lg btn-circle paper-shadow relative" target="_blank" href="{{ $user->socialmedia->website }}" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="Website">
                                    <i class="fa fa-link"></i>
                                </a>
                            @endif
                            
                            @if(isset($user->socialmedia->facebook))
                                <a class="btn btn-default text-grey-400 btn-lg btn-circle paper-shadow relative" target="_blank" href="{{ $user->socialmedia->facebook }}" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="Facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            @endif

                            @if(isset($user->socialmedia->twitter))
                                <a class="btn btn-default text-grey-400 btn-lg btn-circle paper-shadow relative" target="_blank" href="{{ $user->socialmedia->twitter }}" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="Twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            @endif

                            @if(isset($user->socialmedia->linkedin))
                                <a class="btn btn-default text-grey-400 btn-lg btn-circle paper-shadow relative" target="_blank" href="{{ $user->socialmedia->linkedin }}" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="LinkedIn">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            @endif
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('public/js/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('public/js/countrySelect.min.js') }}"></script>
    <script src="{{ asset('public/plugins/slim/slim.kickstart.min.js') }}"></script>
    <script src="{{ asset('public/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection