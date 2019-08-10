@extends('layouts.app1')

@section('content')

<section class="info-section">
	<div class="container">
		<div class="row">
			@if (auth()->check())
				<div class="col-md-4">
					<img src="{{asset('img/img1.png')}}" class="align-self-center ">
				</div>
				<div class="col-md-5 text-light text-justify">
					<h3>How we work</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia fugit nesciunt non recusandae molestiae facilis quo hic fuga optio praesentium quidem iste temporibus dolorem, dolor veniam eaque voluptates explicabo, laudantium.</p>
				</div>
			@else
				<div class="col-md-6">
					<img src="{{asset('img/img1.png')}}" class="align-self-center ">
				</div>
				<div class="col-md-6 text-light text-justify">
					<h3>How we work</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia fugit nesciunt non recusandae molestiae facilis quo hic fuga optio praesentium quidem iste temporibus dolorem, dolor veniam eaque voluptates explicabo, laudantium.</p>
				</div>
			@endif
		</div>
	</div>
</section>

@endsection
