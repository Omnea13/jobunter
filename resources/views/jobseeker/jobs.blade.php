@extends('layouts.jobseeker')

@section('styles')
@endsection

@section('content')
	<div class="item section col-xs-12 col-lg-12" id="certificates-section">
        <div class="panel panel-default paper-shadow" data-z="0.5">
            <div class="panel-body">
            @foreach($jobs as $job)
                <div class="section-item">
                    <div class="pull-left certificate-img">
                    	<img class="img-responsive" src="{{ asset('public/img/logo') }}/{{ App\Company::where('user_id', '=', $job->user_id)->first()->logo }}">
                    </div>
                    <h3>{{ $job->name }}</h3>
                    <p>{!! $job->description !!}</p>
                    <p>{!! $job->requirements !!}</p>
                    <a href="{{ URL('jobseeker/interest') }}/{{ $job->id }}">
                        <i class="fa fa-heart fa-4x"></i>
                    </a>
                </div>
            @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection