var appModule = angular.module('feeCalculator', ['ngStorage']).run(
	function($rootScope){
		$rootScope.calculator = "/api/calculator/v1/calculate";
		$rootScope.dataOne = "/api/dataone/v1/vehicle";
		$rootScope.config = "/api/calculator/v1/configuration2";
		$rootScope.defaults = {
			state: null,
			ttlType: "NR",
		};
		$rootScope.configurations = {};
		$rootScope.loading = true;
		$rootScope.errorMessages = [
			{
				server: {
					message: "Server error! We cannot proccess your request at the moment.",
					code: "server_error"
				},
				something: {
					message: "We cannot proccess your request at the moment.",
					code: "something_is_wrong"
				}
			}

		];
	}
);

