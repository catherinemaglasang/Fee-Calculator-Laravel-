// Scrips that handle Resource

appModule.factory('Resources', ['$rootScope', 'Calculate', 'getDataone', 'Configuration', 'Avalara', 'Log', 'States', 'jQuerySize', 'inArray', 'isVariable',
    'getValue', 'toSlug', 'GeoLocationRates',
    function ($rootScope, Calculate, getDataone, Configuration, Avalara, Log, States, jQuerySize, inArray, isVariable, getValue, toSlug, GeoLocationRates) {
        var Resource = {
            configuration: function (data) {
                console.log(data);
                Configuration.post(data).then(function successHandler(response) {
                    if (response.data.response_code == "SUCCESS") {
                        $rootScope.$broadcast('success', {
                            data: response.data.data.configuration,
                            type: 'configuration',
                            status: null
                        });
                        $rootScope.$broadcast('ttlTypesloaded');
                    } else {
                        $rootScope.$broadcast('error', {
                            data: null,
                            type: 'configuration',
                            status: $rootScope.errorMessages[0].something
                        });
                    }
                }, function errorHandler(response) {
                    $rootScope.$broadcast('error', {
                        data: null,
                        type: 'configuration',
                        status: $rootScope.errorMessages[0].server
                    });
                });
            },
            jQuerySize: function (obj) {
                return jQuerySize.count(obj);
            },
            inArray: function (arr, key) {
                return inArray.search(arr, key);
            },
            isVariable: function (data) {
                return isVariable.validate(data);
            },
            toSlug: function (data) {
                return toSlug.slugify(data);
            },
            getValue: function (data) {
                return getValue.getValueOrKey(data);
            },
            states: function () {
                getStates: States.getStates().then(function (response) {
                    $rootScope.$broadcast('resultLoaded', {
                        data: response.data,
                        response_type: 'states',
                        status: null
                    });
                }, function errorHandler(response) {
                    alert('Unable to load states');
                });
            },
            jqueryCount: function (obj) {
                return jQuerySize.count(obj);
            },
            removeKey: function (key, obj) {
                if (key in obj) {
                    delete(obj[key]);
                }

                return obj;
            },
            Log: function (data) {
                Log.post(data).then(function successHandler(response) {

                }, function errorHandler(response) {
                    console.log('Logging failed.');
                });
            },
            getLogs: function (data) {
                Log.getLogs(data).then(function successHandler(response) {
                    // Broadcast.
                    $rootScope.$broadcast('resultLoaded', {
                        data: response,
                        status: {
                            message: response.data.response_code,
                            code: response.data.http_code
                        },
                        response_type: 'Logs'
                    });
                }, function errorHandler(response) {
                    console.log('Logging failed.');
                });
            },
            dataone: function (data) {
                getDataone.post(data).then(function successHandler(response) {

                    if (response.data.response_code == "SUCCESS") {
                        $rootScope.$broadcast('success', {
                            data: response.data.data.vehicles,
                            type: 'dataone',
                            status: {
                                message: response.data.data.response_msg,
                                code: response.data.response_code
                            }
                        });
                    } else {
                        $rootScope.$broadcast('error', {
                            data: null,
                            type: 'dataone',
                            status: {
                                message: response.data.data.error,
                                code: response.data.response_code
                            }
                        });
                    }
                }, function errorHandler(response) {
                    $rootScope.$broadcast('error', {
                        data: null,
                        type: 'dataone',
                        status: $rootScope.errorMessages[0].server
                    });
                });
            },
            calculate: function (data) {
                Calculate.post(data).then(function successHandler(response) {
                    if (response.data.response_code == "SUCCESS") {
                        $rootScope.$broadcast('success', {
                            data: {
                                results: response.data.data.calculation.summary,
                                total: response.data.data.calculation.total,
                                response_data: response
                            },
                            type: 'calculation',
                            status: null
                        });
                    } else {
                        $rootScope.$broadcast('error', {
                            data: null,
                            type: 'calculation',
                            status: response.data,
                            response_data: response
                        });
                    }
                }, function errorHandler() {
                    $rootScope.$broadcast('error', {
                        data: null,
                        type: 'calculation',
                        status: $rootScope.errorMessages[0].server
                    });
                });
            },
            avalara: function (data) {
                return Avalara.post(data);
            },
            GeoLocationRates: function(data) {
                return GeoLocationRates.post(data);
            }
        }
        return Resource;
    }]);

appModule.factory('States', ['$http', function ($http) {
    var states = {
        getStates: function () {
            return $http.get('/api/manage/states');
        }
    }

    return states;
}]);

appModule.factory('toSlug', function ($http) {
    return {
        slugify: function (data) {
            return data
                .toLowerCase()
                .replace(/ /g, '_')
                .replace(/[^\w-]+/g, '')
                ;
        }
    }
});

appModule.factory('jQuerySize', function () {
    return {
        count: function (obj) {
            var count = 0;

            console.log(obj);

            for (var i in obj) {
                count++;
            }

            return count;
        }
    };
});

appModule.factory('hasOwnKey', function () {
    return {
        hasKey: function (data) {
            if (data.length == 1) {

            }

            return false;
        }
    };
});

appModule.factory('getValue', function () {
    return {
        getValueOrKey: function (data) {
            if ("key" in data) {
                return data[key];
            }

            return data;
        }
    };
});

appModule.factory('inArray', function () {
    return {
        search: function (arr, key) {
            for (var i = 0; i < arr.length; i++) {
                if (arr[i] === key) {
                    return true;
                }
            }
            return false;
        }
    }
});

appModule.factory('Calculate', ['$http', '$rootScope', function ($http, $rootScope) {
    var Calculations = {
        post: function (data) {
            return $http.post($rootScope.calculator, data);
        }
    };
    return Calculations;
}]);

appModule.factory('Calculate', ['$http', '$rootScope', function ($http, $rootScope) {
    var Calculations = {
        post: function (data) {
            return $http.post($rootScope.calculator, data);
        }
    };
    return Calculations;
}]);

appModule.factory('PlateTypes', ['$http', function ($http) {
    var PlateTypes = {
        post: function (data) {
            return $http.post('/api/vehicle/v1/plate/types/vehicleAndState', data);
        }
    };
    return PlateTypes;
}]);

appModule.factory('FuelTypes', ['$http', function ($http) {
    var FuelTypes = {
        get: function (data, state) {
            return $http.get('/api/vehicle/v1/fuelTypes/' + state, {params: data});
        }
    };
    return FuelTypes;
}]);

appModule.factory('Ttltypes', ['$http', '$rootScope', function ($http, $rootScope) {
    var Types = {
        post: function (data) {
            return $http.post($rootScope.config, data);
        }
    };
    return Types;
}]);

appModule.factory('Configuration', ['$http', '$rootScope', function ($http, $rootScope) {
    var Configuration = {
        post: function (data) {
            return $http.post($rootScope.config, data);
        }
    };
    return Configuration;
}]);

appModule.factory('stringify', function () {
    var Str = {
        glue: function (old, message, code) {
            var exist = 0;
            if (old.length) {
                for (var i = 0; i < old.length; i++) {
                    if (code == old[i].code) {
                        exist += 1;
                    }
                }
                if (!exist) {
                    var newMessage = old;
                    newMessage[old.length] = {message: message, code: code};
                    return newMessage;
                } else {
                    return old;
                }
            } else {
                return [
                    {
                        message: message,
                        code: code
                    }
                ];
            }
        }
    };
    return Str;
});

appModule.factory('isVariable', function () {
    var validator = {
        validate: function (data) {
            if (typeof data !== "undefined" && data !== "") {
                return true;
            }

            return false;
        }
    };
    return validator;
});

appModule.factory('removeDialogs', function () {
    var Str = {
        cut: function (type, code, storage) {

            var items = storage[type].message;

            if (items.length) {
                for (var i = 0; i < items.length; i++) {
                    if (items[i].code == code) {
                        items.splice(i, 1);
                        break;
                    }
                }
                if (!items.length) {
                    storage[type].status = false;
                    return storage;
                } else {
                    storage[type].message = jQuery.unique(items);
                    storage[type].status = true;
                    storage.dialog = true;
                    return storage;
                }
            }
            return storage;
        }
    };
    return Str;
});

appModule.factory('keyRemoval', function () {
    var keyRemoval = {
        clearKeys: function (obj, keys) {

        }
    };

    return keyRemoval;
});

appModule.factory('checkFordialogs', function () {
    var Str = {
        check: function (storage) {
            var dialogs = 0;
            var fields = ['error', 'warning', 'info', 'success'];
            if (storage.dialog) {
                for (var i = 0; i < fields.length; i++) {
                    if (storage.hasOwnProperty(fields[i])) {
                        if (storage[fields[i]].message.length) {
                            dialogs += storage[fields[i]].message.length;
                        }
                    }
                }
                if (dialogs) return true;
                return false;
            } else {
                return false;
            }
        }
    };
    return Str;
});

appModule.factory('Log', ['$http', function ($http) {
    var Log = {
        post: function (data) {
            return $http.post('/api/calculator/v1/log', data);
        },
        /**
         * Params: state, page
         * @param data
         * @returns {*}
         */
        getLogs: function (data) {
            return $http.post('/api/calculator/v1/logs', data);
        }
    };
    return Log;
}]);

appModule.factory('resetStorage', ['$localStorage', function ($localStorage) {
    var Str = {
        renew: function () {
            // This is not working.
            /*$localStorage.$default({
             error: {
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
             dialog: false
             });*/

            // Working, you might want to refactor if there's a better way.
            $localStorage.error.message = [];
            $localStorage.error.status = false;

            $localStorage.warning.message = [];
            $localStorage.warning.status = false;

            $localStorage.info.message = [];
            $localStorage.info.status = false;

            $localStorage.success.message = [];
            $localStorage.success.status = false;
        }
    };
    return Str;
}]);

appModule.factory('dialogsHandler', ['$rootScope', '$localStorage', 'stringify', 'checkFordialogs', 'removeDialogs', 'resetStorage', function ($rootScope, $localStorage, stringify, checkFordialogs, removeDialogs, resetStorage) {
    var Dialogs = {
        error: function (message, code) {
            $localStorage.error.status = true;
            $localStorage.error.message = stringify.glue($localStorage.error.message, message, code);
            $localStorage.dialog = true;
            $rootScope.loading = false;
        },
        warning: function (message, code) {
            $localStorage.warning.status = true;
            $localStorage.warning.message = stringify.glue($localStorage.warning.message, message, code);
            $localStorage.dialog = true;
            $rootScope.loading = false;
        },
        success: function (message, code) {
            $localStorage.success.status = true;
            $localStorage.success.message = stringify.glue($localStorage.success.message, message, code);
            $localStorage.dialog = true;
            $rootScope.loading = false;
        },
        info: function (message, code) {
            $localStorage.info.status = true;
            $localStorage.info.message = stringify.glue($localStorage.info.message, message, code);
            $localStorage.dialog = true;
            $rootScope.loading = false;
        },
        removeDialog: function (type, code) {
            if (checkFordialogs.check($localStorage)) {
                $localStorage = removeDialogs.cut(type, code, $localStorage);
            } else {
                resetStorage.renew();
            }
        },
        removeAlldialog: function () {
            resetStorage.renew();
        }
    };
    return Dialogs;
}]);

appModule.factory('Avalara', ['$http', function ($http) {
    var Avalara = {
        post: function (data) {
            return $http.post('/api/avalara/v1/verify/location', data);
        }
    }
    return Avalara;
}]);

appModule.factory('GeoLocationRates', ['$http', function ($http) {
    var GeoLocationRates = {
        post: function (data) {
            return $http.post('/api/vehicle/v1/geoLocationRates', data);
        }
    }
    return GeoLocationRates;
}]);

appModule.factory('getDataone', ['$http', '$localStorage', function ($http, $localStorage) {
    var Dataone = {
        post: function (data) {
            return $http.post('/api/dataone/v1/vehicle', data);
        }
    };
    return Dataone;
}]);

appModule.factory('fields', function () {
    var Fields = {
        transaction_type: {
            show: true,
            required: true
        },
        new_or_used: {
            show: false,
            required: false
        },
        type_of_plate: {
            show: false,
            required: false
        },
        number_of_passengers: {
            show: false,
            required: false
        },
        vin: {
            show: false,
            required: false
        },
        vehicle_type: {
            show: false,
            required: false
        },
        model_year: {
            show: false,
            required: false
        },
        mortgage_fee: {
            show: false,
            required: false
        },
        address: {
            show: false,
            required: false
        },
        street_address: {
            show: false,
            required: false
        },
        zip: {
            show: false,
            required: false
        },
        city_limits: {
            show: true,
            required: false
        },
        resident_county: {
            show: false,
            required: false
        },
        processing_county: {
            show: false,
            required: false
        },
        empty_weight: {
            show: false,
            required: false
        },
        trailer_weight: {
            show: false,
            required: false
        },
        carrying_capacity: {
            show: true,
            required: true
        },
        cc_displacement: {
            show: true,
            required: true
        },
        gvw: {
            show: false,
            required: false
        },
        gvwr: {
            show: false,
            required: false
        },
        inspection_fee: {
            show: false,
            required: false
        },
        inspection_type: {
            show: false,
            required: false
        },
        freight: {
            show: false,
            required: false
        },
        sales_price: {
            show: false,
            required: false
        },
        rebate_discount: {
            show: false,
            required: false
        },
        trade_in_value: {
            show: false,
            required: false
        },
        taxable_value: {
            show: false,
            required: false
        },
        fuel_type: {
            show: false,
            required: false
        },
        date_of_sale: {
            show: false,
            required: false
        },
        no_fees: {
            show: false,
            required: true
        },
        farm_use: {
            show: false,
            required: true
        },
        temp_tag: {
            show: false,
            required: true
        },
        is_trade_in_leased: {
            show: false,
            required: true
        },
        farm_ranch: {
            show: false,
            required: true
        },
        member_of_military: {
            show: false,
            required: true
        },
        off_highway_use: {
            show: false,
            required: true
        },
        rebuilt_salvage: {
            show: false,
            required: true
        },
        exempt_from_sales_tax: {
            show: false,
            required: true
        },
        did_pull_a_trailer: {
            show: false,
            required: true
        },
        is_vehicle_for_hire: {
            show: false,
            required: false
        },
        include_inspection_fee: {
            show: false,
            required: true
        },
        include_late_fees: {
            show: false,
            required: true
        },
        include_vit_tax: {
            show: false,
            required: true
        },
        miscellaneous_fee: {
            show: false,
            required: false
        },

        transfer_plate: {
            show: false,
            required: false
        },
        vehicle_financed: {
            show: false,
            required: false
        },
        add_accessories: {
            show: false,
            required: false
        },
        add_warranty: {
            show: false,
            required: false
        },
        number_of_axles: {
            show: false,
            required: false
        },
        warranty: {
            show: false,
            required: false
        },
        accessories: {
            show: false,
            required: false
        },

    }
    return Fields;
});


// Unique for Texas

appModule.factory('taxTypes', function () {
    var Tax = {
        Type: function (type, state) {
            var taxes = {};
            switch (type) {
                case 1:
                    taxes = {
                        state: state,
                        sales_tax: true,
                        gift_tax: false,
                        new_registration_tax: false,
                        even_trade_tax: false,
                        vit_tax_rate: 0.005
                    };
                    break;
                case 2:
                    taxes = {
                        state: state,
                        sales_tax: false,
                        gift_tax: true,
                        new_registration_tax: false,
                        even_trade_tax: false,
                        vit_tax_rate: 0.005
                    };
                    break;
                case 3:
                    taxes = {
                        state: state,
                        sales_tax: false,
                        gift_tax: false,
                        new_registration_tax: true,
                        even_trade_tax: false,
                        vit_tax_rate: 0.005
                    };
                    break;
                case 4:
                    taxes = {
                        state: state,
                        sales_tax: false,
                        gift_tax: false,
                        new_registration_tax: false,
                        even_trade_tax: true,
                        vit_tax_rate: 0.005
                    };
                    break;
            }
            return taxes;
        }
    }
    return Tax;
});
