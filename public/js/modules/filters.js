appModule.filter('currency', function () {
    function currencyFilter(input) {
        return input.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    return currencyFilter;
});

appModule.filter('percentage', function () {
    function currencyFilter(input) {
        var input_string = (input * 100).toString();

        if(input_string.length < 4) {
            input_string = parseInt(input_string).toFixed(2);
        }

        return input_string.toString() + '%';

        /*return (input * 100).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


        // Conditions.
        input = (input * 100).toString();

        if (input.length < 4) {
            return input + '%';
        } else {
            return input + '%';
        }*/
    }

    return currencyFilter;
});

appModule.filter('capitalize', function () {
    function capitalizFilter(input) {
        return input.replace(/\w\S*/g, function (txt) {
            return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
        });
    }

    return capitalizFilter;
});

appModule.filter('limit', function () {
    return function (value, wordwise, max, tail) {
        if (!value) return '';

        max = parseInt(max, 10);
        if (!max) return value;
        if (value.length <= max) return value;

        value = value.substr(0, max);
        if (wordwise) {
            var lastspace = value.lastIndexOf(' ');
            if (lastspace != -1) {
                value = value.substr(0, lastspace);
            }
        }

        return value + (tail || ' …');
    };
});

/*
 appModule.filter('camelCase', function() {
 function camelCase(input) {
 return input.replace(/\s(.)/g, function($1) { console.log($1); return $1.toUpperCase(); })
 .replace(/\s/g, '')
 .replace(/^(.)/, function($1) { return $1.toLowerCase(); });
 }
 return camelCase;
 });*/
