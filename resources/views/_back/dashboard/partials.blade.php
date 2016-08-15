<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta id="token" name="token" value="{{ csrf_token() }}">
    <meta id="api_key" name="api_key" value="{{ env('API_KEY') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>Fee Calculator | Thirty 98</title>
    <!-- <link rel="stylesheet" href="{!! url(); !!}/css/bootstrap.min.css"> -->
    <link rel="stylesheet" type="text/css" href="{!! url(); !!}/css/app.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script type="text/javascript" src="{!! url(); !!}/js/vendor.js"></script>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>
<body>
	<header id="header">
        <a class="logo" href="/calculator"><img src="{!! url(); !!}/images/logo.png"></a>
        <a class="desktop-menu-toggler" href="#"><i class="fa fa-bars"></i></a>
        <div class="head-nav" v-class="active: nav">
            <ul class="nav">
                <li><a href="/calculator/TX">Calculator</a></li>
                <li><a href="/manage/TX?cat=fees&type=state_fees">Manage</a></li>
                <li><a href="/logout">Logout</a></li>
            </ul>
        </div>
	</header>
    <div id="calculator-sidebar" class="sidebar menu-open">
        <span><i class="fa fa-calculator"></i>&nbsp;Calculator</span>
       <!--  <ul>
            @foreach($states as $state)
                <li><a href="{!! url(); !!}/calculator/{{ $state->code }}"><i class="fa fa-map-marker"></i>&nbsp;{{ $state->name }}</a></li>
            @endforeach
        </ul> -->
        <ul>
            <li><a href="{!! url(); !!}/calculator/TX"><i class="fa fa-map-marker"></i>&nbsp;Texas</a></li>
            <li><a href="{!! url(); !!}/calculator/LA"><i class="fa fa-map-marker"></i>&nbsp;Louisiana</a></li>
        </ul>
        <span><i class="fa fa-cogs"></i>&nbsp;Manage</span>
         <ul>
            <li><a href="{!! url(); !!}/manage/TX?cat=fees&type=state_fees"><i class="fa fa-map-marker"></i>&nbsp;Texas</a></li>
            <li><a href="{!! url(); !!}/manage/LA?cat=fees&type=state_fees"><i class="fa fa-map-marker"></i>&nbsp;Louisiana</a></li>
        </ul>
    </div>
  <!--   <div class="dropdown-navigation">
        <h2><i class="fa fa-calculator"></i>Sales Tax Calculation</h2>
        <div class="main-dropdown-container">
            <span class="select-state">
                <label for="state">Select State:</label>
                <div class="has-select clearfix">
                    <select name="state" v-model="state" v-on="change: changeState()">
                        <option value="">Select</option>
                        <option value="texas">Texas</option>
                        <option value="louisiana">Louisiana</option>
                    </select>
                </div>
            </span>
        </div>
    </div> -->
	@yield('content')
    <script type="text/javascript" src="{!! url(); !!}/js/script.js"></script>
</body>
</html>