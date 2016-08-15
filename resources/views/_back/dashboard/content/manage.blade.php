@extends('dashboard.partials')

@section('content')

<div class="container menu-open clearfix">
	
	@include('dashboard.manageaside')

	<div class="content">

		@include('flash')

		@include('errors')

		<h1>Welcome to TRS Calculator Manager</h1>
		<p>Please select state</p>
	</div>
</div>

@stop