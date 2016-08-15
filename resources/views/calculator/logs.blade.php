@extends('partials.logs')

@section('content')
    <style>
        .disabled {
            background: grey;
        }
    </style>
    <div class="container @if(!$data['agent']) menu-open desktop-content @endif clearfix" name="panel" part>


        <div id="calculator" class="content">
            <div class="main-module-wrapper @if(!$data['agent']) desktop-main-module-wrapper @endif">
                <div class="dropdown-navigation module">
                    <h2><i class="fa fa-map-marker"></i>&nbsp;Calculator Logs</h2>

                    <div class="breadcrumbs">
                        <div><i class="fa fa-calculator"></i>&nbsp;Calculator <i class="fa fa-angle-right"></i> <i class="fa fa-map-marker"></i>&nbsp;Logs</div>
                    </div>
                </div>

                <div class="module">
                    <div class="manage-panel">
                        <div id="search-filters">
                            <label for="status-filter">Filter:</label> <br/> <br/>

                            <label for="Status">Status</label> <br/>
                            <select name="status-filter" ng-change="refreshParams()" ng-model="search.status">
                                <option value="" selected>ALL</option>
                                <option value="SUCCESS">SUCCESS</option>
                                <option value="FAILURE">FAILURE</option>
                            </select> <br/>

                            <label for="Status">State</label> <br/>
                            <select name="status-filter" ng-change="refreshParams()" ng-model="search.state">
                                <option value="" selected>ALL</option>
                                <option ng-repeat="state in states" value="@{{ state.code }}">@{{ state.code }} - @{{ state.name }}</option>
                            </select> <br/>

                            <button ng-click="refreshLogs()">Filter</button>
                        </div>

                        <table>
                            <thead>
                            <tr>
                                {{--<th>ID</th>--}}
                                <th ng-click="orderColumns('State')"><a href="#">State</a></th>
                                <th>Params</th>
                                <th ng-click="orderColumns('Status')"><a href="#">Status</a></th>
                                <th ng-click="orderColumns('Date Added')"><a href="#">Date Added</a></th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr ng-repeat="log in logs.data | filter:search.status | orderBy : order:order_reverse">
                                {{--<td>@{{ log.id }}</td>--}}
                                <td>@{{ log.state_code }}</td>
                                <td><a ng-click="displayFullParams(log.log_params)" href="#">@{{ log.log_params | limit:true:130:' ...' }}</a></td>
                                <td>@{{ log.status }}</td>
                                <td>@{{ log.date_added }}</td>
                            </tr>
                            </tbody>
                        </table>

                        {{--Paginated Links here--}}
                        <ul id="pages"></ul>

                        {{--<a href="" ng-repeat="x " ng-click="reloadLogs()">@{{  }}</a>--}}
                    </div>

                </div>
            </div>
            {{--<div class="calculator-wrapper clearfix @if(!$data['agent']) desktop-calculator-wrapper @endif" equalizeheight>
                <div class="narrow-module module-wrapper @if(!$data['agent']) desktop-module-wrapper @endif" equalizeheightadd>

                </div>
            </div>--}}
            @include('panels.modal_logs')
        </div>

    </div>

@stop














