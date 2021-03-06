<!DOCTYPE html>
<html lang="en" ng-app="feeCalculatorLogs">
<head>
    <meta charset="UTF-8">
    <meta id="token" name="token" value="{{ csrf_token() }}">
    <meta id="api_key" name="api_key" value="{{ env('API_KEY') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>Fee Calculator | Thirty 98</title>
    <link rel="stylesheet" type="text/css" href="{!! url('/'); !!}/css/app.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{!! url('/'); !!}/css/jquery.mCustomScrollbar.min.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="{!! url('/'); !!}/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="{!! url('/'); !!}/js/angular.min.js"></script>
</head>
<body ng-controller="logsController" templatemap>
<header id="header" class="@if(!$data['agent']) desktop @endif clearfix" name="header" part>
    @if($data["agent"])<a class="desktop-menu-toggler" ng-click="changeClass()"><i class="fa fa-bars"></i></a>@endif
            <!-- <div class="header-top-left">
        </div> -->
    <div class="header-top-right">
        <div class="avatar">
            <img src="{!! url('/'); !!}/images/default.jpg">
            <span>Steven Maroulis</span>
            <a href="/logout">Logout</a>
        </div>
    </div>
</header>
<div id="calculator-sidebar" ng-class="@if($data["agent"]) class @endif" class="sidebar @if(!$data['agent']) menu-open @endif" ng-init="showPane = 'calculator'">
    @if($data["agent"])<a ng-click="changeClass()" class="close"><i class="fa fa-times fa-2x"></i></a>@endif
    <div class="logo-container">
        <a class="logo" href="/calculator"><img src="{!! url('/'); !!}/images/logo.png"></a>
    </div>
    <span class="group" ng-click="toggleList('calculator')" ng-class="{ 'open-span': showPane == 'calculator'}"><i class="fa fa-globe"></i>&nbsp;United States<i class="fa fa-angle-right right"></i></span>
    <!-- <div class="group-tabs" ng-class="{ 'open-list': showPane == 'calculator'}"> -->
    <div class="group-tabs" ng-if="showPane == 'calculator'" ng-cloak>
        <span ng-click="showSubgroup('aCalc')"><i class="fa fa-angle-right right"></i><i class="fa fa-cog"></i>&nbsp;Available States</span>
        <div class="sub-group-tabs" ng-if="showC =='aCalc'"  scroll>
            <ul>
                <li><a href="{!! url('/'); !!}/calculator/TX"><i class="fa fa-map-marker"></i>&nbsp;Texas</a></li>
                <li><a href="{!! url('/'); !!}/calculator/LA"><i class="fa fa-map-marker"></i>&nbsp;Louisiana</a></li>
            </ul>
        </div>
        <span ng-click="showSubgroup('nCalc')"><i class="fa fa-angle-right right"></i><i class="fa fa-cog"></i>&nbsp;Upcoming States</span>
        <div class="sub-group-tabs upcoming" ng-if="showC == 'nCalc'" scroll>
            <ul>
                @foreach($states as $state)
                    <li><a href="#" style="color:#868686;"><i class="fa fa-map-marker"></i>&nbsp;{{ $state->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <span class="group" ng-click="toggleList('manage')" ng-class="{ 'open-span': showPane == 'manage'}"><i class="fa fa-cogs"></i>&nbsp;Manage<i class="fa fa-angle-right right"></i></span>
</div>
@yield('content')

<script type="text/javascript" src="{!! url('/'); !!}/js/app_log.js"></script>
<script type="text/javascript" src="{!! url('/'); !!}/js/ngStorage.min.js"></script>
<script type="text/javascript" src="{!! url('/'); !!}/js/angular-vertilize.min.js"></script>
<script type="text/javascript" src="{!! url('/'); !!}/js/modules/filters.js"></script>
<script type="text/javascript" src="{!! url('/'); !!}/js/modules/directives.js"></script>
<script type="text/javascript" src="{!! url('/'); !!}/js/modules/factory.js"></script>
<script type="text/javascript" src="{!! url('/'); !!}/js/controllers/logs.js"></script>

</body>
</html>