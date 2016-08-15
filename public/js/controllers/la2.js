appModule.controller('laController', ['$timeout', '$scope', 'Calculate', '$localStorage', 'Ttltypes', 'PlateTypes', 'dialogsHandler', 'fields', 'getDataone', '$rootScope', 'Resources',
    function ($timeout, $scope, Calculate, $localStorage, Ttltypes, PlateTypes, dialogsHandler, fields, getDataone, $rootScope, Resources) {
        // State defaults configuration.
        $localStorage.$default({state: 'LA'});

        // To target fields.
        $scope.calculator = angular.element('#form-fields');

        // Get master field list in Factory.
        $scope.field_index_map = {
            form_fields: {},
            calculator_options: {}
        };
        $scope.fields = fields;
        $scope.form_fields = [];
        $scope.calculator_options = [];

        // For VIN choices.
        $scope.vin = {
            vehicles: [],
            modal: false,
            details: {
                model_year: "",
                vehicle: "",
                gvw: "",
                gvwr: "",
                carrying_capacity: "",
            }
        };

        // For VIN modal.
        $scope.dialogs.modal = true;

        // For sales tax rates.
        $scope.sales_tax_rates = {
            modal: false,
            address: {
                city: "",
                county: ""
            },
            area: {
                code: "",
                tax: "",
                discount: ""
            },
            parish: {
                tax: "",
                discount: ""
            }
        };

        // Hold current values while updating configuration.
        $scope.old_form_fields = [];
        $scope.old_calculator_options = [];

        $scope.params = [];
        $scope.disabled_option_fields = false;

        // For calculation results.
        $scope.results = [];
        $scope.total_fees_and_taxes = 0;

        var removeErrors = function () {
            dialogsHandler.removeAlldialog();

            jQuery('#form-fields select').removeClass('error-field');
            jQuery('#form-fields input').removeClass('error-field');
        }

        var buildHashMap = function () {
            $scope.field_index_map.form_fields = [];
            $scope.field_index_map.calculator_options = [];

            angular.forEach($scope.form_fields, function (value, key) {
                $scope.field_index_map.form_fields[value.name] = key;
            });

            angular.forEach($scope.calculator_options, function (value, key) {
                $scope.field_index_map.calculator_options[value.name] = key;
            });
        }

        var setDefaults = function (callback) {
            angular.forEach($scope.form_fields, function (value, key) {
                switch (value.name) {
                    case "transaction_type":
                        $scope.form_fields[key]['param'] = $scope.form_fields[key]['data'][0]['value'].toString();
                        break;
                    case "vehicle_type":
                        $scope.form_fields[key]['param'] = $scope.form_fields[key]['data'][0]['value'].toString();
                        break;
                    case "type_of_plate":
                        $scope.form_fields[key]['param'] = $scope.form_fields[key]['data'][0]['value'].toString();
                        break;
                    case "mortgage_fee":
                        $scope.form_fields[key]['param'] = $scope.form_fields[key]['data'][0]['value'].toString();
                        break;
                    case "city_limits":
                        $scope.form_fields[key]['param'] = false;
                        break;
                    case "sales_price":
                        $scope.form_fields[key]['param'] = "0.00";
                        break;
                    case "rebate_discount":
                        $scope.form_fields[key]['param'] = "0.00";
                        break;
                    case "trade_in_value":
                        $scope.form_fields[key]['param'] = "0.00";
                        break;
                    case "taxable_value":
                        $scope.form_fields[key]['param'] = "0.00";
                        break;
                    case "empty_weight":
                        $scope.form_fields[key]['param'] = 0;
                        break;
                    case "trailer_weight":
                        $scope.form_fields[key]['param'] = 0;
                        break;
                    case "carrying_capacity":
                        $scope.form_fields[key]['param'] = 0;
                        break;
                    case "gvw":
                        $scope.form_fields[key]['param'] = 0;
                        break;
                    case "gvwr":
                        $scope.form_fields[key]['param'] = 0;
                        break;
                    case "date_of_sale":
                        $scope.form_fields[key]['param'] = $.datepicker.formatDate('mm/dd/yy', new Date());
                        break;
                }

                $scope.form_fields[$scope.field_index_map.form_fields['transaction_type']]['param'] = "NR";

                if (typeof $scope.form_fields[key]['param'] === "undefined") {
                    $scope.form_fields[key]['param'] = "";
                }
            });

            // Callbacks.
            if (typeof callback !== "undefined") {
                callback();
            }

            // Responds.
            $scope.results = [];
            $scope.total_fees_and_taxes = 0;
        }

        var initializeParamWatcher = function () {
            disableWatcher();
            enableWatchers();
        }

        $scope.inputWatcher = "";

        var enableWatchers = function () {

            var form_fields_length = $scope.form_fields.length,
                calculator_options_length = $scope.calculator_options.length;

            var watchStr = '[';

            var watchGroupFormFields = [],
                watchGroupCalculatorOptions = [];

            for (var i = 0; i < form_fields_length; i++) {
                watchGroupFormFields.push('form_fields[' + i + '].param');
            }

            for (var i = 0; i < calculator_options_length; i++) {
                watchGroupCalculatorOptions.push('calculator_options[' + i + '].default');
            }

            var watchFieldInputs = watchGroupFormFields.concat(watchGroupCalculatorOptions);

            $scope.inputWatcher = $scope.$watchGroup(watchFieldInputs, function (newVal, oldVal) {
                if (newVal !== oldVal) {
                    dialogsHandler.removeDialog("error", 600);
                    dialogsHandler.info('Press calculate to reflect the changes.', 600);
                }
            });
        }

        var disableWatcher = function () {
            if (typeof $scope.inputWatcher === 'function') {
                $scope.inputWatcher();
                $scope.inputWatcher = false;
            }
        }

        $scope.isOptionField = function (form_field_name) {
            var non_option_fields = [
                'transaction_type',
                'mortgage_fee',
                'type_of_plate'
            ];

            if (non_option_fields.indexOf(form_field_name) != -1) {
                return false;
            }

            return true;
        }

        /**
         *  Number of Passengers?
         *  Empty Weight
         *  Trailer Weight
         *  Carrying Capacity*
         *  GCVW
         *  GVWR
         */

        $scope.isWeightFields = function (form_field_name) {
            var weight_fields = [
                'empty_weight',
                'trailer_weight',
                'carrying_capacity'
            ];

            if (weight_fields.indexOf(form_field_name) != -1) {
                return true;
            }

            return false;
        }

        $scope.isNoFeesOption = function (form_field_name) {
            var noFeesField = [
                'temp_tag',
                'farm_use',
                'include_late_fees'
            ];

            if (noFeesField.indexOf(form_field_name) != -1) {
                return true;
            }

            return false;
        }

        $scope.isDidPullATrailerOption = function (form_field_name) {
            var didPullATrailerField = [
                'did_pull_a_trailer',
            ];

            if (didPullATrailerField.indexOf(form_field_name) != -1) {
                return true;
            }

            return false;
        }

        $scope.isNotNoFeesOption = function (form_field_name) {
            var noFeesField = [
                'exempt_from_sales_tax'
            ];

            if (noFeesField.indexOf(form_field_name) != -1) {
                return true;
            }

            return false;
        }

        $scope.isNoFeeOption = function (form_field_name) {
            var noFeesField = [
                'no_fees'
            ];

            if (noFeesField.indexOf(form_field_name) != -1) {
                return true;
            }

            return false;
        }

        $scope.isDisabledWeightFields = function (form_field_name) {
            var disabled_weight_fields = [
                'gvw',
                'gvwr'
            ];

            if (disabled_weight_fields.indexOf(form_field_name) != -1) {
                return true;
            }

            return false;
        }

        $scope.isPassengerField = function (form_field_name) {
            var passenger_field = [
                'number_of_passengers'
            ];

            if (passenger_field.indexOf(form_field_name) != -1) {
                return true;
            }

            return false;
        }

        $scope.isTypeOfPlate = function (form_field_name) {
            var type_of_plate_field = [
                'type_of_plate'
            ];

            if (type_of_plate_field.indexOf(form_field_name) != -1) {
                return true;
            }

            return false;
        }

        $scope.isAddressFields = function (form_field_name) {
            var address_fields = [
                'street_address',
                'zip'
            ];

            if (address_fields.indexOf(form_field_name) != -1) {
                return true;
            }

            return false;
        }

        $scope.isTransactionType = function (form_field_name) {
            var field = [
                'transaction_type'
            ];

            if (field.indexOf(form_field_name) != -1) {
                return true;
            }

            return false;
        }

        $scope.isVehicleType = function (form_field_name) {
            var field = [
                'vehicle_type'
            ];

            if (field.indexOf(form_field_name) != -1) {
                return true;
            }

            return false;
        }

        $scope.isRegularDropdown = function (form_field_name) {
            var fields = [
                'model_year',
                'mortgage_fee',
                'county'
            ];

            if (fields.indexOf(form_field_name) != -1) {
                return true;
            }

            return false;
        }

        $scope.isDollarFields = function (form_field_name) {
            var dollar_fields = [
                'sales_price',
                'rebate_discount',
                'trade_in_value',
                'sales_tax_credit'
            ];

            if (dollar_fields.indexOf(form_field_name) != -1) {
                return true;
            }

            return false;
        }

        /**
         * ==================================================
         *  Configuration Functions.
         * ==================================================
         */

        $scope.loadDefaultFields = function () {
            disableWatcher();
            removeErrors();

            $scope.form_fields = [];
            $scope.calculator_options = [];

            $scope.results = [];
            $scope.total_fees_and_taxes = 0;

            $scope.loading = true;

            $scope.loadConfigurations();
        }

        $scope.callMe = function () {
            var a = function () {
                console.log('a');
            }
            var b = function () {
                console.log('b');
            }
            var c = function () {
                console.log('c');
            }
            var d = 'a';

            $scope.loadConfigurationsDynamics([a, b, c, d]);
        }

        var loadCalculatorConfiguration = function (data, callbacks) {
            removeErrors();

            Ttltypes.post(data).then(function successCallback(response) {
                $timeout(function () {
                    $scope.form_fields = response.data.data.configuration.form_fields;
                    $scope.calculator_options = response.data.data.configuration.calculator_options;

                    // buildHashMap();
                    // setDefaults(initializeParamWatcher);

                    // Loop callbacks.
                    if (callbacks instanceof Array) {
                        for (var i in callbacks) {
                            if (typeof callbacks[i] === "function") {
                                callbacks[i]();
                            }
                        }
                    }

                    // Finish loading.
                    $scope.loading = false;
                }, 100);
            }, function errorCallback(response) {
                dialogsHandler.error("We are having a difficulty at the moment. We cannot process your request.", 900);

                // Finish loading.
                $scope.loading = false;
            });
        }

        // Fetch JSON config.
        $scope.loadConfigurationsDynamics = function (callbacks) {


            /*removeErrors();

             Ttltypes.post({
             state: $localStorage.state,
             transaction_type: $rootScope.defaults.ttlType
             }).then(function successCallback(response) {
             $timeout(function () {
             $scope.form_fields = response.data.data.configuration.form_fields;
             $scope.calculator_options = response.data.data.configuration.calculator_options;
             $scope.params = $scope.form_fields.concat($scope.options);

             buildHashMap();
             setDefaults(initializeParamWatcher);

             $scope.loading = false;
             }, 100);
             }, function errorCallback(response) {
             dialogsHandler.error("We are having a difficulty at the moment. We cannot process your request.", 900);
             });*/
        }

        // Fetch JSON config.
        $scope.loadConfigurations = function () {
            removeErrors();

            Ttltypes.post({
                state: $localStorage.state,
                transaction_type: $rootScope.defaults.ttlType
            }).then(function successCallback(response) {
                $timeout(function () {
                    $scope.form_fields = response.data.data.configuration.form_fields;
                    $scope.calculator_options = response.data.data.configuration.calculator_options;
                    $scope.params = $scope.form_fields.concat($scope.options);

                    buildHashMap();
                    setDefaults(initializeParamWatcher);

                    $scope.loading = false;
                }, 100);
            }, function errorCallback(response) {
                dialogsHandler.error("We are having a difficulty at the moment. We cannot process your request.", 900);
            });
        }

        $scope.loadConfigurationsByTransactionType = function (transaction_type) {
            removeErrors();

            $scope.loading = true;

            $scope.form_fields = [];
            $scope.calculator_options = [];

            Ttltypes.post({
                "state": $localStorage.state,
                "transaction_type": transaction_type
            }).then(function successCallback(response) {
                $timeout(function () {
                    $scope.form_fields = response.data.data.configuration.form_fields;
                    $scope.calculator_options = response.data.data.configuration.calculator_options;
                    $scope.params = $scope.form_fields.concat($scope.options);

                    buildHashMap();
                    setDefaults($scope.createTaxableValueWatcher);

                    $scope.form_fields[$scope.field_index_map.form_fields.transaction_type].param = transaction_type;

                    $scope.loading = false;
                }, 100);
            }, function errorCallback(response) {
                dialogsHandler.error("We are having a difficulty at the moment. We cannot process your request.", 900);
            });
        }

        $scope.loadConfigurationsByVehicleType = function (vehicle_type) {
            removeErrors();

            $scope.loading = true;

            var transaction_type = $scope.form_fields[$scope.field_index_map.form_fields.transaction_type].param;

            $scope.form_fields = [];
            $scope.calculator_options = [];

            Ttltypes.post({
                "state": $localStorage.state,
                "transaction_type": transaction_type,
                "vehicle_type": vehicle_type
            }).then(function successCallback(response) {
                $timeout(function () {
                    $scope.form_fields = response.data.data.configuration.form_fields;
                    $scope.calculator_options = response.data.data.configuration.calculator_options;
                    $scope.params = $scope.form_fields.concat($scope.options);

                    buildHashMap();
                    setDefaults($scope.createTaxableValueWatcher);

                    // Default override.
                    $scope.form_fields[$scope.field_index_map.form_fields.vehicle_type].param = vehicle_type;
                    $scope.form_fields[$scope.field_index_map.form_fields.transaction_type].param = transaction_type;

                    $scope.loading = false;
                }, 100);
            }, function errorCallback(response) {
                dialogsHandler.error("We are having a difficulty at the moment. We cannot process your request.", 900);
            });
        }

        $scope.loadConfigurationsByTypeOfPlate = function (type_of_plate) {
            if (type_of_plate === "hire_passenger_plate" || type_of_plate === "private_bus_plate") {
                $scope.loadConfigurationsPreserveParams({
                    state: $localStorage.state,
                    transaction_type: $scope.form_fields[$scope.field_index_map.form_fields.transaction_type].param,
                    vehicle_type: $scope.form_fields[$scope.field_index_map.form_fields.vehicle_type].param,
                    type_of_plate: type_of_plate
                }, function () {

                });
            }
        }

        // Config that still preserves values.
        $scope.loadConfigurationsPreserveParams = function (data, callback) {

            removeErrors();

            saveOldParams();

            $scope.loading = true;

            if (typeof data === "undefined") {
                data = {
                    state: "LA",
                    transaction_type: "TRC",
                    vehicle_type: "car"
                };
            }

            Ttltypes.post(data).then(function successCallback(response) {
                if (typeof response.data.data.error !== "undefined") {
                    $scope.loading = false;

                    if (typeof response.data.data.error === "string") {
                        dialogsHandler.error("Configuration failed." + " " + response.data.data.error, 200);
                    } else {
                        for (var i in response.data.data.error) {
                            dialogsHandler.error("Configuration failed." + " " + response.data.data.error[i], 200);
                        }
                    }
                } else {
                    $timeout(function () {
                        $scope.form_fields = response.data.data.configuration.form_fields;
                        $scope.calculator_options = response.data.data.configuration.calculator_options;
                        $scope.params = $scope.form_fields.concat($scope.options);


                        buildHashMap();
                        setDefaults($scope.createTaxableValueWatcher);

                        loadNewParams();

                        // Callback might be a setDefaults function.
                        if (typeof callback !== "undefined") {
                            callback();
                        }

                        $scope.loading = false;
                    }, 400);
                }
            }, function errorCallback(response) {
                dialogsHandler.error("We are having a difficulty at the moment. We cannot process your request.", 900);
            });
        }

        $scope.loadDefaultFields();

        /**
         * ==================================================
         *  end of Configuration Functions.
         * ==================================================
         */

        var saveOldParams = function () {
            angular.forEach($scope.form_fields, function (value, key) {
                if (typeof $scope.form_fields[key].param !== "undefined") {
                    $scope.old_form_fields[$scope.form_fields[key].name] = $scope.form_fields[key].param;
                }
            });

            angular.forEach($scope.calculator_options, function (value, key) {
                if (typeof $scope.calculator_options[key].default !== "undefined") {
                    $scope.old_calculator_options[$scope.calculator_options[key].name] = $scope.calculator_options[key].default;
                }
            });

            // Empty fields after looping.
            $scope.form_fields = [];
            $scope.calculator_options = [];
        }

        var loadNewParams = function () {
            for (var field_name in $scope.old_form_fields) {
                if (typeof $scope.form_fields[$scope.field_index_map.form_fields[field_name]] !== "undefined") {
                    $scope.form_fields[$scope.field_index_map.form_fields[field_name]].param = $scope.old_form_fields[field_name];
                }
            }
        }

        /**
         * Weight functions.
         */

        $scope.updateGVW = function () {
            var empty_weight = 0,
                trailer_weight = 0,
                carrying_capacity = 0;

            angular.forEach($scope.form_fields, function (value, key) {
                switch (value.name) {
                    case "empty_weight":
                        empty_weight = parseFloat($scope.form_fields[key].param);
                        break;
                    case "trailer_weight":
                        trailer_weight = parseFloat($scope.form_fields[key].param);
                        break;
                    case "carrying_capacity":
                        carrying_capacity = parseFloat($scope.form_fields[key].param);
                        break;
                }
            });

            $scope.$apply(function () {
                empty_weight = isNaN(empty_weight) ? 0 : empty_weight;
                trailer_weight = isNaN(trailer_weight) ? 0 : trailer_weight;
                carrying_capacity = isNaN(carrying_capacity) ? 0 : carrying_capacity;

                var total = empty_weight + trailer_weight + carrying_capacity;

                $scope.form_fields[$scope.field_index_map.form_fields.gvw].param = (total < 0) ? 0 : total;
            });
        }

        $scope.testConfigPreserve = function () {
            jQuery('#form-fields select').addClass('error-field');
            jQuery('#form-fields input').addClass('error-field');
        }

        $scope.testConfigPreserve2 = function () {
            jQuery('#form-fields select').removeClass('error-field');
            jQuery('#form-fields input').removeClass('error-field');
        }

        /**
         * end of Weight functions.
         */

        /**
         * Geo Location functions.
         */
        $scope.updateGeoLocation = function () {
            if (Resources.isVariable($scope.form_fields[$scope.field_index_map.form_fields.street_address].param) &&
                Resources.isVariable($scope.form_fields[$scope.field_index_map.form_fields.zip].param)) {

                // Show loading.
                $scope.loading = true;

                // Remove old error.
                dialogsHandler.removeDialog("error", 200);

                // Fetch rates.
                Resources.GeoLocationRates({
                    state: $localStorage.state,
                    zip: $scope.form_fields[$scope.field_index_map.form_fields.zip].param,
                    street_address: $scope.form_fields[$scope.field_index_map.form_fields.street_address].param
                }).then(function successCallback(response) {
                    // Callback.
                    if (response.data.data.error) {
                        if (typeof response.data.data.error === "string") {
                            dialogsHandler.error("Address verification failed." + " " + response.data.data.error, 200);
                        } else {
                            for (var i in response.data.data.error) {
                                dialogsHandler.error("Address verification failed." + " " + response.data.data.error[i], 200);
                            }
                        }
                    } else {
                        $scope.form_fields[$scope.field_index_map.form_fields.county].param = Resources.toSlug(response.data.data['Sales Tax Rates']['county_name']);

                        // Display modal and put display information.
                        $scope.sales_tax_rates = {
                            modal: true,
                            address: {
                                city: response.data.data['Sales Tax Rates']['city_name'],
                                county: response.data.data['Sales Tax Rates']['county_name']
                            },
                            area: {
                                code: response.data.data['Sales Tax Rates']['area_code'],
                                tax: response.data.data['Sales Tax Rates']['area_tax'],
                                discount: response.data.data['Sales Tax Rates']['area_vendor_desc']
                            },
                            parish: {
                                tax: response.data.data['Sales Tax Rates']['parish_tax'],
                                discount: response.data.data['Sales Tax Rates']['parish_vendor_desc']
                            },
                            city: Resources.toSlug(response.data.data['Sales Tax Rates']['city_name'])
                        };

                        // Remove error fields.
                        jQuery('#zip').removeClass('error-field');
                        jQuery('#street_address').removeClass('error-field');
                    }

                    $scope.loading = false;
                }, function errorCallback(response) {
                    // Error.
                    $scope.loading = false;
                });
            }
        }

        $scope.closeRatesModal = function () {
            $scope.sales_tax_rates.modal = false;
        }

        /**
         * ==================================================
         * end of Geo Location functions.
         * ==================================================
         */

        /**
         * ==================================================
         * VIN functions.
         * ==================================================
         */

        $scope.getVehicles = function () {
            dialogsHandler.removeDialog("error", 250);

            getDataone.post({
                vin: $scope.form_fields[$scope.field_index_map.form_fields.vin].param,
            }).then(function successHandler(response) {
                if (response.data.data.error) {
                    if (typeof response.data.data.error === "string") {
                        dialogsHandler.error(response.data.data.error, 250);
                    } else {
                        for (var i in response.data.data.error) {
                            dialogsHandler.error(response.data.data.error[i], 250);
                        }
                    }
                } else {
                    $scope.vehicles = response.data.data.vehicles;

                    // Load vehicle automatically if there's only 1 vin located.
                    if (Object.keys(response.data.data.vehicles).length === 1) {
                        angular.forEach(response.data.data.vehicles, function (value, key) {
                            $scope.loadSelectedVehicle(value);
                        });
                    } else {
                        $scope.vin.modal = true;
                    }
                }
            }, function errorHandler(response) {

            });
        }

        $scope.loadSelectedVehicle = function (vehicle) {
            $scope.loadConfigurationsPreserveParams(
                {
                    // Fetch params.
                    state: $localStorage.state,
                    transaction_type: $scope.form_fields[$scope.field_index_map.form_fields.transaction_type].param,
                    vehicle_type: Resources.toSlug(vehicle['vehicle_slug'])
                },
                function () {
                    angular.forEach($scope.form_fields, function (value, key) {
                        switch (value.name) {
                            case "vehicle_type":
                                $scope.form_fields[key].param = vehicle['vehicle_slug'];
                                break;
                            case "model_year":
                                $scope.form_fields[key].param = vehicle['model_year'].toString();
                                break;
                            case "gvw":
                                $scope.form_fields[key].param = vehicle['gvw'].toString();
                                break;
                            case "gvwr":
                                $scope.form_fields[key].param = vehicle['gvwr'].toString();
                                break;
                            case "empty_weight":
                                $scope.form_fields[key].param = vehicle['curb_weight'].toString();
                                break;
                            case "carrying_capacity":
                                $scope.form_fields[key].param = vehicle['carrying_capacity'].toString();
                                break;
                        }
                    });

                    // Override type of plate params.
                    $scope.form_fields[$scope.field_index_map.form_fields['type_of_plate']].param = $scope.form_fields[$scope.field_index_map.form_fields['type_of_plate']].data[0]['value'];

                    $scope.closeVinModal();
                }
            );
        }

        $scope.closeVinModal = function () {
            $scope.vin.modal = false;
        }

        /**
         * ==================================================
         * end of VIN functions.
         * ==================================================
         */

        /**
         * ==================================================
         * Watchers.
         * ==================================================
         */


        /**
         * ==================================================
         * end of Watchers.
         * ==================================================
         */

        /**
         * ==================================================
         * Totals.
         * ==================================================
         */

        $scope.updateTaxableValue = function () {
            $scope.$apply(function () {
                var total = parseFloat($scope.form_fields[$scope.field_index_map.form_fields['sales_price']].param)
                    + parseFloat($scope.form_fields[$scope.field_index_map.form_fields['rebate_discount']].param)
                    - parseFloat($scope.form_fields[$scope.field_index_map.form_fields['trade_in_value']].param);

                $scope.form_fields[$scope.field_index_map.form_fields.taxable_value].param = (total < 0) ? 0 : total;
            });
        }

        /**
         * ==================================================
         * end of Totals.
         * ==================================================
         */


        /**
         * ==================================================
         * Calculate functions.
         * ==================================================
         */
        $scope.calculate = function () {
            var calculate_params = {},
                errors = false;

            angular.forEach($scope.form_fields, function (value, key) {
                var key = value.name;

                // If fields are empty or undefined, set error to be true.
                if (value.required === true && value.param === "") {
                    jQuery('#' + value.name).addClass('error-field');
                    console.log('Error here ' + value.name + ' is required.');

                    errors = true;
                }

                if (typeof value.param === "undefined") {
                    // Set undefined values to "".
                    value.param = "";
                } else if (value.param === "true" || value.param === "false") {
                    // Parse true and false string values.
                    value.param = JSON.parse(value.param);
                } else if (value.param === "0.00") {
                    // "0.00" to 0.
                    value.param = 0;
                }

                calculate_params[key] = value.param;
            });

            angular.forEach($scope.calculator_options, function (value) {
                calculate_params[value.name] = value.default;
            });

            if (errors == false) {
                removeErrors();
                dialogsHandler.removeDialog("error", 500);

                calculate_params["state"] = $localStorage.state;
                calculate_params["city"] = $scope.sales_tax_rates.city;

                executeCalculation(calculate_params);
            } else {
                dialogsHandler.error("Please fill up the required fields.", 500);
            }
        }

        var executeCalculation = function (data) {
            $scope.loading = true;

            Calculate.post(data).then(function successCallback(response) {
                removeErrors();
                $scope.loading = false;

                if (typeof response.data.data.error !== "undefined") {
                    if (typeof response.data.data.error === "string") {
                        dialogsHandler.error("Address verification failed." + " " + response.data.data.error, 300);
                    } else {
                        for (var i in response.data.data.error) {
                            dialogsHandler.error("Address verification failed." + " " + response.data.data.error[i], 300);
                        }
                    }
                } else {
                    $scope.results = response.data.data['calculation'].summary;
                    $scope.total_fees_and_taxes = response.data.data['calculation'].total.overall;
                }
            }, function errorCallback(response) {
                removeErrors();
                $scope.loading = false;

                if (typeof response.data.data.error === "string") {
                    dialogsHandler.error("Address verification failed." + " " + response.data.data.error, 300);
                } else {
                    for (var i in response.data.data.error) {
                        dialogsHandler.error("Address verification failed." + " " + response.data.data.error[i], 300);
                    }
                }
            });
        }

        /**
         * ==================================================
         * end of Calculate functions.
         * ==================================================
         */

        /**
         * ==================================================
         * Calculator Option Functions.
         * ==================================================
         */

        /**
         * No Fees
         */
        $scope.lockFees = function () {
            if ($scope.calculator_options[$scope.field_index_map.calculator_options["no_fees"]].default === true) {
                $scope.disabled_option_fields = true;

                angular.forEach($scope.calculator_options, function (value, key) {
                    switch (value.name) {
                        case "temp_tag":
                            $scope.calculator_options[key].default = false;
                            break;
                        case "farm_use":
                            $scope.calculator_options[key].default = false;
                            break;
                        case "did_pull_a_trailer":
                            $scope.calculator_options[key].default = false;
                            break;
                        case "include_late_fees":
                            $scope.calculator_options[key].default = false;
                            break;
                    }
                });
            } else {
                $scope.disabled_option_fields = false;
            }
        }

        /**
         * Did pull a trailer.
         */
        $scope.didPullATrailerConfig = function () {
            $scope.loadConfigurationsPreserveParams({
                state: $localStorage.state,
                transaction_type: $scope.form_fields[$scope.field_index_map.form_fields.transaction_type].param,
                vehicle_type: $scope.form_fields[$scope.field_index_map.form_fields.vehicle_type].param,
                did_pull_a_trailer: $scope.calculator_options[$scope.field_index_map.calculator_options.did_pull_a_trailer].default
            }, function callback() {

            });
        }
        /**
         * ==================================================
         * end of Calculator Option Functions.
         * ==================================================
         */
    }]);