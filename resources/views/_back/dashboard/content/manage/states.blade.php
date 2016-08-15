@extends('dashboard.partials')
@section('content')

<div class="container menu-open clearfix">

	@include('dashboard.manageaside')

	<div class="content">

	<div class="dropdown-navigation module">
        <h2><i class="fa fa-cogs"></i>&nbsp;{{ $data['state']}} Fee Calculator Manager</h2>
        <div class="breadcrumbs">
			<div><i class="fa fa-calculator"></i>&nbsp;Manage <i class="fa fa-angle-right"></i> <i class="fa fa-map-marker"></i>&nbsp;{{ $data['state']}}</div>
		</div>
   	</div>

   	<div class="module">
		@include('flash')
		@include('errors')
		@include('dashboard.content.manage.tabs.tabs')
	</div>

	</div>
</div>
@stop