appModule.controller('txController', ['$timeout', '$scope', '$rootScope', '$localStorage', 'dialogsHandler', 'fields', 'taxTypes', 'Resources', 'FuelTypes',
    function ($timeout, $scope, $rootScope, $localStorage, dialogsHandler, fields, taxTypes, Resources, FuelTypes) {

        // Old defaults
        $localStorage.$default({state: 'TX'});
        $scope.calculator = angular.element('#calculator');
        $localStorage.trade_in = false; // Unique for Texas
        $scope.salesTaxwrap = angular.element('#sales-tax'); // Unique for Texas
        $scope.selectedTax = 1; // Unique for Texas
        $scope.ttlType = $localStorage.ttl_type;
        $scope.inspType = '',
            $scope.fields = fields;
        $scope.params = {
            transaction_type: $scope.ttlType.code,
            modals: {
                rates: false
            },
            street_address: "",
            'Sales Tax Rate': []
        };

        $localStorage.taxTypes = taxTypes.Type($scope.selectedTax, $localStorage.state);
        $scope.finalParams = $localStorage.taxTypes;
        $scope.total = {
            overall: 0
        };
        $scope.miscellaneous_fees = "";
        $scope.reset = 0;
        $scope.loaded = 0;

        $scope.$watch('params.is_trade_in_leased', function () {
            if ($scope.params.is_trade_in_leased == true) {
                var trade_in_value = getNumeric($scope.params.trade_in_value),
                    taxable_value = getNumeric($scope.taxable_value);

                $scope.params.trade_in_value = "";

                $scope.taxable_value = numberize(taxable_value + trade_in_value);
            }
        });

        $scope.$watch('params.processing_county', function(oldVal, newVal) {
           console.log('New val: ' + newVal);
        });

        /*$scope.inspection_factors = [
         $scope.params.model_year
         ];*/

        /*$scope.$watchCollection('[params.model_year, params.vehicle_type, params.processing_county, params.new_or_used]', function () {
         console.clear();

         console.log($scope.params.model_year);
         console.log($scope.params.vehicle_type);
         console.log($scope.params.processing_county);
         console.log($scope.params.new_or_used);

         if($scope.params.include_inspection_fee === true) {
         if($scope.params.include_inspection_fee != "" && $scope.params.vehicle_type != "" && $scope.params.processing_county != "") {

         }
         }
         });*/


        $scope.defaults.state = "TX";

        $scope.fuelTypes = [];
        $scope.getFuelTypes = function () {
            FuelTypes.get({"api_key": "12345"}, $localStorage.state).then(function (response) {
                $scope.fuelTypes = response.data.data.fuel_types;
            });
        }

        $scope.getFuelTypes();

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

        // Set default vehicle type
        var setDefaultvehicletype = function () {
            $scope.params.vehicle_type = $scope.vehicleTypes[0]['slug'];
        }

        var setDefaultinspectiontype = function () {
            $scope.$watch('params.new_or_used', function (newVal, oldVal) {
                if (newVal == 1) {
                    $scope.params.inspection_type = $scope.inspectionTypes[1];
                } else {
                    $scope.params.inspection_type = $scope.inspectionTypes[0];
                }
            });
        }

        // Load configurations
        var watch_no_fees = function () {
            $scope.$watch('params.no_fees', function () {
                var no_fees = $scope.params.no_fees;

                if (no_fees) {
                    // Set all to false.
                    $scope.params.is_trade_in_leased = false;
                    $scope.params.temp_tag = false;
                    $scope.params.is_trade_in_leased = false;
                    $scope.params.farm_ranch = false;
                    $scope.params.member_of_military = false;
                    $scope.params.rebuilt_salvage = false;
                    // $scope.params.exempt_from_sales_tax = false;

                    $scope.params.include_inspection_fee = false;
                    $scope.params.include_vit_tax = false;

                    $scope.disabled_off_highway_use = false;
                    $scope.params.off_highway_use = false;
                    $scope.params.include_late_fees = false;
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

        var loadConfigurations = function (config) {
            $scope.availFields = config.form_fields;
            $scope.options = config.calculator_options;
            $scope.transactionTypes = config.transaction_types;
            $scope.vehicleTypes = config.vehicle_types;
            $scope.inspectionTypes = config.inspection_fees;
            $scope.counties = config.counties;

            updateFields();
            setDefaultvehicletype();
            setDefaultinspectiontype();
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

        // Add comma

        var numberize = function (value) {
            var str = value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            if (str.indexOf('.') === -1) {
                str = String(str) + '.00';
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

                /*if ($(this).val()) {
                 $(this).attr('error', false);
                 }

                 if ($(this).attr('error') == 'true') {
                 $(this).addClass('error-field');
                 } else {
                 $(this).removeClass('error-field');
                 }*/
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
                            if (key == "inspection_type") {
                                $scope.finalParams[key] = $scope.params[key].code;
                            } else if (key == "resident_county" || key == "processing_county") {
                                console.log(key);
                                if ($scope.params.hasOwnProperty(key)) {
                                    $scope.finalParams[key] = $scope.params[key];
                                }
                            } else {
                                $scope.finalParams[key] = $scope.params[key];
                            }
                        }
                    });

                    $scope.finalParams["transaction_type"] = $scope.ttlType.code;
                    $scope.finalParams["taxable_value"] = getNumeric($scope.taxable_value);
                    $scope.finalParams["miscellaneous_fee"] = getNumeric($scope.params.miscellaneous_fee);

                    // hackathon pakin.
                    if (typeof $scope.finalParams["fuel_type"] == "undefined") {
                        $scope.finalParams["fuel_type"] = "G";
                    }

                    if (typeof $scope.finalParams["empty_weight"] == "undefined") {
                        $scope.finalParams["empty_weight"] = "0";
                    }

                    if (typeof $scope.finalParams["empty_weight"] == "undefined") {
                        $scope.finalParams["empty_weight"] = "0";
                    }

                    dialogsHandler.removeDialog('error', 12000);

                    console.log('Calculating...');
                    console.log(JSON.stringify($scope.finalParams));
                    console.log($scope.finalParams);

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
            var response_data = response.response_data.data;

            console.log('response data');
            console.log(response_data);

            $scope.loading = false;

            switch (response.type) {
                case 'dataone':
                    /*$scope.params.vehicle_type = '';
                     $scope.params.model_year = '';
                     dialogsHandler.removeDialog('error', 'NO_DATA_FOUND');*/
                    break;
                case 'calculation':

                    var error = (typeof response_data.data.error != "undefined") ? response_data.data.error : false;

                    if (error) {
                        jQuery.each(error, function (key, value) {
                            dialogsHandler.error(value[0], key);
                        });
                    }

                    break;
            }
        });

        Resources.configuration({"state": $scope.defaults.state, "transaction_type": $scope.defaults.ttlType});

        // This function watch for empty weight changes and add it automatically to GVWR
        // A dirty function and should have be done on directive

        $scope.weights = angular.element('#weigths');

        var updateModel = function (value) {
            $scope.params.gvw = value;
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

            updateModel(numberize(total));
        }

        // End new code.

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
                    'fuel_type': '',
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

        /**
         * REPLACED WITH WATCHER.
         */
        /*$scope.taxableUpdate = function () {
         $localStorage.trade_in = $scope.params.is_trade_in_leased;
         var total = 0;
         $scope.salesTaxwrap.find('input').each(function () {
         var name = $(this).attr('name');
         var thisVal = parseFloat($(this).val().split(',').join(''));
         if (thisVal && !$localStorage.trade_in) {
         switch ($(this).attr('operation')) {
         case '+':
         total += thisVal;
         break;
         case '-':
         total -= thisVal;
         }
         } else if (thisVal && $localStorage.trade_in) {
         switch ($(this).attr('operation')) {
         case '+':
         if (name !== 'trade_in_value') {
         total += thisVal;
         }
         break;
         case '-':
         if (name !== 'trade_in_value') {
         total -= thisVal;
         }
         break;
         }
         }
         $scope.taxable_value = $scope.monitizeField(total);
         });
         }*/

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

        var checkVehicle = function (a) {

            for (var i = 0; i < $scope.vehicleTypes.length; i++) {
                if ($scope.vehicleTypes[i]['slug'] === a) {

                    removeFreightCalculation();

                    if ($scope.vehicleTypes[i].category === 'truck' || $scope.vehicleTypes[i].slug === 'trailer') {
                        $scope.showFarmRanch = true;
                    } else {
                        $scope.showFarmRanch = false;
                    }

                    if ($scope.vehicleTypes[i].slug === 'motorcycle' || $scope.vehicleTypes[i].slug == 'passenger') {
                        $scope.showAddress = true;
                        $scope.fields.freight.show = true;
                        $scope.fields.carrying_capacity.show = false;
                        $scope.params.carrying_capacity = 0;
                        $scope.fields.gvwr.show = false;
                    } else {
                        $scope.showAddress = false;
                        $scope.fields.freight.show = false;
                        $scope.fields.carrying_capacity.show = true;
                        $scope.fields.gvwr.show = true;
                    }

                    if ($scope.vehicleTypes[i].slug === 'motorcycle' || $scope.vehicleTypes[i].slug === 'off_road_motorcycle' || $scope.vehicleTypes[i].slug === 'moped') {
                        // Show off road vehicles.
                        $scope.showAddress = true;

                        // Hide empty weight.
                        $scope.fields.empty_weight.show = false;

                        // End empty weight.

                        // Show freight.
                        $scope.fields.freight.show = true;
                    } else {
                        // Do the opposite for all of the above.
                        $scope.showAddress = false;
                        $scope.fields.empty_weight.show = true;
                        $scope.fields.freight.show = false;
                    }

                    // Fuel Type Rules.
                    if ($scope.vehicleTypes[i].slug === 'motorcycle' || $scope.vehicleTypes[i].slug === 'off_road_motorcycle' ||
                        $scope.vehicleTypes[i].slug === 'mini_bike' || $scope.vehicleTypes[i].slug === 'atv_type_vehicle' ||
                        $scope.vehicleTypes[i].slug === 'travel_trailer' || $scope.vehicleTypes[i].slug === 'token_trailer' ||
                        $scope.vehicleTypes[i].slug === 'trailer' || $scope.vehicleTypes[i].slug === 'utility_trailer' ||
                        $scope.vehicleTypes[i].slug === 'moped') {
                        $scope.fields.fuel_type.show = false;
                        $scope.params.fuel_type = "";
                    } else {
                        $scope.fields.fuel_type.show = true;
                        $scope.params.fuel_type = "G";
                    }

                    // GVWR or GVW
                    if ($scope.vehicleTypes[i].slug === 'moped' || $scope.vehicleTypes[i].slug === 'motorcycle' ||
                        $scope.vehicleTypes[i].slug === 'off_road_motorcycle' || $scope.vehicleTypes[i].slug === 'atv_type_vehicle' ||
                        $scope.vehicleTypes[i].slug === 'mini_bike') {
                        $scope.fields.gvw.show = false;
                        $scope.fields.gvwr.show = false;
                    } else {
                        $scope.fields.gvw.show = true;
                        $scope.fields.gvwr.show = true;
                    }

                    // Lock params.off_highway_use
                    if ($scope.vehicleTypes[i].slug === 'mini_bike' ||
                        $scope.vehicleTypes[i].slug === 'off_road_motorcycle' ||
                        $scope.vehicleTypes[i].slug === 'atv_type_vehicle') {
                        $scope.disabled_off_highway_use = true;
                        $scope.params.off_highway_use = true;
                    } else {
                        $scope.disabled_off_highway_use = false;
                        $scope.params.off_highway_use = false;
                    }

                    // Inspection fee rules.
                    if ($scope.vehicleTypes[i].slug === 'moped' ||
                        $scope.vehicleTypes[i].slug === 'motorcycle' ||
                        $scope.vehicleTypes[i].slug === 'travel_trailer' ||
                        $scope.vehicleTypes[i].slug === 'token_trailer' ||
                        $scope.vehicleTypes[i].slug === 'trailer' ||
                        $scope.vehicleTypes[i].slug === 'utility_trailer') {

                        // Set default inspection type.
                        $scope.fields.include_inspection_fee.show = true;

                        // $scope.params.inspection_type
                        $scope.params.inspection_type = $scope.inspectionTypes[4];

                        $scope.fields.include_inspection_fee.show = true;
                        $scope.params.include_inspection_fee = true;
                    } else {

                    }

                    if ($scope.vehicleTypes[i].slug === 'off_road_motorcycle' ||
                        $scope.vehicleTypes[i].slug === 'mini_bike' ||
                        $scope.vehicleTypes[i].slug === 'atv_type_vehicle') {
                        // Block Include Inspection Fees column.
                        // Gray it out.
                        $scope.fields.include_inspection_fee.show = false;
                        $scope.fields.inspection_type.show = false;
                    } else {
                        $scope.fields.inspection_type.show = true;
                    }
                }
            }
        };

        $scope.checkVehicleclass = function () {
            $scope.$watch('params.vehicle_type', function (newVal, oldVal) {
                checkVehicle($scope.params.vehicle_type);
            });
        };

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

        /**
         * New modifications.
         */

    }]);