@extends('dashboard.partials')

@section('content')
<div class="container row clearfix">
	
	@include('dashboard.calculatoraside')

	<div class="content">
		<h1>Under Construction</h1>

		@include('errors')

		<p>This calculator is under construction.</p>
	</div>
</div>
@stop