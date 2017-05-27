<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Jobunter | Exam</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="{{ asset('public/plugins/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/plugins/fontawesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/form-elements.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/exam.css') }}">
        <style>
            .navbar-brand {
                width: 225px!important;
                background-position: 0 -80px!important;
                /*line-height: 127px;*/
                text-indent: -99999px;
            }
        </style>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body style="background: url({{ asset('public/img/backgrounds/1.jpg') }}) center center /cover;">

		<!-- Top menu -->
		<nav class="navbar navbar-inverse navbar-no-bg" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="javascript:;">BootZard - Bootstrap Wizard Template</a>
				</div>
			</div>
		</nav>

        <!-- Top content -->
        <div class="top-content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 form-box">
                    	<form role="form" action="{{ URL('jobseeker/submit-answers') }}" id="exam-form" method="post" class="f1">
                    		{{ csrf_field() }}
                    		<input type="hidden" name="exam_id" value="{{ $exam->id }}">
                    		<h3>Register To Our App</h3>
                    		<p>Fill in the form to get instant access</p>
                    		<div class="f1-steps">
                    			<div class="f1-progress">
                    			    <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3" style="width: 16.66%;"></div>
                    			</div>
                    			@for($i = 0; $i < count($questions); $i++)
	                    			<div class="f1-step">
	                    				<div class="f1-step-icon"><i class="fa fa-question"></i></div>
	                    				<p>Level {{ $i+1 }}</p>
	                    			</div>
                    			@endfor
                    		</div>
                    		
                    		<fieldset>
                    		    <h4 class="text-center">Beginner Questions</h4>
                    			@foreach($questions['beginner'] as $index => $question)
	                    			<div class="form-group">
	                    				<img src='{{ asset("public/img/questions/{$question->question}") }}' alt="{{ $question->category->name }}">
	                    				@foreach(json_decode($question->choices) as $key => $choice)
	                    					<div class="radio">
		                    					<label for="answer{{ $key }}">
		                    						<input type="radio" id="answer{{ $key }}" name="{{ $question->id }}" value="{{ $choice }}">
		                    						{{ $choice }}
		                    					</label>
	                    					</div>
	                    				@endforeach
	                    			</div>
                    			@endforeach
                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-next">Next</button>
                                </div>
                            </fieldset>

                            <fieldset>
                                <h4 class="text-center">Intermediate Questions</h4>
                                @foreach($questions['intermediate'] as $index => $question)
	                    			<div class="form-group">
	                    				<img src='{{ asset("public/img/questions/{$question->question}") }}' alt="{{ $question->category->name }}">
	                    				@foreach(json_decode($question->choices) as $key => $choice)
	                    					<div class="radio">
		                    					<label for="answer{{ $key }}">
		                    						<input type="radio" id="answer{{ $key }}" name="{{ $question->id }}" value="{{ $choice }}">
		                    						{{ $choice }}
		                    					</label>
	                    					</div>
	                    				@endforeach
	                    			</div>
                    			@endforeach
                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-next">Next</button>
                                </div>
                            </fieldset>

                            <fieldset>
                                <h4 class="text-center">Advanced Questions</h4>
                                @foreach($questions['advanced'] as $index => $question)
	                    			<div class="form-group">
	                    				<img src='{{ asset("public/img/questions/{$question->question}") }}' alt="{{ $question->category->name }}">
	                    				@foreach(json_decode($question->choices) as $key => $choice)
	                    					<div class="radio">
		                    					<label for="answer{{ $key }}">
		                    						<input type="radio" id="answer{{ $key }}" name="{{ $question->id }}" value="{{ $choice }}">
		                    						{{ $choice }}
		                    					</label>
	                    					</div>
	                    				@endforeach
	                    			</div>
                    			@endforeach
                                <div class="f1-buttons">
                                    <button type="submit" class="btn btn-submit">Submit</button>
                                </div>
                            </fieldset>

                    	</form>
                    </div>
                </div>                    
            </div>
        </div>

        <!-- Javascript -->
        <script src="{{ asset('public/plugins/jquery/jquery-2.1.3.min.js') }}"></script>
        <script src="{{ asset('public/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('public/plugins/backstretch/jquery.backstretch.min.js') }}"></script>
        <script src="{{ asset('public/js/retina-1.1.0.min.js') }}"></script>
        <script src="{{ asset('public/js/exam.js') }}"></script>
    </body>
</html>