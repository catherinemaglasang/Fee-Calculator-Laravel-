@extends('partials.calculator')

@section('content')
    <style>
        .disabled {
            background: grey;
        }
    </style>
    <div class="container @if(!$data['agent']) menu-open desktop-content @endif clearfix" ng-controller="txController" name="panel" part>


        <div id="calculator" class="content">
            <div class="main-module-wrapper @if(!$data['agent']) desktop-main-module-wrapper @endif">
                <div class="dropdown-navigation module">
                    <h2><i class="fa fa-map-marker"></i>&nbsp;Texas Calculator</h2>

                    <div class="breadcrumbs">
                        <div><i class="fa fa-calculator"></i>&nbsp;Calculator <i class="fa fa-angle-right"></i> <i class="fa fa-map-marker"></i>&nbsp;Texas</div>
                    </div>
                </div>
            </div>
            @include('dialog.info')
            <div class="calculator-wrapper clearfix @if(!$data['agent']) desktop-calculator-wrapper @endif" equalizeheight>
                <div class="narrow-module module-wrapper @if(!$data['agent']) desktop-module-wrapper @endif" equalizeheightadd>
                    <div class="calculator-form-asside module">
                        <h1><i class="fa fa-check-square-o"></i>&nbsp;Options</h1>

                        <div class="summary options">
                            <label>Options</label>

                            <div class="summary-content">
                                <div ng-if="fields.no_fees.show" class="summary-row clearfix">
                                    <input id="no_fees" type="checkbox" name="no_fees" ng-model="params.no_fees">
                                    <label for="no_fees">No Fees</label>
                                </div>
                                <div ng-if="fields.temp_tag.show" class="summary-row clearfix">
                                    <input id="temp_tag" type="checkbox" name="temp_tag" ng-model="params.temp_tag" ng-disabled="params.no_fees">
                                    <label for="temp_tag">Temp Tag</label>
                                </div>
                                <div ng-if="fields.is_trade_in_leased.show" class="summary-row clearfix">
                                    <input id="is_trade_in_leased" type="checkbox" name="is_trade_in_leased" ng-model="params.is_trade_in_leased" ng-disabled="params.no_fees">
                                    <label for="is_trade_in_leased">Is Trade-in Leased?</label>
                                </div>
                                <div ng-if="fields.farm_ranch.show && showFarmRanch" class="summary-row clearfix">
                                    <input id="farm_ranch" type="checkbox" name="farm_ranch" ng-model="params.farm_ranch" ng-disabled="params.no_fees">
                                    <label for="farm_ranch">Farm/Ranch</label>
                                </div>
                                <div ng-if="fields.member_of_military.show" class="summary-row clearfix">
                                    <input id="member_of_military" type="checkbox" name="member_of_military" ng-model="params.member_of_military" ng-disabled="params.no_fees">
                                    <label for="member_of_military">Member of Military</label>
                                </div>
                                <div ng-hide="!fields.off_highway_use.show && showAddress" class="summary-row clearfix">
                                    <input id="off_highway_use" type="checkbox" ng-disabled="params.no_fees || disabled_off_highway_use" name="off_highway_use" ng-model="params.off_highway_use">
                                    <label for="off_highway_use">Off Highway Use</label>
                                </div>
                                <div ng-if="fields.rebuilt_salvage.show" class="summary-row clearfix">
                                    <input id="rebuilt_salvage" type="checkbox" name="rebuilt_salvage" ng-model="params.rebuilt_salvage" ng-disabled="params.no_fees">
                                    <label for="rebuilt_salvage">Rebuilt/Salvage</label>
                                </div>
                                <div ng-if="fields.exempt_from_sales_tax.show" class="summary-row clearfix">
                                    <input id="exempt_from_sales_tax" type="checkbox" name="exempt_from_sales_tax" ng-model="params.exempt_from_sales_tax">
                                    <label for="exempt_from_sales_tax">Exempt From Sales Tax</label>
                                </div>
                                <div  ng-if="fields.did_pull_a_trailer.show && showFarmRanch" class="summary-row clearfix">
                                    <input id="did_pull_a_trailer" type="checkbox" name="did_pull_a_trailer" ng-model="params.did_pull_a_trailer">
                                    <label for="did_pull_a_trailer">Do you ever pull a Trailer?</label>
                                </div>
                                <div ng-if="fields.include_inspection_fee.show" id="inspection-fee" class="summary-row clearfix">
                                    <input id="include_inspection_fee" type="checkbox" name="include_inspection_fee" ng-model="params.include_inspection_fee" ng-disabled="params.no_fees || disabled_inspection_fees">
                                    <label for="include_inspection_fee">Include Inspection Fees?</label>
                                </div>
                                <div ng-if="fields.include_vit_tax.show" class="summary-row clearfix">
                                    <input id="include_vit_tax" type="checkbox" name="include_vit_tax" ng-model="params.include_vit_tax" ng-disabled="params.no_fees">
                                    <label for="include_vit_tax">Include VIT Tax?</label>
                                </div>
                                <div ng-if="fields.include_late_fees.show" class="summary-row clearfix">
                                    <input id="include_late_fees" type="checkbox" name="include_late_fees" ng-model="params.include_late_fees" ng-disabled="params.no_fees">
                                    <label for="exempt_from_sales_tax">Include Late Fees?</label>
                                </div>
                            </div>
                        </div>
                        <div class="summary">
                            <label>Total Tax and Fees</label>

                            <div class="total" ng-cloak>
                                <span>$ </span> @{{ total.overall | currency }}
                            </div>
                        </div>
                    </div>

                </div>
                <div class="module-wrapper @if(!$data['agent']) desktop-module-wrapper @endif" calcui>
                    <div class="module">
                        <h1><i class="fa fa-calculator"></i>&nbsp;Sales Tax Calculator</h1>

                        <form id="calculator" class="clearfix">
                            <div class="form-group clearfix">
                                <label for="category">Transaction Type<span class="req-mark">*</span></label>

                                <div class="has-select">
                                    <select ng-model="ttlType" name="transaction_type" ng-options="transaction.name for transaction in transactionTypes track by transaction.code"
                                            ng-change="changeTransaction()"></select>
                                </div>
                            </div>
                            <div ng-if="fields.new_or_used.show" class="form-group clearfix" ng-model="fields.new_or_used.required">
                                <label for="category">Select Vehicle Status<span class="req-mark">*</span></label>

                                <div class="radio-container">
                                    <input id="new" type="radio" name="new_or_used" ng-model="params.new_or_used" value="1" ng-init="params.new_or_used = 1">
                                    <label for="new">New</label>
                                    <input id="used" type="radio" name="new_or_used" ng-model="params.new_or_used" value="0">
                                    <label for="used">Used</label>
                                </div>
                            </div>
                            <div ng-if="fields.vin.show" class="form-group clearfix" ng-model="fields.vin.required" field>
                                <label for="category">Enter VIN #</label>
                                <input type="text" name="vin" title="1FDXW46R09E679900" ng-model="params.vin" ctrl-fn="getVehicles(elem)" vin>
                            </div>
                            <div ng-if="fields.vehicle_type.show" class="form-group clearfix" ng-model="fields.vehicle_type.required" field>
                                <label for="vehicle_type">Vehicle Type</label>

                                <div class="has-select">
                                    <select name="vehicle_type" ng-model="params.vehicle_type" title="Vehicle Type" ctrl-fn="checkVehicleclass()" selectcheck>
                                        <option value="">Select</option>
                                        <option ng-repeat="vehicle in vehicleTypes" value="@{{ vehicle.slug }}">@{{ vehicle.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div ng-if="fields.model_year.show" class="form-group clearfix" ng-model="fields.model_year.required" field>
                                <label for="model_year">Model Year</label>

                                <div class="has-select">
                                    <select name="model_year" ng-model="params.model_year" title="Model Year" selectcheck>
                                        <option value="">Select</option>
                                        @foreach(range(date('Y')+2, 1900) as $year)
                                            <option value="{{$year}}">{{$year}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div ng-model="params" addressandziptexas>
                                <div ng-hide="!(fields.street_address.show && showAddress)" class="form-group clearfix" ng-model="fields.street_address.required" field>
                                    <label for="address">Seller Address</label>
                                    <input type="text" ng-model="params.street_address" id="seller_address">
                                </div>
                                <div ng-hide="!(fields.zip.show && showAddress)" class="form-group clearfix" ng-model="fields.zip.required" field>
                                    <label for="address">Zip</label>
                                    <input type="text" ng-model="params.zip" valid="TX">
                                </div>
                            </div>
                            <div ng-if="fields.resident_county.show && showAddress" class="form-group clearfix" ng-model="fields.resident_county.required" field>
                                <label for="county_name">Resident County</label>

                                <div class="has-select">
                                    <select ng-model="params.resident_county" name="resident_county" title="Resident County" selectcheck>
                                        <option value="">Select</option>
                                        <option ng-repeat="county in counties" value="@{{ county.code }}">@{{ county.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div ng-if="fields.processing_county.show" class="form-group clearfix" ng-model="fields.processing_county.required" field>
                                <label for="county_name">Processing County</label>

                                <div class="has-select">
                                    <select ng-model="params.processing_county" name="processing_county" title="Processing County" selectcheck>
                                        <option value="">Select</option>
                                        <option ng-repeat="county in counties" value="@{{ county.code }}">@{{ county.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div id="weights" ng-model="params.gvw" weights>
                                <div ng-if="fields.empty_weight.show" class="form-group clearfix" ng-model="fields.empty_weight.required" field>
                                    <label>Empty Weight</label>

                                    <div class="is-weight">
                                        <input type="text" name="empty_weight" placeholder="0" ng-model="params.empty_weight" operation="+" title="Empty Weight">
                                    </div>
                                </div>
                                <div ng-show="fields.trailer_weight.show && pullingTrailer" class="form-group clearfix" ng-model="fields.trailer_weight.required" field>
                                    <label>Trailer Weight</label>

                                    <div class="is-weight">
                                        <input type="text" name="trailer_weight" placeholder="0" ng-model="params.trailer_weight" operation="+" title="Trailer Weight">
                                    </div>
                                </div>
                                <div ng-hide="!fields.carrying_capacity.show" class="form-group clearfix" ng-model="fields.carrying_capacity.required" field>
                                    <label>Carrying Capacity</label>

                                    <div class="is-weight">
                                        <input type="text" name="carrying_capacity" placeholder="0" ng-model="params.carrying_capacity" operation="+" title="Carrying Capacity">
                                    </div>
                                </div>
                            </div>
                            <div ng-if="fields.gvw.show" class="form-group clearfix" ng-model="fields.gvw.required" field>
                                <label>GVW</label>

                                <div class="is-weight">
                                    <input type="text" placeholder="0" ng-model="params.gvw" disabled>
                                </div>
                            </div>
                            <div ng-if="fields.gvwr.show" class="form-group clearfix" ng-model="fields.gvwr.required" field>
                                <label>GVWR</label>

                                <div class="is-weight">
                                    <input disabled="disabled" type="text" placeholder="0" ng-model="params.gvwr">
                                </div>
                            </div>
                            <div ng-if="fields.inspection_type.show && includeInspectionFee" class="form-group clearfix" ng-model="fields.inspection_type.required" field>
                                <label for="taxable_value">Select Inspection Type</label>

                                <div class="has-select">
                                    <!-- <input type="text" name="inspection_fee" placeholder="0.00" ng-model="params.inspection_fee" title="Inspection Fee" > -->
                                    <!-- <select ng-model="inspType" name="inspection_type" title="Inspection Type" selectcheck>
									<option value="">Select</option>
									<option ng-repeat="inspection in inspectionTypes" value="@{{ inspection.code }}">@{{ inspection.title }}</option>
								</select> -->
                                    <select ng-model="params.inspection_type" name="inspection_type" title="Inspection Type"
                                            ng-options="inspection as inspection.title for inspection in inspectionTypes track by inspection.code" selectcheck></select>
                                    <!-- <select ng-model="params.inspection_type" name="inspection_type" title="Inspection Type" selectcheck>
                                        <option value="">Select</option>
                                        <option label="One Year Safety Inspection Only" value="1YR">One Year Safety Inspection Only</option>
                                        <option label="Two Year Safety Inspection Only" value="2YR">Two Year Safety Inspection Only</option>
                                        <option label="Commercial/Windshield Inspection" value="CW">Commercial/Windshield Inspection</option>
                                        <option label="Commercial/Decal Inspection" value="CDEC">Commercial/Decal Inspection</option>
                                        <option label="Trailer/Motorcycle Inspection" value="TLMC">Trailer/Motorcycle Inspection</option>
                                        <option label="TSI Safety Emission Inspection" value="TSI">TSI Safety Emission Inspection</option>
                                        <option label="ASM Safety Emission Inspection" value="ASM">ASM Safety Emission Inspection</option>
                                        <option label="OBD Safety Emission Inspection" value="OBD">OBD Safety Emission Inspection</option>
                                        <option label="Emission Inspection Only" value="EMONLY">Emission Inspection Only</option>
                                        <option label="Emission Inspection Only" value="EMONLY-ASM">Emission Inspection Only</option>
                                        <option label="Emission Inspection Only" value="EMONLY-OBD">Emission Inspection Only</option>
                                        <option label="TSI/OBD Safety Emission" value="TISOBD">TSI/OBD Safety Emission</option>
                                        <option label="OBD Safety Emission - No LIRAP" value="OBDNL">OBD Safety Emission - No LIRAP</option>
                                        <option label="Travis/Williamson Emission - No LIRAP" value="NLTSI">Travis/Williamson Emission - No LIRAP</option>
                                        <option label="One Year Safety + Emissions Only" value="SOEO">One Year Safety + Emissions Only</option>
                                        <option label="Commercial/Windshield + Emission" value="CWEO">Commercial/Windshield + Emission</option>
                                    </select> -->
                                </div>
                            </div>

                            <!--
                                SalesTax is automatically computed
                            -->

                            <!-- Start sales tax -->
                            <div id="sales-tax" ng-model="taxable_value" salestax>
                                <div ng-hide="!fields.freight.show" class="form-group clearfix" ng-model="fields.freight.required" field>
                                    <label for="taxable_value">Freight</label>

                                    <div class="is-currency">
                                        <input type="text" title="Freight" placeholder="0.00" ng-model="params.freight" name="freight" operation="+">
                                    </div>
                                </div>

                                <div ng-if="fields.sales_price.show" class="form-group clearfix" ng-model="fields.sales_price.required" field>
                                    <label for="taxable_value">Sales Price</label>

                                    <div class="is-currency">
                                        <input type="text" title="Sales Price" placeholder="0.00" ng-model="params.sales_price" name="sales_price" operation="+">
                                    </div>
                                </div>
                                <div ng-if="fields.rebate_discount.show" class="form-group clearfix" ng-model="fields.rebate_discount.required" field>
                                    <label for="taxable_value">Rebate/Discount</label>

                                    <div class="is-currency">
                                        <input type="text" title="Rebate/Discount" placeholder="0.00" ng-model="params.rebate_discount" name="rebate_discount" operation="-">
                                    </div>
                                </div>
                                <div ng-if="fields.trade_in_value.show" class="form-group clearfix" ng-model="fields.trade_in_value.required" field>
                                    <label for="taxable_value">Trade-in Value</label>

                                    <div class="is-currency">
                                        <input type="text" ng-disabled="params.is_trade_in_leased" title="Trade-in Value" placeholder="0.00" ng-model="params.trade_in_value" name="trade_in_value" operation="-">
                                    </div>
                                </div>
                                <div ng-if="fields.sales_tax_credit.show" class="form-group clearfix" ng-model="fields.sales_tax_credit.required" field>
                                    <label for="taxable_value">Sales Tax Credit</label>

                                    <div class="is-currency">
                                        <input type="text" title="Sales Tax Credit" placeholder="0.00" ng-model="params.sales_tax_credit" name="sales_tax_credit" operation="-">
                                    </div>
                                </div>
                            </div>
                            <div ng-if="fields.taxable_value.show" class="form-group clearfix" ng-model="fields.taxable_value.required" field>
                                <label>Taxable Value</label>

                                <div class="is-currency">
                                    <input id="taxable_value" disabled="disabled" type="text" placeholder="0.00" ng-model="taxable_value">
                                </div>
                            </div>

                            <div ng-if="fields.miscellaneous_fee.show" class="form-group clearfix" ng-model="fields.miscellaneous_fee.required" field>
                                <label>Miscellaneous Fees</label>

                                <div class="is-currency">
                                    <input type="text" placeholder="0.00" ng-model="params.miscellaneous_fee" numeric>
                                </div>
                            </div>
                            <!-- End sales tax -->

                            <div ng-if="fields.fuel_type.show" class="form-group clearfix" ng-model="fields.fuel_type.required" field>
                                <label for="fuel_type">Fuel Type</label>

                                <div class="has-select">
                                    <select name="fuel_type" ng-model="params.fuel_type" title="Fuel Type" selectcheck>
                                        <option value="">Select</option>
                                        {{--<option value="D">Diesel</option>
                                        <option value="G">Gasoline</option>--}}
                                        <option ng-repeat="fuelType in fuelTypes" value="@{{ fuelType.code }}">@{{ fuelType.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div ng-if="fields.date_of_sale.show" class="form-group clearfix" ng-model="fields.date_of_sale.required" field>
                                <label for="sale_date">Date of Sale</label>
                                <input type="text" ng-model="params.date_of_sale" datepicker>
                            </div>
                            <button class="reset" ng-click="resetParams()">Reset</button>
                            <button type="submit" class="calc" ng-click="calculate()">Calculate</button>
                        </form>
                    </div>
                </div>
                @include('panels.result')
                @include('panels.modal')
                @include('panels.modal_rates_TX')
            </div>
        </div>
    </div>

@stop














