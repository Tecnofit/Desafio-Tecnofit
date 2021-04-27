angular.module("angular-extensions", [])
    // GENERAL CONFIGURATIONS
    .config(["$httpProvider", function ($httpProvider) {
        $httpProvider.defaults.headers.post["Content-Type"] = "application/json; charset=utf-8"
        // Indica que as requisições são Ajax. Usado na checagem do .NET IsAjaxRequest().
        $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
    }])
    // FACTORIES
    .factory("$async", ["$http", "$filter", function ($http, $filter) {
        var csrf = {
            headers: { "X-Csrf-Token": $("input[name='__RequestVerificationToken']").val() }
        }

        function resolveUrl(url) {
            return /^~\//.test(url) ? $filter("resolveUrl")(url) : url;
        }

        var fn = function (url, data, onSuccess, onError) {
            if (url[0] === '/') {
                var page = window.location.pathname.split('/');
                url = page[page.length - 1] + url;
            }

            var request = $http.post(url, data);

            var success = typeof onSuccess === "function";
            var error = typeof onError === "function";

            if (!success)
                onSuccess = function () { };

            if (!error)
                onError = function () { };

            if (success || error)
                request.then(onSuccess, onError);

            return request;
        }

        fn.get = function (url, config) {
            return $http.get(resolveUrl(url), angular.merge(config || {}, csrf));
        }

        fn.post = function (url, data, config) {
            return $http.post(resolveUrl(url), data, angular.merge(config || {}, csrf));
        }

        fn.put = function (url, data, config) {
            return $http.put(resolveUrl(url), data, angular.merge(config || {}, csrf));
        }

        return fn;
    }])
    // FILTERS
    .filter("resolveUrl", function () {
        return function (url, query) {
            var baseUrl = window.$ROOT$;
            if (!url || !baseUrl) return "";
            if (url.indexOf("~/") === 0) url = baseUrl + url.substring(2);
            else if (url.indexOf("/") === 0) url = baseUrl + url.substring(1);
            if (query) url = url + "?" + query;
            return url;
        }
    })
    .filter("empty", function () {
        return function (value, replace) {
            if (value === undefined || value === null || value === "")
                return replace;
            return value;
        }
    })
    .filter("truncate", function () {
        return function (text, len, sufix) {
            if (!text || isNaN(len))
                return "";

            if (sufix === undefined || sufix === null)
                sufix = "...";

            var str = String(text);
            if (str.length <= len)
                return str;

            return str.substring(0, len) + sufix;
        }
    });

angular.module("app", ["angular-extensions"])
    .controller("main", ["$scope", "$async", "$timeout", function ($scope, $async, $timeout) {

        $scope.currentEntityName = null;
        $scope.searchText = "";
        $scope.search = { text: ""};


        $scope.setEntityName = function(entityName) {

            if(!$scope.isLoading) {
                $scope.currentEntityName = entityName;
                $scope.isLoading = true;

                $async.get("route.php?entityName=" + $scope.currentEntityName).then(function (r) {

                    $timeout(function () {
                        $scope.rows = r.data;
                        $scope.isLoading = false;

                        $timeout(function() {
                            $('.popup')
                                .popup({
                                    delay: {
                                        show: 400
                                    }
                                });

                        });


                    })



                },function(data) {
                    alertify.error('Falha de comunicação com o servidor. Contate o suporte técnico.', 'error', 5, function() {
                        console.log(data);
                    });

                    $scope.isLoading = false;

                })

            }

        }

        $scope.isCurrentEntity = function(entityName) {
            return entityName === $scope.currentEntityName;
        }

        $scope.hasAnyEntitySelected = function() {
            return $scope.currentEntityName != null
        }

        $scope.addItem = function() {
            alert("aqui");
        }

        // paginação e busca no data table

        $scope.tableState = {
            itemsPerPage: 8,
            numPages: 0,
            currentPage: 1
        }

        $scope.getSelectedRows = function(rows) {
            let selectedRows = [];
            $scope.isLoading = true;
            if(rows) {

                if ($scope.search.text.length > 0) {

                    for (let i = 0; i < rows.length; i++) {
                        if (rows[i].name.toLowerCase().indexOf($scope.search.text.toLowerCase()) !== -1 || rows[i].id == parseInt($scope.search.text)) {
                            selectedRows.push(rows[i]);
                        }
                    }
                }
                else
                    selectedRows = rows;

                $scope.tableState.numPages = Math.ceil(selectedRows.length / $scope.tableState.itemsPerPage);
            }

            $scope.isLoading = false;



            return getPagedRows(selectedRows);

        }

        function getPagedRows(rows) {
            if(rows) {
                let startPageIndex = ($scope.tableState.currentPage - 1) * $scope.tableState.itemsPerPage;
                let endPageIndex = startPageIndex + $scope.tableState.itemsPerPage;

                if (startPageIndex >= rows.length)
                    startPageIndex = rows.length;

                if (endPageIndex >= rows.length)
                    endPageIndex = rows.length;

                let pagedRows = [];

                for (let i = startPageIndex; i < endPageIndex; i++) {
                    pagedRows.push(rows[i]);
                }

                return pagedRows;
            }

        }

        $scope.selectPage = function(pageNumber) {
            $scope.tableState.currentPage = pageNumber <= 0 || pageNumber > $scope.tableState.numPages? $scope.tableState.currentPage: pageNumber;
        }

    }]);