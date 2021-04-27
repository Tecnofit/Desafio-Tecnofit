angular.module("app", ["angular-desafio-tecnofit"])
    .controller("main", ["$scope", "$async", "$timeout", function ($scope, $async, $timeout) {

        $scope.entityName = null;

        $scope.setEntityName = function(entityName) {

            if(!$scope.isLoading) {

                $scope.entityName = entityName;
                $scope.isLoading = true;

                $async.get("route.php?entity=" + $scope.entityName).then(function (r) {
                    $scope.isLoading = false;
                },function(data) {
                    alertify.error('Falha de comunicação com o servidor. Contate o suporte técnico.', 'error', 5, function() {
                        console.log(data);
                    });
                })



            }

        }

    }]);