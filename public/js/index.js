

$('[data-phone]').mask('(00) 0000-00009');

angular.module("angular-extensions", [])
    .config(["$httpProvider", function ($httpProvider) {
        $httpProvider.defaults.headers.post["Content-Type"] = "application/json; charset=utf-8"
        // Indica que as requisições são Ajax. Usado na checagem do .NET IsAjaxRequest().
        $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
    }])
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


angular.module("app", ["angular-extensions"])
    .controller("main", ["$scope", "$async", "$timeout", function ($scope, $async, $timeout) {
        $scope.isLoading = false;
        $scope.stateEntity = {}
        $scope.entity = {};
        $scope.exercises = [];
        $scope.search = { text: ""};
        $scope.rows = [];

        function startStateEntity() {
            $scope.stateEntity = {
                id: null,
                name: null,
                action: null,

                permissions: {
                    edit: true,
                    delete: true,
                    activate: false,
                    deactivate: false,
                    dashboard : false,
                    trainings: false
                }

            };
        }
        startStateEntity();


        function getData(fromEntityName, fromId, action) {

            $scope.isLoading = true;
            let routePath = "route.php?entityName=" + fromEntityName;
            routePath += fromId > 0? "&id=" + fromId: "";

            $async.get(routePath).then(function (r) {

                switch (action) {
                    case "list": {
                        $scope.rows = r.data;
                        break;
                    }
                    case "edit": {
                        $scope.entity = r.data;
                        break;
                    }
                    case "get-exercises": {
                        $scope.exercises = r.data;

                        console.log($scope.exercises);

                        // $scope.setEntity("trainings");
                        // $timeout(function() {
                        //     $scope.edit(10);
                        // }, 100)

                        break;
                    }
                }

                startJqueryComponents();
                $scope.isLoading = false;

            }, function(data) {
                $scope.isLoading = false;
                showErrorMessage(data);
            })
        }

        getData("exercises", null, "get-exercises");


        $scope.setEntity = function(entityName) {

            if(!$scope.isLoading) {
                startStateEntity();
                $scope.entity = {};
                $scope.stateEntity.name = entityName;
                $scope.stateEntity.action = "list";


                switch (entityName) {
                    case "students": {
                        $scope.stateEntity.permissions.dashboard = true;
                        $scope.stateEntity.permissions.trainings = true;
                        $scope.stateEntity.permissions.delete = true;
                        break;
                    }

                    case "trainings": {
                        $scope.stateEntity.permissions.activate = true;
                        $scope.stateEntity.permissions.deactivate = true;
                        $scope.stateEntity.permissions.delete = false;
                        break;
                    }
                }
                getData($scope.stateEntity.name, $scope.stateEntity.id, $scope.stateEntity.action);
            }
        }



        $scope.$watch("stateEntity.action", function (newAction) {
            if (newAction === "edit" && $scope.stateEntity.id > 0) {
                getData($scope.stateEntity.name, $scope.stateEntity.id, $scope.stateEntity.action);
            }

        });

        $scope.new = function () {
            $scope.edit(null);
        }

        $scope.save = function () {
            if($scope.validateForm($scope.stateEntity.name))
                post("save");
        }

        function post(action) {

                console.log(action);
                $scope.isLoading = true;
                $scope.entity.action =  action;
                $scope.entity.id = $scope.stateEntity.id;
                $scope.entity.entityName = $scope.stateEntity.name;

                $async.post("route.php", JSON.stringify($scope.entity)).then(function (r) {
                    $scope.entity = r.data;
                    $scope.stateEntity.id = $scope.entity.id;
                    $scope.entity = r.data;
                    $scope.isLoading = false;

                    if($scope.entity.entityName === "exercises")
                        getData("exercises", null, "get-exercises")

                    if(action === "save")
                        alertify.success("Registro salvo com sucesso", 'success', 5);
                    if(action === "delete") {
                        getData($scope.stateEntity.name, $scope.stateEntity.id, $scope.stateEntity.action);
                        alertify.success("Registro removido com sucesso", 'success', 5);
                    }


                }, function (response) {
                    showErrorMessage(response.data);
                });

        }

        $scope.delete = function (row) {
            alertify.confirm("Tem certeza que deseja deletar esse registro?", function () {
                $scope.entity = row;
                $scope.stateEntity.id = row.id;
                post("delete")


            }, function () {

            })
                .set({ labels: { ok: 'Deletar registro', cancel: 'Voltar' } })
                .set({ title: "Deletar registro" })
        }

        $scope.goBack = function () {
            $scope.setEntity($scope.stateEntity.name, "list");
        }

        $scope.isEntity = function(entityName) {
            return entityName === $scope.stateEntity.name;
        }

        $scope.hasEntitySelected = function() {
            return $scope.stateEntity.name != null
        }

        $scope.edit = function(id) {
            $scope.stateEntity.id = id;
            $scope.stateEntity.action = "edit";
        }

        $scope.isAction = function (actionName) {
            return $scope.stateEntity.action === actionName;
        }

        $scope.newTrainingExercise = {exerciseId: null, numberOfSessions: null}

        $scope.addExerciseToTraining = function () {
            if (!$scope.validateForm("add-exercise-to-training"))
                return false;
            else {

                if(!$scope.entity.trainingExercises)
                    $scope.entity.trainingExercises = [];

                let exerciseName = "";

                for(let i = 0; i < $scope.exercises.length; i++) {
                    if($scope.exercises[i].id === $scope.newTrainingExercise.exerciseId)
                        exerciseName = $scope.exercises[i].name;
                }


                $scope.entity.trainingExercises.push({
                    id: null,
                    exerciseId: $scope.newTrainingExercise.exerciseId,
                    numberOfSessions: $scope.newTrainingExercise.numberOfSessions,
                    exercise: {name: exerciseName}
                });

                $scope.newTrainingExercise = {exerciseId: null, numberOfSessions: null}
            }
        }

        $scope.hasTrainingExercises = function() {
            return $scope.entity.trainingExercises !== undefined
        }

        // paginação e busca no data table

        $scope.tableState = {
            itemsPerPage: 8,
            numPages: 0,
            currentPage: 1
        }
        $scope.isGridEmpty = true;
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
            $scope.isGridEmpty = selectedRows.length === 0;

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

        function showErrorMessage(errorMessage) {
            alertify.error("Falha ao se comunicar com o servidor: " + errorMessage, 'error', 5);
            $scope.isLoading = false;
        }



        $scope.validateForm = function (className) {

            let fields = {};
            switch (className) {
                case "students": {
                    fields.txtName = "empty";
                    fields.txtEmail = "empty";
                    fields.txtPhone = "empty";
                    break;
                }
                case "exercises": fields.txtName = "empty"; break;
                case "trainings": fields.txtName = "empty"; break;
                case "add-exercise-to-training": {
                    fields.ddlExercicios = "empty";
                    fields.txtNumberOfSessions = "empty";
                }
            }

            let formValidator = $(".ui.form." + className).form({
                fields: fields,
                on: "blur"
            });

            return formValidator.form("validate form");
        }

        function startJqueryComponents() {
            $timeout(function() {

                $('[data-phone]').mask('(00) 0000-00009');

                $('.popup').popup({
                    delay: {
                        show: 400
                    }
                });
            }, 10)

        }

    }]);