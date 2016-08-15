/**
 * Creates scrollbar
 */

appModule.directive("scroll", function () {
    return {
        restrict: "A",
        link: function (scope, elem, attrs, ngModelCtrl) {
            elem.mCustomScrollbar({
                autoHideScrollbar: true,
                contentTouchScroll: 25
            });
        }
    }
});

/**
 * Calculates body height and create an scrollable panel
 */

appModule.directive("templatemap", function () {
    return {
        restrict: "A",
        link: function (scope, elem, attrs, ngModelCtrl) {
            var view = angular.element(window);
            var header = elem.find('header');
            var container = elem.find('div.container');
            var sidebar = elem.find('div.sidebar');
            var logo = elem.find('div.logo-container');
            var groups = sidebar.children('span.group');
            var subGroups = sidebar.children('div.group-tabs');

            scope.viewHeight = view.height();
            scope.headerHeight = header.outerHeight();
            scope.containerHeight = container.outerHeight();
            scope.totalSpanheight = 0;
            scope.allowedHeight = 0;
            scope.sidebarHeight = 0;

            var resizeSidebar = function () {
                scope.sidebarHeight = parseFloat(scope.headerHeight) + parseFloat(scope.containerHeight);
                scope.allowedHeight = scope.sidebarHeight - scope.totalSpanheight - 72;
                $(sidebar).css('height', scope.sidebarHeight + "px");
            }

            view.on('resize', function () {
                scope.viewHeight = view.height();
                scope.headerHeight = header.outerHeight();
                scope.containerHeight = container.outerHeight();
                resizeSidebar();
            });

            groups.each(function (index) {
                scope.totalSpanheight += parseFloat($(this).outerHeight());
            });

            scope.totalSpanheight += parseFloat(logo.outerHeight());

            resizeSidebar();

            elem.append('<style rel="stylesheet" type="text/css">.sub-group-tabs.upcoming{height:' + scope.allowedHeight + 'px !important}</style>');

        }
    }
});

/**
 * Creates accordion for results
 */

appModule.directive("accord", function () {
    return {
        restrict: "A",
        link: function (scope, elem, attrs, ngModelCtrl) {
            elem.find('a').on("click", function (e) {
                e.preventDefault();
                if (!elem.find('.sub-panel').hasClass('open-sub')) {
                    elem.find('.sub-panel').addClass('open-sub');
                } else {
                    elem.find('.sub-panel').removeClass('open-sub');
                }
            });
        }
    }
});

/**
 * Create a datepicker UI using Jquery UI
 */

appModule.directive("datepicker", ['$timeout', function ($timeout) {
    return {
        restrict: "A",
        require: "ngModel",
        link: function (scope, elem, attrs, ngModelCtrl) {
            var updateModel = function (dateText) {
                scope.$apply(function () {
                    ngModelCtrl.$setViewValue(dateText);
                    ngModelCtrl.$render();
                });
            };
            var options = {
                dateFormat: "mm/dd/yy",
                nextText: "&#10095;",
                prevText: "&#10094;",
                onSelect: function (dateText) {
                    updateModel(dateText);
                }
            };
            elem.datepicker(options);
            $timeout(function () {
                updateModel($.datepicker.formatDate('mm/dd/yy', new Date()));
            }, 0);
        }
    }
}]);

/**
 * Calculates sales tax automatically
 */

appModule.directive("salestax", ['dialogsHandler', '$timeout', '$localStorage', function (dialogsHandler, $timeout, $localStorage) {
    return {
        restrict: "A",
        require: "ngModel",
        link: function (scope, elem, attrs, ngModelCtrl) {
            var monitize = function (value) {
                return value.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            /**
             *
             * @param value
             */
            var updateModel = function (value) {

                $localStorage.taxable_value = parseFloat(value.split(',').join(''));

                scope.$apply(function () {
                    if (parseFloat(value.split(',').join('')) > 0) {
                        $localStorage.taxable_value = parseFloat(value.split(',').join(''));
                        ngModelCtrl.$setViewValue(value);
                    } else {
                        $localStorage.taxable_value = 0;
                        ngModelCtrl.$setViewValue(0.00);
                    }

                    ngModelCtrl.$render();
                });
            }

            /**
             * Gets the total in the DOM.
             */
            var doThemath = function () {
                var total = 0;
                elem.find('input').each(function () {
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
                                if (name != 'trade_in_value') {
                                    total += thisVal;
                                }
                                break;
                            case '-':
                                if (name != 'trade_in_value') {
                                    total -= thisVal;
                                }
                                break;
                        }
                    }
                });

                console.log('Total is: ' + total);

                updateModel(monitize(total));
            }

            scope.$on('ttlTypesloaded', function () {
                $timeout(function () {
                    elem.find('input').each(function () {
                        $(this).on('blur', function () {
                            var el = $(this);
                            var title = el.attr('title');
                            var name = el.attr('name');
                            var thisVal = el.val();
                            if (thisVal) {
                                dialogsHandler.removeDialog('error', ngModelCtrl.$name);
                                if (!/[a-zA-Z\|\<\>\"\'\;\:\?\*\&\^\%\$\#\@\!\`\~\+\=\-\=\(\)]/g.test(thisVal)) {
                                    if (/[0-9]+(?:\,[0-9]*)?(?:\.[0-9]*)?/g.test(thisVal)) {
                                        el.val(monitize(parseFloat(thisVal.split(',').join(''))));
                                        dialogsHandler.removeDialog('error', ngModelCtrl.$name);
                                        el.removeClass('error-field');
                                    } else {
                                        el.val(monitize(parseFloat(thisVal)));
                                        dialogsHandler.removeDialog('error', ngModelCtrl.$name);
                                        el.removeClass('error-field');
                                    }
                                } else {
                                    el.val(null);
                                    if ($localStorage.fields[name].required) {
                                        el.addClass('error-field').attr('error', true);
                                        dialogsHandler.error(title + " should not be empty.", ngModelCtrl.$name);
                                    }
                                }
                            } else {
                                if ($localStorage.fields[name].required) {
                                    el.addClass('error-field').attr('error', true);
                                    dialogsHandler.error(title + " should not be empty.", ngModelCtrl.$name);
                                }
                            }
                            doThemath();
                        });
                    });
                }, 0, false);
            });
        }
    }
}]);


/**
 * Calculates Gross vehicle weights automatically
 */

appModule.directive("weights", ['$timeout', 'dialogsHandler', '$localStorage', function ($timeout, dialogsHandler, $localStorage) {
    return {
        restrict: "A",
        require: "ngModel",
        link: function (scope, elem, attrs, ngModelCtrl) {
            var numberize = function (value) {
                return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
            var updateModel = function (value) {
                scope.$apply(function () {
                    ngModelCtrl.$setViewValue(value);
                });
            }
            var doThemath = function () {
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

            // Add watcher if scope changes.
            // Listen to html if it changes.
            // alert(ngModelCtrl.$modelValue);

            /*scope.$watch('ngModelCtrl.$modelValue', function() {
             alert('hahaha');
             });*/

            scope.$on('ttlTypesloaded', function () {

                $timeout(function () {
                    elem.find('input').each(function () {
                        $(this).on('blur', function () {
                            var el = $(this);
                            var title = el.attr("title");
                            var name = el.attr("name");
                            var thisVal = el.val();
                            if (thisVal) {
                                dialogsHandler.removeDialog('error', name);
                                if (!/[a-zA-Z\|\<\>\"\'\;\:\?\*\&\^\%\$\#\@\!\`\~\+\=\-\=\(\)]/g.test(thisVal)) {
                                    if (/[0-9]+(?:\,[0-9]*)?(?:\.[0-9]*)?/g.test(thisVal)) {
                                        el.val(numberize(parseFloat(thisVal.split(',').join(''))));
                                        el.removeClass('error-field');
                                    } else {
                                        el.val(numberize(parseFloat(thisVal)));
                                        el.removeClass('error-field');
                                    }
                                } else {
                                    if ($localStorage.fields[name].required) {
                                        el.addClass('error-field').attr('error', true);
                                        dialogsHandler.error(title + " should not be empty.", name);
                                    }
                                    el.val(null);
                                }
                            } else {
                                if ($localStorage.fields[name].required) {
                                    el.addClass('error-field').attr('error', true);
                                    dialogsHandler.error(title + " should not be empty.", name);
                                }
                            }
                            doThemath();
                        });
                    });
                }, 0, false);
            });
        }
    }
}]);

appModule.directive('numeric', function () {
    return {
        restrict: "A",
        link: function (scope, elem, attr) {
            var numberize = function (value) {
                var str = value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                if (str.indexOf('.') === -1) {
                    str = String(str) + '.00';
                }

                return str;
            }

            elem.on('blur', function () {
                var val = elem.val();
                val = val.trim();

                if (isNaN(val) === true) {
                    elem.val("");
                } else {
                    if (val > 0) {
                        elem.val(numberize(val));
                    } else {
                        elem.val("");
                    }
                }
            });
        }
    }
});

/**
 * Validates and formats numbers as currency
 */

appModule.directive("currency", ['dialogsHandler', '$localStorage', function (dialogsHandler, $localStorage) {
    return {
        restrict: "A",
        require: "ngModel",
        link: function (scope, elem, attrs, ngModelCtrl) {
            var monitize = function (value) {
                return value.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
            elem.on('blur', function () {
                var el = $(this);
                var title = el.attr('title');
                var thisVal = el.val();
                if (thisVal) {
                    dialogsHandler.removeDialog('error', ngModelCtrl.$name);
                    if (!/[a-zA-Z\|\<\>\"\'\;\:\?\*\&\^\%\$\#\@\!\`\~\+\=\-\=\(\)]/g.test(thisVal)) {
                        if (/[0-9]+(?:\,[0-9]*)?(?:\.[0-9]*)?/g.test(thisVal)) {
                            el.val(monitize(parseFloat(thisVal.split(',').join(''))));
                            dialogsHandler.removeDialog('error', ngModelCtrl.$name);
                            el.removeClass('error-field');
                        } else {
                            el.val(monitize(parseFloat(thisVal)));
                            dialogsHandler.removeDialog('error', ngModelCtrl.$name);
                            el.removeClass('error-field');
                        }
                    } else {
                        if ($localStorage.fields[ngModelCtrl.$name].required) {
                            dialogsHandler.error(title + " should not be empty.", ngModelCtrl.$name);
                            el.addClass('error-field').attr('error', true);
                        }
                        el.val(null);
                    }
                } else {
                    if ($localStorage.fields[ngModelCtrl.$name].required) {
                        dialogsHandler.error(title + " should not be empty.", ngModelCtrl.$name);
                        el.addClass('error-field').attr('error', true);
                    }
                }
                scope.$apply();
            });
        }
    }
}]);

appModule.directive('capitalize', function () {
    return {
        restrict: "A",
        link: function (scope, elem, attr) {
            elem.on('blur', function () {
                if (typeof elem.val() !== "undefined") {
                    elem.val(elem.val().toUpperCase());
                }
            });
        }
    }
});

/**
 * Zip validator v2
 */

appModule.directive("streetAddress", ['$http', function ($http) {
    return {
        restrict: "A",
        link: function (scope, elem, attrs) {
            elem.on('click', function () {
                alert('Clicked')
            })
        }
    }
}]);

/**
 * end of Zip validator v2
 */


/**
 * Validates Zip
 */

appModule.directive('validateaddress', ['Resources', function (Resources) {
    return {
        restrict: "A",
        require: "ngModel",
        controller: function ($scope) {
            this.validateAddress = function () {
                $scope.loading = true;
                Resources.avalara({
                    street_address: $scope.params.street_address,
                    zip: $scope.params.zip,
                    api_key: 12345
                });
            }
        }
    }
}]);

appModule.directive("zip", ['$http', 'dialogsHandler', '$localStorage', function ($http, dialogsHandler, $localStorage) {
    return {
        restrict: "A",
        require: "^validateaddress",
        link: function (scope, elem, attrs, ngModelCtrl) {
            var validate = function (zip) {
                return /^\d{5}(-\d{4})?$/.test(zip);
            }

            elem.on('blur', function () {
                var el = $(this);
                var thisVal = el.val();

                var valid = $localStorage.state;
                if (thisVal) {
                    dialogsHandler.removeDialog('error', 700);
                    el.removeClass('error-field');
                    if (validate(thisVal)) {
                        dialogsHandler.removeDialog('error', 300);
                        $http.get('https://zip.getziptastic.com/v2/US/' + thisVal).then(function (response) {
                            if (response.data.state_short != valid) {
                                ngModelCtrl.validateAddress();
                                dialogsHandler.error("Zip entered does not belong to " + $localStorage.state + " state.", 200);
                                el.addClass('error-field').attr('error', true);
                            } else {
                                ngModelCtrl.validateAddress();
                                dialogsHandler.removeDialog('error', 200);
                                el.removeClass('error-field');
                            }
                        })
                    } else {
                        el.val(null);
                        dialogsHandler.error("Zip entered is not a valid Zip.", 300);
                        el.addClass('error-field').attr('error', true);
                    }
                } else {
                    if ($localStorage.fields.zip.required) {
                        dialogsHandler.error("Zip field cannot be empty.", 700);
                        el.addClass('error-field').attr('error', true);
                    }
                    dialogsHandler.removeDialog('error', 200);
                    dialogsHandler.removeDialog('error', 300);
                    el.removeClass('error-field');
                }
                scope.$apply();
            });
        }
    }
}]);

/*appModule.directive('addressandzip', ['$http', '$rootScope', function ($http, $rootScope) {
 return {
 restrict: "A",
 require: "ngModel",
 link: function (scope, elem, attr, ngModel) {
 var model_values = ngModel.$viewValue;

 scope.$watch('model_values.street_address', function() {
 alert('chnaged' + model_values.street_address);
 });
 }
 }
 }]);*/

/**
 * Validates LA Zip, both address and zip code.
 */
appModule.directive("addressandzip", ['$http', 'dialogsHandler', '$localStorage', function ($http, dialogsHandler, $localStorage) {
    return {
        restrict: "A",
        require: "ngModel",
        link: function (scope, elem, attrs, ngModelCtrl) {
            var addresses = elem.find('input');

            var validate_address = function (zip) {
                return /^\d{5}(-\d{4})?$/.test(zip);
            }

            var validate = function () {
                if (customer_address.val().trim() != "" && zip.val().trim() != "") {

                    // Model vars.
                    var model_values = ngModelCtrl.$viewValue;

                    dialogsHandler.removeDialog('error', 200);
                    dialogsHandler.removeDialog('success', 200);

                    var data = {
                        "api_key": "12345",
                        "street_address": customer_address.val().trim(),
                        "zip": zip.val().trim()
                    };

                    $http.post('/api/avalara/v1/verify/location', data).then(function (response) {
                        if (response.data.data.error) {
                            model_values.city = "";
                            model_values.county = "";
                            dialogsHandler.error("Address verification failed." + " " + response.data.data.error, 200);
                        } else {

                            // Get city and county.
                            var city = '';
                            county = '';

                            if (typeof response.data.data.location.Address.City != "undefined") {
                                city = response.data.data.location.Address.City;

                                model_values.city_limits = true;
                            } else {
                                model_values.city_limits = false;
                            }

                            if (typeof response.data.data.location.Address.County != "undefined") {
                                county = response.data.data.location.Address.County;
                            }

                            model_values.county = county;

                            // Check if there is a city.
                            if (city != '') {
                                // Set city params to true.
                                model_values.city = city;
                            } else {
                                model_values.city = "";
                            }

                            // see dialogs first.
                            console.log($localStorage.dialog);

                            // Remove error.
                            // dialogsHandler.removeDialog('Address verification failed. There\'s something wrong with your request. Please try again', 200);
                            elem.find('div > input').removeClass('error-field');

                            ngModelCtrl.$setViewValue(model_values);
                            ngModelCtrl.$render();
                        }
                    });
                } else {
                    dialogsHandler.info("Customer Address and Zip must both be populated.", 200);
                }
            }

            var customer_address = $(addresses[0]),
                zip = $(addresses[1]);

            customer_address.on("blur", function () {
                var customer_address_value = customer_address.val().trim();
                customer_address.val(customer_address.val().toUpperCase().trim());
                validate();
            });

            zip.on("blur", function () {
                var zip_value = zip.val().trim();
                zip.val(zip.val().toUpperCase().trim());
                validate();
            });
        }
    }
}]);

// Opens a modal after.
appModule.directive("addressandziptexas", ['$http', 'dialogsHandler', '$localStorage', function ($http, dialogsHandler, $localStorage) {
    return {
        restrict: "A",
        require: "ngModel",
        link: function (scope, elem, attrs, ngModelCtrl) {
            var addresses = elem.find('input');

            var validate_address = function (zip) {
                return /^\d{5}(-\d{4})?$/.test(zip);
            }

            var validate = function () {
                if (customer_address.val().trim() != "" && zip.val().trim() != "") {

                    // Model vars.
                    var model_values = ngModelCtrl.$viewValue;

                    dialogsHandler.removeDialog('error', 200);
                    dialogsHandler.removeDialog('success', 200);

                    var data = {
                        "api_key": "12345",
                        "street_address": customer_address.val().trim(),
                        "zip": zip.val().trim(),
                        "state": $localStorage.state
                    };

                    $http.post('/api/vehicle/v1/geoLocationRates', data).then(function (response) {
                        if (response.data.data.error) {
                            dialogsHandler.error("Address verification failed." + " " + response.data.data.error, 200);
                        } else {
                            model_values['Sales Tax Rate'] = response.data.data['Sales Tax Rates']['TaxDetails'];

                            // Modal param value.
                            model_values.modals.rates = true;

                            // Change processing county.
                            model_values.processing_county = response.data.data['Sales Tax Rates']['processing_county_id'];

                            // Apply changes in main controller.
                            ngModelCtrl.$setViewValue(model_values);
                            ngModelCtrl.$render();
                        }
                    });
                } else {
                    dialogsHandler.info("Customer Address and Zip must both be populated.", 200);
                }
            }

            var customer_address = $(addresses[0]),
                zip = $(addresses[1]);

            var customer_address_value = customer_address.val().trim(),
                zip_value = zip.val().trim();

            // if(customer_address.val().trim() != "" && zip.val().trim() != "")

            customer_address.on("blur", function () {
                customer_address.val(customer_address.val().toUpperCase().trim());
                validate();
            });

            zip.on("blur", function () {
                zip.val(zip.val().toUpperCase().trim());
                validate();
            });
        }
    }
}]);

// Opens a modal after.
appModule.directive("addressandziplouisiana", ['$http', 'dialogsHandler', '$localStorage', function ($http, dialogsHandler, $localStorage) {
    return {
        restrict: "A",
        require: "ngModel",
        link: function (scope, elem, attrs, ngModelCtrl) {
            var addresses = elem.find('input');

            var validate_address = function (zip) {
                return /^\d{5}(-\d{4})?$/.test(zip);
            }

            var validate = function () {
                if (customer_address.val().trim() != "" && zip.val().trim() != "") {

                    // Model vars.
                    var model_values = ngModelCtrl.$viewValue;

                    dialogsHandler.removeDialog('error', 200);
                    dialogsHandler.removeDialog('success', 200);

                    var data = {
                        "api_key": "12345",
                        "street_address": customer_address.val().trim(),
                        "zip": zip.val().trim(),
                        "state": $localStorage.state
                    };

                    $http.post('/api/vehicle/v1/geoLocationRates', data).then(function (response) {
                        console.log('Avalara With Rates: ');
                        console.log(response.data);
                        if (response.data.data.error) {
                            dialogsHandler.error("Address verification failed." + " " + response.data.data.error, 200);
                        } else {
                            // Get city and county.
                            var sales_tax_rates = response.data.data['Sales Tax Rates'];

                            console.log('sales_tax_rates: ');
                            console.log(sales_tax_rates);

                            var city = sales_tax_rates.city_name,
                                county = sales_tax_rates.county_name;

                            console.log('city: ' + city);
                            console.log('county: ' + county);

                            // Set param values.
                            model_values.county = sales_tax_rates.county_name;
                            model_values.city = sales_tax_rates.city_name;

                            model_values['Sales Tax Rate'].area_code = sales_tax_rates.area_code;
                            model_values['Sales Tax Rate'].area_tax = sales_tax_rates.area_tax;
                            model_values['Sales Tax Rate'].area_vendor_desc = sales_tax_rates.area_vendor_desc;
                            model_values['Sales Tax Rate'].parish_tax = sales_tax_rates.parish_tax;
                            model_values['Sales Tax Rate'].parish_vendor_desc = sales_tax_rates.parish_vendor_desc;

                            // Modal param value.
                            model_values.modals.rates = true;

                            if (city != '') {
                                // Set city params to true.
                                model_values.city_limits = true;
                            }

                            // Remove error fields.
                            elem.find('div > input').removeClass('error-field');

                            // Apply changes in main controller.
                            ngModelCtrl.$setViewValue(model_values);
                            ngModelCtrl.$render();
                        }
                    });
                } else {
                    dialogsHandler.info("Customer Address and Zip must both be populated.", 200);
                }
            }

            var customer_address = $(addresses[0]),
                zip = $(addresses[1]);

            customer_address.on("blur", function () {
                var customer_address_value = customer_address.val().trim(),
                    zip_value = zip.val().trim();

                customer_address.val(customer_address.val().toUpperCase().trim());
                validate();
            });

            zip.on("blur", function () {
                var customer_address_value = customer_address.val().trim(),
                    zip_value = zip.val().trim();

                zip.val(zip.val().toUpperCase().trim());
                validate();
            });
        }
    }
}]);

appModule.directive("autoaddress", ['$http', function ($http) {
    return {
        restrict: "A",
        require: "ngModel",
        link: function (scope, elem, attrs, ngModelCtrl) {
            // hoah.
            var placeSearch, autocomplete;
            var componentForm = {
                street_number: 'short_name',
                route: 'long_name',
                locality: 'long_name',
                administrative_area_level_1: 'short_name',
                country: 'long_name',
                postal_code: 'short_name'
            };

            function initAutocomplete() {
                // Create the autocomplete object, restricting the search to geographical
                // location types.
                autocomplete = new google.maps.places.Autocomplete(
                    (document.getElementById(attrs.id)),
                    {types: ['geocode']}
                );

                autocomplete.addListener('place_changed', fillInAddress);
            }

            function fillInAddress() {
                var address = autocomplete.getPlace().formatted_address;

                scope.$apply(function () {
                    ngModelCtrl.$setViewValue(address.toUpperCase());
                    ngModelCtrl.$render();
                });
            }

            initAutocomplete();
        }
    }
}]);

/**
 * Validates Vin
 */

appModule.directive("vin", ['dialogsHandler', '$localStorage', function (dialogsHandler, $localStorage) {
    return {
        restrict: "A",
        require: "ngModel",
        scope: {ctrlFn: '&'},
        link: function (scope, elem, attrs, ngModelCtrl) {
            var validate = function (vin) {
                return /^([a-zA-Z0-9_-]){17}$/.test(vin);
            }
            $localStorage.vinElement = elem;
            scope.validValue, scope.newValue, scope.empty = false;
            scope.$watch(function () {
                return ngModelCtrl.$modelValue;
            }, function (newVal, oldVal) {
                newVal != oldVal ? scope.newValue = true : scope.newValue = false;
                validate(newVal) ? scope.validValue = true : scope.validValue = false;
            });
            elem.on('focus', function () {
                if (ngModelCtrl.$modelValue) {
                    scope.validValue = validate(scope.oldValue);
                    scope.newValue = false;
                }
            });
            elem.on('keyup', function () {
                if (elem.val().trim().length === 17) {
                    if (scope.validValue && scope.newValue) {
                        elem.removeClass('error-field');
                        dialogsHandler.removeDialog('error', elem.attr('name'));
                        scope.ctrlFn();
                    } else if (!scope.validate && scope.newValue) {
                        elem.addClass('error-field').attr('error', true);
                        dialogsHandler.error("VIN pattern Invalid or Empty.", elem.attr('name'));
                    }
                }
            });
        }
    }
}]);

/**
 * Validates Vin
 */

appModule.directive("modal", function () {
    return {
        restrict: "A",
        require: "ngModel",
        link: function (scope, elem, attrs, ngModelCtrl) {
            elem.find('.close').on('click', function (e) {
                e.preventDefault();
                scope.$apply(function () {
                    ngModelCtrl.$setViewValue(false);
                });
            });
        }
    }
});


appModule.directive("selectcheck", ['dialogsHandler', '$localStorage', function (dialogsHandler, $localStorage) {
    return {
        restrict: "A",
        require: "ngModel",
        scope: {ctrlFn: '&'},
        link: function (scope, elem, attrs, ngModelCtrl) {
            if (attrs.name == 'vehicle_type') {
                scope.ctrlFn();
            }
            elem.on("change", function () {
                if ($localStorage.fields[ngModelCtrl.$name].required) {
                    var el = $(this);
                    var title = el.attr("title");
                    var thisVal = el.val().trim();
                    if (!thisVal || thisVal == "") {
                        dialogsHandler.error(title + " should not be empty.", ngModelCtrl.$name);
                        elem.addClass('error-field').attr('error', true);
                    } else {
                        dialogsHandler.removeDialog('error', ngModelCtrl.$name);
                        elem.removeClass('error-field');
                    }
                }
            });
        }
    }
}]);


appModule.directive("field", ['dialogsHandler', '$timeout', function (dialogsHandler, $timeout) {
    return {
        restrict: "A",
        require: "ngModel",
        link: function (scope, elem, attr, ngModelCtrl) {
            $timeout(function () {
                if (ngModelCtrl.$modelValue) {
                    elem.children('label').append('<span class="req-mark">*</span>');
                    elem.find('input').addClass('required-field').attr('error', true);
                    elem.find('select').addClass('required-field').attr('error', true);
                }
            }, 1000);
        }
    }
}]);

/**
 * ==================================================
 * Configuration V2 Directives
 * ==================================================
 */

appModule.directive("evalField", ['dialogsHandler', '$timeout', function (dialogsHandler, $timeout) {
    return {
        restrict: "A",
        require: "ngModel",
        scope: {
            fieldStatus: '='
        },
        link: function (scope, elem, attrs, ngModelCtrl) {
            var required = (attrs.fieldRequired === "true");

            if (required == true) {
                elem.children('label').append('<span class="req-mark">*</span>');
            }
        }
    }
}]);

/**
 * ==================================================
 * Configuration Version 2 Directives.
 * ==================================================
 */


appModule.directive("datepickerV2", ['$timeout', function ($timeout) {
    return {
        restrict: "A",
        require: "ngModel",
        link: function (scope, element, attributes, ngModelCtrl) {
            $timeout(function () {
                element.datepicker({
                    dateFormat: "mm/dd/yy",
                    nextText: "&#10095;",
                    prevText: "&#10094;",
                    onSelect: function (dateText) {
                        ngModelCtrl.$setViewValue(dateText);
                        ngModelCtrl.$render();
                    }
                });
            }, 200);
        }
    }
}]);

/**
 * ==================================================
 * Changes numeric values to dollar format.
 * ==================================================
 */

appModule.directive('didPullATrailer', function () {
    return {
        restrict: "A",
        require: "ngModel",
        scope: {
            ctrlFn: '&'
        },
        link: function (scope, element, attributes, ngModel) {
            element.on("change", function () {
                scope.ctrlFn();
            });
        }
    }
});

appModule.directive('vinNo', function () {
    return {
        restrict: "A",
        require: "ngModel",
        scope: {
            ctrlFn: '&'
        },
        link: function (scope, element, attributes, ngModel) {
            element.on('keyup', function () {

                // Validates 17 digit VIN.
                var validate = function (vin) {
                    return /^([a-zA-Z0-9_-]){17}$/.test(vin);
                }

                if (validate(element.val()) === true) {
                    // Reflect value in controller's scope.
                    ngModel.$setViewValue(element.val());

                    // Call controller function.
                    scope.ctrlFn();

                    // Remove input focus.
                    element.blur();
                }
            });
        }
    }
});

appModule.directive('geoLocation', function () {
    return {
        restrict: "A",
        require: "ngModel",
        scope: {
            ctrlFn: '&'
        },
        link: function (scope, element, attributes, ngModel) {
            element.on('focusout', function () {
                var value = element.val();

                if (typeof value !== "undefined" && value !== "") {
                    ngModel.$setViewValue(value.toUpperCase());
                    element.val(value.toUpperCase());

                    scope.ctrlFn();
                }
            });
        }
    }
});

appModule.directive('toDollarAndTotal', function () {
    return {
        restrict: "A",
        require: "ngModel",
        scope: {
            ctrlFn: '&'
        },
        link: function (scope, element, attributes, ngModel) {

            var monitize = function (value) {
                return value.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            element.unbind();

            element.on('focusout', function () {
                var value = element.val();

                // Remove all commas and set data type to float
                value = value.toString().replace(/,/g, '');
                value = parseFloat(value);

                // Change model value and display.
                if (isNaN(value) === true) {
                    value = 0.00;

                    ngModel.$setViewValue(value);
                    element.val(value);
                } else {
                    ngModel.$setViewValue(value);
                    element.val(monitize(value));
                }

                scope.ctrlFn();
            });
        }
    }
});

appModule.directive('toWeightAndTotal', function () {
    return {
        restrict: "A",
        require: "ngModel",
        scope: {
            ctrlFn: '&'
        },
        link: function (scope, element, attributes, ngModel) {

            var monitize = function (value) {
                return value.toFixed(0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            element.unbind();

            element.on('focusout', function () {
                var value = element.val();

                // Remove all commas and set data type to float
                value = value.toString().replace(/,/g, '');
                value = parseFloat(value);

                value = value.toString().split('.', value);
                value = (value.length == 2) ? parseFloat(value[0]) : parseFloat(value);

                console.log('VALUE: ' + value);

                // Change model value and display.
                if (isNaN(value) === true) {
                    value = 0.00;

                    ngModel.$setViewValue(value);
                    element.val(value);
                } else {
                    ngModel.$setViewValue(value);
                    element.val(monitize(value));
                }

                scope.ctrlFn();
            });
        }
    }
});

appModule.directive('toDollar', function () {
    return {
        restrict: "A",
        require: "ngModel",
        link: function (scope, elem, attrs, ngModelCtrl) {
            var monitize = function (value) {
                return parseFloat(value).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            // Watch ngmodel.
            scope.$watch(attrs.ngModel, function (newVal, oldVal) {
                elem.val(monitize(ngModelCtrl.$viewValue));
            });
        }
    }
});

appModule.directive('toWeight', function () {
    return {
        restrict: "A",
        require: "ngModel",
        link: function (scope, elem, attrs, ngModelCtrl) {
            var monitize = function (value) {
                return parseFloat(value).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            // Watch ngmodel.
            scope.$watch(attrs.ngModel, function (newVal, oldVal) {
                if (isNaN(ngModelCtrl.$viewValue)) {
                    ngModelCtrl.$viewValue = "";
                } else {
                    elem.val(monitize(ngModelCtrl.$viewValue));
                }
            });
        }
    }
});

/**
 * ==================================================
 * end of Configuration V2 Directives
 * ==================================================
 */

appModule.directive("updatetax", ['taxTypes', '$localStorage', function (taxTypes, $localStorage) {
    return {
        restrict: "A",
        scope: {ctrlFn: '&'},
        link: function (scope, elem, attr) {
            elem.on('change', function (e) {
                $localStorage.selectedTax = parseInt(elem.val());
                $localStorage.taxTypes = taxTypes.Type($localStorage.selectedTax, $localStorage.state);
                scope.ctrlFn();
            });
        }
    }
}]);

appModule.directive('calcui', ['$localStorage', function ($localStorage) {
    return {
        restrict: "A",
        controller: function ($scope) {
            // this.resetParams = function(){
            //   $localStorage.selectedVehicle = false;
            //   $scope.results = {};
            //   $scope.total.overall = 0;
            //   angular.forEach($scope.params, function(value, key){
            //     if(key != 'transaction_type'){
            //       $scope.params[key] = null;
            //     }
            //   });
            // }
        }
    }
}]);

appModule.directive('calculator', function () {
    return {
        restrict: "A",
        require: "^calcui",
        link: function (scope, elem, attr, ngModelCtrl) {
            /*elem.on("reset", function(){
             elem.find('input').each(function(){
             // ngModelCtrl.resetParams();
             $(this).removeClass('error-field');
             });
             });*/
        }
    }
});