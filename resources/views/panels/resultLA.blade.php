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
                            <label>-- @{{ sumKey }}</label>

                            <div class="is-currency">
                                <input type="text" disabled="disabled" value="@{{ value | currency }}">
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>