@extends('layouts.jobseeker')

@section('styles')
    <style>
        body {
            text-align: center;
        }
        #container
        {
            margin: 0 auto;
            padding-right: 100px;
            padding-left: 100px;
        }
        #title {
            padding-right: 800px;
        }
        .overlay {
            background-color: rgba(0,0,0,0.6);
        }
        .panel-body {
            padding: 60px 0!important;
            color: #fff;
        }
        .text-white {
            color: #fff!important;
        }
        a.text-white:hover {
            text-decoration: none;
        }
        .item {
            position: relative!important;
            padding: 10px!important;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="st-content">
        <div class="st-content-inner padding-none">
            <div class="container-fluid">
                <div class="page-section">
                    <div class="media v-middle">
                        <div class="media-body" id="title" >
                            <h1 class="text-display-1 margin-none text-left" >Courses</h1>
                        </div>
                    </div>
                </div>
                <div class="w3-container">
                    <div class="row">
                        @foreach($categories as $category)
                            <div class="col-md-6">
                                <div class="item" style='background: url({{ asset("public/img/courses/category/$category->image") }}) center center no-repeat /cover;'>
                                    <div class="panel-body">
                                        <h4 class="text-headline margin-v-0-10">
                                            <a href='{{ URL("jobseeker/courses") }}/{{ str_slug($category->name, '-') }}' class="text-white">{{ $category->name }}</a>
                                        </h4>
                                        <p class="small margin-none">
                                            <div class="dot">
                                                @for($i=0; $i < count($category->courses); $i++)
                                                    <span class="fa fa-circle"></span>
                                                @endfor
                                                <span class="course-count">{{ count($category->courses) }} Courses</span>
                                            </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach    
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
@endsection
