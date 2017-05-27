@extends('layouts.jobseeker')

@section('styles')
    <link rel="stylesheet" href="{{ asset('public/css/job-details.css') }}">
@endsection

@section('content')
        <div class="container">
            <div class="clearfix col-md-12" style="height: 100px;">
                <div class="col-md-12 media v-middle company-card white-card">
	                <div class="col-md-12">
	                    <div class="col-md-9">
                            <h1 class="margin-v-0">{{ $job->name }}</h1>
                            <ul class="list-inline mt-20">
                                <li><i class="fa fa-clock-o"></i> <b>Posted:</b> {{ $job->created_at->diffForHumans() }}</li>
                                <li><i class="fa fa-money"></i> <b>Salary:</b> {{ $job->salary }} EGP</li>
                                <li>
                                    <i class="fa fa-map-marker"></i> 
                                    <b>Location:</b> {{ $job->location }}
                                </li>
                            </ul>
                            <ul class="list-inline">
                                <li><i class="fa fa-history"></i> <b>Employment Type:</b> {{ title_case($job->type) }}</li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-7 btn-7e btn-icon-only icon-heart">Like</button>
                        </div>
	                </div>
	            </div>
            </div>
			
            <div class="pt-60 row col-md-12">
            	<div class="col-md-9">
                    <div class="white-card">
                    
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
                    </div>
                </div>
                <div class="col-md-3">
            		<div class="white-card">
                    	<div class="photo">
        					<div class="media-center text-center">
               					@if(isset($job->company->logo))
                    				<img src="{{ asset('public/img/logo') }}/{{ $job->company->logo }}" alt="{{ $job->company->user->name }}" class="img-circle width-90">
                				@else
                    				<img src="http://placehold.it/145x145" alt="{{ $job->company->user->name }}" class="img-circle">                				
                    			@endif
	                        	<h3 class="text-warning mb-20"><a target="_blank" href="{{ URL('jobseeker/company') }}/{{ $job->company->user->id }}">
		                            {!! $job->company->user->name !!}
		                            </a>
		                        </h3>
        					</div>
        				</div>

        				<div class="text-center">
                        	@if(isset($job->company->industry))
	                            <i class="fa fa-bolt"></i> {!! $job->company->industry !!}
	                        @endif
                        </div>

                        <div class="mt-20 bt-1">
                        	<h5 class="text-primary fs-16 mb-20"> 
	                           Company Contacts
	                        </h5>
	                        <div>
	                        	<i class="fa fa-envelope"></i>{!! $job->company->user->email !!}
	                        </div>
	                        <div>
		                        @if(isset($job->company->phone ))
		                            <i class="fa fa-phone-square"></i> {!! $job->company->phone !!}
		                        @endif
	                        </div>
                        </div>
						
						<div class="mt-20 bt-1">
                        	<h5 class="text-primary fs-16 mb-20"> 
	                            Location
	                        </h5>
	                        @if(isset($job->company->country))
	                            <i class="fa fa-map-marker"></i> {{ $job->company->country }}
	                        @endif
	                        @if(isset($job->company->city))
	                            , {{ $job->company->city }}</li>
	                        @endif
                            <div id="company_map" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQxU6cjr773oEg2e9z1cBK3jBvzFz5kTA&libraries=places&callback=initMap"></script>
    <script>
        /*=======================================
        =            Interest Button            =
        =======================================*/
        $('button.btn-7').on('click', function(){
            $(this).toggleClass('btn-activated');
        });
        /*=====  End of Interest Button  ======*/
        
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