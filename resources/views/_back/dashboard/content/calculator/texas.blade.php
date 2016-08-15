@extends('dashboard.partials')

@section('content')
	<div class="container menu-open clearfix">

	@include('dashboard.calculatoraside')

	<div id="calculator" class="content">
		<div class="dropdown-navigation module">
        	<h2><i class="fa fa-calculator"></i>&nbsp;Texas Sales Tax Calculation</h2>
        	<div class="breadcrumbs">
				<div><i class="fa fa-calculator"></i>&nbsp;Calculator <i class="fa fa-angle-right"></i> <i class="fa fa-map-marker"></i>&nbsp;Texas</div>
			</div>
    	</div>

		<div class="calculator-wrapper module clearfix">

		@include('dashboard.content.calculator.panels.info')

		<form v-on="submit: getResults">

			<input type="hidden" v-model="state_code" value="TX">

			<div class="form-group clearfix">
				<label for="category">Transaction Type*</label>
				<div class="has-select">
					<select name="type" v-model="transactionType" v-on="change: setConditions()">
						<option value="1">New Title/New Registration</option>
						<option value="2">New Title/Transfer Plate</option>
						<option value="3">Duplicate Title</option>
						<option value="4">Title Only</option>
						<option value="5">Registration Only</option>
						<option value="6">Title Registration Correction</option>
					</select>
				</div>
			</div>

			<div class="form-group clearfix">
				<label for="category">Enter VIN #*</label>
				<input type="text" title="1FDXW46R09E679900" v-on="blur: getCatAndType()" v-model="vin_pattern">
			</div>
			<div class="form-group clearfix">
				<label for="type">Vehicle Type*</label>
				<div class="has-select">
					<select name="type" v-model="vehicleClass" v-on="change: setConditions()">
						<option value="">Select</option>
						<option v-repeat="class in clasification" value="@{{ $index }}">@{{ class.name }}</option>
					</select>
				</div>
			</div>
			<div class="form-group clearfix">
				<label for="model_year">Model Year</label>
                <div class="has-select">
                    <select name="model_year" v-model="params.model_year">
                        <option value="">Select</option>
                        <!-- Rule: add 2 from the current year -->
                        @foreach(range(date('Y')+2, 1900) as $year)
                        <option value="{{$year}}">{{$year}}</option>
                        @endforeach
                    </select>
                </div>
			</div>
			<div class="form-group clearfix" v-if="motorcycle && transactionType != 3 && transactionType != 5 && transactionType != 6">
				<label for="address">Street Address*</label>
				<input type="text" name="address" v-model="params.address">
			</div>
			<div class="form-group clearfix" v-if="motorcycle && transactionType != 3 && transactionType != 5 && transactionType != 6">
				<label for="address">Zip*</label>
				<input type="text" name="address" v-model="params.zip">
			</div>
			<div class="form-group clearfix" v-if="transactionType != 3 && transactionType != 5 && transactionType != 6">
				<label for="county_name">Select County</label>
				<div class="has-select">
					<select name="county_name" v-model="params.county_name">
						<option value="">Select</option>
						@foreach($counties as $county)
							<option value="{{$county->name}}">{{$county->name}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group clearfix" v-if="!motorcycle && transactionType != 3 && transactionType != 6">
				<label for="gvw">Empty Weight*</label>
				<div class="is-weight">
					<input type="text" v-on="change: updateWeights()" v-model="empty_weight"  placeholder="0">
				</div>
			</div>
			<div class="form-group clearfix" v-if="!motorcycle && transactionType != 3 && transactionType != 6">
				<label for="gvw">Carrying Capacity*</label>
				<div class="is-weight">
					<input type="text" v-on="change: updateWeights()" v-model="carrying_capacity"  placeholder="0">
				</div>
			</div>
			<div class="form-group clearfix" v-if="!motorcycle && transactionType != 3 && transactionType != 6">
				<label>GVW</label>
				<div class="is-weight">
					<input disabled="disabled" type="text" v-model="params.gvw" placeholder="0">
				</div>
			</div>
			<div class="form-group clearfix" v-if="!motorcycle && transactionType != 3 && transactionType != 6">
				<label>GVWR</label>
				<div class="is-weight">
					<input disabled="disabled" type="text" v-model="params.gvwr" placeholder="0">
				</div>
			</div>
			<div class="form-group clearfix" v-if="transactionType != 3">
				<label for="taxable_value">Inspection Fee</label>
				<div class="is-currency">
					<input type="text" v-on="blur: insFeetransform()" name="taxable_value" v-model="params.inspection_fee" placeholder="0.00">
				</div>
			</div>
			<div class="form-group clearfix" v-if="motorcycle && transactionType != 3 && transactionType != 6 && transactionType != 5">
				<label for="gvw">Freight</label>
				<input type="number" name="freight" v-model="params.freight">
			</div>
			<div class="form-group clearfix" v-if="transactionType != 3 && transactionType != 5 && transactionType != 6">
				<label for="taxable_value">Sales Price</label>
				<div class="is-currency">
					<input type="text" v-on="blur: updateTaxable()" v-model="params.sale_price" placeholder="0.00">
				</div>
			</div>
				<div class="form-group clearfix" v-if="transactionType != 3 && transactionType != 5 && transactionType != 6">
				<label for="taxable_value">Rebate/Discount</label>
				<div class="is-currency">
					<input type="text" v-on="blur: updateTaxable()" v-model="params.rebate" placeholder="0.00">
				</div>
			</div>
			<div class="form-group clearfix" v-if="transactionType != 3 && transactionType != 5 && transactionType != 6">
				<label for="taxable_value">Trade-in Value</label>
				<div class="is-currency">
					<input type="text" v-on="blur: updateTaxable()" v-model="params.trade_in" placeholder="0.00">
				</div>
			</div>
			<div class="form-group clearfix" v-if="transactionType != 3">
				<label for="taxable_value">Sales Tax Credit</label>
				<div class="is-currency">
					<input type="text" v-on="blur: updateTaxable()" name="taxable_value" v-model="params.sales_tax_credit" placeholder="0.00">
				</div>
			</div>
			<div class="form-group clearfix" v-if="transactionType != 3 && transactionType != 5 && transactionType != 6">
				<label>Taxable Value</label>
				<div class="is-currency">
					<input disabled="disabled" type="text" v-model="taxable_value" placeholder="0.00">
				</div>
			</div>
			<div class="form-group clearfix" v-if="transactionType != 3 && transactionType != 6">
				<label for="fuel_type">Fuel Type</label>
                <div class="has-select">
                    <select name="fuel_type" v-model="params.fuel_type">
                        <option value="">Select</option>
                        <option value="diesel">Diesel</option>
                        <option value="gasoline">Gasoline</option>
                    </select>
                </div>
			</div>
			<div class="form-group clearfix" v-if="transactionType != 3 && transactionType != 6">
				<label for="sale_date">Date of Sales*</label>
				<input v-datepicker="sale_date" type="text" name="sale_date" v-model="sale_date">
			</div>
			<button type="submit" v-attr="disabled: missing">Calculate Fees and Taxes</button>
		</form>

		<div class="calculator-form-asside">
			<div class="summary options">
				<label>Options</label>
				<div class="summary-content">
					<div class="summary-row clearfix">
						<input id="temp_tag" type="checkbox" name="temp_tag" v-model="temp_tag">
						<label for="temp_tag">Temp Tag</label>
					</div>
					<div class="summary-row clearfix">
						<input id="trade_or_lease" type="checkbox" name="trade_or_lease" v-model="trade_or_lease">
						<label for="trade_or_lease">Leased Traded-In?</label>
					</div>
					<div class="summary-row clearfix">
						<input id="farm_or_ranch" type="checkbox" name="farm_or_ranch" v-model="farm_or_ranch">
						<label for="farm_or_ranch">Farm / Ranch</label>
					</div>
					<div class="summary-row clearfix">
						<input id="member_military" type="checkbox" name="member_military" v-model="member_military">
						<label for="member_military">Member Military</label>
					</div>
					<div class="summary-row clearfix">
						<input id="off_highway_use" type="checkbox" name="off_highway_use" v-model="off_highway_use">
						<label for="off_highway_use">Off Highway Use</label>
					</div>
					<div class="summary-row clearfix">
						<input id="rebuilt_or_salvage" type="checkbox" name="rebuilt_or_salvage" v-model="rebuilt_or_salvage">
						<label for="rebuilt_or_salvage">Rebuilt / Salvage</label>
					</div>
				</div>
			</div>
			<div class="summary">
				<label>Total Tax and Fees</label>
				<!-- <div class="summary-content" v-if="success">
					<div class="summary-row">
						<label>Total Fees</label>
						$<input type="text" disabled="true" value="@{{ total_fees | toFixed }}">
					</div>
					<div class="summary-row">
						<label>Total Tax</label>
						$<input type="text" disabled="true" value="@{{ total_tax | toFixed }}">
					</div>
					<div class="summary-row">
						<label>Total Penalties</label>
						$<input type="text" disabled="true" value="@{{  total_penalties | toFixed }}">
					</div>
				</div> -->
				<div class="total">
					<span>$ </span>@{{ total | toFixed }}
				</div>
			</div>
		</div>
		</div>
		@include('dashboard.content.calculator.panels.result')
		@include('dashboard.content.calculator.panels.modal')
	</div>
</div>

@stop














