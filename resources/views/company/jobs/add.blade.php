@extends('layouts.company')

@section('styles')
	<!-- Include external CSS. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">

    <!-- Include Editor style. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/froala_style.min.css" rel="stylesheet" type="text/css" />
	
	<link rel="stylesheet" href="{{ asset('public/plugins/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/tagsinput/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/timepicker/jquery-ui-timepicker-addon.min.css') }}">

	<style>
		.btn-rounded {
			border: 1px solid #ccc;
			color: #000;
			border-radius: 30px;
		}
		#ui-datepicker-div {
            z-index: 999999!important;
            background: #eee;
            padding: 10px;
            border-radius: 10px;
        }
        .ui-datepicker-calendar {
            width: 100%;
        }
		.pl-0 {
			padding-left: 0!important;
		}
		.mt-80 {
			margin-top: 80px;
		}
		.right {
			margin: 20px auto;
		    font-size: 50px;
		    color: #f17878;
		    width: 100px;
		    height: 100px;
		    border: 1px solid #f17878;
		    border-radius: 50%;
		    padding: 20px;
		    display: block;
		}
		.panel {
			background-color: #e7e7e7;
			padding: 20px!important;
		}
		.bootstrap-tagsinput {
            display: block;
        }
	</style>
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<h3 class="text-center">Add New Job</h3>
			<div class="col-md-12 panel">
				<form action="#" method="POST" id="new-job-form">
					<div class="form-group">
						{{ csrf_field() }}
						<label for="title">Job Title</label>
						<input type="text" name="title" id="title" placeholder="Job Title" class="form-control">
					</div>

					<div class="form-group clearfix">
						<div class="col-md-6 pl-0">
							<label for="salary">Salary</label>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-money"></i>
								</span>
								<input type="number" min="0" name="salary" id="salary" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<label for="type">Employment Type</label>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-user"></i>
								</span>
								<select name="type" id="type" class="form-control">
									<option selected disabled>Select Employment Type</option>
									<option value="full-time">Full-time</option>
									<option value="part-time">Part-time</option>
								</select>
							</div>
						</div>
					</div>

					<div class="form-group clearfix">
						<div class="col-md-6 pl-0">
							<label for="description">Job Description</label>
							<textarea name="description" id="description" class="form-control"></textarea>
						</div>
						<div class="col-md-6">
							<label for="requirements">Job Requirements</label>
							<textarea name="requirements" id="requirements" class="form-control"></textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="skills">Job Required Skills</label>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-bolt"></i>
							</span>
							<input type="text" name="skills" id="skills" data-role="tagsinput" placeholder="Requirements Skills" class="form-control tags">
						</div>
					</div>

					<div class="form-group clearfix">
						<div class="col-md-6 pl-0">
							<label for="location">Location</label>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-map-marker"></i>
								</span>
								<input type="text" name="location" id="location" placeholder="Job Location" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<label for="end_date">Job Availabel Until</label>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</span>
								<input type="text" name="end_date" id="end_date" class="datetimepicker form-control">
							</div>
						</div>
					</div>

					<div class="form-group">
						<a href="{{ url('company') }}" class="btn btn-rounded"><i class="fa fa-arrow-left"></i> Back<a>
						<input type="submit" value="Post Job" class="btn btn-primary pull-right">
					</div>

				</form>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
 	<!-- Include external JS libs. -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>

    <!-- Include Editor JS files. -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1//js/froala_editor.pkgd.min.js"></script>
	
    <script src="{{ asset('public/plugins/tagsinput/bootstrap-tagsinput.min.js') }}"></script>
	<script src="{{ asset('public/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('public/plugins/timepicker/jquery-ui-timepicker-addon.min.js') }}"></script>

    <!-- Initialize the editor. -->
    <script> 
    	$(function() {
    		$('textarea').froalaEditor();
    		$('.datetimepicker').datetimepicker({timeFormat: "HH:mm:ss"});

    		$('form#new-job-form').on('submit', function(event) {
    			event.preventDefault();

    			$.ajax({
    				url: '',
    				data: $(this).serialize(),
    				type: 'POST',
    				success: function(response) {
    					window.location = '{{ URL('company') }}'
    				}
    			});
    		});
    	}); 
    	</script>
@endsection