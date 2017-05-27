@extends('layouts.company')

@section('styles')
	<style>
		.bt-1 {
			border-top: 1px solid #ccc;
		}
		.p-0 {
			padding: 0;
		}
	</style>
@endsection

@section('content')
	 @if(isset(Auth::user()->company->cover))
        <div class="overflow-hidden height-220 page-section company-cover third" style="background: url({{ asset('public/img/cover') }}/{{ Auth::user()->company->cover }}) no-repeat center center /cover">
    @else
        <div class="overflow-hidden height-220 page-section company-cover third" style="background-color: #ccc;">
    @endif
        <div class="container">
            <div class="clearfix" style="height: 300px;">
                <div class="media v-middle company-card">
	                <div class="col-md-10">
	                    <h1 class="margin-v-0">{{ $job->name }}</h1>
	                    <ul class="list-inline mt-20">
	                    	<li><i class="fa fa-clock-o"></i> <b>Posted:</b> {{ $job->created_at->diffForHumans() }}</li>
	                        <li><i class="fa fa-money"></i> <b>Salary:</b> {{ $job->salary }} EGP</li>
	                        <li><i class="fa fa-map-marker"></i> <b>Location:</b> {{ $job->location }}</li>
	                    </ul>
	                    <ul class="list-inline">
	                    	<li><i class="fa fa-history"></i> <b>Employment Type:</b> {{ title_case($job->type) }}</li>
	                    </ul>
	                </div>
	            </div>
            </div>
			
            <div class="row">
            	<div class="col-md-9">
                    <div class="white-card">
                        
                        <!-- Job Description -->
                        <div class="mt-20">
                        	<h5 class="text-primary fs-16 mb-20"> 
	                            <i class="fa fa-align-left"></i> Job Description
	                        </h5>
	                        <div>
	                        	{!! $job->description !!}
	                        </div>
                        </div>

                        <!-- Job Requirements -->
                        <div class="mt-20 bt-1">
                        	<h5 class="text-primary fs-16 mb-20"> 
	                            <i class="fa fa-align-left"></i> Job Requirements
	                        </h5>
	                        <div>
	                        	{!! $job->requirements !!}
	                        </div>
                        </div>
						
						<!-- Job Skills -->
                        <div class="mt-20 bt-1">
                        	<h5 class="text-primary fs-16 mb-20"> 
	                            <i class="fa fa-thumbs-up"></i> Skills
	                        </h5>
	                        <div class="tagcloud">
	                        	@foreach($skills as $skill)
	                            	<span class="tag-skill">{{ $skill }}</span>
	                            @endforeach
	                        </div>
                        </div>

                        <!-- Job Interested -->
                        <div class="mt-20 bt-1">
	                        <h5 class="text-primary fs-16 mb-20"> 
	                            <i class="fa fa-heart"></i> Job Interested
	                        </h5>
	                        <div class="panel-body p-0">
	                            <a class="btn btn-default text-grey-400 btn-lg btn-circle paper-shadow relative"  href="#" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="Username">
	                                <img src="{{ asset('public/img/jobseekers/1.jpg') }}" alt="" class="img-responsive img-circle">
	                            </a>
	                            <a class="btn btn-default text-grey-400 btn-lg btn-circle paper-shadow relative" href="#" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="Username">
	                                <img src="{{ asset('public/img/jobseekers/2.jpg') }}" alt="" class="img-responsive img-circle">
	                            </a>
	                            <a class="btn btn-default text-grey-400 btn-lg btn-circle paper-shadow relative" href="#" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="Username">
	                                <img src="{{ asset('public/img/jobseekers/3.jpg') }}" alt="" class="img-responsive img-circle">
	                            </a>
	                            <a class="btn btn-default text-grey-400 btn-lg btn-circle paper-shadow relative" href="#" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="Username">
	                                <img src="{{ asset('public/img/jobseekers/4.jpg') }}" alt="" class="img-responsive img-circle">
	                            </a>
	                            <a class="btn btn-default text-grey-400 btn-lg btn-circle paper-shadow relative"  href="#" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="Username">
	                                <img src="{{ asset('public/img/jobseekers/5.jpg') }}" alt="" class="img-responsive img-circle">
	                            </a>
	                            <a class="btn btn-default text-grey-400 btn-lg btn-circle paper-shadow relative" href="#" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="Username">
	                                <img src="{{ asset('public/img/jobseekers/6.jpg') }}" alt="" class="img-responsive img-circle">
	                            </a>
	                            <a class="btn btn-default text-grey-400 btn-lg btn-circle paper-shadow relative" href="#" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="Username">
	                                <img src="{{ asset('public/img/jobseekers/7.jpg') }}" alt="" class="img-responsive img-circle">
	                            </a>
	                            <a class="btn btn-default text-grey-400 btn-lg btn-circle paper-shadow relative" href="#" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="Username">
	                                <img src="{{ asset('public/img/jobseekers/8.jpg') }}" alt="" class="img-responsive img-circle">
	                            </a>
	                            <a class="btn btn-default text-grey-400 btn-lg btn-circle paper-shadow relative"  href="#" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="Username">
	                                <img src="{{ asset('public/img/jobseekers/9.jpg') }}" alt="" class="img-responsive img-circle">
	                            </a>
	                            <a class="btn btn-default text-grey-400 btn-lg btn-circle paper-shadow relative" href="#" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="Username">
	                                <img src="{{ asset('public/img/jobseekers/10.jpg') }}" alt="" class="img-responsive img-circle">
	                            </a>
	                            <a class="btn btn-default text-grey-400 btn-lg btn-circle paper-shadow relative" href="#" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="Username">
	                                <img src="{{ asset('public/img/jobseekers/11.jpg') }}" alt="" class="img-responsive img-circle">
	                            </a>
	                            <a class="btn btn-default text-grey-400 btn-lg btn-circle paper-shadow relative" href="#" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="Username">
	                                <img src="{{ asset('public/img/jobseekers/12.jpg') }}" alt="" class="img-responsive img-circle">
	                            </a>
	                            <a class="btn btn-default text-grey-400 btn-lg btn-circle paper-shadow relative"  href="#" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="Username">
	                                <img src="{{ asset('public/img/jobseekers/13.jpg') }}" alt="" class="img-responsive img-circle">
	                            </a>
	                            <a class="btn btn-default text-grey-400 btn-lg btn-circle paper-shadow relative" href="#" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="Username">
	                                <img src="{{ asset('public/img/jobseekers/14.jpg') }}" alt="" class="img-responsive img-circle">
	                            </a>
	                            <a class="btn btn-default text-grey-400 btn-lg btn-circle paper-shadow relative" href="#" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="Username">
	                                <img src="{{ asset('public/img/jobseekers/15.jpg') }}" alt="" class="img-responsive img-circle">
	                            </a>
	                            <a class="btn btn-default text-grey-400 btn-lg btn-circle paper-shadow relative" href="#" data-hover-z="0.5" data-animated data-toggle="tooltip" data-title="Username">
	                                <img src="{{ asset('public/img/jobseekers/16.jpg') }}" alt="" class="img-responsive img-circle">
	                            </a>
	                        </div>
	                    </div>

                    </div>
                </div>
                <div class="col-md-3">
            		<h5 class="text-primary fs-16 mb-20"> 
                        <i class="fa fa-suitcase" aria-hidden="true"></i> Your other jobs
                    </h5>
                
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection()