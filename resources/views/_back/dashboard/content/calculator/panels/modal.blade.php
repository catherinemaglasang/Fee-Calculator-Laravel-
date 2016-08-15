<div class="checkpoint-modal" v-if="modal" v-transition="expand" v-cloak>
	<div class="checkpoint-modal-inner">
		<label>Please select the specific vehicle type</label>
		<ul>
			<li v-repeat="vehicle in vehicles">
				<input v-on="click: setVehicle($index)" name="vehicle" id="@{{ vehicle.vehicle_id }}" type="radio" value="@{{ $index }}">
				<!-- <input v-on="click: setVehicle() vihicleSelected($index)" name="vehicle" id="@{{ vehicle.vehicle_id }}" type="radio" value="@{{ $index }}"> -->
				<label for="@{{ vehicle.vehicle_id }}">Vehicle Chassis: @{{ vehicle.year +' '+vehicle.make +' '+vehicle.model +' - '+vehicle.trim}}</label>
				<span>@{{ vehicle.style }}</span>
			</li>
		</ul>
		<button v-if="selected" v-on="click: submitVehicle()">Submit</button>
	</div>
</div>