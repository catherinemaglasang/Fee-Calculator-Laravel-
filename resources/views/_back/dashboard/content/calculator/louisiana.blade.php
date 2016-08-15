@extends('dashboard.partials')

@section('content')
    <div class="container menu-open clearfix">

        @include('dashboard.calculatoraside')

        <div id="calculator" class="content">
            <div class="dropdown-navigation module">
                <h2><i class="fa fa-calculator"></i>&nbsp;Texas Sales Tax Calculation</h2>
                <div class="breadcrumbs">
                    <div><i class="fa fa-calculator"></i>&nbsp;Calculator <i class="fa fa-angle-right"></i> <i class="fa fa-map-marker"></i>&nbsp;Texas</div>
                </div>
            </div>

            <div class="calculator-wrapper module clearfix">

                @include('dashboard.content.calculator.panels.info')

                <form v-on="submit: getResults">

                    <input type="hidden" v-model="state_code" value="TX">

                    <div class="form-group clearfix">
                        <label for="category">Enter VIN #*</label>
                        <input type="text" title="1FDXW46R09E679900" v-on="blur: getCatAndType()" v-model="vin_pattern">
                    </div>
                    <button type="submit" v-attr="disabled: missing">Calculate Fees and Taxes</button>
                </form>

                <div class="calculator-form-asside">
                    <div class="summary options">
                        <label>Options</label>
                        <div class="summary-content">
                            <div class="summary-row clearfix">
                                <input id="temp_tag" type="checkbox" name="temp_tag" v-model="temp_tag">
                                <label for="temp_tag">Temp Tag</label>
                            </div>
                            <div class="summary-row clearfix">
                                <input id="trade_or_lease" type="checkbox" name="trade_or_lease" v-model="trade_or_lease">
                                <label for="trade_or_lease">Leased Traded-In?</label>
                            </div>
                            <div class="summary-row clearfix">
                                <input id="farm_or_ranch" type="checkbox" name="farm_or_ranch" v-model="farm_or_ranch">
                                <label for="farm_or_ranch">Farm / Ranch</label>
                            </div>
                            <div class="summary-row clearfix">
                                <input id="member_military" type="checkbox" name="member_military" v-model="member_military">
                                <label for="member_military">Member Military</label>
                            </div>
                            <div class="summary-row clearfix">
                                <input id="off_highway_use" type="checkbox" name="off_highway_use" v-model="off_highway_use">
                                <label for="off_highway_use">Off Highway Use</label>
                            </div>
                            <div class="summary-row clearfix">
                                <input id="rebuilt_or_salvage" type="checkbox" name="rebuilt_or_salvage" v-model="rebuilt_or_salvage">
                                <label for="rebuilt_or_salvage">Rebuilt / Salvage</label>
                            </div>
                        </div>
                    </div>
                    <div class="summary">
                        <label>Total Tax and Fees</label>
                        <div class="total">
                            <span>$ </span>@{{ total | toFixed }}
                        </div>
                    </div>
                </div>
            </div>
            @include('dashboard.content.calculator.panels.result')
            @include('dashboard.content.calculator.panels.modal')
        </div>
    </div>

@stop














