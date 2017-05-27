@extends('layouts.jobseeker')

@section('styles')
    <style>
        #custom-search-input{
            padding: 3px;
            border: solid 1px #E4E4E4;
            border-radius: 6px;
            background-color: #fff;
            /*font-size: 30px;*/
        }

        #custom-search-input input{
            border: 0;
            box-shadow: none;
            /*font-size: 17px;*/
        }

        #custom-search-input button{
            margin: 2px 0 0 0;
            background: none;
            box-shadow: none;
            border: 0;
            color: #666666;
            padding: 0 8px 0 10px;
            border-left: solid 1px #ccc;
        }

        #custom-search-input button:hover{
            border: 0;
            box-shadow: none;
            border-left: solid 1px #ccc;
        }

        #custom-search-input .glyphicon-search{
            /*font-size: 18px;*/
        } 
        .plf-50 {
            padding: 50px;
        }
        .mt-10 {
            margin-top: 10px;
        }
        .mt-30 {
            margin-top: 30px;
        }
        .item {
            background: #fff;
            margin-top: 10px;
            border-bottom: 1px solid #ccc;
        }
        .item:last-child {
            border-bottom: 1px solid transparent;
        }
    </style>
@endsection

@section('content')

	<div class="section col-xs-12 col-lg-12 panel-body plf-50" id="jobs-panel">
        <div class="panel panel-default paper-shadow" data-z="0.5">
            <div class="panel-heading">
                <h2 class="row">
                    <div class="col-md-8"> Available Jobs
                    </div> 
                    <div class="col-md-4" >
                        <div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <input type="text" class="form-control" id="search-input" placeholder="Search" />
                                <span class="input-group-btn">
                                    <button class="btn btn-info" id="search" type="button">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </h2>
            </div>
            {{-- <div class="panel-body"> --}}
                <div class="search-container">
                    
                    <div class="col-md-9 item">
                        @if(isset($availableJobs) && count($availableJobs) > 0)
                            @foreach($availableJobs as $job)
                                <div class="section-item">
                                    <div class="col-md-2">
                                        <div class="pull-left company-logo">
                                            <img class="img-responsive" src="{{ asset('public/img/logo') }}/{{ App\Company::where('user_id', '=', $job->user_id)->first()->logo }}">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <h3>
                                            <a target="_blank" href="{{ URL('jobseeker/jobs/details') }}/{{ $job->id }}"> {{ $job->name }}</a>
                                        </h3>
                                        <ul class="list-inline">
                                            <li> <i class="fa fa-hospital-o"></i> <b>Company : </b> {{ $job->companyName->name }}</li>
                                            <li> <i class="fa fa-money"></i> <b>Salary : </b> {{ $job->salary }} EGP</li>
                                            <li> <i class="fa fa-map-marker"></i> <b>Location : </b> {{ $job->location }}</li>
                                            <li> <i class="fa fa-history"></i> <b>Employment Type : </b> {{ title_case($job->type) }}</li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h4>You don't have any success skills to view jobs depend on these skills</h4>
                        @endif
                    </div>
                    
                    <div class="col-md-3 mt-10">
                        <form action="POST">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#jobtype" aria-expanded="true" aria-controls="jobtype">
                                                <i class="fa fa-history"></i> Job Type
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="jobtype" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <div class="radio">
                                                    <label for="full-time">
                                                        <input type="radio" name="jobtype" id="full-time" value="full-time">
                                                        Full-Time
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="radio">
                                                    <label for="part-time">
                                                        <input type="radio" name="jobtype" id="part-time" value="part-time">
                                                        Part-Time
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingTwo">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#salary" aria-expanded="false" aria-controls="salary">
                                                <i class="fa fa-money"></i> Salary
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="salary" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <div class="smart-forms">
                                                    <div class="section">
                                                        <div class="slider-wrapper yellow-slider">
                                                            <div id="slider-range2"></div>  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                
                </div>
            {{-- </div> --}}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function(){
            $('.tooltipped').tooltip({delay: 50});

            var valtooltip = function(sliderObj, ui){
                val1            = '<span class="slider-tip">'+ sliderObj.slider("values", 0) +'</span>';
                val2            = '<span class="slider-tip">'+ sliderObj.slider("values", 1) +'</span>';
                sliderObj.find('.ui-slider-handle:first').html(val1);
                sliderObj.find('.ui-slider-handle:last').html(val2);                         
            };

            // salary price
            $("#slider-range2" ).slider({
                range: true,
                min: 0,
                max: 10000,
                values: [1000, 5000],              
                create:function(event,ui){
                    valtooltip($(this),ui);                    
                },
                slide: function( event, ui ) {
                    valtooltip($(this),ui);
                }, 
                stop:function(event,ui){
                    valtooltip($(this),ui);             
                }
            });
        });

        $("#search-input").on("keyup", search);
        $("#search").on("click", search);

        var search = function (event) {
            event.preventDefault();
            $name = $("#search-input").val();
            $.ajax({
                url: "jobs/search",
                method: 'GET',
                data: {'name': $name},
                success: function (response) {
                    console.log(response);
                    //foreach
                    $("#searchContainer").empty();
                    for (var i = 0; i < response.length; i++) {
                        draw(response[i]);
                    }
                },
                error: function (error) {
                    //show no item
                    var container = $("#searchContainer");
                    container.empty();
                    container.append($("<h1><h1>").text(error));
                    // console.log(error);
                }
            });
        };
    </script>
@endsection