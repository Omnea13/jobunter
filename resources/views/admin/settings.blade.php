@extends('layouts/admin')

@section('styles')
@endsection

@section('content')
	<div class="col-md-6">
		
		<div class="panel panel-primary">
            <div class="panel-heading">
                <span class="panel-title h3">Questions Settings</span>
            </div>
            <div class="panel-body">
            	<form method="POST" class="form-vertical" id="question-form">
            		<div class="form-group">
            			{{ csrf_field() }}
            			<label for="num-of-questions">Number Of Question In every Level</label>
                        @if(isset($settings->num_of_questions))
                        	<input type="text" name="num_of_question" value="{{ $settings->num_of_questions }}" placeholder="Number Of Questions" id="num-of-questions" class="form-control">
            			@else
                        	<input type="text" name="num_of_question" placeholder="Number Of Questions" id="num-of-questions" class="form-control">
            			@endif
            		</div>
	            	<div class="form-group">
	            		<label for="time-for-exam">Time For Exam</label>
	            		@if(isset($settings->time_for_questions))
	            			<input type="text" name="time_for_exam" value="{{ $settings->time_for_questions }}" placeholder="Time for exam" id="time-for-exam" class="form-control">
	            		@else
	            			<input type="text" name="time_for_exam" placeholder="Time for exam" id="time-for-exam" class="form-control">
	            		@endif
	            	</div>
	            	<div class="form-group">
	            		<input type="submit" value="Save" class="btn btn-block btn-success">
	            	</div>
	            </form>
            </div>
        </div>
	</div>

	<div class="col-md-6">
		<div class="panel panel-danger">
            <div class="panel-heading">
                <span class="panel-title h3">PayPal Settings</span>
            </div>
            <div class="panel-body">
            	<form method="post" class="form-vertical" id="paypal-form">
	            	{{ csrf_field() }}
	            	<div class="form-group">
	            		<label for="paypal_mode">PayPal Status</label>
	            		@if(isset($settings->paypal_mode))
							<select name="paypal_mode" id="paypal_mode" class="form-control" required>
		            			<option selected disabled>Select PayPal Status</option>
		            			<option value="live" @if($settings->paypal_mode == 'live') {{ 'selected' }} @endif>Live Mode</option>
		            			<option value="sandbox" @if($settings->paypal_mode == 'sandbox') {{ 'selected' }} @endif>SandBox Mode</option>
		            		</select>
						@else
							<select name="paypal_mode" id="paypal_mode" class="form-control" required>
		            			<option selected disabled>Select PayPal Status</option>
		            			<option value="live">Live Mode</option>
		            			<option value="sandbox">SandBox Mode</option>
		            		</select>
	            		@endif
	            	</div>
	            	<div class="form-group">
	            		<label for="client_id">Secret Key</label>
	            		@if(isset($settings->client_id))
	            			<input type="text" name="client_id" value="{{ $settings->client_id }}" id="client_id" placeholder="Client ID" autocomplete="off" class="form-control">
	            		@else
	            			<input type="text" name="client_id" id="client_id" placeholder="Client ID" autocomplete="off" class="form-control">
	            		@endif
	            	</div>
	            	<div class="form-group">
	            		<label for="secret">Public Key</label>
	            		@if(isset($settings->secret_id))
	            			<input type="text" name="secret_id" id="secret" value="{{ $settings->secret_id }}" placeholder="Secret" autocomplete="off" class="form-control">
	            		@else
	            			<input type="text" name="secret_id" id="secret" placeholder="Secret" autocomplete="off" class="form-control">
	            		@endif
	            	</div>
	            	<div class="form-group">
	            		<input type="submit" value="Save" class="btn btn-danger btn-block">
	            	</div>
	            </form>
            </div>
        </div>
	</div>
@endsection

@section('scripts')
	<script>
		$(function(){
			$('form#paypal-form').on('submit', function(event){
				event.preventDefault();

				$.ajax({
					url: 'settings/paypal',
					type: 'POST',
					data: $(this).serialize(),
					success: function(response){
						window.location.reload();
					}
				});
			});

			$("form#question-form").on('submit', function(event) {
				event.preventDefault();

				$.ajax({
					url: 'settings/questions',
					type: 'POST',
					data: $(this).serialize(),
					success: function(response){
						window.location.reload();
					}
				});
			});
		});
	</script>
@endsection