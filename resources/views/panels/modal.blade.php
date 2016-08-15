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


<div class="checkpoint-modal" ng-if="vin.modal" ng-cloak ng-model="dialogs.modal" modal>
    <div class="checkpoint-modal-inner">
        <a class="close" href="#" ng-click="closeVinModal()"><i class="fa fa-times-circle"></i></a>
        <label>Please select the specific vehicle type</label>
        <ul>
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
                <tr ng-repeat="(key, vehicle) in vehicles">
                    <td><input ng-click="loadSelectedVehicle(vehicle)" type="radio"><br></td>
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