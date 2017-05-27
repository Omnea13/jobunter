@extends('layouts.company')

@section('styles')
    <link rel="stylesheet" href="{{ asset('public/plugins/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/countrySelect.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/slim/slim.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/tagsinput/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/timepicker/jquery-ui-timepicker-addon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/company-details.css') }}">
@endsection

@section('content')
    @if(isset($user->company->cover))
        <div class="overflow-hidden height-220 page-section company-cover third" style="background: url({{ asset('public/img/cover') }}/{{ $user->company->cover }}) no-repeat center center /cover">
    @else
        <div class="overflow-hidden height-220 page-section company-cover third" style="background-color: #ccc;">
    @endif
        <div class="container">
            <div class="media v-middle company-card">
                <div class="col-md-2">
                    @if(isset($user->company->logo))
                        <img src="{{ asset('public/img/logo') }}/{{ $user->company->logo }}" alt="{{ $user->name }}" class="img-responsive img-center" />
                    @else
                        <img src="http://placehold.it/145x145" alt="">
                    @endif
                </div>
                <div class="col-md-10">
                    <h1 class="text-display margin-v-0"> {{ title_case($user->name) }}
                    </h1>
                    <ul class="list-inline mt-20">
                        @if(isset($user->company->industry))
                            <li><i class="fa fa-bolt"></i> {{ $user->company->industry }}</li>
                        @endif
                        @if(isset($user->company->company_size))
                            <li><i class="fa fa-users"></i> {{ $user->company->company_size }}</li>
                        @endif
                        @if(isset($user->company->country))
                            <li><i class="fa fa-map-marker"></i> {{ $user->company->country }}</li>
                        @endif
                        @if(isset($user->company->city))
                            , {{ $user->company->city }}</li>
                        @endif
                    </ul>
                    <ul class="list-inline">
                        <li><i class="fa fa-envelope"></i> {{ $user->email }}</li>
                        @if(isset($user->company->phone))
                            <li><i class="fa fa-phone-square"></i> {{ $user->company->phone }}</li>
                        @endif

                        @if(isset($user->company->fax))
                            <li><i class="fa fa-fax"></i> {{ $user->company->fax }}</li>
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
                    <div class="row" data-toggle="isotope">
                        <div class="item col-xs-12">
                            <div class="panel panel-default paper-shadow" data-z="0.5">
                                <div class="panel-heading">
                                    <h4 class="text-headline margin-none">About us
                                    </h4>
                                </div>
                                <div class="panel-body about-company">
                                    {{-- <div class="expandable expandable-indicator-white expandable-trigger"> --}}
                                        {{-- <div class="expandable-content"> --}}
                                            @if(isset($user->company->about))
                                                <p>{{ $user->company->about }}</p>
                                            @endif
                                        {{-- </div> --}}
                                    {{-- </div> --}}
                                </div>
                            </div>
                        </div>

                        <div class="item col-xs-12">
                            <div class="panel panel-default paper-shadow">
                                <div class="panel-heading">
                                    <h4 class="text-headline">Available Posted Jobs
                                    </h4>
                                </div>
                                <ul class="list-group relative paper-shadow" data-hover-z="0.5" data-animated>
                                    
                                    @foreach($jobs as $job)
                                        <li class="list-group-item paper-shadow">  
                                            <div class="media job-container v-middle">
                                                <div class="media-body">
                                                    <a target="_blank" href="{{ URL('jobseeker/jobs/details') }}/{{ $job->id }}" class="text-subhead job-details link-text-color">{{ $job->name }}</a> 
                                                    <i class="fa fa-clock-o"></i> <span class="text-caption text-light">{{ $job->created_at->diffForHumans() }}</span>
                                                    <div class="text-light">
                                                        <i class="fa fa-map-marker"></i> {{ $job->location }} 
                                                        <i class="fa fa-money"></i> {{ $job->salary }} EGP
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
                                </h4>
                            </div>
                            <div class="panel-body social-media-heading">

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

                    <div class="item col-xs-12">
                        <div class="panel panel-default paper-shadow" data-z="0.5">
                            <div class="panel-heading">
                                <h4 class="text-headline">Location</h4>
                            </div>
                            <div class="panel-body">
                                <div id="company_map" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <strong>Jobunter</strong> v1.0.0 &copy; Copyright 2017
    </footer>

@endsection


@section('scripts')
    <script src="{{ asset('public/js/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('public/js/countrySelect.min.js') }}"></script>
    <script src="{{ asset('public/plugins/slim/slim.kickstart.min.js') }}"></script>
    <script src="{{ asset('public/plugins/tagsinput/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('public/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('public/plugins/timepicker/jquery-ui-timepicker-addon.min.js') }}"></script>
    <script src="{{ asset('public/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQxU6cjr773oEg2e9z1cBK3jBvzFz5kTA&libraries=places&callback=initMap"></script>
    <script>
        /*========================================
        =            Company Location            =
        ========================================*/
        function initMap() {
            var map = new google.maps.Map(document.getElementById('company_map'), {
                center: {
                    lat: {{ (isset($job->company->latitude)) ? $job->company->latitude : 27.72 }},
                    lng: {{ (isset($job->company->langtude)) ? $job->company->langtude : 85.36 }}
                },
                zoom: 15
            });
            var marker = new google.maps.Marker({
                position: {
                    lat: {{ (isset($job->company->latitude)) ? $job->company->latitude : 27.72 }},
                    lng: {{ (isset($job->company->langtude)) ? $job->company->langtude : 85.36 }}  
                },
                map: map,
            });
        }
    </script>
@endsection