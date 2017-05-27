@extends('layouts.company')

@section('styles')
	<style>
		.mt-80 {
			margin-top: 80px;
		}
		.right {
			margin: 20px auto;
		    font-size: 50px;
		    color: #7cd480;
		    width: 100px;
		    height: 100px;
		    border: 1px solid #7cd480;
		    border-radius: 50%;
		    padding: 20px;
		    display: block;
		}
		.panel {
			background-color: #e7e7e7;
		}
	</style>
@endsection

@section('content')
	@if(isset($method) && $method->state == 'approved')
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 mt-80 text-center panel">
					<span class="right">
						<i class="fa fa-check" aria-hidden="true"></i>	
					</span>
					<h2 class="text-success">Payment Succesful</h2>
					<h4 class="lead">
						You will recieve email from <b>EmployMe</b> with details
						about your paymant. You can now go to your dashboard from <a href="{{ URL('company') }}">here</a>
					</h4>	
				</div>
			</div>
		</div>
	@else
	
	@endif
@endsection