@extends('partials.calculator')

@section('content')
    <style>
        .disabled {
            background: grey;
        }
    </style>
    <div class="container @if(!$data['agent']) menu-open desktop-content @endif clearfix" ng-controller="arController" name="panel" part>


        <div id="calculator" class="content">
            <div class="main-module-wrapper @if(!$data['agent']) desktop-main-module-wrapper @endif">
                <div class="dropdown-navigation module">
                    <h2><i class="fa fa-map-marker"></i>&nbsp;Arkansas Calculator</h2>

                    <div class="breadcrumbs">
                        <div><i class="fa fa-calculator"></i>&nbsp;Calculator <i class="fa fa-angle-right"></i> <i class="fa fa-map-marker"></i>&nbsp;Arkansas</div>
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
                                <div class="summary-row clearfix">
                                    <input id="no_fees" type="checkbox" name="no_fees" ng-model="params.no_fees">
                                    <label for="no_fees">No Fees</label>
                                </div>
                                <div class="summary-row clearfix">
                                    <input id="temp_tag" type="checkbox" name="temp_tag" ng-model="params.temp_tag" ng-disabled="params.no_fees">
                                    <label for="temp_tag">Temp Tag</label>
                                </div>
                                <div class="summary-row clearfix">
                                    <input id="exempt_from_sales_tax" type="checkbox" name="exempt_from_sales_tax" ng-model="params.exempt_from_sales_tax">
                                    <label for="exempt_from_sales_tax">Exempt From Sales Tax</label>
                                </div>
                                <div class="summary-row clearfix">
                                    <input id="transfer_plate" type="checkbox" name="transfer_plate" ng-model="params.transfer_plate">
                                    <label for="transfer_plate">Transfer Plate?</label>
                                </div>
                                <div class="summary-row clearfix">
                                    <input id="vehicle_financed" type="checkbox" name="vehicle_financed" ng-model="params.vehicle_financed">
                                    <label for="vehicle_financed">Vehicle Financed?</label>
                                </div>
                                <div class="summary-row clearfix" ng-if="farm_vehicle">
                                    <input id="farm_use" type="checkbox" name="farm_use" ng-model="params.farm_use">
                                    <label for="farm_use">Farm Use?</label>
                                </div>
                                {{--<div class="summary-row clearfix" ng-if="motorcycle_vehicle">
                                    <input id="off_road" type="checkbox" name="off_road" ng-model="params.off_road">
                                    <label for="off_road">Off-Road?</label>
                                </div>--}}
                                <div class="summary-row clearfix">
                                    <input id="add_accessories" type="checkbox" name="add_accessories" ng-model="params.add_accessories">
                                    <label for="add_accessories">Add Accessories? </label>
                                </div>
                                <div class="summary-row clearfix">
                                    <input id="exempt_from_sales_tax" type="checkbox" name="exempt_from_sales_tax" ng-model="params.exempt_from_sales_tax">
                                    <label for="exempt_from_sales_tax">Add Warranty?</label>
                                </div>
                                <div ng-if="fields.exempt_from_sales_tax.show"class="summary-row clearfix">
                                    <input id="exempt_from_sales_tax" type="checkbox" name="exempt_from_sales_tax" ng-model="params.exempt_from_sales_tax">
                                    <label for="exempt_from_sales_tax">Vehicle Financed?</label>
                                </div>
                                <div class="summary-row clearfix">
                                    <input id="include_late_fees" type="checkbox" name="include_late_fees" ng-model="params.include_late_fees">
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
                            {{--Transaction Types--}}
                            <div class="form-group clearfix">
                                <label for="category">Transaction Type<span class="req-mark">*</span></label>

                                <div class="has-select">
                                    <select ng-model="ttlType" name="transaction_type" ng-options="transaction.name for transaction in transactionTypes track by transaction.code"
                                            ng-change="changeTransaction()"></select>
                                </div>
                            </div>
                            {{--Vin No--}}
                            <div ng-if="fields.vin.show" class="form-group clearfix" ng-model="fields.vin.required" field>
                                <label for="category">Enter VIN #</label>
                                <input type="text" name="vin" title="1FDXW46R09E679900" ng-model="params.vin" ctrl-fn="getVehicles(elem)" vin>
                            </div>
                            {{--Vehicle Type--}}
                            <div ng-if="fields.vehicle_type.show" class="form-group clearfix" ng-model="fields.vehicle_type.required" field>
                                <label for="vehicle_type">Vehicle Type</label>

                                <div class="has-select">
                                    <select name="vehicle_type" ng-model="params.vehicle_type" title="Vehicle Type" ctrl-fn="checkVehicleclass()" selectcheck>
                                        <option value="">Select</option>
                                        <option ng-repeat="vehicle in vehicleTypes" value="@{{ vehicle.slug }}">@{{ vehicle.name }}</option>
                                    </select>
                                </div>
                            </div>
                            {{--Model Year--}}
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
                            {{--Dealer Address and ZIP--}}
                            <div addressandzip ng-model="params">
                                <div ng-hide="!fields.street_address.show" class="form-group clearfix" ng-model="fields.street_address.required" field>
                                    <label for="address">Dealer Address</label>
                                    <input type="text" ng-model="params.street_address" capitalize>
                                </div>
                                <div ng-hide="!fields.zip.show" class="form-group clearfix" ng-model="fields.zip.required" field>
                                    <label for="address">Zip</label>
                                    <input type="text" ng-model="params.zip" valid="AR">
                                </div>
                            </div>
                            {{--Empty Weight, Trailer Weight, Carrying Capacity--}}
                            <div class="form-group clearfix" ng-if="motorcycle_vehicle" ng-model="fields.cc_displacement.required" field>
                                <label>Engine Size (CCs)</label>

                                <div class="is-weight">
                                    <input type="text" name="cc_displacement" placeholder="0" ng-model="params.cc_displacement">
                                </div>
                            </div>
                            <div id="weights" ng-model="params.gvw" weights>
                                <div class="form-group clearfix" ng-if="fields.empty_weight.show" ng-model="fields.empty_weight.required" field>
                                    <label>Empty Weight</label>

                                    <div class="is-weight">
                                        <input type="text" name="empty_weight" placeholder="0" ng-model="params.empty_weight" operation="+" title="Empty Weight">
                                    </div>
                                </div>
                                <div class="form-group clearfix" ng-if="fields.trailer_weight.show" ng-model="fields.trailer_weight.required" field>
                                    <label>Trailer Weight</label>

                                    <div class="is-weight">
                                        <input type="text" name="trailer_weight" placeholder="0" ng-model="params.trailer_weight" operation="+" title="Trailer Weight">
                                    </div>
                                </div>
                                <div class="form-group clearfix" ng-if="fields.carrying_capacity.show" ng-model="fields.carrying_capacity.required" field>
                                    <label>Carrying Capacity</label>

                                    <div class="is-weight">
                                        <input type="text" name="carrying_capacity" placeholder="0" ng-model="params.carrying_capacity" operation="+" title="Carrying Capacity">
                                    </div>
                                </div>
                            </div>
                            {{--GVW--}}
                            <div class="form-group clearfix" ng-model="fields.gvw.required" field>
                                <label>GVW</label>

                                <div class="is-weight">
                                    <input type="text" placeholder="0" ng-model="params.gvw" disabled>
                                </div>
                            </div>
                            {{--GVWR--}}
                            <div class="form-group clearfix" ng-model="fields.gvwr.required" field>
                                <label>GVWR</label>

                                <div class="is-weight">
                                    <input disabled="disabled" type="text" placeholder="0" ng-model="params.gvwr">
                                </div>
                            </div>
                            {{--Number of Axles--}}
                            <div ng-if="fields.number_of_axles.show" class="form-group clearfix" ng-model="fields.number_of_axles.required" field>
                                <label for="category">Number of Axles</label>
                                <div class="is-currency">
                                    <input type="text" name="number_of_axles" title="1FDXW46R09E679900" placeholder="0" ng-model="params.number_of_axles">
                                </div>
                            </div>
                            {{--Sales Prices, Accessories, Warranty, Rebate / Discount, Trade-in Value, Taxable Value--}}


                            <!-- Start sales tax -->
                            <div id="sales-tax" ng-model="params.taxable_value" salestax>
                                <div ng-if="fields.freight.show" class="form-group clearfix" ng-model="fields.freight.required" field>
                                    <label for="freight">Freight</label>

                                    <div class="is-currency">
                                        <input type="text" title="Freight" placeholder="0.00" ng-model="params.freight" name="freight" operation="+">
                                    </div>
                                </div>

                                <div ng-if="fields.sales_price.show" class="form-group clearfix" ng-model="fields.sales_price.required" field>
                                    <label for="sales_price">Sales Price</label>

                                    <div class="is-currency">
                                        <input type="text" title="Sales Price" placeholder="0.00" ng-model="params.sales_price" name="sales_price" operation="+">
                                    </div>
                                </div>

                                <div ng-if="fields.accessories.show" class="form-group clearfix" ng-model="fields.accessories.required" field>
                                    <label for="accessories">Accessories</label>

                                    <div class="is-currency">
                                        <input type="text" title="Rebate/Discount" placeholder="0.00" ng-model="params.accessories" name="accessories" operation="+">
                                    </div>
                                </div>
                                <div ng-if="fields.warranty.show" class="form-group clearfix" ng-model="fields.warranty.required" field>
                                    <label for="warranty">Warranty</label>

                                    <div class="is-currency">
                                        <input type="text" title="Rebate/Discount" placeholder="0.00" ng-model="params.warranty" name="warranty" operation="+">
                                    </div>
                                </div>

                                <div ng-if="fields.rebate_discount.show" class="form-group clearfix" ng-model="fields.rebate_discount.required" field>
                                    <label for="rebate_discount">Rebate/Discount</label>

                                    <div class="is-currency">
                                        <input type="text" title="Rebate/Discount" placeholder="0.00" ng-model="params.rebate_discount" name="rebate_discount" operation="-">
                                    </div>
                                </div>
                                <div ng-if="fields.trade_in_value.show" class="form-group clearfix" ng-model="fields.trade_in_value.required" field>
                                    <label for="trade_in_value">Trade-in Value</label>

                                    <div class="is-currency">
                                        <input type="text" ng-disabled="params.is_trade_in_leased" title="Trade-in Value" placeholder="0.00" ng-model="params.trade_in_value" name="trade_in_value" operation="-">
                                    </div>
                                </div>
                                <div ng-if="fields.sales_tax_credit.show" class="form-group clearfix" ng-model="fields.sales_tax_credit.required" field>
                                    <label for="sales_tax_credit">Sales Tax Credit</label>

                                    <div class="is-currency">
                                        <input type="text" title="Sales Tax Credit" placeholder="0.00" ng-model="params.sales_tax_credit" name="sales_tax_credit" operation="-">
                                    </div>
                                </div>
                            </div>
                            <div ng-if="fields.taxable_value.show" class="form-group clearfix" ng-model="fields.taxable_value.required" field>
                                <label>Taxable Value</label>

                                <div class="is-currency">
                                    <input id="taxable_value" {{--disabled="disabled"--}} ng-disabled="true" type="text" placeholder="0.00" ng-model="params.taxable_value">
                                </div>
                            </div>
                            <!-- End sales tax -->



                            {{--Date of Sale--}}
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
            </div>
        </div>
    </div>

@stop














