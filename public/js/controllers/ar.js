appModule.controller('arController', ['$timeout', '$scope', '$rootScope', '$localStorage', 'dialogsHandler', 'fields', 'taxTypes', 'Resources',
    'FuelTypes', function ($timeout, $scope, $rootScope, $localStorage, dialogsHandler, fields, taxTypes, Resources, FuelTypes) {

    // Old defaults
    $localStorage.$default({state: 'AR'});
    $scope.calculator = angular.element('#calculator');
    $localStorage.trade_in = false; // Unique for Texas
    $scope.salesTaxwrap = angular.element('#sales-tax'); // Unique for Texas
    $scope.selectedTax = 1; // Unique for Texas
    $scope.ttlType = $localStorage.ttl_type;
    $scope.inspType = '';
    $scope.fields = fields;
    $scope.params = {
        transaction_type: $scope.ttlType.code
    };
    $localStorage.taxTypes = taxTypes.Type($scope.selectedTax, $localStorage.state);
    $scope.finalParams = $localStorage.taxTypes;
    $scope.total = {
        overall: 0
    };
    $scope.miscellaneous_fees = "";
    $scope.reset = 0;
    $scope.loaded = 0;
    $scope.defaults.state = "AR";
    $scope.farm_vehicle = false;
    $scope.motorcycle_vehicle = false;

    var updateFields = function () {
        angular.forEach($scope.fields, function (value, key) {
            $scope.fields[key].show = false;
            $scope.fields[key].required = false;
        });
        $timeout(function () {
            var availFields = $scope.availFields;

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
                    $scope.fields[value.name].show = true;
                    $scope.params[value.name] = value.selected;
                }
            });
        }, 10)

        $localStorage.fields = $scope.fields;
    }

    var loadConfigurations = function (config) {
        $scope.availFields = config.form_fields;
        $scope.options = config.calculator_options;
        $scope.transactionTypes = config.transaction_types;
        $scope.vehicleTypes = config.vehicle_types;
        $scope.inspectionTypes = config.inspection_fees;
        $scope.counties = config.counties;

        updateFields();
        watch_no_fees();
    }

    // Load calculation results

    var loadCalculations = function (data) {
        $scope.results = data.results;
        $scope.total = data.total;
        dialogsHandler.success("Success! your calculation has been loaded.", 'success');
    }

    // Load dataone
    var loadVehicles = function (response) {
        $scope.vehicles = response;
        var count = 0;
        var key = null;
        for (var i in $scope.vehicles) {
            key = i;
            count++;
        }
        $timeout(function () {
            if (count > 1) {
                $scope.dialogs.modal = true;
            } else {
                $scope.loadDataone($scope.vehicles[key]);
            }
        }, 10)
    }

    // Execute calculations

    var executeCalculation = function (data) {
        dialogsHandler.removeDialog('success', 'success');
        Resources.calculate(data);
        dialogsHandler.removeAlldialog();
    }

    // Load configurations
    var watch_no_fees = function () {
        $scope.$watch('params.no_fees', function () {
            var no_fees = $scope.params.no_fees;

            if (no_fees) {
                // Set all to false.
                $scope.params.temp_tag = false;

            } else {
                // Lock params.off_highway_use
                if ($scope.params.vehicle_type === 'mini_bike' ||
                    $scope.params.vehicle_type === 'off_road_motorcycle' ||
                    $scope.params.vehicle_type === 'atv_type_vehicle') {
                    $scope.disabled_off_highway_use = true;
                    $scope.params.off_highway_use = true;
                } else {
                    $scope.disabled_off_highway_use = false;
                    $scope.params.off_highway_use = false;
                }
            }
        });
    }

    var numberize = function (value) {
        var str = value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        if (str.indexOf('.') === -1) {
            str = String(str);
        }

        return str;
    }

    // Reset fields with error on it

    var removeErrors = function () {
        $scope.calculator.find('.required-field').each(function () {
            var $this = $(this);

            if ($this.val()) {
                $this.removeClass('error-field');
            } else {
                $this.addClass('error-field');
            }
        });
    }

    $scope.changeTransaction = function () {
        $scope.loading = true;
        Resources.configuration({"state": $scope.defaults.state, "transaction_type": $scope.ttlType.code});

        $scope.resetParams();
    }

    $scope.calculate = function () {
        $scope.finalParams = $localStorage.taxTypes;
        $scope.loading = true;
        dialogsHandler.removeDialog('success', 500);
        var error = 0;

        angular.forEach($scope.availFields, function (value, key) {
            if (value.required) {
                if (!$scope.params[value.name] || $scope.params[value.name] == "") {

                    if (value.name == "empty_weight") {
                        $scope.params.empty_weight = 0;
                    } else {
                        error++;
                        console.log("error here " + value.name);
                    }
                }
            }
        });
        $timeout(function () {
            if (error > 0) {
                dialogsHandler.error('Items that are marked with * are required.', 12000);
                removeErrors();
                $scope.loading = false;
            } else {
                angular.forEach($scope.fields, function (value, key) {
                    if (value.show) {
                        $scope.finalParams[key] = $scope.params[key];
                    }
                });

                $scope.finalParams["transaction_type"] = $scope.ttlType.code;
                $scope.finalParams["taxable_value"] = getNumeric($scope.taxable_value);
                $scope.finalParams["miscellaneous_fee"] = getNumeric($scope.params.miscellaneous_fee);
                $scope.finalParams["county"] = $scope.params.county;
                $scope.finalParams["city"] = $scope.params.city;
                $scope.finalParams["gvw"] = getNumeric($scope.finalParams["gvw"]);

                dialogsHandler.removeDialog('error', 12000);

                console.log('Calculating...');
                console.log(JSON.stringify($scope.finalParams));

                executeCalculation($scope.finalParams);
            }
        }, 100)
    }

    var getLogParams = function (response, status) {

        if (status === "FAILURE") {
            params = response.data.data.payload;
            params = Resources.removeKey('calc_config', params);
            params = Resources.removeKey('fee_rates', params);
            params = Resources.removeKey('transaction', params);
            params.state = params.state.code;
            params.vehicle_type = params.vehicles.slug;
            params = Resources.removeKey('vehicles', params);
        } else if (status === "SUCCESS") {
            params = response.data.data.payload;
            params = Resources.removeKey('calc_config', params);
            params = Resources.removeKey('fee_rates', params);
            params = Resources.removeKey('transaction', params);
            params.state = params.state.code;
            params.vehicle_type = params.vehicles.slug;
            params = Resources.removeKey('vehicles', params);
        }

        Resources.Log({
            'state': $localStorage.state,
            'status': status,
            'log_params': JSON.stringify(params)
        });
    }

    var removeKey = function (key, obj) {
        if (key in obj) {
            delete(obj[key]);
        }

        return obj;
    }

    $scope.$on('success', function (e, response) {
        console.log('response');
        console.log(response);

        switch (response.type) {
            case 'configuration':
                loadConfigurations(response.data);
                $scope.loading = false;
                break;
            case 'calculation':
                $('.error-field').removeClass('error-field').attr('error', true);

                console.log(response);

                loadCalculations(response.data);

                getLogParams(response.data.response_data, "SUCCESS");

                $scope.loading = false;
                break;
            case 'dataone':
                loadVehicles(response.data);
                $scope.loading = false;
                break;
            case 'avalara':
                $scope.loading = false;
                break;
        }
    });

    $scope.$on('error', function (e, response) {

        $scope.loading = false;

        switch (response.type) {
            case 'dataone':
                break;
            case 'calculation':
                /*console.log('Calculation Error: ');
                 console.log(response.response_data.data.data);

                 console.log('Calculation E: ');
                 console.log(e);*/

                var error = (typeof response.response_data.data.data.error != undefined) ? response.response_data.data.data.error : false;
                var errors = (typeof response.response_data.data.data.errors != undefined) ? response.response_data.data.data.errors : false;

                var error_arr_check = jQuery.isArray(error);
                var errors_arr_check = jQuery.isArray(errors);

                console.log('error_arr_check: ');
                console.log(error_arr_check);

                console.log('errors_arr_check: ');
                console.log(errors_arr_check);

                if (error) {
                    if (jQuery.isArray(error)) {
                        jQuery.each(error, function (key, value) {
                            dialogsHandler.error(value[0], key);
                        });
                    } else {
                        dialogsHandler.error(error, 300);
                    }
                }

                if (errors) {
                    if (jQuery.isArray(errors)) {
                        jQuery.each(errors, function (key, value) {
                            dialogsHandler.error(value[0], key);
                        });
                    } else {
                        dialogsHandler.error(errors, 300);
                    }
                }

                /*var count = Resources.jQuerySize(error);
                 console.log('Error Count: ');
                 console.log(count);

                 var count = Resources.jQuerySize(errors);
                 console.log('Errors Count: ');
                 console.log(count);*/

                /*if (error) {
                 jQuery.each(error, function (key, value) {
                 dialogsHandler.error(value[0], key);
                 });
                 }

                 if (errors) {
                 jQuery.each(errors, function (key, value) {
                 dialogsHandler.error(value[0], key);
                 });
                 }*/

                break;
        }
    });

    Resources.configuration({"state": $scope.defaults.state, "transaction_type": $scope.defaults.ttlType});

    // This function watch for empty weight changes and add it automatically to GVWR
    // A dirty function and should have be done on directive

    $scope.weights = angular.element('#weigths');

    var updateModel = function (value) {
        if (value != '') {
            $scope.params.gvw = value;
        }
    }

    var getNumeric = function (a) {
        if (a != null && a != 0) {
            var a = a.replace(',', '');

            return parseFloat(a);
        } else {
            return 0;
        }
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

        updateModel(numberize(total));
    }

    $scope.resetParams = function () {

        $scope.reset = 1;
        $scope.total.overall = 0;
        $scope.params.new_or_used = 1;

        // Set all options to false.
        var reset_values = {
            "params": {
                // Options
                'no_fees': false,
                'temp_tag': true,
                'is_trade_in_leased': false,
                'member_of_military': false,
                'rebuilt_salvage': false,
                'exempt_from_sales_tax': false,
                'include_inspection_fee': false,
                'include_vit_tax': false,

                // TX forms.
                'vin': "",
                'vehicle_type': $scope.vehicleTypes[0]['slug'],
                'model_year': '',
                'processing_county': '',
                'empty_weight': '',
                'gvw': '',
                'sales_price': '',
                'rebate_discount': '',
                'miscellaneous_fee': '',
                'carrying_capacity': '',
                'fuel_type': '',
                'gvw': '',
                'gvwr': '',
                'inspection_type': '',
                'trade_in_value': '',
                'date_of_sale': $.datepicker.formatDate('mm/dd/yy', new Date())
            },
            'taxable_value': '',
        };

        $scope.results = false;

        var params = reset_values.params;

        for (var k in params) {
            $scope.params[k] = params[k];
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

    /*$scope.$watch('ttlType', function () {
     alert('changed to: ' + $scope.ttlType);
     console.log($scope.ttlType);
     });*/

    $scope.loadDataone = function (a) {
        $localStorage.selectedVehicle = true;
        $scope.dialogs.modal = false;
        $scope.params.model_year = $.trim(a.year);
        $scope.params.gvwr = numberize(a.gross_vehicle_weight_rating);
        $scope.params.fuel_type = a.fuel_type;
        $scope.params.vehicle_type = $.trim(a.vehicle_slug);
        $scope.params.empty_weight = numberize($.trim(a.curb_weight));
        $scope.params.carrying_capacity = numberize($.trim(a.carrying_capacity));
        $timeout(function () {
            doThemath();
            removeErrors();
            $scope.loading = false;
        }, 100);
    }

    // Functions used by directives

    $scope.getVehicles = function () {
        // $scope.loading = true;
        var elem = $($localStorage.vinElement);
        Resources.dataone({vin: $scope.params.vin, state: $scope.defaults.state});
    }

    // Scripts unique for Texas Calculator

    $scope.monitizeField = function (value) {
        return value.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    $scope.weightUpdate = function () {
        var total = 0;
        elem.find('input').each(function () {
            var thisVal = parseInt($(this).val().split(',').join(''));
            if (thisVal) {
                switch ($(this).attr('operation')) {
                    case '+':
                        total += thisVal;
                        break;
                    case '-':
                        total -= thisVal;
                }
            }
        });
        updateModel(numberize(total));
    }

    var removeFreightCalculation = function () {

        if ($scope.params.freight > 0) {
            $scope.taxable_value -= $scope.params.freight;
            $scope.params.freight = "";

            if (isNaN($scope.taxable_value)) {
                $scope.taxable_value = "";
            } else if ($scope.taxable_value == 0) {
                $scope.taxable_value = "";
            } else if ($scope.taxable_value < 0) {
                $scope.taxable_value = "";
            } else {
                $scope.taxable_value = numberize($scope.taxable_value);
            }
        }
    }

    $scope.$watch('params', function () {
        if ($scope.reset == 0) {
            dialogsHandler.info('Press calculate to reflect the changes.', 'info');
        } else {
            $scope.reset = !$scope.reset;
        }
    }, true);

    $scope.$watch('params.did_pull_a_trailer', function (newVal, oldVal) {
        if (newVal) {
            $scope.pullingTrailer = true;
        } else {
            $scope.pullingTrailer = false;
            $scope.params.trailer_weight = null;
        }
        $timeout(function () {
            doThemath();
        }, 0);
    });

    $scope.$watch('params.include_inspection_fee', function (newVal, oldVal) {
        if (newVal) {
            $scope.includeInspectionFee = true;
        } else {
            $scope.includeInspectionFee = false;
        }
    });

    $scope.$watch('taxable_value', function (newVal, oldVal) {
        if (newVal) {
            if ($scope.fields.taxable_value.required) {
                angular.element('#taxable_value').removeClass('error-field').attr('error', false);
            }
        }
    });
    $scope.$watch('params.vehicle_type', function (newVal, oldVal) {
        if (newVal === 'moped' ||
            newVal === 'motorcycle' ||
            newVal === 'off_road_motorcycle'
        ) {
            $scope.motorcycle_vehicle = true;
        } else {
            $scope.motorcycle_vehicle = false;
        }

        if (newVal === '1_2_pickup_van' ||
            newVal === '3_4_pickup_van' ||
            newVal === '1_ton_pickup_van' ||
            newVal === '1_2_pickup_truck' ||
            newVal === '3_4_pickup_truck' ||
            newVal === '1_ton_pickup_truck'
        ) {
            $scope.farm_vehicle = true;
        } else {
            $scope.farm_vehicle = false;
        }
    });

    /**
     * New modifications.
     */

}]);