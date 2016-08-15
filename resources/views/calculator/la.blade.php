@extends('partials.calculator')

@section('content')
    <div class="container @if(!$data['agent']) menu-open desktop-content @endif clearfix" ng-controller="laController" name="panel" part>

        <div id="calculator" class="content">
            <div class="main-module-wrapper @if(!$data['agent']) desktop-main-module-wrapper @endif">
                <div class="dropdown-navigation module">
                    <h2><i class="fa fa-map-marker"></i>&nbsp;Lousiana Calculator</h2>

                    <div class="breadcrumbs">
                        <div><i class="fa fa-calculator"></i>&nbsp;Calculator <i class="fa fa-angle-right"></i> <i class="fa fa-map-marker"></i>&nbsp;Louisiana</div>
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

                            <button ng-click="testReload()">HOHOHOHO</button>

                            <div class="summary-content">
                                <div ng-if="fields.no_fees.show" class="summary-row clearfix">
                                    <input id="no_fees" type="checkbox" name="no_fees" ng-model="params.no_fees">
                                    <label for="no_fees">No Fees</label>
                                </div>
                                <div ng-if="fields.temp_tag.show" class="summary-row clearfix">
                                    <input id="temp_tag" type="checkbox" name="temp_tag" ng-model="params.temp_tag" ng-disabled="params.no_fees">
                                    <label for="temp_tag">Temp Tag</label>
                                </div>
                                <div ng-if="fields.farm_use.show" class="summary-row clearfix">
                                    <input id="farm_use" type="checkbox" name="farm_use" ng-model="params.farm_use" ng-disabled="params.no_fees">
                                    <label for="farm_use">Farm Use?</label>
                                </div>
                                <div ng-if="fields.did_pull_a_trailer.show" class="summary-row clearfix">
                                    <input id="did_pull_a_trailer" type="checkbox" name="did_pull_a_trailer" ng-model="params.did_pull_a_trailer" ng-disabled="params.no_fees">
                                    <label for="did_pull_a_trailer">Do you ever pull a trailer?</label>
                                </div>
                                <div ng-if="fields.exempt_from_sales_tax.show" class="summary-row clearfix">
                                    <input id="exempt_from_sales_tax" type="checkbox" name="exempt_from_sales_tax" ng-model="params.exempt_from_sales_tax">
                                    <label for="exempt_from_sales_tax">Exempt From Sales Tax</label>
                                </div>
                                <div ng-if="fields.include_late_fees.show" class="summary-row clearfix">
                                    <input id="include_late_fees" type="checkbox" name="include_late_fees" ng-model="params.include_late_fees" ng-disabled="params.no_fees">
                                    <label for="include_late_fees">Include Late Fees?</label>
                                </div>
                            </div>
                        </div>
                        <div class="summary">
                            <label>Total Tax and Fees</label>

                            <div class="total" ng-cloak>
                                <span>$ </span> @{{ total_fees_and_taxes | currency }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="module-wrapper @if(!$data['agent']) desktop-module-wrapper @endif" equalizeheightadd>
                    <div class="module">
                        <h1><i class="fa fa-calculator"></i>&nbsp;Sales Tax Calculator</h1>

                        <form class="clearfix">
                            <div class="form-group clearfix">
                                <label for="category">Transaction Type<span class="req-mark">*</span></label>

                                <div class="has-select">
                                    <select ng-model="ttlType" name="transaction_type" ng-options="transaction.name for transaction in transactionTypes track by transaction.code"
                                            ng-change="changeTransaction()"></select>
                                </div>
                            </div>
                            <div ng-if="fields.new_or_used.show" class="form-group clearfix" ng-model="fields.new_or_used.required" field>
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
                                <label for="type">Vehicle Type</label>

                                <div class="has-select">
                                    <!-- Name should be declared for proper mapping -->
                                    <select name="vehicle_type" ng-model="params.vehicle_type" title="Vehicle Type" selectcheck>
                                        <option ng-repeat="vehicle in vehicleTypes" value="@{{ vehicle.slug }}">@{{ vehicle.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div ng-if="fields.type_of_plate.show" class="form-group clearfix" ng-model="fields.type_of_plate.required" field>
                                <label for="category">Type of Plate</label>

                                <div class="has-select">
                                    <select name="type_pf_plate" ng-model="params.type_of_plate" title="Type Of Plate">
                                        <option value="">Select</option>
                                        <option ng-repeat="typeOfPlate in plateTypes" value="@{{ typeOfPlate.slug }}">@{{ typeOfPlate.name }}</option>
                                    </select>
                                </div>
                            </div>


                            {{--<div ng-if="params.type_of_plate == 'hire_passenger_plate'" class="form-group clearfix" ng-model="fields.number_of_passengers.required" field>
                                <label for="category">Number of Passengers</label>

                                <input id="new" type="text" name="number_of_passengers" ng-model="params.number_of_passengers">
                            </div>--}}


                            <div ng-if="fields.number_of_passengers.show" class="form-group clearfix" ng-model="fields.number_of_passengers.required" field>
                                <label for="category">Number of Passengers</label>
                                <input type="text" name="number_of_passengers" ng-model="params.number_of_passengers">
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

                            <div ng-if="fields.mortgage_fee.show" class="form-group clearfix" ng-model="fields.mortgage_fee.required" field>
                                <label for="type">Mortgage Fee</label>

                                <div class="has-select">
                                    <!-- Name should be declared for proper mapping -->
                                    <select name="mortgage_fee" ng-model="params.mortgage_fee" title="Mortgage Fee" selectcheck>
                                        <option value="15.00">UCC-1 = $15.00</option>
                                        <option value="10.00">Non UCC-1 = $10.00</option>
                                        <option value="0.00">No Lender = $0.00</option>
                                    </select>
                                </div>
                            </div>

                            <div addressandziplouisiana ng-model="params" ng-if="fields.street_address.show && fields.zip.show">
                                <div class="form-group clearfix" {{--ng-if="fields.street_address.show"--}} ng-model="fields.street_address.required" field>
                                    <label for="address">Customer Address</label>
                                    <input type="text" ng-model="params.street_address" id="street_address">
                                </div>
                                <div class="form-group clearfix" {{--ng-if="fields.zip.show"--}} ng-model="fields.zip.required" field>
                                    <label for="address">Zip</label>
                                    <input type="text" ng-model="params.zip">
                                </div>
                            </div>


                            <div ng-if="fields.city_limits.show" class="form-group clearfix" ng-model="fields.city_limits" field>
                                <label for="address">City Limits</label>

                                <div style="text-align: center;">
                                    <span style="top: -5px; position:relative;">Yes</span><input type="radio" name="city_limits" ng-model="params.city_limits" ng-value="true" value="true">
                                    <span style="top: -5px; position:relative;">No</span><input type="radio" name="city_limits" ng-model="params.city_limits" ng-value="false" value="false">
                                </div>
                            </div>


                            <div ng-if="fields.resident_county.show" class="form-group clearfix" ng-model="fields.resident_county.required" field>
                                <label for="county_name">Resident County</label>

                                <div class="has-select">
                                    <select name="resident_county" ng-model="params.resident_county" title="Resident County" selectcheck>
                                        <option value="">Select</option>
                                        @foreach($data["counties"] as $county)
                                            <option value="{{$county->name}}">{{$county->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div ng-if="fields.processing_county.show" class="form-group clearfix" ng-model="fields.processing_county.required" field>
                                <label for="county_name">Processing County</label>

                                <div class="has-select">
                                    <select name="processing_county" ng-model="params.processing_county" title="Processing County" selectcheck>
                                        <option value="">Select</option>
                                        @foreach($data["counties"] as $county)
                                            <option value="{{$county->name}}">{{$county->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div ng-model="params.gvw" weights>
                                <div ng-if="fields.empty_weight.show" class="form-group clearfix" ng-model="fields.empty_weight.required" field>
                                    <label>Empty Weight</label>

                                    <div class="is-weight">
                                        <input type="text" name="empty_weight" placeholder="0" ng-model="params.empty_weight" operation="+" title="Empty Weight">
                                    </div>
                                </div>
                                <div ng-if="fields.trailer_weight.show" class="form-group clearfix" ng-model="fields.trailer_weight.required" field>
                                    <label>Trailer Weight</label>

                                    <div class="is-weight">
                                        <input type="text" name="trailer_weight" placeholder="0" ng-model="params.trailer_weight" operation="+" title="Trailer Weight">
                                    </div>
                                </div>
                                <div ng-if="fields.carrying_capacity.show" class="form-group clearfix" ng-model="fields.carrying_capacity.required" field>
                                    <label>Carrying Capacity</label>

                                    <div class="is-weight">
                                        <input type="text" name="carrying_capacity" placeholder="0" ng-model="params.carrying_capacity" operation="+" title="Carrying Capacity">
                                    </div>
                                </div>
                            </div>
                            <div ng-if="fields.gvw.show" class="form-group clearfix" ng-model="fields.gvw.required" field>
                                <label>GCVW</label>

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
                            <div ng-if="fields.inspection_fee.show" class="form-group clearfix" ng-model="fields.inspection_fee.required" field>
                                <label for="taxable_value">Inspection Fee</label>

                                <div class="is-currency">
                                    <input type="text" name="inspection_fee" placeholder="0.00" ng-model="params.inspection_fee" title="Inspection Fee" currency>
                                </div>
                            </div>
                            <div ng-if="fields.freight.show" class="form-group clearfix" ng-model="fields.freight.required" field>
                                <label for="freight">Freight</label>

                                <div class="is-currency">
                                    <input type="text" name="freight" placeholder="0.00" ng-model="params.freight">
                                </div>
                            </div>
                            <!--
                                SalesTax is automatically computed
                            -->

                            <!-- Start sales tax -->
                            <div ng-model="params.taxable_value" salestax>
                                <div ng-if="fields.sales_price.show" class="form-group clearfix" ng-model="fields.sales_price.required" field>
                                    <label for="sales_price">Sales Price</label>

                                    <div class="is-currency">
                                        <input type="text" placeholder="0.00" ng-model="params.sales_price" operation="+">
                                    </div>
                                </div>
                                <div ng-if="fields.rebate_discount.show" class="form-group clearfix" ng-model="fields.rebate_discount.required" field>
                                    <label for="rebate_discount">Rebate/Discount</label>

                                    <div class="is-currency">
                                        <input type="text" placeholder="0.00" ng-model="params.rebate_discount" operation="-">
                                    </div>
                                </div>
                                <div ng-if="fields.trade_in_value.show" class="form-group clearfix" ng-model="fields.trade_in_value.required" field>
                                    <label for="trade_in_value">Trade-in Value</label>

                                    <div class="is-currency">
                                        <input type="text" placeholder="0.00" ng-model="params.trade_in_value" operation="-">
                                    </div>
                                </div>
                                <div ng-if="fields.sales_tax_credit.show" class="form-group clearfix" ng-model="fields.sales_tax_credit.required" field>
                                    <label for="sales_tax_credit">Sales Tax Credit</label>

                                    <div class="is-currency">
                                        <input type="text" placeholder="0.00" ng-model="salesTaxcredit" operation="-">
                                    </div>
                                </div>
                            </div>
                            <div ng-if="fields.taxable_value.show" class="form-group clearfix" ng-model="fields.taxable_value.required" field>
                                <label for="taxable_value">Taxable Value</label>

                                <div class="is-currency">
                                    <input disabled="disabled" type="text" placeholder="0.00" ng-model="params.taxable_value">
                                </div>
                            </div>
                            <!-- End sales tax -->

                            <div ng-if="fields.fuel_type.show" class="form-group clearfix" ng-model="fields.fuel_type.required" field>
                                <label for="fuel_type">Fuel Type</label>

                                <div class="has-select">
                                    <select name="fuel_type" ng-model="params.fuel_type" title="Fuel Type" selectcheck>
                                        <option value="">Select</option>
                                        <option value="D">Diesel</option>
                                        <option value="G">Gasoline</option>
                                    </select>
                                </div>
                            </div>
                            <div ng-if="fields.date_of_sale.show" class="form-group clearfix" ng-model="fields.date_of_sale.required" field>
                                <label for="date_of_sale">Date of Sale</label>
                                <input type="text" ng-model="params.date_of_sale" datepicker>
                            </div>
                            <button class="reset" ng-click="resetParams()">Reset</button>
                            <button type="submit" class="calc" ng-click="calculate()">Calculate</button>
                        </form>
                    </div>
                </div>
                @include('panels.resultLA')
                @include('panels.modal_rates_LA')
            </div>
        </div>
    </div>

@stop