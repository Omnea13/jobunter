@if(Auth::user()->type == 'company' && Auth::user()->company->expire_date <= strtotime(Carbon\Carbon::now()))
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Jobunter | Re-new Payment</title>
		<link rel="stylesheet" href="{{ asset('public/plugins/bootstrap/css/bootstrap.min.css') }}">
		<style>
			@font-face {
				font-family: 'icomoon';
				src:url('{{ asset('public/fonts/icomoon/icomoon.eot') }}');
				src:url('{{ asset('public/fonts/icomoon/icomoon.eot?#iefix') }}') format('embedded-opentype'),
					url('{{ asset('public/fonts/icomoon/icomoon.woff') }}') format('woff'),
					url('{{ asset('public/fonts/icomoon/icomoon.ttf') }}') format('truetype'),
					url('{{ asset('public/fonts/icomoon/icomoon.svg#icomoon') }}') format('svg');
				font-weight: normal;
				font-style: normal;
			}
			.hero-section {
				height: 100vh;
				background: -webkit-linear-gradient(135deg,#00b1b3,#1d5086);
			    background: linear-gradient(-45deg,#00b1b3,#1d5086);
			    color: #fff;
			}
			.m-0 {
				margin: 0 auto;
			}
			.mt-100 {
				margin-top: 100px;
			}
			.renew-btn {
				text-align: center;
				margin-top: 60px;
			}
			/* General button style (reset) */
			.btn {
				border: none;
				font-family: inherit;
				font-size: inherit;
				color: inherit;
				background: none;
				cursor: pointer;
				padding: 25px 80px;
				display: inline-block;
				margin: 15px 30px;
				text-transform: uppercase;
				letter-spacing: 1px;
				font-weight: 700;
				outline: none;
				position: relative;
				-webkit-transition: all 0.3s;
				-moz-transition: all 0.3s;
				transition: all 0.3s;
			}

			.btn:after {
				content: '';
				position: absolute;
				z-index: -1;
				-webkit-transition: all 0.3s;
				-moz-transition: all 0.3s;
				transition: all 0.3s;
			}

			/* Pseudo elements for icons */
			.btn:before,
			.icon-heart:after,
			.icon-star:after,
			.icon-plus:after,
			.icon-file:before {
				font-family: 'icomoon';
				speak: none;
				font-style: normal;
				font-weight: normal;
				font-variant: normal;
				text-transform: none;
				line-height: 1;
				position: relative;
				-webkit-font-smoothing: antialiased;
			}
			.btn-5 {
				background: #fff;
    			color: #0896a6;
				height: 70px;
				min-width: 260px;
				line-height: 24px;
				font-size: 16px;
				overflow: hidden;
				-webkit-backface-visibility: hidden;
				-moz-backface-visibility: hidden;
				backface-visibility: hidden;
			}

			.btn-5:active {
				background: #9053a9;
				top: 2px;
			}

			.btn-5 span {
				display: inline-block;
				width: 100%;
				height: 100%;
				-webkit-transition: all 0.3s;
				-webkit-backface-visibility: hidden;
				-moz-transition: all 0.3s;
				-moz-backface-visibility: hidden;
				transition: all 0.3s;
				backface-visibility: hidden;
			}

			.btn-5:before {
				position: absolute;
				height: 100%;
				width: 100%;
				line-height: 2.5;
				font-size: 180%;
				-webkit-transition: all 0.3s;
				-moz-transition: all 0.3s;
				transition: all 0.3s;
			}

			.btn-5:active:before {
				color: #703b87;
			}
			.icon-coin-dollar:before {
			    content: "\e001";
			}
			.btn-5b:hover span {
				-webkit-transform: translateX(200%);
				-moz-transform: translateX(200%);
				-ms-transform: translateX(200%);
				transform: translateX(200%);
			}

			.btn-5b:before {
				left: -100%;
				top: 0;
			}

			.btn-5b:hover:before {
				left: 0;
			}
		</style>
	</head>
	<body>
		<div class="hero-section">
			<div class="container">
				<div class="row mt-100">
					<div class="col-md-6 col-md-offset-3">
						<img src="{{ asset('public/img/logo.png') }}" alt="" class="img-responsive m-0">
					</div>
				</div>
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<p class="h1 text-center">
							"I'm sorry, but if you are not a member of Jobunter, what are you doing?!"
						</p>
						<div class="renew-btn">
	                        <a href="{{ URL('checkout/renew') }}" class="btn btn-5 btn-5b icon-coin-dollar">
	                        	<span>Re-new</span>
	                        </a>
						</div>
	                </div>
				</div>
			</div>
		</div>
		{{-- <div class="media-left">
            <div class="bg-green-400 text-white">
                <div class="panel-body">
                    <i class="fa fa-credit-card fa-fw fa-2x"></i>
                </div>
            </div>
        </div>
        <div class="media-body">
            <p class="media-heading margin-v-5-3">
                Your Subscription ends on 
                <span>{{ App\Helpers\Helper::after()['day'] }}</span>
                After 
                <span>{{ App\Helpers\Helper::after()['days'] }} Days - {{ App\Helpers\Helper::after()['hours'] }} Hours - {{ App\Helpers\Helper::after()['minutes'] }} Minutes</span>
            </p>
        </div> --}}
		
		{{-- {{ strtotime(Carbon\Carbon::now()->addDays(4)) }} --}}
        
        {{-- @if(App\Helpers\Helper::after()['days'] <= 5)
            <div class="media-right media-padding">
                <a class="btn btn-white paper-shadow relative" data-z="0.5" data-hover-z="1" data-animated href="{{ URL('company/checkout/upgrade') }}">
                    Renew
                </a>
            </div>
        @endif --}}
	</body>
	</html>
@else
	<meta http-equiv="refresh" content="0;url={{ URL('/') }}"/>
@endif