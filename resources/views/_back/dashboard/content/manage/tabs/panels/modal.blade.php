<div class="edit-modal" v-if="edit" v-transition="expand">
	<div class="edit-modal-inner">
		<label>Update Values</label>
		<input v-model="original.min_weight" type="hidden" value="@{{ edits.min_weight }}">
		<input v-model="original.max_weight" type="hidden" value="@{{ edits.max_weight }}">
		<input v-model="original.amount" type="hidden" value="@{{ edits.amount }}">
		<input v-model="original.start_date" type="hidden" value="@{{ edits.start_date }}">
		<input v-model="original.end_date" type="hidden" value="@{{ edits.end_date }}">
		<ul>
			<li><label>Min Weight</label><input v-model="edits.min_weight" type="number"></li>
			<li><label>Min Weight</label><input v-model="edits.max_weight" type="number"></li>
			<li><label>Amount</label><input v-model="edits.amount" type="number"></li>
			<li><label>Start Date</label><input v-model="edits.start_date" type="text" v-free-datepicker="edits.start_date"></li>
			<li><label>End Date</label><input v-model="edits.end_date" type="text" v-free-datepicker="edits.end_date"></li>
		</ul>
		<button class="update" v-attr="disabled:!changed" v-on="click: updateValues()">Update</button>
		<button class="cancel" v-on="click: cancelEdit()">Cancel</button>
	</div>
</div>