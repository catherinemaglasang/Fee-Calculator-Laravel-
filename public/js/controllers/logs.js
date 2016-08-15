appModule.controller('logsController', ['$scope', '$rootScope', 'Resources', '$localStorage', '$compile',
    function ($scope, $rootScope, Resources, $localStorage, $compile) {

        var generatePaginatedHtmlLinks = function (last_index) {
            var pages = '',
                index = 0;

            for (i = 0; i < last_index; i++) {
                index = i + 1;
                pages += '<li><a href="#" ng-click="refreshLogs(' + index + ')">' + index + '</a></li>';
            }

            return pages;
        }

        $localStorage.reset;

        $scope.logs = {
            data: [],
            total_pages: "",
            modal: false,
            modal_value: "",
            total_pages: "",
            current_page: ""
        };

        $scope.search = {
            // Search factors.
            state: "ALL",
            status: ""
        };
        $scope.order = '';
        $scope.order_reverse = false;

        $scope.orderColumns = function (orderString) {
            if (orderString == 'State') {
                $scope.order = 'state';
            } else if (orderString == 'Date Added') {
                $scope.order = 'date_added';
            } else if (orderString == 'Status') {
                $scope.order = 'status';
            }

            $scope.order_reverse = !($scope.order_reverse);
        }

        $scope.states = [];

        $scope.refreshLogs = function (page) {
            $scope.getLogs($scope.search.state, page);
        }

        $scope.getStates = function () {
            Resources.states();
        }

        $scope.getLogs = function (state, page, status) {
            if (typeof state === "undefined") {
                status = 'ALL';
            }

            if (!(typeof page !== "undefined" && (page === parseInt(page, 10)))) {
                page = 1;
            }

            if (typeof status === "undefined") {
                status = 'ALL';
            }

            Resources.getLogs({
                state: state,
                page: page,
                status: status
            });

            $scope.logs.current_page = page;

            console.log('Searching with state: ' + state + ' and Page: ' + page);
        }

        // To compile new HTML in angular.
        $scope.generatePaginatedLinks = function (html_string) {
            var id = document.getElementById('pages'),
                angular_element = angular.element(id);

            angular_element.html(html_string);
            $compile(angular_element.contents())($scope);
        }

        $scope.displayFullParams = function (params) {
            $scope.logs.modal_value = params;
            $scope.logs.modal = true;
        }

        $rootScope.$on('resultLoaded', function (e, response) {
            if (response.response_type == 'Logs') {
                if (response.status.message === 'SUCCESS') {
                    $scope.logs.data = response.data.data.data.logs.data;
                    $scope.logs.total_pages = response.data.data.data.logs['last_page'];
                    $scope.generatePaginatedLinks(generatePaginatedHtmlLinks(response.data.data.data.logs['last_page']));
                } else {
                    alert('Failed to load logs');
                }
            } else if (response.response_type == 'states') {
                $scope.states = response.data;
            }
        });

        $scope.getLogs('ALL', 1);
        $scope.getStates();
    }]);