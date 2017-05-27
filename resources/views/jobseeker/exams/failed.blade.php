@extends('layouts.jobseeker')

@section('styles')
    <meta http-equiv="refresh" content="5;{{ URL('jobseeker/courses') }}/{{ str_slug($category) }}"/>
    <link rel="stylesheet" href="{{ asset('public/css/exams-message.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="st-content">
            <div class="st-content-inner padding-none">
                <div class="container">
                    <div class="page-section panel panel-default" style="margin-top: 50px;">
                        <div class="media-body">
                            <div class="notify errorbox">
                                <h1 style="margin-top: 30px;">
                                    Ooopss you have failed in the {{ $category }} exam!
                                </h1>
                                <br>
                                <span class="alerticon">
                                    <img src="http://s22.postimg.org/ulf9c0b71/error.png" alt="error" style="width: 70px; height: 70px;" />
                                </span>
                                <br>
                                <br>
                                <h4>You will redirect to your Recommended Course</h4>
                                <h3>To enhance your Skills. Don't miss it!</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection