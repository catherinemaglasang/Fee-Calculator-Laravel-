@extends('dashboard.partials')

@section('content')

<div class="container row clearfix">

	@include('dashboard.calculatoraside')

	<div id="calculator" class="content">

	<h1>Delaware</h1>

	<div class="alert alert-info" v-if="errors">
			Items mark with * are required please fill them accordingly.
		</div>

		<div class="alert alert-danger" v-if="param_error">
			Oops Something went wrong! Please review your parameters.
		</div>

		<div class="loading" v-if="loading">
		</div>

	<form v-on="submit: getResults">

			<input type="hidden" v-model="state_code" value="DE">

			<div class="form-group clearfix">
				<label for="category">Enter VIN #*</label>
				<input type="text" name="params.vin" v-model="params.vin">
			</div>

			<div class="form-group clearfix">
				<label for="category">Vehicle Category*</label>
				<select name="category" v-model="category" v-on="change: fetchTypes()">
					<option value="">Select</option>
					@foreach($data['categories'] as $category)
						<option value="{{$category->name}}|{{$category->id}}">{{$category->name}}</option>
					@endforeach
				</select>
				<input type="hidden" name="params.category" v-model="params.category">
			</div>

			<div class="form-group clearfix">
				<label for="type">Vehicle Type*</label>
				<select name="type" v-model="params.type" v-attr="disabled:! enable">
					<option value="">Select</option>
					<option v-repeat="types" value="@{{ name }}">@{{ name }}</option>
				</select>
			</div>
			<button type="submit">Calculate Fees and Taxes</button>

			<div class="summary">
				<label>Total Tax and Fees</label>
				<div class="summary-content">
					<div class="summary-row">
						<label>Fees</label>
						$<input type="text" disabled="true" value="@{{ result.fees | total | toFixed }}">
					</div>
					<div class="summary-row">
						<label>Tax</label>
						$<input type="text" disabled="true" value="@{{ result.tax | total | toFixed }}">
					</div>
					<div class="summary-row">
						<label>Penalties</label>
						$<input type="text" disabled="true" value="@{{ result.penalties | total | toFixed }}">
					</div>
				</div>
				<div class="total">
					<span>$</span>@{{ total | grandTotal 'fees,tax,penalties' | toFixed }}
				</div>
			</div>
	</form>


	@include('dashboard.content.calculator.panels.result')
	</div>
</div>
@stop