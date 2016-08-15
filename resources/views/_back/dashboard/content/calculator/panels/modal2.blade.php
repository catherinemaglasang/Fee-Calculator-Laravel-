<div class="checkpoint-modal" v-if="modal" v-transition="expand">
    <div class="checkpoint-modal-inner manage-panel">

        {{--<ul id="la-list">
            <li v-repeat="vehicle in vehicles">
                <input v-on="click: selectVehicle(vehicle)" name="vehicle" id="@{{ vehicle.vehicle_id }}" type="radio"
                       value="@{{ $index }}">
                <label for="@{{ vehicle.vehicle_id }}">@{{ vehicle.style }}</label>
            </li>
        </ul>--}}

        <label>Please select one of the Vehicle Styles</label>

        <table id="vin-table">
            <thead>
                <tr>
                    <th>Choice</th>
                    <th>Trim Level</th>
                    <th>Engine #</th>
                </tr>
            </thead>

            <tbody>
                <tr v-repeat="vehicle in vehicles">
                    <td style="text-align: center">
                        <input v-on="click: selectVehicle(vehicle)" name="vehicle" id="@{{ vehicle.vehicle_id }}" type="radio" value="@{{ $index }}">
                    </td>

                    <td style="padding-left: 54px;">@{{ vehicle.style }}</td>
                    <td style="text-align: center">@{{ vehicle.def_engine_id }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="checkpoint-modal" v-if="views.modalAvalara" v-transition="expand">
    <div class="checkpoint-modal-inner manage-panel">
        <a class="modal-close" v-on="click: closeAvalaraModal()">(x)</a>
        <label>Sales Tax Breakdown</label>

        <div class="avalara-table">
            <table class="">
                <thead>
                    <tr>
                        <th style="text-align: left;">JurisName</th>
                        {{--<th style="text-align: right">County / City Tax</th>--}}
                        <th style="text-align: right">JurisType</th>
                        <th style="text-align: right;">JurisCode</th>
                        <th style="text-align: right;">Rate</th>
                        <th style="text-align: right;">Tax</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-repeat="taxDetail in taxesAndFees.tax_details">
                        <td style="text-align: left">@{{ taxDetail.JurisName | normal_case }}</td>
                        {{--<td style="text-align: right;"><span>$ </span>@{{ taxDetail['County / City Tax'] | toDollar }}</td>--}}
                        <td style="text-align: right;">@{{ taxDetail.JurisType }}</td>
                        <td style="text-align: right;">@{{ taxDetail.JurisCode }}</td>
                        <td style="text-align: right;">@{{ taxDetail.Rate | toPercentage }}</td>
                        <td style="text-align: right;"><span>$ </span>@{{ taxDetail.Tax | toDollar}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>