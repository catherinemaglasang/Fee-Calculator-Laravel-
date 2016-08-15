appModule.controller('mainController', ['$rootScope', '$scope', '$localStorage', 'Ttltypes', 'dialogsHandler', 'Resources', function ($rootScope, $scope, $localStorage, Ttltypes, dialogsHandler, Resources) {

	$scope.showPane = null;

	$localStorage.$reset();
	$localStorage.vin = null;
	$localStorage.taxable_value = 0;

	$localStorage.$default({ttl_type: {code: "NR", name: "New Title/New Registration"}});
	$scope.dialogs = $localStorage.$default({
    	error : {
			status: false,
			message: []
		},
		warning: {
			status: false,
			message: []
		},
		info: {
			status: false,
			message: []
		},
		success: {
			status: false,
			message: []
		},
		selectedVehicle: false,
		vehicles: {},
		dialog: false,
		modal: false
	});

	$scope.toggleList = function(a){
		if($scope.showPane != a){
			$scope.showPane = a;
		}else{
			$scope.showPane = null;
		}
	}

	$scope.showSubgroup = function(a){
		$scope.showC = a;
	}

	$scope.class = "no-nav";
    
    /*For Nav Toggle*/
    $scope.changeClass = function(){
        if ($scope.class === "no-nav")
            $scope.class = "show-nav";
         else
            $scope.class = "no-nav";
    };
    /*End Nav Toggle*/
}]);