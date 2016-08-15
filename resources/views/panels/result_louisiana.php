<div class="module-wrapper @if(!$data['agent']) desktop-module-wrapper @endif" pos="last" equalizeheightadd>
    <div class="result module" ng-cloak>
        <h1><i class="fa fa-cogs"></i>&nbsp;Result Breakdown</h1>
        <ul ng-if="results">
            <li ng-repeat="(key, result) in results" class="bark clearfix" accord>
                <div class="clearfix">
                    <label class="bold">@{{ key }}</label>
                    <a href="#">more</a>

                    <div class="is-currency">
                        <input type="text" disabled="disabled"
                               value="@{{ result.total.overall | currency }}">
                    </div>
                </div>
                <div class="sub-panel clearfix">
                    <ul>
                        <li ng-repeat="(sumKey, value) in result.summary" class="clearfix">
                            <label ng-if="finalParams.state != 'TX' && sumKey != 'Sales Tax'">-- @{{ sumKey }}</label>
                            <label ng-if="finalParams.state == 'TX' && sumKey != 'Sales Tax' && sumKey != 'Gift Tax' && sumKey != 'New Resident Tax' && sumKey != 'Even Trade Tax'">-- @{{ sumKey }}</label>

                            <div ng-if="finalParams.state != 'TX' && sumKey != 'Sales Tax'" class="is-currency">
                                <input type="text" disabled="disabled" value="@{{ value | currency }}">
                            </div>
                            <div ng-if="finalParams.state == 'TX' && sumKey != 'Sales Tax' && sumKey != 'Gift Tax' && sumKey != 'New Resident Tax' && sumKey != 'Even Trade Tax'" class="is-currency">
                                <input type="text" disabled="disabled" value="@{{ value | currency }}">
                            </div>
                            <div ng-if="finalParams.state == 'TX' && sumKey == 'Sales Tax'" class="form-group">
                                <div class="has-select" style="width: 40%;">
                                    <select updatetax ctrl-fn="calculate()">
                                        <option value="1" selected>Sales Tax</option>
                                        <option value="2">Gift Tax</option>
                                        <option value="3">New Residence Tax</option>
                                        <option value="4">Even Trade Tax</option>
                                    </select>
                                </div>
                                <div class="is-currency">
                                    <input type="text" disabled="disabled" value="@{{ value | currency }}">
                                </div>
                            </div>
                            <div ng-if="finalParams.state == 'TX' && sumKey == 'Gift Tax'" class="form-group">
                                <div class="has-select" style="width: 40%;">
                                    <select updatetax ctrl-fn="calculate()">
                                        <option value="1">Sales Tax</option>
                                        <option value="2" selected>Gift Tax</option>
                                        <option value="3">New Residence Tax</option>
                                        <option value="4">Even Trade Tax</option>
                                    </select>
                                </div>
                                <div class="is-currency">
                                    <input type="text" disabled="disabled" value="@{{ value | currency }}">
                                </div>
                            </div>
                            <div ng-if="finalParams.state == 'TX' && sumKey == 'New Resident Tax'" class="form-group">
                                <div class="has-select" style="width: 40%;">
                                    <select updatetax ctrl-fn="calculate()">
                                        <option value="1">Sales Tax</option>
                                        <option value="2">Gift Tax</option>
                                        <option value="3" selected>New Residence Tax</option>
                                        <option value="4">Even Trade Tax</option>
                                    </select>
                                </div>
                                <div class="is-currency">
                                    <input type="text" disabled="disabled" value="@{{ value | currency }}">
                                </div>
                            </div>
                            <div ng-if="finalParams.state == 'TX' && sumKey == 'Even Trade Tax'" class="form-group">
                                <div class="has-select" style="width: 40%;">
                                    <select updatetax ctrl-fn="calculate()">
                                        <option value="1">Sales Tax</option>
                                        <option value="2">Gift Tax</option>
                                        <option value="3">New Residence Tax</option>
                                        <option value="4" selected>Even Trade Tax</option>
                                    </select>
                                </div>
                                <div class="is-currency">
                                    <input type="text" disabled="disabled" value="@{{ value | currency }}">
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>