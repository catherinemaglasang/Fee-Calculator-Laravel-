<ul class="tabs-main clearfix">
	<li {!! $data['category'] == 'fees' ? 'class="active"' : ''; !!}>
		<a href="{!! url(); !!}/manage/{!! $data['state'].'?cat='; !!}fees&type=state_fees">Fees</a>
		<ul class="clearfix">
			<li {!! $data['type'] == 'state_fees' ? 'class="active"' : ''; !!}><a href="{!! url(); !!}/manage/{!! $data['state'].'?cat='; !!}fees&type=state_fees">State Fees</a></li>
			<li {!! $data['type'] == 'county_fees' ? 'class="active"' : ''; !!}><a href="{!! url(); !!}/manage/{!! $data['state'].'?cat='; !!}fees&type=county_fees">{!! $data['state'] == 'louisiana' ? 'Parish' : 'County' !!}</a></li>
			<li {!! $data['type'] == 'city_fees' ? 'class="active"' : ''; !!}><a href="{!! url(); !!}/manage/{!! $data['state'].'?cat='; !!}fees&type=city_fees">City Fees</a></li>
		</ul>
	</li>
	<li {!! $data['category'] == 'penalties' ? 'class="active"' : ''; !!}>
		<a href="{!! url(); !!}/manage/{!! $data['state'].'?cat='; !!}penalties&type=state_penalties">Penalties</a>
		<ul class="clearfix">
			<li {!! $data['type'] == 'state_penalties' ? 'class="active"' : ''; !!}><a href="{!! url(); !!}/manage/{!! $data['state'].'?cat='; !!}penalties&type=state_penalties">State Penalties</a></li>
			<li {!! $data['type'] == 'county_penalties' ? 'class="active"' : ''; !!}><a href="{!! url(); !!}/manage/{!! $data['state'].'?cat='; !!}penalties&type=county_penalties">County Penalties</a></li>
			<li {!! $data['type'] == 'city_penalties' ? 'class="active"' : ''; !!}><a href="{!! url(); !!}/manage/{!! $data['state'].'?cat='; !!}penalties&type=city_penalties">City Penalties</a></li>
		</ul>
	</li>
	<li {!! $data['category'] == 'tax' ? 'class="active"' : ''; !!}>
		<a href="{!! url(); !!}/manage/{!! $data['state'].'?cat='; !!}tax&type=state_tax">Tax</a>
		<ul class="clearfix">
			<li {!! $data['type'] == 'state_tax' ? 'class="active"' : ''; !!}><a href="{!! url(); !!}/manage/{!! $data['state'].'?cat='; !!}tax&type=state_tax">State Tax</a></li>
			<li {!! $data['type'] == 'county_tax' ? 'class="active"' : ''; !!}><a href="{!! url(); !!}/manage/{!! $data['state'].'?cat='; !!}tax&type=county_tax">County Tax</a></li>
			<li {!! $data['type'] == 'city_tax' ? 'class="active"' : ''; !!}><a href="{!! url(); !!}/manage/{!! $data['state'].'?cat='; !!}tax&type=city_tax">City Tax</a></li>
		</ul>
	</li>
	<li {!! $data['category'] == 'dates' ? 'class="active"' : ''; !!}>
		<a href="{!! url(); !!}/manage/{!! $data['state'].'?cat='; !!}dates&type=effective_dates">Dates</a>
		<ul class="clearfix">
			<li {!! $data['type'] == 'effective_dates' ? 'class="active"' : ''; !!}><a href="{!! url(); !!}/manage/{!! $data['state'].'?cat='; !!}dates&type=effective_dates">Effective Dates</a></li>
		</ul>
	</li>
</ul>

@if ($data['state'] != null)
	<!-- Fees -->
	@if($data['category'] == 'fees' && $data['type'] == 'state_fees')
		<div id="manage-state-fees-penalties-tax" class="manage-panel">
			@include('dashboard.content.manage.tabs.panels.stateFees')
		</div>
	@endif

	@if($data['category'] == 'fees' && $data['type'] == 'county_fees')
		<div id="manage-county-fees-penalties-tax" class="manage-panel">
			@include('dashboard.content.manage.tabs.panels.countyFees')
		</div>
	@endif

	@if($data['category'] == 'fees' && $data['type'] == 'city_fees')
		@if($data['state'] == 'louisiana')
			<div id="manage-county-fees-city-fees" class="manage-panel">
				@include('dashboard.content.manage.tabs.panels.cityFees')
			</div>
		@else
			@include('dashboard.content.manage.tabs.panels.construction')
		@endif
	@endif
	<!-- Penalties -->
	@if($data['category'] == 'penalties' && $data['type'] == 'state_penalties')
		<div id="manage-state-fees-penalties-tax" class="manage-panel">
			@include('dashboard.content.manage.tabs.panels.statePenalties')
		</div>
	@endif

	@if($data['category'] == 'penalties' && $data['type'] == 'county_penalties')
		<div id="manage-county-fees-penalties-tax" class="manage-panel">
			@include('dashboard.content.manage.tabs.panels.countyPenalties')
		</div>
	@endif

	@if($data['category'] == 'penalties' && $data['type'] == 'city_penalties')
		@include('dashboard.content.manage.tabs.panels.construction')
	@endif

	<!-- Tax -->

	@if($data['category'] == 'tax' && $data['type'] == 'state_tax')
		<div id="manage-state-fees-penalties-tax" class="manage-panel">
			@include('dashboard.content.manage.tabs.panels.stateTax')
		</div>
	@endif

	@if($data['category'] == 'tax' && $data['type'] == 'county_tax')
		<div id="manage-county-fees-penalties-tax" class="manage-panel">
			@include('dashboard.content.manage.tabs.panels.countyTax')
		</div>
	@endif

	@if($data['category'] == 'tax' && $data['type'] == 'city_tax')
		@include('dashboard.content.manage.tabs.panels.construction')
	@endif

	<!-- Dates -->

	@if($data['category'] == 'dates' && $data['type'] == 'effective_dates')
		<div id="manage-state-dates" class="manage-panel">
			@include('dashboard.content.manage.tabs.panels.effectiveDates')
		</div>
	@endif


@endif