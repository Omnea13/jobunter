@extends('layouts.jobseeker')

@section('styles')
    <meta http-equiv="refresh" content="5;{{ URL('jobseeker') }}" />
    <link rel="stylesheet" href="{{ asset('public/css/exams-message.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="st-content">
            <div class="st-content-inner padding-none">
                <div class="container">
                    <div class="page-section panel panel-default" style="margin-top: 50px;">
                        <div class="media-body">
                            <div class="notify successbox">
                                <h1 style="margin-top: 30px;">
                                    Congratulations you have passed in {{ $category }} exam!
                                </h1>
                                <br>
                                <span class="alerticon">
                                    <img src="http://s22.postimg.org/i5iji9hv1/check.png" alt="checkmark" style="width: 70px; height: 70px;" />
                                </span>
                                <br>
                                <br>
                                <h4>You will redirect to your Profile</h4>
                                <h3>Fill Your data in it!</h3>
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
