angular.module("angular-desafio-tecnofit", [])

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