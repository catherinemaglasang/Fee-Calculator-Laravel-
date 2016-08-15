<div class="alert alert-info">
	<label for="county">County:</label>
	<div class="has-select">
		<select name="county" v-model="updates.county" v-on="change: countySelect()" v-attr="disabled:! enableCounty">
			@foreach($data['counties'] as $county)
				<option value="{{ $county->id }}">{{ $county->name }}</option>
			@endforeach
		</select>
	</div>
	<button v-on="click: changeCounty()" v-attr="disabled:! enableChange">Change</button>
	<label for="category">Vehicle Category:</label>
	<div class="has-select">
		<select name="category" v-model="updates.category" v-on="change: fetchTypes" v-attr="disabled:! enableCategory">
			@foreach($data['categories'] as $category)
				<option value="{{ $category->id }}">{{ $category->name }}</option>
			@endforeach
		</select>
	</div>
	<label for="type">Vehicle Type:</label>
	<div class="has-select">
		<select name="type" v-model="updates.type" v-on="change: fetchData('tax')" v-attr="disabled:! enableType">
			<option value="">Select</option>
			<option v-repeat="types" value="@{{ id }}">@{{ name }}</option>
		</select>
	</div>
	<input type="hidden" v-model="state" value="{{ $data['state_id'] }}">
	<input type="hidden" v-model="scope" value="tax">
</div>
<div class="alert alert-danger" v-if="errors">
	Please select County, Vehicle Category and Vehicle Type.
</div>
<div class="alert alert-info" v-if="empty">
	No entries found.
</div>
<table v-if="show">
	<tbody>
		<tr>
			<th>Fee</th>
			<th style="width: 177px;">Amount</th>
			<th style="width: 158px;">Action</th>
		</tr>
		<tr v-repeat="fee in penalties" v-transition="staggered" stagger="30">
			<td>@{{ fee.fee_name }}</td>
			<td>
				$<input v-attr="disabled:! fee.edit" v-model="fees[$index].amount" type="number" value="@{{ fee.amount }}">
				<input type="hidden" v-model="fees[$index].originalAmount" value="@{{ fee.amount }}">
			</td>
			<td>
				<button v-on="click: editThis(fee)" class="manage-btn edit-btn">@{{ fee.button }}</button>
				<button v-on="click: updateThis(fee)" class="manage-btn update-btn" v-attr="disabled:! fee.update">Update</button>
			</td>
		</tr>
	</tbody>
</table>