
<div class="alert alert-info">
	<label for="category">Fee Type:</label>
	<div class="has-select">
		<select name="category" v-model="updates.fee_type" v-on="change: fetchDates()">
			<option value="">Select</option>
			@foreach($data['fee_types'] as $fee_type)
				<option value="{{ $fee_type['slug'] }}">{{ $fee_type['name'] }}</option>
			@endforeach
		</select>
	</div>
	<input type="hidden" v-model="state" value="{{ $data['state_id'] }}">
	<input type="hidden" v-model="scope" value="dates">
</div>
<div class="alert alert-danger" v-if="errors">
	Please select Fee Type.
</div>
<div class="alert alert-info" v-if="empty">
	No entries found.
</div>
<div class="alert alert-info" v-if="success">
	Success! item updated!
</div>
<table v-if="show" class="dates">
	<tbody>
		<tr>
			<th>Fee</th>
			<th>Min Weight</th>
			<th>Max Weight</th>
			<th>Amount</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th>Action</th>
		</tr>
		<tr v-repeat="date in dates" v-transition="staggered" stagger="30">
			<td>@{{ date.fee_name }}</td>
			<td>
				lbs<input v-attr="disabled:! date.edit" type="number" value="@{{ date.min_weight }}">
			</td>
			<td>
				lbs<input v-attr="disabled:! date.edit" type="number" value="@{{ date.max_weight }}">
			</td>
			<td>
				$<input v-attr="disabled:! date.edit" type="number" value="@{{ date.amount }}">
			</td>
			<td>
				<input v-attr="disabled:! date.edit" type="text" value="@{{ date.start_date }}">
			</td>
			<td>
				<input v-attr="disabled:! date.edit" type="text" value="@{{ date.end_date }}">
			</td>
			<td>
				<button v-on="click: editThis($index)">Edit</button>
			</td>
		</tr>
	</tbody>
</table>
@include('dashboard.content.manage.tabs.panels.modal')