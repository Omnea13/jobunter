@extends('layouts.company')

@section('styles')
	<style>
		.mt-50 {
			margin-top: 50px;
		}
	</style>
@endsection

@section('content')
	<div class="container mt-50">
	    <div class="row">
	        <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
	            <div class="row">
	                <div class="text-center">
	                    <h1 class="text-primary">Payment List</h1>
	                </div>
	                </span>
	                <table class="table table-hover table-striped">
	                    <thead>
	                        <tr>
	                            <th class="text-center">Product</th>
	                            <th class="text-center">Invoice Number</th>
	                            <th class="text-center">Amount</th>
	                            <th class="text-center">Expire Date</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	@foreach($payments as $payment)
		                        <tr>
		                            <td class="col-md-3"><em>Upgrade Account</em></h4></td>
		                            <td class="col-md-4 text-center">{{ $payment->invoice_number }}</td>
		                            <td class="col-md-1 text-center">{{ $payment->amount }}$</td>
		                            <td class="col-md-4 text-center">{{ Date('d M Y', $payment->expire_date) }}</td>
		                        </tr>
							@endforeach
	                    </tbody>
	                </table>
	                <a class="btn btn-info btn-sm btn-block" href="{{ URL('company') }}">
	                    <span class="glyphicon glyphicon-chevron-left"></span> Back
	                </a>
	            </div>
	        </div>
	    </div>
	</div>
@endsection

@section('scripts')
@endsection