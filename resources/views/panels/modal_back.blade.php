<!--<div class="checkpoint-modal" ng-if="dialogs.modal" ng-cloak ng-model="dialogs.modal" modal>
	<div class="checkpoint-modal-inner">
		<a class="close" href="#"><i class="fa fa-times-circle"></i></a>
		<label>Please select the specific vehicle type</label>
		<ul>
			<li class="vehicle" ng-repeat="vehicle in vehicles" ng-click="loadDataone(vehicle)">
				<strong>@{{ vehicle.vehicle_type }}, @{{ vehicle.make }}, @{{ vehicle.model }}, @{{ vehicle.trim }} - @{{ vehicle.model_year }} </strong>
				<p>@{{ vehicle.style }}</p>
			</li>
		</ul>
	</div>
</div>-->

<style>
    #data-one-options {
        margin: 0 auto;
        width: 100%;
        height: 100%;
    }

    #data-one-options td, th {
        text-align: center;
    }
</style>


<div class="checkpoint-modal" ng-if="modal" ng-cloak ng-model="modal" modal>
    <div class="checkpoint-modal-inner">
        <a class="close" href="#"><i class="fa fa-times-circle"></i></a>
        <label>Please select the specific vehicle type</label>
        <ul>
            {{--<li class="vehicle" ng-repeat="vehicle in vehicles" ng-click="loadDataone(vehicle)">
                <strong>@{{ vehicle.vehicle_type }}, @{{ vehicle.make }}, @{{ vehicle.model }}, @{{ vehicle.trim }} - @{{ vehicle.model_year }} </strong>
                <p>@{{ vehicle.style }}</p>
            </li>--}}

            <table id="data-one-options">
                <thead>
                    <tr>
                        <th></th>
                        <th>Vehicle Type</th>
                        <th>Engine No</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Trim</th>
                        <th>Model Year</th>
                    </tr>
                </thead>
                <tbody>
                <tr ng-repeat="vehicle in vehicles">
                    <td><input ng-click="loadDataone(vehicle)" type="radio" name="sex" value="male"><br></td>
                    <td>@{{ vehicle.vehicle_type }}</td>
                    <td>@{{ vehicle.def_engine_id }}</td>
                    <td>@{{ vehicle.make }}</td>
                    <td>@{{ vehicle.model }}</td>
                    <td>@{{ vehicle.trim }}</td>
                    <td>@{{ vehicle.year }}</td>
                </tr>
                </tbody>
            </table>
        </ul>
    </div>
</div>