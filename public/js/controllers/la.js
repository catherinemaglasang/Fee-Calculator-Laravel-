appModule.controller('laController', ['$timeout', '$scope', 'Calculate', '$localStorage', 'Ttltypes', 'PlateTypes', 'dialogsHandler', 'fields', 'getDataone', '$rootScope', 'Resources',
    function ($timeout, $scope, Calculate, $localStorage, Ttltypes, PlateTypes, dialogsHandler, fields, getDataone, $rootScope, Resources) {
        $localStorage.$default({state: 'LA'});
        $scope.calculator = angular.element('#calculator');
        // $scope.ttlType = $localStorage.ttl_type;
        $scope.ttlType = $localStorage.ttl_type;
        $scope.fields = fields;
        $scope.plateTypes = [];
        $scope.calculator = angular.element('#calculator');
        $scope.plateTypesWithFarm = [];
        $scope.plateTypesWithoutFarm = [];
        $scope.params = {
            transaction_type: $scope.ttlType.code,
            typeOfPlate: "",
            transaction_type_select: true,
            street_address: "",
            modals: {
                rates: false
            },
            'Sales Tax Rate': {
                area_code: '',
                area_tax: '',
                area_vendor_desc: '',
                parish_tax: '',
                parish_vendor_desc: '',
            }
        };
        $scope.old_city = "";

        $scope.loadingDataOne = false;

        $scope.finalParams = {
            "state": "LA",
            "sales_tax": true,
            "gift_tax": false,
            "new_registration_tax": false,
            "even_trade_tax": false,
            "city_limits_false": true,
            "city_limits_true": false
        };

        $scope.total_fees_and_taxes = 0;

        $scope.total = {
            overall: 0
        };

        $scope.reset = 0;
        $scope.reset_plate = 0;


        /**
         * New config funtions.
         */

        /**
         * VEHICLE TYPE WATCHER.
         */

        // Vehicle types.
        var truck_vehicles = [
            "truck",
            "truck_tractor"
        ];

        var regular_vehicles = [
            "car",
            "van",
            "suv",
            "antique_vehicle",
            "motor_home",
            "motorcycle",
            "off_road_vehicle",
            "trailer",
            "travel_trailer",
            "semi_trailer"
        ];

        var boat_vehicles = [
            "boat_trailer",
            "utility_trailer"
        ];

        var loadVehicleWatcher = function () {
            $scope.$watch('params.vehicle_type', function (newVal) {
                if (typeof newVal != "undefined") {
                    console.log({
                        "state": $localStorage.state,
                        "transaction_type": $scope.params.transaction_type,
                        "vehicle_type": $scope.params.vehicle_type
                    });

                    reloadConfigurations({
                        "state": $localStorage.state,
                        "transaction_type": $scope.params.transaction_type,
                        "vehicle_type": $scope.params.vehicle_type
                    });

                    $scope.updatePlateTypes();
                }
            });
        }


        /**
         * OPTIONS WATCHER.
         */
        $scope.$watchCollection('[params.farm_use, params.did_pull_a_trailer]', function () {
            console.log('Option fields changing');
            // Make all options JSON and send? WTF
            // Or just send both?
            var data = {
                "state": $localStorage.state,
                "transaction_type": $scope.params.transaction_type,
                "vehicle_type": $scope.params.vehicle_type,
                "farm_use": $scope.params.farm_use,
                "did_pull_a_trailer": $scope.params.did_pull_a_trailer
            };

            reloadConfigurations({
                "state": $localStorage.state,
                "transaction_type": $scope.params.transaction_type,
                "vehicle_type": $scope.params.vehicle_type,
                "farm_use": $scope.params.farm_use,
                "did_pull_a_trailer": $scope.params.did_pull_a_trailer
            });

            $scope.$broadcast('ttlTypesloaded');
        });

        /**
         * TYPE OF PLATE WATCHER.
         */
        $scope.$watch('params.type_of_plate', function (newVal) {
            if (newVal === 'hire_passenger_plate') {
                reloadConfigurations({
                    "state": $localStorage.state,
                    "transaction_type": $scope.params.transaction_type,
                    "vehicle_type": $scope.params.vehicle_type,
                    "farm_use": $scope.params.farm_use,
                    "did_pull_a_trailer": $scope.params.did_pull_a_trailer,
                    "type_of_plate": newVal
                });
            }
        });

        $scope.testReload = function () {
            reloadConfigurations({
                "state": $localStorage.state,
                "transaction_type": "DT"
            });
        }

        var reloadConfigurations = function (data) {
            $scope.loading = true;

            dialogsHandler.removeDialog('success', 500);
            Ttltypes.post(data).then(function successCallback(response) {
                $scope.availFields = response.data.data.configuration.form_fields;
                $scope.options = response.data.data.configuration.calculator_options;
                $scope.transactionTypes = response.data.data.configuration.transaction_types;
                $scope.vehicleTypes = response.data.data.configuration.vehicle_types;
                $scope.loading = false;

                updateNewConfigurationByFieldsOnly();

            }, function errorCallback(response) {
                $scope.loading = false;
                updateNewConfigurationByFieldsOnly();

                dialogsHandler.error("We are having a difficulty at the moment. we cannot process your request.", 900);
            });
        }

        // By fields without value.
        var updateNewConfigurationByFieldsOnly = function () {

            // Whether fields are shown or not.
            angular.forEach($scope.fields, function (value, key) {
                $scope.fields[key].show = false;
                $scope.fields[key].required = false;
            });
            // Whethered fields are required.
            $timeout(function () {
                angular.forEach($scope.availFields, function (value, key) {
                    if ($scope.fields.hasOwnProperty(value.name)) {
                        $scope.fields[value.name].show = true;
                        if (value.required) {
                            $scope.fields[value.name].required = true;
                        }
                    }
                });
            }, 0);
            // Options fields value.
            $timeout(function () {
                angular.forEach($scope.options, function (value, key) {
                    if ($scope.fields.hasOwnProperty(value.name)) {
                        $scope.fields[value.name].show = true;
                    }
                });
            }, 10);
            $localStorage.fields = $scope.fields;
        }

        /**
         * End of new config functions.
         */

        $scope.setDefaultMortgageFee = function () {
            $scope.params.mortgage_fee = "15.00";
        }

        $scope.loadDataone = function (a) {

            $scope.loadingDataOne = true;


            var gvwr = parseFloat(a.gross_vehicle_weight_rating),
                vehicle_type = a.vehicle_type.toLowerCase().replace(/\s/g, '_');

            $localStorage.selectedVehicle = true;
            $scope.dialogs.modal = false;
            $scope.params.model_year = String($.trim(a.year));
            $scope.params.carrying_capacity = parseFloat(a.tonnage) * 2000;

            if ($scope.params.vehicle_type == 'passenger') {
                dialogsHandler.info('Manually specify if the passenger vehicle is Car, Van or SUV in the vehicle types option.', 200);
            } else {
                $scope.params.vehicle_type = vehicle_type;
            }

            // carrying_capacity
            $scope.params.carrying_capacity = numberize(a.tonnage * 2000);
            $scope.params.empty_weight = numberize($.trim(a.curb_weight));
            $scope.params.gvwr = numberize(a.gvwr);

            $scope.checkWeightColumns();

            $timeout(function () {
                doThemath();
            }, 100);
        }

        var doThemath = function () {
            var total = 0;

            var empty_weight = $scope.params.empty_weight;
            var trailer_weight = $scope.params.trailer_weight;
            var carrying_capacity = $scope.params.carrying_capacity;
            var gvw = '';

            if ($scope.fields.empty_weight.show == true) {
                empty_weight = getNumeric(empty_weight);
            } else {
                empty_weight = 0;
            }

            if ($scope.fields.trailer_weight.show == true) {
                trailer_weight = getNumeric(trailer_weight);
            } else {
                trailer_weight = 0;
            }

            if ($scope.fields.carrying_capacity.show == true) {
                carrying_capacity = getNumeric(carrying_capacity);
            } else {
                carrying_capacity = 0;
            }

            gvw = parseFloat(empty_weight) + parseFloat(trailer_weight) + parseFloat(carrying_capacity);

            total = gvw;


            /*$scope.weights.find('input').each(function () {
             var thisVal = parseInt($(this).val().split(',').join(''));
             alert('ahaha');
             if (thisVal) {
             switch ($(this).attr('operation')) {
             case '+':
             total += thisVal;
             break;
             case '-':
             total -= thisVal;
             }
             }
             });*/

            //  updateModel(numberize(total));
            $scope.params.gvw = numberize(total);
        }

        var getNumeric = function (a) {
            if (isNaN(a)) {
                if (a != null && a != 0 && typeof a !== "undefined") {
                    var a = a.replace(',', '');

                    return parseFloat(a);
                } else {
                    return 0;
                }
            } else {
                return a;
            }
        }

        var numberize = function (value) {
            var str = value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            if (str.indexOf('.') === -1) {
                str = String(str) + '.00';
            }

            return str;
        }

        $scope.checkWeightColumns = function () {
            var gvwr = $scope.params.gvwr,
                vehicle_type = $scope.params.vehicle_type;

            if ((gvwr >= 10000 && (vehicle_type == 'car' || vehicle_type == 'van' || vehicle_type == 'suv')) || vehicle_type == 'truck' || vehicle_type == 'truck_tractor') {
                if ($scope.loadingDataOne == false) {
                    $scope.showWeightColumns();
                } else {
                    $scope.loadingDataOne = true;
                }

            } else {
                $scope.hideWeightColumns();
            }
        }

        $scope.addFarmPlateOption = function () {
            if ($scope.params.farm_use == true) {
                $scope.plateTypes = $scope.plateTypesWithFarm;
            } else {
                $scope.plateTypes = $scope.plateTypesWithoutFarm;
            }

            $scope.setFirstPlateType();
        }

        $scope.showWeightColumns = function () {
            // Reset values to zero every show.
            // $scope.params.trailer_weight = 0;
            // $scope.params.carrying_capacity = 0;
            // $scope.params.gvw = 0;

            // Show all fields.
            fields.weight_inputs = false;

            // Hide did you ever pull a trailer...
            $scope.fields.did_pull_a_trailer.show = true;
        }

        $scope.resetTrailerWeight = function () {
            if ($scope.params.did_pull_a_trailer == false) {
                $scope.params.gvw = parseInt($scope.params.gvw) - parseInt($scope.params.trailer_weight);
                $scope.params.trailer_weight = 0;
            }
        }

        $scope.hideWeightColumns = function () {
            // Reset values to zero every show.
            $scope.params.trailer_weight = 0;
            $scope.params.carrying_capacity = 0;
            $scope.params.gvw = 0;
            $scope.params.gvwr = 0;

            // Show all fields.
            fields.weight_inputs = true;

            // Show did you ever pull a trailer...
            $scope.fields.did_pull_a_trailer.show = false;
        }

        /**
         * Set the first plate type as default if the plate has only 1 content.
         */
        $scope.setFirstPlateType = function () {
            if ($scope.plateTypes.length == 1) {
                $scope.params.type_of_plate = $scope.plateTypes[0]['slug'];
            } else {
                $scope.params.type_of_plate = "";
            }
        }

        $scope.updatePlateTypes = function (callback) {
            var vehicleType = $scope.params.vehicle_type;

            if ($scope.reset_plate == 1) {
                $scope.reset = 1;
            }

            // Watcher na itu.
            /*if (vehicleType == "truck" || vehicleType == "truck_tractor") {
             $scope.showWeightColumns();
             } else {
             $scope.hideWeightColumns();
             }*/

            $scope.params.did_pull_a_trailer = false;
            $scope.fields.farm_use.show = false;
            $scope.params.farm_use = false;
            $scope.plateTypesWithoutFarm = [];
            $scope.plateTypesWithFarm = [];

            if (vehicleType != "") {
                var data = {
                    "api_key": "12345",
                    "state": $localStorage.state,
                    "vehicle_type": vehicleType
                };

                PlateTypes.post(data).then(function (response) {
                    $scope.plateTypes = response.data.data.plate_types;

                    data = response.data.data.plate_types;

                    for (var i in data) {
                        $scope.plateTypesWithFarm.push(data[i]);

                        if (data[i]['name'].match(/farm/ig)) {
                            // Show farm if there is a farm option.
                            $scope.fields.farm_use.show = true;
                        } else {
                            $scope.plateTypesWithoutFarm.push(data[i]);
                        }
                    }

                    $scope.plateTypes = $scope.plateTypesWithoutFarm;

                    if (typeof callback !== 'undefined') {
                        callback();
                        $scope.params.vehicle_type = 'car';
                    } else {
                        $scope.setFirstPlateType();
                    }
                });
            }

            $scope.reset_plate = 0;
        }

        /**
         * End of Newly Added Functions.
         */

        $scope.$watch('params.no_fees', function () {
            if ($scope.params.no_fees == true) {
                $scope.params.temp_tag = false;
                $scope.params.did_pull_a_trailer = false;
                $scope.params.exempt_from_sales_tax = false;
                $scope.params.include_late_fees = false;
            } else {

            }
        });

        var removeErrors = function () {
            $scope.calculator.find('.required-field').each(function () {
                var $this = $(this);

                if ($this.val() != "") {
                    $this.removeClass('error-field');
                } else {
                    $this.addClass('error-field');
                }
            });
        }

        $scope.resetParams = function () {
            $scope.reset = 1;
            $scope.reset_plate = 1;
            $scope.total_fees_and_taxes = 0;

            // Get params.
            var params = {
                options: {
                    'no_fees': false,
                    'temp_tag': true,
                    'farm_use': false,
                    'did_pull_a_trailer': false,
                    'exempt_from_sales_tax': false,
                    'include_late_fees': true
                },
                inputs: {
                    'vin': '',
                    'vehicle_type': 'car',
                    // 'type_of_plate': false,
                    'model_year': '',
                    'mortgage_fee': "15.00",
                    'street_address': "",
                    'zip': "",
                    'city_limits': null,
                    'sales_price': "",
                    'rebate_discount': "",
                    'trade_in_value': "",
                    'taxable_value': "",
                    'date_of_sale': "",
                    "city_limits": null,
                    'date_of_sale': $.datepicker.formatDate('mm/dd/yy', new Date())
                },
                'taxable_value': ''
            }

            $scope.results = false;

            var option_params = params.options,
                input_params = params.inputs;

            for (var i in option_params) {
                $scope.params[i] = option_params[i];
            }

            for (var i in input_params) {
                $scope.params[i] = input_params[i];
            }

            $scope.taxable_value = '';

            // Remove all error field classes.
            $('.error-field').removeClass('error-field').attr('error', true);

            $rootScope.$broadcast('reset');
        }

        $scope.$on('reset', function () {
            // Remove all dialogs.
            dialogsHandler.removeAlldialog();
        })

        $scope.changeTransaction = function () {
            $scope.loading = true;

            dialogsHandler.removeDialog('success', 500);
            Ttltypes.post({
                "state": $localStorage.state,
                "transaction_type": $scope.ttlType.code
            }).then(function successCallback(response) {
                $scope.availFields = response.data.data.configuration.form_fields;
                $scope.options = response.data.data.configuration.calculator_options;
                $scope.transactionTypes = response.data.data.configuration.transaction_types;
                $scope.vehicleTypes = response.data.data.configuration.vehicle_types;
                $scope.$broadcast('ttlTypesloaded');

                $scope.resetParams();

                // $scope.setDefaultVehicleType();
                $scope.setDefaultMortgageFee();
                // dialogsHandler.info('Items that are marked with * are required.', 800);
            }, function errorCallback(response) {
                $scope.$broadcast('ttlTypesloaded');
                dialogsHandler.error("We are having a difficulty at the moment. we cannot process your request.", 900);
            });
        }

        $scope.executeCalculation = function (data) {
            $scope.total_fees_and_taxes = 0;
            $scope.loading = true;

            // Broadcasting has a limited approach.
            Calculate.post(data).then(function (response) {
                /*if (response.data.response_code == "SUCCESS") {
                 $scope.results = response.data.data.calculation.summary;
                 $scope.total_fees_and_taxes = response.data.data.calculation.total.overall;

                 dialogsHandler.removeAll();
                 dialogsHandler.success('Success! your calculation has been loaded.', 500);
                 $scope.loading = false;
                 } else {
                 $scope.results = false;
                 dialogsHandler.error(response.data.data.error, 1300);
                 }

                 $scope.loading = false;*/

                $scope.$broadcast('resultLoaded', {"data": response.data});


                /*if (response.data.response_code == "SUCCESS") {
                 // dialogsHandler.removeDialog('error', 1300);
                 $scope.result_status = response.data.response_code;
                 $scope.results = response.data.data.calculation.summary;
                 $scope.total = response.data.data.calculation.total;

                 // Broadcasting it here will not help.
                 $scope.$broadcast('resultLoaded');
                 } else {
                 $scope.$broadcast('resultLoaded');
                 // dialogsHandler.error(response.data.data.error, 1300);
                 }*/
            }, function errorCallback(response) {
                $scope.$broadcast('ttlTypesloaded');
                dialogsHandler.error("We are having a difficulty at the moment. we cannot process your request.", 900);
            });

            $scope.loading = false;
        }

        var getLogParams = function (result_params) {
            var params = result_params.data.data.payload,
                status = "",
                result = result_params.data.data,
                error = "",
                state = "",
                log_data = [];

            params.vehicle_type = params.vehicles.slug;
            params = Resources.removeKey('vehicles', params);
            params.state = params.state.code;
            params = Resources.removeKey('transaction', params);
            params = Resources.removeKey('calc_config', params);
            params = Resources.removeKey('Sales Tax Rate', params);
            params = Resources.removeKey('fee_rates', params);

            // trim .
            /*if ('vehicles' in params) {
             params.vehicle_type = params.vehicles.slug;
             delete(params.vehicles);
             }

             if ('state' in params) {
             state = params.state.code;
             delete(params.state);
             params.state = state;
             }

             if ('transaction' in params) {
             delete(params.transaction);
             }

             if ('calc_config' in params) {
             delete(params.calc_config);
             }

             if ('calc_config' in params) {
             delete(params.calc_config);
             }*/

            if ('error' in result_params.data.data) {
                status = "FAILURE";
                error = params.error;
            } else if ('errors' in result_params.data.data) {
                status = "FAILURE";
                error = params.errors;
            } else if ('calculation' in result_params.data.data) {
                status = "SUCCESS";
            } else {
                status = "";
            }

            Resources.Log({
                'state': $localStorage.state,
                'status': status,
                'log_params': JSON.stringify(params)
            });
        }

        $scope.$on('resultLoaded', function (e, args) {
            var response_data = args.data;

            // Remove error fields.
            $('.error-field').removeClass('error-field').attr('error', true);

            // get params.
            // getLogParams(args.data.data.payload);
            getLogParams(args);

            if (args.data.response_code === "SUCCESS") {
                $scope.loading = false;

                // Process logic here.
                $scope.results = response_data.data.calculation.summary;
                $scope.total_fees_and_taxes = response_data.data.calculation.total.overall;

                dialogsHandler.removeAlldialog();
                dialogsHandler.removeDialog('info', 800);
                dialogsHandler.removeDialog('error', 900);
                dialogsHandler.removeDialog('success', 1000);
                dialogsHandler.success('Success! your calculation has been loaded.', 500);
            } else {
                var error = (typeof response_data.data.error != undefined) ? response_data.data.error : false;
                var errors = (typeof response_data.data.errors != undefined) ? response_data.data.errors : false;

                if (error) {
                    jQuery.each(error, function (key, value) {
                        dialogsHandler.error(value[0], key);
                    });
                    /*if (Resources.jQuerySize(error) > 1) {
                     jQuery.each(error, function (key, value) {
                     dialogsHandler.error(value[0], key);
                     });
                     } else {
                     dialogsHandler.error(error[0], 300);
                     }*/
                }

                if (errors) {
                    jQuery.each(errors, function (key, value) {
                        dialogsHandler.error(value[0], key);
                    });
                    /*if (Resources.jQuerySize(errors) > 1) {
                     jQuery.each(error, function (key, value) {
                     dialogsHandler.error(value[0], key);
                     });
                     } else {
                     dialogsHandler.error(errors[0], 300);
                     }*/
                }

                /*dialogsHandler.error(errors[i][0], i);

                 for (var i in errors) {
                 console.log('key: ' + i);
                 console.log('Value: ' + errors[i][0]);

                 dialogsHandler.error(errors[i][0], i);
                 }

                 // dialogsHandler.error(response_data.data.errors[0], 900);

                 console.log('errors');
                 console.log(response_data.data.errors);*/

                $scope.loading = false;
            }
            /*console.log(args.result);

             var result = args.result,
             result_status = args.result.data.response_code;

             console.log(result_status);

             if(result === "SUCCESS") {

             }*/

            /*$scope.loading = false;

             dialogsHandler.removeDialog('info', 800);
             dialogsHandler.removeDialog('error', 900);
             dialogsHandler.removeDialog('success', 1000);
             dialogsHandler.success('Success! your calculation has been loaded.', 500);*/
        });

        $scope.calculate = function () {
            $scope.loading = true;
            dialogsHandler.removeDialog('success', 500);
            var error = 0;
            angular.forEach($scope.availFields, function (value, key) {
                if (value.required) {
                    if (!$scope.params[value.name] || $scope.params[value.name] == "") {
                        // Add a statement that enables carrying_capacity and empty_weights to NOT be required if the ff conditions are not met
                        var param_name = value.name,
                            gvwr = $scope.params.gvwr,
                            vehicle_type = $scope.params.vehicle_type;

                        error++;
                        console.log("error here " + value.name);

                        /*if (param_name == 'empty_weight' || param_name == 'carrying_capacity') {
                         if (((vehicle_type == 'car' || vehicle_type == 'van' || vehicle_type == 'suv') && gvwr >= 10000) || (vehicle_type == 'truck' || vehicle_type == 'truck_tractor')) {
                         error++;
                         console.log("error here " + value.name);
                         } else {

                         }
                         } else {
                         error++;
                         console.log("error here " + value.name);
                         }*/
                    }
                }
            });
            $timeout(function () {
                if (error > 0) {
                    dialogsHandler.error('Items that are marked with * are required.', 12000);
                    removeErrors();

                    $scope.loading = false;
                } else {
                    $scope.finalParams = {
                        "state": "LA",
                    };
                    angular.forEach($scope.fields, function (value, key) {
                        if (value.show || key == 'farm_use' || key == 'did_pull_a_trailer') {
                            $scope.finalParams[key] = $scope.params[key];
                        }
                        $scope.finalParams["transaction_type"] = $scope.ttlType.code;
                        $scope.finalParams["taxable_value"] = $localStorage.taxable_value;
                        $scope.finalParams["county"] = $scope.params.county;
                        $scope.finalParams["city"] = $scope.params.city;
                        $scope.finalParams["gvw"] = getNumeric($scope.finalParams["gvw"]);
                    });

                    // hackathon pakin.
                    if (typeof $scope.finalParams["fuel_type"] == "undefined") {
                        $scope.finalParams["fuel_type"] = "G";
                    }

                    dialogsHandler.removeDialog('error', 12000);

                    console.log('Calculate Params: ');
                    console.log(JSON.stringify($scope.finalParams));

                    $scope.executeCalculation($scope.finalParams);
                }
            }, 100)
        }

        $scope.$watch('params', function () {
            if ($scope.reset == 0) {
                dialogsHandler.info('Press calculate to reflect the changes.', 'info');
            } else {
                $scope.reset = !$scope.reset;
            }
        }, true);

        $scope.$watch('params.city_limits', function (newVal, oldVal) {
            if ($scope.params.city_limits != null && typeof $scope.params.city_limits != "undefined") {
                if ($scope.params.city_limits == true) {
                    // Check if old city is set.
                    if ($scope.old_city != "") {
                        $scope.params.city = $scope.old_city;
                    }
                } else if ($scope.params.city_limits == false) {
                    if ($scope.params.city != "") {
                        $scope.old_city = $scope.params.city;
                        $scope.params.city = "";
                    }
                }
            }


            /*console.log($scope.params.city_limits);
             if ($scope.params.city_limits != null) {
             if (newVal === true) {
             if ($scope.params.city != "") {
             $scope.old_city = $scope.params.city;
             }

             $scope.params.city = "";
             } else {
             if ($scope.old_city != "") {
             $scope.params.city = $scope.old_city;
             }

             $scope.params.city_limits = true;
             }
             }*/
        });

        $scope.updateFields = function () {

            angular.forEach($scope.fields, function (value, key) {
                $scope.fields[key].show = false;
                $scope.fields[key].required = false;
            });
            $timeout(function () {
                angular.forEach($scope.availFields, function (value, key) {
                    if ($scope.fields.hasOwnProperty(value.name)) {
                        $scope.fields[value.name].show = true;
                        if (value.required) {
                            $scope.fields[value.name].required = true;
                        }
                    }
                });
            }, 0)
            $timeout(function () {
                angular.forEach($scope.options, function (value, key) {
                    if ($scope.fields.hasOwnProperty(value.name)) {
                        if (value.name != 'farm_use' && value.name != 'did_pull_a_trailer') {
                            $scope.fields[value.name].show = true;
                            $scope.params[value.name] = value.selected;
                        }
                    }
                });
            }, 10)
            $localStorage.fields = $scope.fields;
        }

        /*$scope.setDefaultPlateType = function () {
         $scope.params.type_of_plate = $scope.plateTypes[0]['slug'];
         }

         $scope.setDefaultVehicleType = function () {
         $scope.params.vehicle_type = $scope.vehicleTypes[0]['slug'];
         $scope.updatePlateTypes($scope.setDefaultPlateType);
         }*/

        $scope.$on('ttlTypesloaded', function () {
            $scope.loading = false;
            $scope.updateFields();

            // Load vehicle listener.
            loadVehicleWatcher();

            // Set default to car (indexed 0) and update it's plate type correspondingly.
            /*$scope.setDefaultVehicleType();
             $scope.setDefaultMortgageFee();*/

            dialogsHandler.removeDialog('error', 900);
        });

        $scope.changeTransaction();

// Functions used by directives

        $scope.getVehicles = function () {
            $scope.loading = true;

            var elem = $($localStorage.vinElement);
            getDataone.post({vin: $scope.params.vin}).then(function successHandler(response) {
                if (response.data.response_code == "SUCCESS") {
                    var vehicles = response.data.data.vehicles,
                        count = 0,
                        key = '';

                    $scope.vehicles = vehicles;

                    for (var i in vehicles) {
                        count++;
                        key = i;
                    }

                    // Populate fields automatically if there is only 1 vehicle type returned, else show choices.
                    if (count == 1) {
                        $scope.loadDataone(vehicles[key]);
                    } else {
                        $scope.dialogs.modal = true;
                    }

                    elem.removeClass('error-field');
                    dialogsHandler.removeDialog('error', elem.attr('name'));
                    $scope.loading = false;
                } else {
                    // elem.addClass('error-field').attr('error', elem.attr('name'));
                    // dialogsHandler.error("VIN pattern not found.", elem.attr('name'));
                    $scope.loading = false;
                }
            }, function errorHandler() {
                elem.addClass('error-field').attr('error', elem.attr('name'));
                dialogsHandler.error("VIN pattern not found.", elem.attr('name'));
                $scope.loading = false;
            });
        }

        /**
         * Old Watchers.
         */
        /*$scope.$watch('params.gvwr', function () {
         if ($scope.params.vehicle_type == 'truck' || $scope.params.vehicle_type == 'truck_tractor') {
         // Display farm use.
         $scope.addFarmPlateOption();
         }
         });

         $scope.$watch('params.vehicle_type', function () {
         var vehicleType = $scope.params.vehicle_type;

         $scope.updatePlateTypes();

         if (vehicleType == "truck" || vehicleType == "truck_tractor" || vehicleType == 'boat_trailer' || vehicleType == 'utility_trailer') {

         if (vehicleType == 'boat_trailer' || vehicleType == 'utility_trailer') {
         $scope.fields.did_pull_a_trailer.show = false;
         $scope.fields.trailer_weight.show = true;
         $scope.params.did_pull_a_trailer = true;
         $scope.showWeightColumns();


         $scope.params.trailer_weight = "";
         } else {
         // Opposite of above.
         $scope.fields.did_pull_a_trailer.show = true;
         $scope.params.did_pull_a_trailer = false;
         $scope.plateTypes = $scope.plateTypesWithFarm;

         $scope.showWeightColumns();
         }


         /!*$scope.showWeightColumns();
         $scope.plateTypes = $scope.plateTypesWithFarm;*!/
         } else {
         $scope.hideWeightColumns();
         $scope.plateTypes = $scope.plateTypesWithoutFarm;
         }
         });*/
    }])
;