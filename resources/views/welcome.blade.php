@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="jumbotron">
			<div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>Tired of forgetting that <em>perfect</em> recipe?</h1>
                        <p>The Recipe Manager lets you save and manage your amazing personal recipe creations anytime, anywhere.</p>
						@if(!Auth::check())
							<a href="{{ url('register') }}" class="btn btn-primary btn-lg">Sign Up - It's Free</a>
							<p><span class="text-caption">Already a member? <a href="{{url('login')}}">Log In</a></span></p>
						@else
							<a href="{{ url('recipes') }}" class="btn btn-primary btn-lg">Continue to Dashboard</a>
						@endif
                    </div>
                    <div class="col-sm-6 hidden-xs">
                        <img src="images/white-egg.png" class="img-responsive header-image" alt="Fancy egg dish">
                    </div>
                </div>
			</div>
		</div>
	</div>

	<div class="row dashboard">
		<div class="circle-pattern">

		</div>
		<h2 class="text-center">One dashboard, for all your recipes.</h2>
		<p class="text-center">The dashboard provides an overview of all your recipes at a glance and lets you browse them easily.</p>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<img src="images/dashboard-small.jpg" class="img-responsive showcase" alt="Recipe Manager Dashboard">
			</div>
		</div>
	</div>
	
	<div class="row">
		<img src="images/red-cake.jpg" class="img-responsive" alt="Red Cake">
	</div>

@stop
