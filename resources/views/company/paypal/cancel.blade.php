@extends('layouts.company')

@section('styles')
	<style>
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
		}
	</style>
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3 mt-80 text-center panel">
				<span class="right">
					<i class="fa fa-exclamation" aria-hidden="true"></i>
				</span>
				<h2 class="text-danger">OoOoPS!!</h2>
				<h4 class="lead">
					Your payment was cancelled! , please try again.
				</h4>
				<h4 class="lead">
					You can now go to your dashboard from <a href="{{ URL('company') }}">here</a>
				</h4>
				<p class="text-success">
					* We did not charge your card!
				</p>
			</div>
		</div>
	</div>
@endsection