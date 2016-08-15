<div ng-if="dialogs.dialog" class="main-module-wrapper @if(!$data['agent']) desktop-main-module-wrapper @endif" ng-cloak ng-animate="'animate'">
	<div ng-if="dialogs.info.status" class="dropdown-navigation module dialogs"  ng-animate="'animate'">
        <div class="dialog info">
            <i class="fa fa-info-circle"></i>&nbsp;Calculator information
            <ul>
                <li ng-repeat="message in dialogs.info.message track by $index">@{{ message.message }}</li>
            </ul>
        </div>
    </div>
    <div ng-if="dialogs.error.status" class="dropdown-navigation module dialogs" ng-animate="'animate'">
    	<div class="dialog error">
    		<i class="fa fa-times-circle"></i>&nbsp;Something went wrong:
    		<ul>
    			<li ng-repeat="message in dialogs.error.message track by $index">@{{ message.message }}</li>
    		</ul>
    	</div>
    </div>
    <div ng-if="dialogs.warning.status" class="dropdown-navigation module dialogs"  ng-animate="'animate'">
    	<div class="dialog warning">
    		<i class="fa fa-exclamation-triangle"></i>&nbsp;Something is not right:
    		<ul>
    			<li ng-repeat="message in dialogs.warning.message track by $index">@{{ message.message }}</li>
    		</ul>
    	</div>
    </div>
    <div ng-if="dialogs.success.status" class="dropdown-navigation module dialogs"  ng-animate="'animate'">
    	<div class="dialog success">
    		<i class="fa fa-check-circle"></i>&nbsp;Congratulations!
    		<ul>
    			<li ng-repeat="message in dialogs.success.message track by $index">@{{ message.message }}</li>
    		</ul>
    	</div>
	</div>
	
</div>
<div ng-if="loading" class="main-module-wrapper @if(!$data['agent']) desktop-main-module-wrapper @endif" ng-cloak  ng-animate="'animate'">
	<div class="dropdown-navigation module dialogs">
    	<div class="dialog success">
    		<div class="loader"></div>
    	</div>
	</div>
</div>