@extends('user')
@section('content')
	@include('partials.breadcrumb')
	<section class="starts-area" >
	<div class="container">
		
		<div class="row">
			<div class="col-md-8 offset-md-2">
				
				<div class="card ">
					<div class="card-header">
					<h3 class="card-title">Deposit via {{$page_title}}</h3>
					</div>
					
					<div class="card-body text-center">
							<h6>  PLEASE SEND EXACTLY <span style="color: green"> {{ $bcoin }}</span> BTC</h6>
							<h5>TO <span style="color: green"> {{ $wallet}}</span></h5>
							{!! $qrurl !!}
							<h4 class="bold">SCAN TO SEND</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>



@endsection