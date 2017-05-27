@extends('layouts.jobseeker')

@section('styles')
	<link rel="stylesheet" href="{{ asset('public/css/course-details.css') }}">
@endsection

@section('content')

	<div class="container">

	    <div class="page-header">
	        <h2>{{ $category->name }} <small><code>Learning Path</code>.</small></h2>
	    </div>

	    <div class="timeline">
	    
	        <div class="line text-muted"></div>
			
			@foreach($courses as $course)
		        <article class="panel panel-primary">
		            <div class="panel-heading icon">1</div>
		            <div class="panel-heading">
		                <h2 class="panel-title"><a href="{{ $course->link }}" target="_blank">{{ $course->name }}</a></h2>
		            </div>
		            <div class="panel-body">
		                <div class="col-md-4">
		                	<img src="{{ asset('public/img/courses') }}/{{ $course->image }}" alt="{{ $course->name }}" class="img-responsive">
		                </div>
		                <div class="col-md-8">
		                	<h4>{{ $course->description }}</h4>
		                </div>
		            </div>
		        </article>
		    @endforeach

	    </div>
	</div>

@endsection

@section('scripts')
@endsection