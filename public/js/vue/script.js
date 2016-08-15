Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
Vue.http.headers.common['api_key'] = document.querySelector('#api_key').getAttribute('value');

// Date picker directive for dates not greater than current date
// bob martin principles of oop https://www.youtube.com/watch?v=TMuno5RZNeE

var body = $('body');
var container = body.find('.container');
var sidebar = body.find('.sidebar');
var windowHeight = $(window).height();
var headerHeight = body.find('header').height();

container.css('min-height', windowHeight - headerHeight + 'px');

body.on('click', '.desktop-menu-toggler', function (e) {
    e.preventDefault();

    container.toggleClass('menu-open');
    sidebar.toggleClass('menu-open');

});

Vue.directive('datepicker', {
    bind: function () {
        var vm = this.vm;
        var key = this.expression;
        var d = new Date();
        $(this.el).datepicker({
            maxDate: d,
            dateFormat: 'mm/dd/yy',
            defaultDate: d,
            onSelect: function (date) {
                vm.$set(key, date);
            }
        });
    },
    update: function (val) {
        $(this.el).datepicker('setDate', val);
    }
});

// Date picker directive for dates

Vue.directive('free-datepicker', {
    bind: function () {
        var vm = this.vm;
        var key = this.expression;
        $(this.el).datepicker({
            dateFormat: 'mm/dd/yy',
            onSelect: function (date) {
                vm.$set(key, date);
            }
        });
    },
    update: function (val) {
        $(this.el).datepicker('setDate', val);
    }
});

// Controller for state Fees
new Vue({
    el: '#header',

    data: {
        state: '',
        section: '',
        nav: false
    },

    ready: function () {
        this.splitPath();
    },

    methods: {

        changeState: function () {
            var search = window.location.search;
            location.replace('/' + this.section + '/' + this.state + search);
        },

        splitPath: function () {
            var path = window.location.pathname;
            var paths = path.split('/');
            this.state = paths[2];
            this.section = paths[1];
        },

        showNav: function () {
            this.nav = !this.nav;
        }
    }
});

new Vue({
    el: '#manage-state-fees-penalties-tax',

    data: {
        updates: {
            category: '',
            type: ''
        },
        state: '',
        enable: false,
        show: false,
        empty: false
    },

    computed: {
        errors: function () {
            for (var key in this.updates) {
                if (!this.updates[key]) return true;
            }

            return false;
        }
    },

    ready: function () {
        // this.fetchInFees();
    },

    methods: {

        fetchTypes: function () {
            console.log('/api/manage/types/' + this.updates.category);
            this.$set('fees', '');
            this.$http.get('/api/manage/types/' + this.updates.category, function (response) {
                this.$set('types', response.data);
                this.enable = true;
            }).error(function () {
                alert('Oops something went wrong!');
            });
        },

        fetchFees: function () {
            if (this.updates.type) {
                this.show = true;

                console.log('/api/manage/fees/state/' + this.state + '/' + this.updates.type);

                this.$http.get('/api/manage/fees/state/' + this.state + '/' + this.updates.type, function (fees) {

                    this.displayInfo(fees);
                    this.$set('fees', fees);
                }).error(function () {
                    alert('Oops something went wrong!');
                });
            } else {
                this.$set('fees', null);
            }
        },

        fetchPenalties: function () {
            if (this.updates.type) {
                this.show = true;
                this.$http.get('/api/manage/penalties/state/' + this.state + '/' + this.updates.type, function (penalties) {
                    this.displayInfo(penalties);
                    this.$set('penalties', penalties);
                }).error(function () {
                    alert('Oops something went wrong!');
                });
            } else {
                this.$set('fees', null);
            }
        },

        fetchTax: function () {
            if (this.updates.type) {
                this.show = true;
                this.$http.get('/api/manage/tax/state/' + this.state + '/' + this.updates.type, function (fees) {
                    this.displayInfo(fees);
                    this.$set('fees', fees);
                }).error(function () {
                    alert('Oops something went wrong!');
                });
            } else {
                this.$set('fees', null);
            }
        },

        fetchData: function (a) {
            switch (a) {
                case 'fees':
                    this.fetchFees();
                    break;
                case 'penalties':
                    this.fetchPenalties();
                    break;
                case 'tax':
                    this.fetchTax();
                    break;
                default:
                    alert('Oops! Something went wrong!');
                    break;
            }
        },

        editThis: function (a) {

            if (a.amount != null) {
                a.edit = !a.edit;

                if (a.edit) {
                    a.button = 'Cancel';
                    a.update = true;
                } else {
                    a.button = 'Edit'
                    a.amount = a.originalAmount;
                    a.update = false;
                }
            } else {
                alert('For now we dont allow editing this value yet.');
            }

        },

        updateThis: function (a) {
            this.$http.post('/api/manage/update/state/table/' + this.state + '/' + a.fee_id + '/' + this.updates.type + '/' + a.amount, function (response) {
                if (response) {
                    alert('Succes! ' + a.fee_name + ' is updated!');
                }
                this.refreshView();
            }).error(function () {
                alert('Oops something went wrong!');
            });
        },

        refreshView: function () {
            switch (this.scope) {
                case 'fees':
                    this.fetchFees();
                    break;
                case 'penalties':
                    this.fetchPenalties();
                    break;
                case 'tax':
                    this.fetchTax();
                    break;
            }
        },

        displayInfo: function (a) {
            if (a.length) {
                this.empty = false;
            } else {
                this.empty = true;
                this.show = false;
            }
        }
    }
});

// Controller for Cities Fees manager

new Vue({
    el: '#manage-county-fees-city-fees',

    data: {
        citiesFees: [],
        originalAmount: '',
        originalStartDate: '',
        originalEndDate: '',
        updates: {
            county: '',
            category: '',
            type: ''
        }
    },

    ready: function () {
        // Load city fees.
        this.fetchCitiesFees();
    },

    methods: {
        fetchCitiesFees: function () {

            this.$http.get('/api/manage/citiesFees/state/Louisiana', function (response) {
                // this.citiesFees = response.data;

                this.$set('citiesFees', response.data);
            }).error(function () {
                alert('Oops something went wrong!');
            });

        },

        editThis: function (a) {

            if (a.edit == 'Edit') {
                a.edit = 'Cancel';
                a.button = false;
            } else if (a.edit == 'Cancel') {
                a.edit = 'Edit';
                a.button = true;
                a.fee_amount = a.originalAmount;
                a.formatted_start_date = a.originalStartDate;
                a.formatted_end_date = a.originalEndDate;
            }

        },

        updateThis: function (a) {

            if (a.fee_amount != '') {
                if (a.edit == 'Cancel') {
                    this.$http.post('/api/manage/update/updateCityFees/' + a.city_id + '/' + a.fee_id + '/' + a.fee_amount + '/' + a.formatted_start_date + '/' + a.formatted_end_date, function (response) {
                        if (response == 'Updated') {
                            alert('Success! ' + a.fee_amount + ' is updated!');
                            this.fetchCitiesFees();
                        } else {
                            alert(response);
                        }
                    }).error(function () {
                        alert('Oops something went wrong!');
                    });
                } else {
                    alert('Make nothing to edit');
                }
            } else {
                alert('Must not be empty.');
            }

        }
    }
});


// Controller for County Fees manager

new Vue({
    el: '#manage-county-fees-penalties-tax',

    data: {
        updates: {
            county: '',
            category: '',
            type: ''
        },
        state: '',
        enableChange: false,
        enableCounty: true,
        enableCategory: false,
        enableType: false,
        show: false,
        empty: false
    },

    computed: {
        errors: function () {
            for (var key in this.updates) {
                if (!this.updates[key]) return true;
            }

            return false;
        }
    },
    ready: function () {
        console.log('County Fees!');
    },

    methods: {
        countySelect: function () {
            this.enableCategory = true;
            this.enableCounty = false;
            this.enableChange = true;
        },
        changeCounty: function () {

            this.updates = {
                county: '',
                category: '',
                type: ''
            };
            this.$set('fees', null);
            this.enableCategory = false;
            this.enableCounty = true;
            this.enableChange = false;
        },
        fetchTypes: function () {
            this.$set('fees', null);
            this.$http.get('/api/manage/types/' + this.updates.category, function (response) {
                this.$set('types', response.data);
                this.enableType = true;
            }).error(function () {
                alert('Oops something went wrong!');
            });
        },

        fetchFees: function () {
            if (this.updates.type) {
                this.show = true;
                this.$http.get('/api/manage/fees/county/' + this.updates.county + '/' + this.updates.type, function (fees) {
                    this.displayInfo(fees);
                    this.$set('fees', fees);
                }).error(function () {
                    alert('Oops something went wrong!');
                });
            } else {
                this.$set('fees', null);
            }
        },

        fetchPenalties: function () {
            if (this.updates.type) {
                this.show = true;
                this.$http.get('/api/manage/penalties/county/' + this.updates.county + '/' + this.updates.type, function (penalties) {
                    this.displayInfo(penalties);
                    this.$set('penalties', penalties);
                }).error(function () {
                    alert('Oops something went wrong!');
                });
            } else {
                this.$set('fees', null);
            }
        },

        fetchTax: function () {
            if (this.updates.type) {
                this.show = true;
                this.$http.get('/api/manage/tax/county/' + this.updates.county + '/' + this.updates.type, function (penalties) {
                    this.displayInfo(penalties);
                    this.$set('penalties', penalties);
                }).error(function () {
                    alert('Oops something went wrong!');
                });
            } else {
                this.$set('fees', null);
            }
        },

        fetchData: function (a) {
            switch (a) {
                case 'fees':
                    this.fetchFees();
                    break;
                case 'penalties':
                    this.fetchPenalties();
                    break;
                case 'tax':
                    this.fetchTax();
                    break;
                default:
                    alert('Oops! Something went wrong!');
                    break;
            }
        },

        editThis: function (a) {

            if (a.amount != null) {
                a.edit = !a.edit;

                if (a.edit) {
                    a.button = 'Cancel';
                    a.update = true;
                } else {
                    a.button = 'Edit'
                    a.amount = a.originalAmount;
                    a.update = false;
                }
            } else {
                alert('For now we dont allow editing this value yet.');
            }

        },

        updateThis: function (a) {
            this.$http.post('/api/manage/update/county/table/' + this.updates.county + '/' + a.fee_id + '/' + this.updates.type + '/' + a.amount, function (response) {
                if (response) {
                    alert('Succes! ' + a.fee_name + ' is updated!');
                }
                this.fetchFees();
            }).error(function () {
                alert('Oops something went wrong!');
            });
        },

        displayInfo: function (a) {
            if (a.length) {
                this.empty = false;
            } else {
                this.empty = true;
                this.show = false;
            }
        }

    }

});

// Calculator here

new Vue({

    el: '#calculator',

    data: {
        vehicleIndex: null,
        selectedVehicle: null,
        oldVin: null,
        missing: true,
        defaultTax: 'SALES_TAX_RATE',
        temp_tag: true,
        trade_or_lease: false,
        farm_or_ranch: false,
        member_military: false,
        off_highway_use: false,
        rebuilt_or_salvage: false
    },
    computed: {
        motorcycle: function () {
            if (this.clasification[this.vehicleClass].category == 'motorcycle') return true;
            return false;
        },
        address: function () {
            if (this.category == 4) {
                if (!this.params.address) return true;
            }
            return false;
        }
    },

    ready: function () {
        this.$set('sale_date', $.datepicker.formatDate('mm/dd/yy', new Date()));
        this.$set('taxable_value', null);
        this.$set('transactionType', null);
        this.$set('vehicleClass', "");
        this.$set('views', {
            fees: false,
            taxes: false,
            penalties: false,
            title: false,
            license: false,
            sales_tax: false,
            title_fees: false,
            inspection: false,
            other: false,
            property_tax: false
        });
        this.$set('params', {
            api_key: Vue.http.headers.common['api_key'],
            taxable_value: null,
            registration_year: 1,
            is_new_vehicle: 1,
            address: "",
            inspection_fee: null,
            sale_price: null,
            sales_tax_credit: null,
            rebate: null,
            trade_in: null,
            gvw: null,
            gvwr: null
        });
        this.$set('result', {
            fees: 0,
            tax: 0,
            penalties: 0
        });
        this.$set('total', 0);
        this.fetchCategoryTypes();
    },

    methods: {

        fetchCategoryTypes: function () {
            this.$http.get('/ajax/get/categories/', function (response) {
                if (response) {
                    this.$set('clasification', response);
                }
            }).error(function (response) {
                console.log('Error');
            });
        },

        showSub: function (a) {
            this.views[a] = !this.views[a];
        },

        trueVin: function () {
            var prefix = this.vin_pattern.substr(0, 8);
            var postfix = this.vin_pattern.substr(9, 2);
            return prefix + postfix;
        },

        reverseDate: function () {
            var dateComp = this.sale_date.split('/');
            return trueDate = dateComp[2] + '-' + dateComp[0] + '-' + dateComp[1];
        },

        serializeParams: function (a) {
            return encode = Object.keys(a).map(function (key) {
                return encodeURIComponent(key) + '=' + encodeURIComponent(a[key]);
            }).join('&');
        },

        getCatAndType: function () {
            this.setResutls();
            if (this.vin_pattern) {
                if (!this.selectedVehicle) {
                    try {
                        this.$http.get('/api/v1/vinpatterns/' + this.vin_pattern + '?api_key=' + Vue.http.headers.common['api_key'], function (response) {
                            if (response.response_code == 'SUCCESS') {
                                this.$set('vehicles', response.data);
                                this.$set('modal', true);
                            }
                        }).error(function (response) {
                            this.$set('server_error', response.response_msg);
                            this.$set('vin_error', true);
                            this.loading = false;
                        });
                    } catch (e) {
                        return null;
                    }
                } else {
                    if (this.oldvin != this.vin_pattern) {
                        this.selectedVehicle = null;
                        this.getCatAndType();
                    } else {
                        this.doCalculations();
                    }
                }
            }
        },

        setVehicle: function (a) {
            this.vehicleIndex = a;
            this.selectedVehicle = this.vehicles[this.vehicleIndex];
            this.params.gvwr = this.selectedVehicle.gross_vehicle_weight_rating.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            this.modal = false;
        },

        calculateData: function (a) {
            this.$http.post('/api/v1/calculate/' + this.state_code + '/?' + a, function (response) {
                if (response.response_code == 'SUCCESS') {
                    this.$set('success', true);
                    this.$set('result', response.data);
                    this.loading = false;
                    this.$set('vin_error', false);
                    this.modal = false;
                    this.$set('selectedTax', this.result.tax[this.defaultTax]);
                    this.getTotal();
                }
            }).error(function (response) {
                this.loading = false;
                this.modal = false;
                this.$set('vin_error', true);
                this.$set('server_error', response.response_msg);
            });
        },

        getResults: function (e) {
            e.preventDefault();
            this.$set('success', false);
            this.$set('result', {
                fees: 0,
                tax: 0,
                penalties: 0
            });
            if (!this.missing) {
                this.loading = true;
                // this.getCatAndType();
                this.vihicleSelected();
            }
        },

        vihicleSelected: function () {
            this.oldvin = this.vin_pattern;
            this.selectedVehicle = this.vehicles[this.vehicleIndex];
            this.params.category = this.clasification[this.vehicleClass].category;
            this.params.type = this.clasification[this.vehicleClass].type;
            // this.params.gvw = this.selectedVehicle.gross_vehicle_weight_rating;
            this.params.gvwr = this.selectedVehicle.gross_vehicle_weight_rating;
            this.params.fuel_type = this.selectedVehicle.fuel_type;
            this.params.model_year = this.selectedVehicle.model_year;
            this.params.vin_pattern = this.trueVin();
            this.params.taxable_value = this.taxable_value ? this.taxable_value.split(',').join('') : null;
            this.params.sale_date = this.reverseDate();
            this.$set('url_encoded', this.serializeParams(this.params));
            this.calculateData(this.url_encoded);
            this.modal = false;
        },

        doCalculations: function () {
            this.params.category = this.clasification[this.vehicleClass].category;
            this.params.type = this.clasification[this.vehicleClass].type;
            this.params.gvw = this.selectedVehicle.gross_vehicle_weight_rating;
            this.params.fuel_type = this.selectedVehicle.fuel_type;
            this.params.model_year = this.selectedVehicle.model_year;
            this.params.vin_pattern = this.trueVin();
            this.params.taxable_value = this.taxable_value ? this.taxable_value.split(',').join('') : null;
            this.params.sale_date = this.reverseDate();
            this.$set('url_encoded', this.serializeParams(this.params));
            this.calculateData(this.url_encoded);
        },

        submitVehicle: function () {
            this.params.type = this.vehicles[this.vehicleIndex].body_type
            this.calculateData();
        },

        searchCategoryByName: function () {
            for (var key in this.categories) {
                if (this.categories[key].name == this.params.category) return this.categories[key].id;
            }
            return null;
        },

        searchCategoryById: function () {
            for (var key in this.categories) {
                if (this.categories[key].id == this.category) return this.categories[key].name;
            }
            return null;
        },

        insFeetransform: function () {
            if (this.params.inspection_fee) {
                if (isNaN(parseFloat(this.params.inspection_fee))) {
                    this.params.inspection_fee = null;
                } else {
                    this.params.inspection_fee = parseFloat(this.params.inspection_fee).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }
            } else {
                this.params.inspection_fee = null;
            }
        },

        updateWeights: function () {

            var fields = ['carrying_capacity', 'empty_weight'];
            var gvw = 0;

            for (var i = 0; i < fields.length; i++) {
                if (this[fields[i]]) {
                    var val = this[fields[i]].split(',').join('');
                    if (isNaN(parseInt(val))) {
                        this.$set(fields[i], null);
                    } else {
                        gvw += parseInt(val);
                        this.params.gvw = gvw.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        this.$set(fields[i], parseInt(val).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    }
                } else {
                    this.$set(fields[i], null);
                }
            }

            return this;
        },

        updateTaxable: function () {

            var fields = ['trade_in', 'rebate', 'sale_price', 'sales_tax_credit'];

            for (var i = 0; i < fields.length; i++) {
                if (this.params[fields[i]]) {
                    var val = this.params[fields[i]].split(',').join('');
                    if (isNaN(parseFloat(val))) {
                        this.params[fields[i]] = null;
                    } else {
                        this.params[fields[i]] = parseFloat(val).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                } else {
                    this.params[fields[i]] = null;
                }
            }

            this.$set('taxable_value', this.params.sale_price);

            if (this.params.rebate && this.params.sale_price) {
                if (!isNaN(parseFloat(this.params.rebate.split(',').join('')))) {
                    this.$set('taxable_value', (parseFloat(this.params.sale_price.split(',').join('')) - parseFloat(this.params.rebate.split(',').join(''))).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                }
            }

            if (this.params.trade_in && this.params.sale_price) {
                if (!isNaN(parseFloat(this.params.trade_in.split(',').join('')))) {
                    this.$set('taxable_value', (parseFloat(this.params.sale_price.split(',').join('')) - parseFloat(this.params.trade_in.split(',').join(''))).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                }
            }

            if (this.params.trade_in && this.params.sale_price && this.params.sales_tax_credit) {
                if (!isNaN(parseFloat(this.params.trade_in.split(',').join('')))) {
                    this.$set('taxable_value', (parseFloat(this.params.sale_price.split(',').join('')) - parseFloat(this.params.trade_in.split(',').join('')) - parseFloat(this.params.sales_tax_credit.split(',').join(''))).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                }
            }

            if (this.params.trade_in && this.params.sale_price && this.params.rebate) {
                if (!isNaN(parseFloat(this.params.trade_in.split(',').join('')))) {
                    this.$set('taxable_value', (parseFloat(this.params.sale_price.split(',').join('')) - parseFloat(this.params.rebate.split(',').join('')) - parseFloat(this.params.trade_in.split(',').join(''))).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                }
            }

            if (this.params.trade_in && this.params.sale_price && this.params.rebate && this.params.sales_tax_credit) {
                if (!isNaN(parseFloat(this.params.trade_in.split(',').join('')))) {
                    this.$set('taxable_value', (parseFloat(this.params.sale_price.split(',').join('')) - parseFloat(this.params.rebate.split(',').join('')) - parseFloat(this.params.trade_in.split(',').join('')) - parseFloat(this.params.sales_tax_credit.split(',').join(''))).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                }
            }

        },
        getTotal: function () {
            var total = 0;
            for (var key in this.sums) {
                var subKeys = this.sums[key].split(',');
                for (var i = 0; i < subKeys.length; i++) {
                    var rSubkey = subKeys[i];
                    for (var rKey in this.result) {
                        var feeType = this.result[rKey];
                        if (feeType.hasOwnProperty(rSubkey)) {
                            if (feeType[rSubkey] != null) {
                                total += parseFloat(feeType[rSubkey]);
                            }
                        }
                    }
                }
            }
            this.total = total;
            this.getPartialSums();
        },

        getPartialSums: function () {
            var fees = 0;
            var tax = 0;
            var penalties = 0;

            for (var key in this.partialSum) {
                var subKeys = this.partialSum[key].split(',');
                for (var i = 0; i < subKeys.length; i++) {
                    var subKey = subKeys[i];
                    for (var rKey in this.result) {
                        var result = this.result[rKey];
                        if (result.hasOwnProperty(subKey)) {
                            if (result[subKey] != null) {
                                if (key == 'total_fees') {
                                    fees += parseFloat(result[subKey]);
                                } else if (key == 'total_tax') {
                                    tax += parseFloat(result[subKey]);
                                } else {
                                    penalties += parseFloat(result[subKey]);
                                }
                            }
                        }
                    }
                }
            }

            this.total_fees = fees;
            this.total_tax = tax;
            this.total_penalties = penalties;
        },

        filterFee: function (a) {

            this.$set('licenseFeedefault', {
                temp_tag: 'TEMP_TAG_FEE',
                farm_or_ranch: 'YNG_FRMR_FEE'
            });
            var fees = a.split(',');
            for (var key in this.licenseFeedefault) {
                if (jQuery.inArray(this.licenseFeedefault[key], fees) > -1) {
                    var i = jQuery.inArray(this.licenseFeedefault[key], fees);
                    if (!this[key]) {
                        fees.splice(i, 1);
                    }
                }
            }

            return fees.join(',');
        },

        setResutls: function () {
            switch (parseInt(this.transactionType)) {
                case 2:
                    this.$set('sums', {
                        title_fees: 'TITLE_FEE,DUP_TITLE_FEE',
                        license_fees: this.filterFee('TEMP_TAG_FEE,DIESEL_FEE,INSP_FEE,YNG_FRMR_FEE'),
                        inspection_fees: 'INSP_FEE',
                        other_fees: 'DLR_LT_PNLTY,CASUAL_LT_PNLTY',
                        sales_tax: this.defaultTax + ',SALES_TAX_LT_PNLTY,EMISSION_FEE,EMM_SURCHARGE',
                        property_tax: 'VIT_TAX'
                    });
                    this.$set('partialSum', {
                        total_fees: this.filterFee('TITLE_FEE,TEMP_TAG_FEE,DIESEL_FEE,INSP_FEE,YNG_FRMR_FEE'),
                        total_tax: this.defaultTax + ',EMISSION_FEE,EMM_SURCHARGE',
                        total_penalties: 'DLR_LT_PNLTY,CASUAL_LT_PNLTY,SALES_TAX_LT_PNLTY'
                    });
                    break;
                case 3:
                    this.$set('sums', {
                        title_fees: 'TITLE_FEE,DUP_TITLE_FEE',
                        license_fees: '',
                        inspection_fees: '',
                        other_fees: '',
                        sales_tax: '',
                        property_tax: ''
                    });
                    this.$set('partialSum', {
                        total_fees: 'TITLE_FEE,DUP_TITLE_FEE',
                        total_tax: '',
                        total_penalties: ''
                    });
                    break;
                case 4:
                    this.$set('sums', {
                        title_fees: 'TITLE_FEE',
                        license_fees: this.filterFee('TEMP_TAG_FEE,INSP_FEE'),
                        inspection_fees: 'INSP_FEE',
                        other_fees: 'DLR_LT_PNLTY,CASUAL_LT_PNLTY',
                        sales_tax: this.defaultTax + ',SALES_TAX_LT_PNLTY',
                        property_tax: 'VIT_TAX'
                    });
                    this.$set('partialSum', {
                        total_fees: this.filterFee('TITLE_FEE,TEMP_TAG_FEE,INSP_FEE'),
                        total_tax: this.defaultTax + ',VIT_TAX',
                        total_penalties: 'DLR_LT_PNLTY,CASUAL_LT_PNLTY,SALES_TAX_LT_PNLTY'
                    });
                    break;
                case 5:
                    this.$set('sums', {
                        title_fees: '',
                        license_fees: this.filterFee('REG_FEE,AUTOMAT_FEE,REG_DPS_FEE,LOCAL_FEES,TEMP_TAG_FEE,DIESEL_FEE,INSP_FEE,YNG_FRMR_FEE'),
                        inspection_fees: 'INSP_FEE',
                        other_fees: 'DLR_LT_PNLTY,CASUAL_LT_PNLTY',
                        sales_tax: this.defaultTax + ',SALES_TAX_LT_PNLTY,EMISSION_FEE,EMM_SURCHARGE',
                        property_tax: 'VIT_TAX'
                    });
                    this.$set('partialSum', {
                        total_fees: this.filterFee('REG_FEE,AUTOMAT_FEE,REG_DPS_FEE,LOCAL_FEES,TEMP_TAG_FEE,DIESEL_FEE,INSP_FEE,YNG_FRMR_FEE'),
                        total_tax: this.defaultTax + ',EMISSION_FEE,EMM_SURCHARGE,VIT_TAX',
                        total_penalties: 'DLR_LT_PNLTY,CASUAL_LT_PNLTY,SALES_TAX_LT_PNLTY'
                    });
                    break;
                case 6:
                    this.$set('sums', {
                        title_fees: 'TITLE_FEE',
                        license_fees: '',
                        inspection_fees: '',
                        other_fees: '',
                        sales_tax: '',
                        property_tax: ''
                    });
                    this.$set('partialSum', {
                        total_fees: 'TITLE_FEE',
                        total_tax: '',
                        total_penalties: ''
                    });
                    break;
                default:
                    this.$set('sums', {
                        title_fees: 'TITLE_FEE,DUP_TITLE_FEE',
                        license_fees: this.filterFee('REG_FEE,AUTOMAT_FEE,REG_DPS_FEE,LOCAL_FEES,TEMP_TAG_FEE,DIESEL_FEE,INSP_FEE,YNG_FRMR_FEE'),
                        inspection_fees: 'INSP_FEE',
                        other_fees: 'DLR_LT_PNLTY,CASUAL_LT_PNLTY',
                        sales_tax: this.defaultTax + ',SALES_TAX_LT_PNLTY,EMISSION_FEE,EMM_SURCHARGE',
                        property_tax: 'VIT_TAX'
                    });
                    this.$set('partialSum', {
                        total_fees: this.filterFee('TITLE_FEE,DUP_TITLE_FEE,REG_FEE,AUTOMAT_FEE,REG_DPS_FEE,LOCAL_FEES,TEMP_TAG_FEE,DIESEL_FEE,INSP_FEE,YNG_FRMR_FEE'),
                        total_tax: this.defaultTax + ',EMISSION_FEE,EMM_SURCHARGE,VIT_TAX',
                        total_penalties: 'DLR_LT_PNLTY,CASUAL_LT_PNLTY,SALES_TAX_LT_PNLTY'
                    });
                    break;
            }
        },

        setConditions: function () {

            if (this.transactionType && this.required) {
                for (var i = 0; i < this.required.length; i++) {
                    var unwatch = this.$watch(this.required[i]);
                    unwatch();
                }
            }

            switch (parseInt(this.transactionType)) {
                case 3:
                    this.required = [
                        'transactionType',
                        'vin_pattern',
                        'vehicleClass',
                    ];
                    break;
                case 5:
                    this.required = [
                        'transactionType',
                        'vin_pattern',
                        'vehicleClass',
                        'sale_date'
                    ];
                    break;
                case 6:
                    this.required = [
                        'transactionType',
                        'vin_pattern',
                        'vehicleClass',
                    ];
                    break;
                default:
                    if (this.motorcycle) {
                        this.required = [
                            'transactionType',
                            'vin_pattern',
                            'vehicleClass',
                            'sale_date',
                            'params.address',
                            'params.zip'
                        ];
                    } else {
                        this.required = [
                            'transactionType',
                            'vin_pattern',
                            'vehicleClass',
                            'sale_date',
                            'empty_weight',
                            'carrying_capacity'
                        ];
                    }
                    break;
            }

            if (this.required) {
                for (var i = 0; i < this.required.length; i++) {
                    this.$watch(this.required[i], function (newVal, oldVal) {

                        var err = this.required.length;

                        if (newVal) {
                            for (var i = 0; i < this.required.length; i++) {
                                if (this[this.required[i]]) err--;
                            }
                        }

                        if (err > 0) {
                            this.missing = true;
                        } else {
                            this.missing = false;
                        }
                    });
                }
            }

            this.setResutls();

        }

    }
});

new Vue({
    el: '#louisiana-calculator',

    data: {
        missing: true,
        populate: false,
        types: '',
        parishes: '',
        ttltypes: '',
        cities: '',
        mortgage_fee: '',
        vin: '',
        plateTypes: '',
        hidden_plateTypes: '',
        real_plateTypes: '',
        taxAndFees: {
            fees: '',
            tax: '',
            penalties: '',
            sales_tax: '',
            tax_details: []
        },
        filters: {
            transaction_type: '',
            category: '',
            type: '',
            parish: '',
            vin: '',
            sales_price: '',
            street_address: '',
            amount: '',
            zip_code: '',
            model_year: '',
            discount: '',
            trade_in_val: '',
            taxable_value: '',
            type_of_plate: '',
            vin_body_subtype: '',
            vin_vehicle_type: '',
            farm_plate: false,
            carrying_capacity: '',
            trailer_weight: '',
            empty_weight: '',
            gvw: '',
            gvwr: '',
            city: '',
            region: '',
            date_of_sale: '',
            date_of_sale_status: false,
            sales_tax_credit: '',
            total: 0
        }
    },

    ready: function () {

        this.getTTLTypes();
        this.getTypes();
        this.getParishes();
        this.getPlateTypes();

        this.$set('filters.date_of_sale', $.datepicker.formatDate('mm/dd/yy', new Date()));

        this.$set('views', {
            titleFees: false,
            licenseFees: false,
            otherFees: false,
            taxAgencyFees: false,
            has_farm: false,
            show_farm: false,
            salesTax: false,
            modalAvalara: false,
            total: false,
            calculation_button: 'Calculate Fees and Taxes',
            calculating: false,
            trailer: false,

            form_fields: {
                transaction_type: true,
                type_of_plate: true,
                vin: true,
                vehicle_type: true,
                model_year: true,
                mortgage_fee: true,
                street_address: true,
                zip: true,
                parish: true,
                city_limits: true,
                empty_weight: false,
                carrying_capacity: false,
                gvw: false,
                gvwr: false,
                sales_price: true,
                rebate_discount: true,
                trade_in: true,
                sales_tax_credit: true,
                taxable_value: true,
                fuel_type: true,
                date_of_sale: true,
                trailer_field: false,
            }
        });

        // this.showWeightInputs();

    },

    computed: {
        address: function () {
            return true;
        }
    },

    methods: {
        updateVehicleWeight: function () {
            this.filters.gvwr = '';
        },

        updateVehicleWeightRating: function () {
            this.filters.empty_weight = '';
            this.filters.carrying_capacity = '';
            this.filters.gvw = '';
        },

        giveTempData: function () {
            this.filters.type = 'car.__.car';
            this.filters.transaction_type = 'NR';
            this.filters.street_address = '55 Tera Ave';
            this.filters.zip_code = '71303-2259';
            this.filters.sales_price = '100000';
            this.filters.taxable_value = '100000';
            this.filters.parish = 'Rapides';
            this.filters.TTLtype = 'Car Plate';

            this.validateCityAndState();
            this.getPlateTypes();
        },

        validateCityAndState: function () {
            this.filters.city = '';
            this.filters.region = '';


            if (this.filters.street_address != '' && this.filters.zip_code != '') {
                var url = '../api/v1/avalara/verify/?api_key=' + Vue.http.headers.common['api_key'];

                var data = {
                    "street_address": this.filters.street_address.trim(),
                    "zip_code": this.filters.zip_code.trim()
                };

                this.$http.get(url, data, function (response) {
                    if (typeof response['Address'] != 'undefined') {
                        var city = response['Address']['City'];
                        var region = response['Address']['Region'];

                        this.filters.city = city;
                        this.filters.region = region;

                        // alert('Validated with City of: ' + response['Address']['City'] + ' and Region of: ' + response['Address']['Region']);
                        alert('Street Address and Zip Code validated.');
                    } else {
                        alert('Street Address and Zip Code cannot be validated.');
                    }
                }).error(function (response) {
                    alert('Unable to connect to validation process.');
                    console.log(response);
                });
            }
        },

        showSub: function (a) {
            this.views[a] = !this.views[a];
        },

        /**
         * Update gvw
         */
        updateGvw: function () {
            this.setWeightDisplay();
            this.setTotalWeight();
        },

        setTotalWeight: function () {
            var empty_weight = this.filters.empty_weight.trim(),
                trailer_weight = this.filters.trailer_weight.trim(),
                carrying_capacity = this.filters.carrying_capacity.trim(),
                gvw = '';

            if (isNaN(empty_weight) == false && empty_weight != '') {
                if (gvw == '') {
                    gvw = 0;
                }

                gvw += parseFloat(empty_weight);
            }

            if (isNaN(trailer_weight) == false && trailer_weight != '') {
                if (gvw == '') {
                    gvw = 0;
                }

                gvw += parseFloat(trailer_weight);
            }

            if (isNaN(carrying_capacity) == false && carrying_capacity != '') {
                if (gvw == '') {
                    gvw = 0;
                }

                gvw += parseFloat(carrying_capacity);
            }

            this.filters.gvw = gvw;
        },

        setWeightDisplay: function () {
            var carrying_capacity = this.filters.carrying_capacity.trim(),
                trailer_weight = this.filters.trailer_weight.trim(),
                empty_weight = this.filters.empty_weight.trim();

            if (isNaN(carrying_capacity) == true) {
                this.filters.carrying_capacity = '';
            } else {
                this.filters.carrying_capacity = carrying_capacity;
            }

            if (isNaN(trailer_weight) == true) {
                this.filters.trailer_weight = '';
            } else {
                this.filters.trailer_weight = trailer_weight;
            }

            if (isNaN(empty_weight) == true) {
                this.filters.empty_weight = '';
            } else {
                this.filters.empty_weight = empty_weight;
            }
        },


        /**
         * Update taxable value.
         */
        updateTaxableValue: function () {
            this.setTotalTaxableValue();
            this.setDollarDisplay();
        },

        /**
         * For display.
         * Remove non numeric inputs.
         */
        setDollarDisplay: function () {
            // To dollar formats
            var taxable_value = this.toNumericFormat(this.filters.taxable_value),
                sales_price = this.toNumericFormat(this.filters.sales_price),
                discount = this.toNumericFormat(this.filters.discount),
                trade_in_val = this.toNumericFormat(this.filters.trade_in_val),
                sales_tax_credit = this.toNumericFormat(this.filters.sales_tax_credit);

            taxable_value = sales_price - discount - trade_in_val;
            if (this.filters.sales_price != "" || isNaN(this.filters.sales_price) == false) {
                this.filters.sales_price = this.toDollarFormat(sales_price);
            }

            if (this.filters.discount != "" || isNaN(this.filters.discount) == false) {
                this.filters.discount = this.toDollarFormat(discount);
            }

            if (this.filters.trade_in_val != "" || isNaN(this.filters.trade_in_val) == false) {
                this.filters.trade_in_val = this.toDollarFormat(trade_in_val);
            }

            if (this.filters.sales_tax_credit != "" || isNaN(this.filters.sales_tax_credit) == false) {
                this.filters.sales_tax_credit = this.toDollarFormat(sales_tax_credit);
            }

            if (this.filters.taxable_value != "" && isNaN(this.filters.taxable_value) == false) {
                if (this.filters.taxable_value < 0) {
                    this.filters.taxable_value = "-" + this.toDollarFormat(this.filters.taxable_value.toString().replace("-", ""));
                } else {
                    this.filters.taxable_value = this.toDollarFormat(this.filters.taxable_value);
                }
            }
        },

        setTotalTaxableValue: function () {
            var taxable_value = "",
                sales_price = this.toNumericFormat(this.filters.sales_price),
                discount = this.toNumericFormat(this.filters.discount),
                trade_in_val = this.toNumericFormat(this.filters.trade_in_val),
                sales_tax_credit = this.toNumericFormat(this.filters.sales_tax_credit);

            if (sales_price != "" && isNaN(sales_price) == false) {
                if (taxable_value == "") {
                    taxable_value = 0;
                }

                taxable_value = sales_price;
            }

            if (trade_in_val != "" && isNaN(trade_in_val) == false) {
                if (taxable_value == "") {
                    taxable_value = 0;
                }

                taxable_value = taxable_value - trade_in_val;
            }

            if (discount != "" && isNaN(discount) == false) {
                if (taxable_value == "") {
                    taxable_value = 0;
                }

                taxable_value = taxable_value - discount;
            }

            if (sales_tax_credit != "" && isNaN(sales_tax_credit) == false) {
                if (taxable_value == "") {
                    taxable_value = 0;
                }

                taxable_value = taxable_value - sales_tax_credit;
            }

            this.filters.taxable_value = taxable_value;
        },

        toDollarFormat: function format1(a) {
            a = parseFloat(a);

            if (a == 0) {
                return a + '.00';
            } else {
                if (a == "" || isNaN(a)) {
                    return "";
                } else {
                    return a.toFixed(2).replace(/./g, function (c, i, a) {
                        return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
                    });
                }
            }
        },

        toNumericFormat: function (a) {
            a = a.toString().replace(/[$|,]/g, "");

            if (isNaN(a) == true) {
                return 0;
            } else {
                return a;
            }
        },

        toNumeric: function (a) {

        },

        setPlateValue: function (a) {

        },

        /**
         * Get avalara by vin.
         */
        getAvalaraByVin: function () {
            // Hide view fields
            this.hideWeightInputs();

            // Calculate vin pattern if 17 characters.
            this.filters.vin = this.filters.vin.trim();

            if (this.filters.vin.length == 17) {
                this.getSampleVin();
            } else {
                alert('VIN is less than 17 digits.');
            }
        },
        /**
         * Function takes an object and determine's it's size.
         * @param obj
         * @returns {number}
         */
        getObjectSize: function (obj) {
            var size = 0, key;
            for (key in obj) {
                if (obj.hasOwnProperty(key)) size++;
            }
            return size;
        },

        loopTest: function (str) {
            return str + ' echoing cutler';
        },

        /**
         * Function to sort a JSON object's keys.
         * @param obj
         * @returns {{}}
         */
        sortObject: function (obj) {
            var keys = [];
            var sorted_obj = {};

            for (var key in obj) {
                if (obj.hasOwnProperty(key)) {
                    keys.push(key);
                }
            }

            // sort keys
            keys.sort();

            // create new array based on Sorted Keys
            jQuery.each(keys, function (i, key) {
                sorted_obj[key] = obj[key];
            });

            return sorted_obj;
        },

        /**
         * Function takes an array and filters it's contents using another array.
         * @param arr
         * @param filters
         * @returns {string}
         */
        filterTTLType: function (arr, filters) {
            var new_arr = '';

            var key = '',
                value = '',
                counter = 0;

            var fee_size = this.getObjectSize(arr);

            var hide_list = filters;

            // Open json element.
            new_arr += '{';

            for (var i in arr) {
                value = arr[i];
                key = i;

                // Hide list for title fees.
                if (hide_list.indexOf(key)) {
                    var storage_data = {key: key, value: value};

                    if (value != '') {
                        if (counter == fee_size - 1) {
                            new_arr += '"' + key + '": "' + value + '"';
                        } else {
                            new_arr += '"' + key + '": "' + value + '"' + ',';
                        }
                    } else {

                    }
                } else {
                    if (counter == fee_size - 1) {
                        new_arr += '"' + key + '": "' + value + '"';
                    } else {
                        new_arr += '"' + key + '": "' + value + '"' + ',';
                    }
                }

                counter = counter + 1;
            }
            new_arr += '}';
            new_arr = this.sortObject(JSON.parse(new_arr));

            return new_arr;
        },

        updateFarmUse: function () {
            if (this.filters.farm_plate == false) {
                this.$set('plateTypes', this.real_plateTypes);
                this.$set('filters.farm_plate', true);
            } else {
                this.$set('plateTypes', this.hidden_plateTypes);
                this.$set('filters.farm_plate', false);
            }
        },

        updateTrailerUse: function () {
            if (this.views.form_fields.trailer_field == false) {
                this.$set('views.form_fields.trailer_field', true);
            } else {
                this.$set('views.form_fields.trailer_field', false);

                this.$set('filters.gvw', this.filters.gvw - this.filters.trailer_weight);
                this.$set('filters.trailer_weight', '');
            }
        },

        updateFormDisplay: function () {
            var transactionType = this.filters.transaction_type;

            switch (transactionType) {
                case "NR":
                    this.views.form_fields.city_limits = true;
                    this.views.form_fields.date_of_sale = true;
                    this.views.form_fields.mortgage_fee = true
                    this.views.form_fields.parish = true;
                    this.views.form_fields.rebate_discount = true;
                    this.views.form_fields.sales_price = true;
                    this.views.form_fields.sales_tax_credit = true;
                    this.views.form_fields.street_address = true;
                    this.views.form_fields.taxable_value = true;
                    this.views.form_fields.type_of_plate = true;
                    this.views.form_fields.trade_in = true;
                    this.views.form_fields.zip = true;
                    break;
                case "TP":
                    this.views.form_fields.city_limits = true;
                    this.views.form_fields.date_of_sale = true;
                    this.views.form_fields.mortgage_fee = true
                    this.views.form_fields.parish = true;
                    this.views.form_fields.rebate_discount = true;
                    this.views.form_fields.sales_price = true;
                    this.views.form_fields.sales_tax_credit = true;
                    this.views.form_fields.street_address = true;
                    this.views.form_fields.taxable_value = true;
                    this.views.form_fields.type_of_plate = true;
                    this.views.form_fields.trade_in = true;
                    this.views.form_fields.zip = true;
                    break;
                case "DT":
                    this.views.form_fields.carrying_capacity = false;
                    this.views.form_fields.city_limits = false;
                    this.views.form_fields.date_of_sale = false;
                    this.views.form_fields.empty_weight = false;
                    this.views.form_fields.gvw = false;
                    this.views.form_fields.mortgage_fee = false
                    this.views.form_fields.parish = false;
                    this.views.form_fields.rebate_discount = false;
                    this.views.form_fields.sales_price = false;
                    this.views.form_fields.sales_tax_credit = false;
                    this.views.form_fields.street_address = false;
                    this.views.form_fields.taxable_value = false;
                    this.views.form_fields.type_of_plate = false;
                    this.views.form_fields.trade_in = false;
                    this.views.form_fields.zip = false;
                    break;
                case "TO":
                    this.views.form_fields.city_limits = true;
                    this.views.form_fields.date_of_sale = true;
                    this.views.form_fields.mortgage_fee = true
                    this.views.form_fields.parish = true;
                    this.views.form_fields.rebate_discount = true;
                    this.views.form_fields.sales_price = true;
                    this.views.form_fields.sales_tax_credit = true;
                    this.views.form_fields.street_address = true;
                    this.views.form_fields.taxable_value = true;
                    this.views.form_fields.type_of_plate = true;
                    this.views.form_fields.trade_in = true;
                    this.views.form_fields.zip = true;
                    break;
                case "RO":
                    this.views.form_fields.city_limits = true;
                    this.views.form_fields.date_of_sale = true;
                    this.views.form_fields.mortgage_fee = true
                    this.views.form_fields.parish = true;
                    this.views.form_fields.rebate_discount = true;
                    this.views.form_fields.sales_price = true;
                    this.views.form_fields.sales_tax_credit = true;
                    this.views.form_fields.street_address = true;
                    this.views.form_fields.taxable_value = true;
                    this.views.form_fields.type_of_plate = true;
                    this.views.form_fields.trade_in = true;
                    this.views.form_fields.zip = true;
                    break;
                case "TRC":
                    this.views.form_fields.carrying_capacity = false;
                    this.views.form_fields.city_limits = false;
                    this.views.form_fields.date_of_sale = false;
                    this.views.form_fields.empty_weight = false;
                    this.views.form_fields.gvw = false;
                    this.views.form_fields.mortgage_fee = false
                    this.views.form_fields.parish = false;
                    this.views.form_fields.rebate_discount = false;
                    this.views.form_fields.sales_price = false;
                    this.views.form_fields.sales_tax_credit = false;
                    this.views.form_fields.street_address = false;
                    this.views.form_fields.taxable_value = false;
                    this.views.form_fields.type_of_plate = false;
                    this.views.form_fields.trade_in = false;
                    this.views.form_fields.zip = false;
                    break;
                default:
                    this.views.form_fields.carrying_capacity = false;
                    this.views.form_fields.city_limits = false;
                    this.views.form_fields.date_of_sale = false;
                    this.views.form_fields.empty_weight = false;
                    this.views.form_fields.gvw = false;
                    this.views.form_fields.mortgage_fee = false
                    this.views.form_fields.parish = false;
                    this.views.form_fields.rebate_discount = false;
                    this.views.form_fields.sales_price = false;
                    this.views.form_fields.sales_tax_credit = false;
                    this.views.form_fields.street_address = false;
                    this.views.form_fields.taxable_value = false;
                    this.views.form_fields.type_of_plate = false;
                    this.views.form_fields.trade_in = false;
                    this.views.form_fields.zip = false;
                    break;
            }
        },

        getPlateTypes: function () {
            this.hideWeightInputs();
            this.$set('filters.TTLtype', '');

            var vehicle_type = this.setCategory()[0];

            if (vehicle_type == "") {
                vehicle_type = "none";
            }

            if (vehicle_type == "truck-tractor" || vehicle_type == "truck") {
                this.showWeightInputs();
                this.$set('views.trailer', true);
            } else {
                this.hideWeightInputs();
                this.$set('views.trailer', false);
            }

            // console.log(vehicle_type);

            //var url = '../api/manage/plateTypes/LA/' + vehicle_type + '/?api_key=' + Vue.http.headers.common['api_key'];

            var requestParams = {
                api_key: Vue.http.headers.common['api_key']
            };

            this.$http.get('../api/manage/plateTypes/LA/' + vehicle_type, requestParams, function (response) {
                var plateTypes = response.data;
                var real_plateTypes = response.data;
                var hidden_plateTypes = [];

                this.$set('views.has_farm', false);
                this.$set('filters.farm_plate', false);

                for (var i in plateTypes) {
                    if (plateTypes[i]['name'].match(/farm/ig)) {
                        this.$set('views.has_farm', true);
                    } else {
                        hidden_plateTypes.push(plateTypes[i]);
                    }
                }

                this.$set('filters.farm_plate', false);

                this.$set('real_plateTypes', real_plateTypes);
                this.$set('hidden_plateTypes', hidden_plateTypes);

                if (this.filters.farm_plate == false) {
                    this.$set('plateTypes', hidden_plateTypes);
                } else {
                    this.$set('plateTypes', real_plateTypes);
                }
            }).error(function (response) {
                alert('Unable to get plate types.');
                console.log(response);
            });
        },

        setVehicleType: function (vehicle_type) {
            vehicle_type = vehicle_type.toLocaleLowerCase().trim();

            var vehicle_types = this.types,
                type = '';

            if (vehicle_type == 'Car') {
                vehicle_type = 'passenger';
            }

            // Get key value pair and assign value then.
            for (var i in vehicle_types) {
                type = vehicle_types[i]['type'],
                    category = vehicle_types[i]['category'];

                if (vehicle_type == type) {
                    this.filters.type = type + '.__.' + category;
                }
            }

            console.log('filters.type is now: ' + this.filters.type);

            if (type == '') {
                alert('Vehicle Type Not Found.');
            }

            console.log('Vehicle Searched: ' + vehicle_type);
        },

        getSampleVin: function () {
            var vin_pattern = this.filters.vin;

            var params = {
                "api_key": Vue.http.headers.common['api_key']
            };

            this.$http.get('/api/v1/vinpatterns/' + vin_pattern, params, function (response) {
                if (response.response_code == 'SUCCESS') {
                    if (response.data.length == 1) {
                        this.selectVehicle(response.data[0]);
                    } else {
                        this.$set('vehicles', response.data);
                        this.$set('modal', true);
                    }
                }
            }).error(function (response) {
                alert('Error in fetching VIN pattern in the database: ' + vin_pattern);
            });
        },

        selectVehicle: function (a) {
            var vehicle_types = {
                "Car": "passenger",
                "Van": "van",
                "SUV": "suv",
                "Truck": "truck",
                "Truck Tractor": "truck-tractor",
                "Combination Truck": "combination-truck",
                "Private Bus": "private-bus",
                "Motor Bus": "motor-bus",
                "Motorcycle": "motorcycle",
                "Off-Road Motorcycle": "off-road-motorcycle",
                "Motor Home": "motor-home",
                "Trailer": "trailer",
                "Utility Trailer": "utility-trailer",
                "Collector Vehicle": "collector-vehicle",
                "Exempt Vehicle": "exempt-vehicle",
                "Boat Trailer": "boat-trailer"
            };

            this.setVehicleType(a.vehicle_type);
            this.filters.model_year = a.year;

            this.$set('filters.model_year', a.year);
            this.$set('filters.gvwr', a.gross_vehicle_weight_rating);
            this.$set('filters.empty_weight', '');
            this.$set('filters.carrying_capacity', '');

            this.$set('modal', false);

            this.updatePlateTypes(a);
            this.getPlateTypes();

            if (isNaN(a.gross_vehicle_weight_rating) == false) {
                gvw = a.gross_vehicle_weight_rating;

                if (gvw >= 10000) {
                    this.$set('filters.gvwr', gvw);

                    this.showWeightInputs();
                }
            }
        },

        hideWeightInputs: function () {
            this.$set('views.form_fields.empty_weight', false);
            this.$set('views.form_fields.carrying_capacity', false);
            this.$set('views.form_fields.gvw', false);

            this.$set('filters.empty_weight', '');
            this.$set('filters.trailer_weight', '');
            this.$set('filters.carrying_capacity', '');
            this.$set('filters.gvw', '');
        },

        showWeightInputs: function () {
            this.$set('views.form_fields.empty_weight', true);
            this.$set('views.form_fields.carrying_capacity', true);
            this.$set('views.form_fields.gvw', true);
        },

        verifyDate: function () {

        },

        updatePlateTypes: function (a) {
            var vehicle_type = a.vehicle_type,
                body_subtype = a.body_subtype;

            this.filters.vin_vehicle_type = a.vehicle_type;
            this.filters.vin_body_subtype = a.body_subtype;

            console.log('filters.vin_vehicle_type: ' + this.filters.vin_vehicle_type);
            console.log('filters.vin_body_subtype: ' + this.filters.vin_body_subtype);

        },


        /**
         * Prevents LA form from being submitted of date of sale is invalid.
         */
        calculate: function () {

            this.$set('success', false);
            this.$set('views.total', false);

            var date = this.filters.date_of_sale;

            var date_split = date.split('/'),
                date_split = date_split[2] + '-' + date_split[0] + '-' + date_split[1];

            this.$http.get('../api/manage/tax/dateValidation/' + date_split, function (response) {
                if (typeof response.msg != 'undefined') {
                    if (response.invalid_date == false) {
                        this.$set('filters.date_of_sale_status', false);

                        // Proceed with calculation.
                        this.search();
                    } else {
                        alert(response.msg);
                    }
                } else {
                    alert('Date cannot be validated, please try calculating again.');
                }
            }).error(function () {
                alert('Date cannot be validated, please try calculating again.');
            });
        },

        validateAll: function () {
            if (this.filters.type == "") {
                alert('Please select a vehicle type.');
                return false;
            }

            if (this.filters.TTLtype == "") {
                alert('Please select a Type of Plate.');
                return false;
            }

            if (this.filters.transaction_type == "") {
                alert('Please select a transaction type.');
                return false;
            }

            if (this.filters.street_address == "") {
                alert('Please enter street address.');
                return false;
            }

            if (this.filters.zip_code == "") {
                alert('Please enter zip code.');
                return false;
            }

            if (this.filters.parish == "") {
                alert('Please select a parish.');
                return false;
            }

            if (this.filters.city == "" || this.filters.region == "") {
                alert('Address cannot be validated.');
                return false;
            }

            if (this.filters.sales_price == "") {
                alert('Please enter sales price.');
                return false;
            } else {
                var amount = this.toNumericFormat(this.filters.taxable_value);
            }

            var avalara_address = this.filters.street_address + ' ' + this.filters.city + ' ' +
                this.filters.region + ' ' + this.filters.zip_code;

            var date_split = this.filters.date_of_sale.split('/'),
                formatted_date = date_split[2] + '-' + date_split[0] + '-' + date_split[1];

            var cat_and_type = this.setCategory();

            var gvw = this.filters.gvw,
                gvwr = this.filters.gvwr,
                weight_value = '';

            if (this.filters.gvwr >= 10000) {
                weight_value = gvw;
            }


            var requestParams = {
                transaction_type: this.filters.transaction_type,
                type: cat_and_type[0],
                category: cat_and_type[1],
                office_loc: this.filters.city,
                parish: this.filters.parish,
                api_key: Vue.http.headers.common['api_key'],
                mortgage_fee: this.mortgage_fee,
                address: avalara_address,
                amount: amount,
                date_of_sale: formatted_date,
                city: this.filters.city,
                sales_tax_credit: this.filters.sales_tax_credit,
                type_of_plate: this.filters.TTLtype,
                gvwr: weight_value
            };

            return requestParams;
        },

        validateTitleRegistrationCorrection: function () {
            if (this.filters.transaction_type == "") {
                alert('Please select a transaction type.');
                return false;
            }

            if (this.filters.type == "") {
                alert('Please select a vehicle type.');
                return false;
            }

            var cat_and_type = this.setCategory();

            var requestParams = {
                transaction_type: this.filters.transaction_type,
                type: cat_and_type[0],
                category: cat_and_type[1],
                api_key: Vue.http.headers.common['api_key'],
                type_of_plate: this.filters.TTLtype
            };

            return requestParams;
        },

        validateDuplicateTitle: function () {
            if (this.filters.transaction_type == "") {
                alert('Please select a transaction type.');
                return false;
            }

            if (this.filters.type == "") {
                alert('Please select a vehicle type.');
                return false;
            }

            var cat_and_type = this.setCategory();

            var requestParams = {
                transaction_type: this.filters.transaction_type,
                type: cat_and_type[0],
                category: cat_and_type[1],
                api_key: Vue.http.headers.common['api_key'],
                type_of_plate: this.filters.TTLtype
            };

            return requestParams;
        },

        search: function () {
            var transactionType = this.filters.transaction_type,
                requestParams = '';

            switch (transactionType) {
                case "NR":
                    requestParams = this.validateAll();
                    break;

                case "TP":
                    requestParams = this.validateAll();
                    break;

                case "DT":
                    requestParams = this.validateDuplicateTitle();
                    break;

                case "TO":
                    requestParams = this.validateAll();
                    break;

                case "RO":
                    requestParams = this.validateAll();
                    break;

                case "TRC":
                    requestParams = this.validateTitleRegistrationCorrection();
                    break;

                default:
                    requestParams = this.validateAll();
                    break;
            }

            this.getCalculation(requestParams);
        },

        getCalculation: function (requestParams) {
            if (requestParams == false) {
                console.log('Invalid / Missing request parameters.');
                return;
            }

            console.log(requestParams);

            // Animation.
            this.$set('views.calculating', true);
            this.$set('views.calculation_button', 'Calculating...');
            this.$set('filters.total', 0);

            this.$http.post('../api/v1/calculate/LA', requestParams, function (response) {
                /*alert(response.data.fees.LICENSE_FEE.msg);
                 alert(response.data.fees.LICENSE_FEE.VALUE);
                 console.log(response.data.fees.LICENSE_FEE.sql_raw);*/

                if (response.response_code == 'SUCCESS') {

                    var taxes = response.data.tax,
                        fees = response.data.fees,
                        penalties = response.data.penalties;

                    if (typeof taxes['SALES_TAX_RATE']['Tax'] != "undefined") {
                        if (typeof taxes['SALES_TAX_RATE']['TaxDetails'] != "undefined") {
                            this.$set('views.modalAvalara', true);
                            this.$set('taxesAndFees.tax_details', taxes['SALES_TAX_RATE']['TaxDetails']);

                            var data = this.taxesAndFees.tax_details;

                            var saleTaxes = {
                                "AVALARA_TAX": taxes['SALES_TAX_RATE']['Tax'],
                                "SALES_TAX_PENALTY": taxes['SALES_TAX_RATE']['Sales Tax Penalty'],
                                "VENDORS_COMP": taxes['SALES_TAX_RATE']['Vendors Comp'],
                                "SALES_TAX_CREDIT": taxes['SALES_TAX_RATE']['Sales Tax Credit'],
                                "INTEREST": taxes['SALES_TAX_RATE']['Interest']
                            };

                            fees.VENDORS_COMP_AGENCY = taxes['SALES_TAX_RATE']['Vendors Comp'];
                            fees.LICENSE_FEE = fees['LICENSE_FEE']['VALUE'];

                            this.taxAndFees.sales_tax = saleTaxes;
                        }
                    } else {
                        var saleTaxes = {
                            "AVALARA_TAX": "",
                            "SALES_TAX_PENALTY": "",
                            "VENDORS_COMP": "",
                            "SALES_TAX_CREDIT": "",
                            "INTEREST": ""
                        };

                        fees.VENDORS_COMP_AGENCY = "";
                        fees.LICENSE_FEE = "";

                        this.taxAndFees.sales_tax = saleTaxes;
                    }

                    this.$set('taxAndFees.fees', fees);
                    this.$set('taxAndFees.tax', taxes);
                    this.$set('taxAndFees.penalties', penalties);

                    var feeKeys = 'TITLE_FEE,DUP_TITLE_FEE,TITLE_CORRECTION_FEE,MORTGAGE_FEE,LICENSE_PNLTY_FEE,LICENSE_FEE,' +
                            'LICENSE_TRNSFR_FEE,HANDLING_FEE,NOTARY_FEE,CONVENIENCE_FEE,PROCESSING_FEE,MAIL_FEE,VENDORS_COMP_AGENCY',

                        taxKeys = 'AVALARA_TAX,SALES_TAX_PENALTY,VENDORS_COMP,INTEREST';

                    // Set total fees and taxes.
                    var feesTotal = this.getTotal(this.taxAndFees.fees, feeKeys),
                        taxTotal = this.getTotal(this.taxAndFees.sales_tax, taxKeys),
                        totalFeesAndTaxes = parseFloat(feesTotal) + parseFloat(taxTotal);

                    this.$set('filters.total', totalFeesAndTaxes);
                    this.$set('views.total', true);

                    this.$set('success', true);
                } else {
                    alert('No results Found.');
                    console.log(response);
                }

                // Animation.
                this.$set('views.calculating', false);
                this.$set('views.calculation_button', 'Calculate Fees and Taxes');

            }).error(function () {
                alert('Fetch error.');
                console.log(requestParams);

                // Animation.
                this.$set('views.calculating', false);
                this.$set('views.calculation_button', 'Calculate Fees and Taxes');
            });
        },

        getTotal: function (items, subitems) {
            var total = 0;
            var subitems = subitems.split(',');
            var decimal = '';
            var number = '';
            var loop_val = '';

            for (var i = 0; i < subitems.length; i++) {
                loop_val = items[subitems[i]];

                if (typeof loop_val != 'undefined' && loop_val != '') {
                    number = parseFloat(loop_val);

                    // Set to negative if vendor's comp per hoke's request.
                    if (subitems[i] == 'VENDORS_COMP') {
                        number = number * -1;
                    }

                    if (!isNaN(number)) {
                        total += parseFloat(number);
                    } else {
                        decimal = parseFloat(loop_val.match(/\$[0-9]*\.[0-9]*/g)[0].replace("$", ""));
                        if (!isNaN(decimal)) {
                            total += decimal;
                        }
                    }
                }

            }


            return total;
        },

        closeAvalaraModal: function () {
            this.$set('views.modalAvalara', false);
        },

        setCategory: function () {
            var split = this.filters.type.split('.__.');

            return split;
        },

        setCity: function () {
            this.$set('city', this.filters.city);
        },

        getTypes: function () {
            this.$http.post('../api/manage/stateTypes/LA', function (response) {
                this.$set('types', response.data);
            }).error(function () {
                alert('Oops something went wrong with Types!');
            });
        },
        getParishes: function () {
            this.$http.get('../api/manage/parishes', function (response) {
                this.$set('parishes', response.data);

                // console.log(this.types);
            }).error(function () {
                alert('Oops something went wrong!');
            });
        },
        getTTLTypes: function () {
            this.$http.get('../api/manage/TTLtypes/LA', function (response) {
                this.$set('ttltypes', response.data);
            }).error(function () {
                alert('Oops something went wrong!');
            });
        },
        getCities: function () {
            if (this.filters.parish != "") {
                this.$http.get('../api/manage/city/getByParish/' + this.filters.parish, function (response) {
                    this.$set('cities', response.data);
                }).error(function () {
                    alert('Oops something went wrong!');
                });
            } else {
                this.cities = {};
            }
        }
    }
});

new Vue({

    el: '#manage-state-dates',

    data: {
        edit: false,

        updates: {
            fee_type: ''
        },

        edits: null

    },

    computed: {
        errors: function () {
            for (var key in this.updates) {
                if (!this.updates[key]) return true;
            }
            return false;
        },

        show: function () {
            if (this.dates) return true;
            return false;
        },

        changed: function () {
            for (var key in this.original) {
                if (this.original[key] != this.edits[key]) return true;
            }
            return false;
        },

        success: function () {
            if (this.response) return true;
            return false;
        }
    },

    ready: function () {

    },

    methods: {
        fetchDates: function () {
            if (this.updates.fee_type) {
                this.$http.get('/api/manage/dates/state/' + this.state + '/' + this.updates.fee_type, function (dates) {
                    this.$set('dates', dates);
                }).error(function () {
                    alert('Oops something went wrong!');
                });
            } else {
                this.dates = null;
                console.log('Nothing Selected');
            }
        },

        editThis: function (a) {

            this.edits = this.dates[a];
            this.edit = true;
        },

        cancelEdit: function () {

            this.edit = false;

            for (var key in this.original) {
                this.edits[key] = this.original[key];
            }
        },

        updateValues: function () {
            if (this.changed) {
                this.$http.post('/api/manage/update/dates/table/' + this.encodeUrl(), function (response) {
                    if (response) {
                        this.edit = false;
                        this.$set('response', response);
                        this.fetchDates();
                    }
                }).error(function () {
                    alert('Oops something went wrong!');
                });
            } else {
                console.log('Nothing Selected');
            }
        },

        encodeUrl: function () {
            var d = this.edits;
            return encode = Object.keys(d).map(function (key) {
                return encodeURIComponent(key) + '=' + encodeURIComponent(d[key]);
            }).join('&');
        }
    }

});

Vue.filter('toFixed', function (value) {

    if (value == 'TBA') {
        return 'TBA';
    } else if (value == null) {
        return 'TBA';
    } else {
        return value.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

});

Vue.filter('toPercentage', function (number) {

    number = number * 100;
    number = number.toString();


    while (number.length < 4) {
        if (number.indexOf('.') !== -1) {
            number += '0';
        } else {
            number += '.';
        }
    }

    number = number + '%';

    return number;

});

Vue.filter('total', function (value) {

    var total = 0;

    if (value) {
        for (var key in value) {
            if (value.hasOwnProperty(key)) {
                if (!isNaN(value[key])) {
                    total += value[key];
                }
            }
        }

    }

    if (total === 'undefined') {
        total = 0;
    }

    return total;
});

Vue.filter('subTotal', function (items, subitems) {

    var total = 0;
    var subitems = subitems.split(',');

    for (var i = 0; i < subitems.length; i++) {
        if (!isNaN(items[subitems[i]])) {
            total += items[subitems[i]];
        }
    }
    ;

    return total;

});

Vue.filter('farmFilter', function (plateName, filter) {
    if (plateName == 'Farm Plate') {
        if (filter == true) {
            return plateName;
        }
    } else {
        return plateName;
    }
});


Vue.filter('subTotalWithString', function (items, subitems) {


    var total = 0;
    var subitems = subitems.split(',');
    var decimal = '';
    var number = '';
    var loop_val = '';

    for (var i = 0; i < subitems.length; i++) {
        loop_val = items[subitems[i]];

        if (typeof loop_val != 'undefined' && loop_val != '') {
            number = parseFloat(loop_val);

            // Set to negative if vendor's comp per hoke's request.
            if (subitems[i] == 'VENDORS_COMP') {
                number = number * -1;
            }

            if (!isNaN(number)) {
                total += parseFloat(number);
            } else {
                decimal = parseFloat(loop_val.match(/\$[0-9]*\.[0-9]*/g)[0].replace("$", ""));
                if (!isNaN(decimal)) {
                    total += decimal;
                }
            }
        }

    }


    return total;
});

Vue.filter('mixTotal', function (items, subitems) {
    var total = 0;
    var names = subitems.split(',');
    for (var key in items) {
        var feeObj = items[key];
        for (var subKeys in feeObj) {
            if (feeObj.hasOwnProperty(subKeys)) {
                for (var i = 0; i < names.length; i++) {
                    if (subKeys == names[i] && feeObj[subKeys] != null && !isNaN(feeObj[subKeys])) {
                        total += feeObj[subKeys];
                    } else {
                        total += 0;
                    }
                }
            } else {
                total += 0;
            }
        }
    }
    return total;
});

Vue.filter('grandTotal', function (items, subitems) {

    var total = 0;
    var subitems = subitems.split(',');

    for (var i = 0; i < subitems.length; i++) {
        var subTotal = 0;
        var value = items[subitems[i]];
        if (value != null) {
            for (var key in value) {
                if (value.hasOwnProperty(key)) {
                    if (!isNaN(value[key])) {
                        subTotal += value[key];
                    }
                }
            }
        } else {
            subTotal += 0;
        }

        total += subTotal;
    }

    return total;

});


Vue.filter('toDollar', function (a) {
    if (a == 0) {
        return a + '.00';
    }

    a = parseFloat(a);

    if (a == "" || isNaN(a)) {
        return "";
    } else {
        return a.toFixed(2).replace(/./g, function (c, i, a) {
            return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
        });
    }
});

Vue.filter('normal_case', function (string) {

    /**
     * Static Filter Hack.
     */

    if (string == 'semi-trailer') {
        return "Semi-Trailer";
    }

    if (string == 'trailer-4y license') {
        return "Trailer 4-Yr License";
    }

    if (string == 'trailer-1y license') {
        return "Trailer 1-Yr License";
    }

    /**
     * End of Hack.
     */


    string = string.split(" ");

    var firstChar = '',
        remainingChars = '',
        joinedWord = '',
        wordContainer = [];

    for (var i in string) {
        if (string[i].match("-")) {
            if (string[i] == "off-road") {
                return "Off-Road";
            } else {
                dashedString = string[i].split('-');

                for (var i in dashedString) {
                    firstChar = dashedString[i].charAt(0).toUpperCase().trim();
                    remainingChars = dashedString[i].slice(1).toLocaleLowerCase().trim();

                    wordContainer.push(firstChar + remainingChars);
                }
            }
        }
        else {
            if (string[i] == 'SUV') {
                wordContainer.push('SUV');
            } else {
                firstChar = string[i].charAt(0).toUpperCase().trim();
                remainingChars = string[i].slice(1).toLocaleLowerCase().trim();

                wordContainer.push(firstChar + remainingChars);
            }
        }
    }

    // Join words separated by a single space.
    joinedWord = wordContainer.join(" ").replace("-", " ");

    return joinedWord;
});

Vue.filter('logLoop', function (a) {
    console.log(a);
});

Vue.filter('fee_readable', function (key) {
    key = key.trim();

    var readableSubstitute = {
        'VEH_INSP_FEE': 'Vehicle Inspection Fee',
        'SERVICE_FEE': 'Service Fee',
        'TITLE_FEE': 'Title Fee',
        'TITLE_CORRECTION_FEE': 'Title Correction Fee',
        'HANDLING_FEE': 'Handling Fee',
        'DUP_TITLE_FEE': 'Dup Title Fee',
        'REG_FEE': 'Registration Fee',
        'REG_DUP_FEE': 'Register Dup Fee',
        'LICENSE_TRNSFR_FEE': 'License Transfer Fee',
        'DUP_PLATE_FEE': 'Dup Plate Fee',
        'PERSNL_PLATE_FEE': 'Personal Plate Fee',
        'PERSL_PLATE_ADMIN_FEE': 'Personal Plate Admin Fee',
        'PERSL_PLATE_HANDLING_FEE': 'Personal Plate Handling Fee',
        'SPEC_PLATE_FEE': 'Spec Plate Fee',
        'MORTGAGE_FEE': 'Mortgage Fee',
        'LICENSE_DUP_FEE': 'License Dup Fee',
        'LICENSE_PNLTY_FEE': 'License Penalty Fee',
        'NOTARY_FEE': 'Notary Fee',
        'CONVENIENCE_FEE': 'Convenience Fee',
        'PROCESSING_FEE': 'Processing Fee',
        'MAIL_FEE': 'Mail Fee'
    };

    if (readableSubstitute.hasOwnProperty(key)) {
        var value = readableSubstitute[key];
    } else {
        value = key;
    }

    return value;
});

Vue.filter('currencyDisplay', {
    currencyDisplay: {
        read: function (val) {
            return val.toFixed(2);
        },
        write: function (val, oldVal) {
            var number = +val.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return isNaN(number) ? 0 : number
        }
    }
});

