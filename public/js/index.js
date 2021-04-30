/*
    A palavra entidade é bastante usada aqui. Como no folclore onde uma entidade encarna num corpo de toma conta do seu controle, a ideia aqui é análoga:
    A entidade sendo gerida incorpora em toda a spa, fazendo todos os seus recursos se adaptarem a ela
    Uma entidade 'incorpora' a partir do momento que seu nome no menu lateral esquerdo é clicado

    As entidades gerenciadas nessa aplicação são:
        - alunos: students
        - exercícios: exercises
        - treinos: trainings
        - vínculo de exercícios a treinos: trainingExercises
        - vínculo de alunos a treinos: trainingStudents e
        - vínculo de alunos a exercícios de treinos: studentTrainingExercises

 */


angular.module("app", ["angular-extensions"])
    .controller("main", ["$scope", "$async", "$timeout", function ($scope, $async, $timeout) {

        // indica quando a página está aguardando por alguma requisição ao servidor.
        // Quando true, várias funções da spa ficam disponíveis
        $scope.isLoading = false;

        // quando uma entidade estiver sendo editada, uma cópia dos seus dados é armazenada aqui, para acesso aos diferentes componentes
        $scope.entity = {};

        // vai armazer a lista de treinos a ser usado no dropdown de treinos a serem associados ao aluno
        $scope.trainings = [];

        // vai armazer a lista de exercícios a ser usado no dropdown de exercícios a serem associados ao treino
        $scope.exercises = [];

        // texto digitado na toolbar de pesquisa do datatable
        $scope.search = { text: ""};

        // registros obtidos do getAll da entidade, usados para popular o datable
        $scope.rows = [];

        // a lista de todos aos possíveis status de um treino
        $scope.trainingStatuses = ['Active', 'Finished', 'Canceled'];

        // objeto que controla o stado da página. Os valores de seus atributos são usados pelos componentes para tomdas de decisão
        $scope.stateEntity = {}

        // reiniciar o estado da página
        function startStateEntity() {
            $scope.stateEntity = {
                id: null, // o id da entidade sendo editada atualmente
                name: null, // o nome da entidade atualmente em processo
                action: null, // ação sendo execudada com a entidade: list (listagem), edit(edição), profile(perfil do aluno)

                // permissões a serem usadas pelo datatable para decidir quais ações mostrar, dependendo de qual entidade estamos nos referindo
                permissions: {
                    edit: true, // editar
                    delete: true, // deletar
                    activate: false, // ativação de treino
                    deactivate: false, // desativação de treino
                    dashboard : false // profile
                }

            };
        }

        // inicia o estado da página
        startStateEntity();

        /*
            Realização de requisição GET ao servidor
            Parametros:
                 - fromEntityName: o nome da entidade que será buscada
                 - fromId: o id da entidade que será busca (se possui valor, no server, fará um findById. Se não tiver valor, é um getAll
                 - action: list, profile, edit, get-exercises, get-trainings

        */
        function getData(fromEntityName, fromId, action) {
            $scope.isLoading = true;

            // monta a rota
            let routePath = "route.php?entityName=" + fromEntityName;
            routePath += fromId > 0? "&id=" + fromId: "";

            // get assincrono
            $async.get(routePath).then(function (r) {

                // de acordo com a ação passada, irá armazenar o resultado da requição em uma variável de escopo específica
                switch (action) {
                    case "list": { // listagem
                        $scope.rows = r.data;
                        break;
                    }
                    case "profile": { // perfil do aluno
                        $scope.entity = r.data;
                        break;
                    }
                    case "edit": { // edição
                        $scope.entity = r.data;
                        break;
                    }
                    case "get-exercises": { // obtenção de lista de exercícios
                        $scope.exercises = r.data;
                        break;
                    }
                    case "get-trainings": { // obtenção de lista de treinos
                        $scope.trainings = r.data;
                        break;
                    }
                }

                // como o DOM é refeito em função da mudança de comportamento da tela, alguns componentes jquery precisam ser reiniciados
                startJqueryComponents();

                $scope.isLoading = false;

            }, function(data) { // caso algo saia errado, exibe mensagem de erro
                $scope.isLoading = false;
                showErrorMessage(data);
            })
        }

        /*
            Realização de requisição POST ao servidor
            Parametros:
                 - action: save, delete. É usado no servidor para decisão de qual caminho tomar

        */
        function post(action) {

            $scope.isLoading = true;
            $scope.entity.action =  action;
            $scope.entity.id = $scope.stateEntity.id;
            $scope.entity.entityName = $scope.stateEntity.name;

            $async.post("route.php", JSON.stringify($scope.entity)).then(function (r) {
                $scope.entity = r.data;
                $scope.stateEntity.id = $scope.entity.id; // se for um cadastro novo, já traz o id gerado para o objeto em memória
                $scope.entity = r.data;
                $scope.isLoading = false;

                if(action === "save") {
                    alertify.success("Registro salvo com sucesso", 'success', 5);
                }
                if(action === "delete") {
                    getData($scope.stateEntity.name, $scope.stateEntity.id, $scope.stateEntity.action);
                    alertify.success("Registro removido com sucesso", 'success', 5);
                }


            }, function (response) { // caso algo saia errado, exibe mensagem de erro
                showErrorMessage(response.data);
            });

        }

        /*
            Realização de requisição POST ao servidor. Diferenente da função anterior(que posta o objeto inteiro), aqui somente os campos a serem atualizados é que são enviados
            Parametros:
                 - entityName: nome da entidade
                 - entity: objeto com os campos que serão atualizados

        */
        function update(entityName, entity) {

            entity.entityName = entityName;
            entity.action = "save";

            $async.post("route.php", JSON.stringify(entity)).then(function (r) {
                alertify.success("Registro salvo com sucesso", 'success', 5);

            }, function (response) {
                showErrorMessage(response.data);
            });
        }

        // Quando uma das opções do menu lateral esquerdo é clicado, essa função é chamada. O comportamento da spa sofre mudança drástica aqui
        $scope.setEntity = function(entityName) {

            if(!$scope.isLoading) {
                startStateEntity(); // reinicia estados
                $scope.entity = {};
                $scope.stateEntity.name = entityName;
                $scope.stateEntity.action = "list";
                $scope.tableState.currentPage = 1; // paginação
                $scope.search.text = "";

                // permisionamento para visualizações das ações no datatable
                switch (entityName) {
                    case "students": {
                        $scope.stateEntity.permissions.dashboard = true; // perfil
                        $scope.stateEntity.permissions.delete = true; // deletar
                        // busca lista de treinos para usar no dropdown da edição de alunos, onde é feito vínculo a treinos
                        getData("trainings", null, "get-trainings");
                        break;
                    }

                    case "trainings": {
                        $scope.stateEntity.permissions.activate = true; // ativar treino
                        $scope.stateEntity.permissions.deactivate = true; // desativar treino
                        $scope.stateEntity.permissions.delete = false; // deleter
                        // busca lista de exercícios para usar no dropdown da edição de treinos, onde é feito vínculo do mesmo a exercícios
                        getData("exercises", null, "get-exercises");
                        break;
                    }
                }

                // após configurado o objeto de estado, a chamada ao getData é realizada
                getData($scope.stateEntity.name, $scope.stateEntity.id, $scope.stateEntity.action);
            }
        }

        /*
            A ação correntemente sendo execuda é escutada aqui
            Caso seja alterada (as actions são alteradas a partir do momento que uma ação é clicada no datatable)
            e seja 'edit' ou 'profile', um getById específico precisa ser chamado para buscar os dados da entidade
         */
        $scope.$watch("stateEntity.action", function (newAction) {
            if ((newAction === "edit" || newAction === "profile") && $scope.stateEntity.id > 0) {
                getData($scope.stateEntity.name, $scope.stateEntity.id, $scope.stateEntity.action);
            }

        });

        // quando o botão 'Novo registro' é clicado na toolbar de listagem
        $scope.new = function () {
            $scope.edit(null); // cria uma entidade nova e abre para edição
        }

        // quando a ação 'Editar' é clicada em um registro da datatable
        $scope.edit = function(id) {
            $scope.stateEntity.id = id;
            $scope.stateEntity.action = "edit";
        }

        // quando o botão 'Salvar é clicado na toolbar de edição
        $scope.save = function () {
            if($scope.validateForm($scope.stateEntity.name)) // valida o form antes
                post("save"); // salva
        }

        // quando a ação 'Deletar' é clicada em um registro da datatable
        $scope.delete = function (row) {
            alertify.confirm("Tem certeza que deseja deletar esse registro?", function () {

                $scope.entity = row; // seta a entidade com os dados a linha clicada
                $scope.stateEntity.id = row.id; // define o id no estado da página que é enviado ao server para deleção
                post("delete") // chama o post, com a ação específica

            })
                .set({ labels: { ok: 'Deletar registro', cancel: 'Voltar' } })
                .set({ title: "Deletar registro" })
        }

        // quando a ação 'Ativar treino' ou 'Desativar treino' é clicada em um item da datatable
        $scope.changeTrainingStatus = function(training, newStatus) {
            training.status = newStatus; // muda status do treino
            $scope.entity = training;
            $scope.stateEntity.id = training.id;
            post("save"); // salva
        }

        // quando o botão 'Voltar' é clicado na toolbar de edição
        $scope.goBack = function () {
            $scope.setEntity($scope.stateEntity.name, "list");
        }

        // quando o botão 'Perfil do aluno' é clicado em um item da datatable
        $scope.showStudentProfile = function (studentId) {
            $scope.stateEntity.id = studentId;
            $scope.stateEntity.action = "profile";
        }

        // valida se é a entityName que é a atualmente sendo gerenciada
        $scope.isEntity = function(entityName) {
            return entityName === $scope.stateEntity.name;
        }

        // valida se alguma entidade está atualmente em uso
        $scope.hasEntitySelected = function() {
            return $scope.stateEntity.name != null
        }

        // valida se é a actionName que é está atualmente em processamento
        $scope.isAction = function (actionName) {
            return $scope.stateEntity.action === actionName;
        }

        // armazena os dados (código do exercício e número de sessões) do novo execício a ser incluído em um treino
        $scope.newTrainingExercise = {exerciseId: null, numberOfSessions: null}

        // quando o botão 'Vincular novo exerício' é clicado na página de edição do treino
        $scope.addExerciseToTraining = function () {
            if (!$scope.validateForm("add-exercise-to-training")) // valida o form
                return false;
            else {

                if(!$scope.entity.trainingExercises)
                    $scope.entity.trainingExercises = [];

                let exerciseName = "";

                // percorre lista de exerícios para buscar nome do exercício sendo adicionado
                for(let i = 0; i < $scope.exercises.length; i++) {
                    if($scope.exercises[i].id === $scope.newTrainingExercise.exerciseId)
                        exerciseName = $scope.exercises[i].name;
                }

                // adiciona novo exercício à entidade
                $scope.entity.trainingExercises.push({
                    id: null,
                    exerciseId: $scope.newTrainingExercise.exerciseId,
                    numberOfSessions: $scope.newTrainingExercise.numberOfSessions,
                    exercise: {name: exerciseName}
                });

                $scope.newTrainingExercise = {exerciseId: null, numberOfSessions: null};
                $timeout(function() {
                    $(".ui.dropdown").dropdown('clear')
                });
            }
        }

        // valida se o treino possui exercícios a ele vinculados
        $scope.hasTrainingExercises = function() {
            return typeof($scope.entity.trainingExercises) !== 'undefined' && $scope.entity.trainingExercises.length > 0
        }

        // armazena os dados (código do treino) do novo treino a ser incluído para um aluno
        $scope.newStudentTraining = {trainingId: null}

        // quando o botão 'Vincular novo treino' é clicado na página de edição do aluno
        $scope.addTrainingToStudent = function () {
            if (!$scope.validateForm("add-training-to-student")) // valida form
                return false;
            else {

                if(!$scope.entity.studentTrainings)
                    $scope.entity.studentTrainings = [];

                // verifica se aluno já possui algum treino ativo
                let alreadyHasActiveTraining = false;
                for(let i = 0; i < $scope.entity.studentTrainings.length; i++) {
                    alreadyHasActiveTraining |= $scope.entity.studentTrainings[i].status === 'Active';
                }

                // caso já tenha treino ativo, não deixa adicionar
                if(alreadyHasActiveTraining) {
                    alertify.warning("N&atilde;o &eacute; poss&iacute;vel adicionar mais de um treino ativo para um aluno");
                }
                else {

                    let training = null;

                    // percorre lista de treinos para buscar nome do treino sendo adicionado
                    for (let i = 0; i < $scope.trainings.length; i++) {
                        if ($scope.trainings[i].id === $scope.newStudentTraining.trainingId)
                            training = $scope.trainings[i];
                    }


                    $scope.entity.studentTrainings.push({
                        id: null,
                        studentId: $scope.entity.id,
                        trainingId: $scope.newStudentTraining.trainingId,
                        training: training,
                        status: training.status

                    });
                    $scope.newStudentTraining = {trainingId: null};

                    $timeout(function() {
                        $(".ui.dropdown").dropdown('clear')
                    });

                }
            }
        }

        // valida se o aluno possui treinos a ele vinculados
        $scope.hasStudentTrainings = function() {
            return typeof($scope.entity.studentTrainings) !== 'undefined' && $scope.entity.studentTrainings.length > 0
        }

        // dada uma lista de exerícios de entrada, retonar somente aqueles que estão ativos.
        // usado no dropdown de treinos da página de edição do alunos: somente treinos ativos estão disponíveis
        $scope.getActiveTrainings = function(trainings) {
            let activeTrainings = [];

            if(trainings) {
                for (let i = 0; i < trainings.length; i++) {
                    if(trainings[i].status === 'Active')
                        activeTrainings.push(trainings[i])
                }
            }

            return activeTrainings;
        }

        // valida se o status do do treino do aluno é igual ao status passado no parametro
        $scope.isStudentTrainingStatus = function(studentTraining, status) {
            return studentTraining.status === status;
        }

        // no página do perfil do aluno, no treino ativo específico, em um exercícios específico, quando a ação de finalizar ou pular é clicar
        $scope.changeStudentTrainingExerciseStatus = function(studentTrainingExercise, studentTraining, status) {

            var actionWord = status === "Finished"? "finalizar": "pular";

            // so deixar continuar se o status atual é pendente
            if(studentTrainingExercise.status === "Pending") {

                // pergunta se realmente quer continuar
                alertify.confirm("Tem certeza que deseja " + actionWord + " esse exerc&iacute;cio?", function () {

                    studentTrainingExercise.status = status;
                    // atualiza o item do treino do aluno para novo status
                    update("studentTrainingExercises", studentTrainingExercise)
                    $timeout(function() {

                        let isStudentTrainingFinished = true;

                        // verifica se todos os itens do treino do aluno estão finalizados ou 'pulados'
                        for(let i = 0; i < studentTraining.studentTrainingExercises.length; i++) {
                            isStudentTrainingFinished &&= studentTraining.studentTrainingExercises[i].status !== 'Pending';
                        }

                        // caso estejam, muda o status do treino para finalizado
                        if(isStudentTrainingFinished) {
                            studentTraining.status = "Finished";
                            update("studentTrainings", studentTraining);
                            $timeout();
                        }

                    }, 200);
                })
                    .set({labels: {ok: actionWord + ' exerc&iacute;cio', cancel: 'Voltar'}})
                    .set({title: actionWord + ' exerc&iacute;cio'})
            }
        }



        // CONFIGURAÇÕES DE GESTÃO DO DATABELA

        // objeto que controla o estado do datatable
        $scope.tableState = {
            itemsPerPage: 8, // itens por página
            numPages: 0, // numero de página sendo exibida
            currentPage: 1, // pagina atualmente sendo exibida
        }
        $scope.isGridEmpty = true;

        // aos registros recebidos do getAll do servidor, é aplicado o filtro dessa função. O resultado disso é usado para popular o datatable
        $scope.getSelectedRows = function(rows) {
            // objeto a ser retornado para o databale
            let selectedRows = [];
            $scope.isLoading = true;
            if(rows) {

                // caso o campo de busca da toobar de listagem tenha valor
                if ($scope.search.text.length > 0) {
                    // filtra os itens para que contenha somente registros cujo nome ou id casem com o texto digitado
                    for (let i = 0; i < rows.length; i++) {
                        if (rows[i].name.toLowerCase().indexOf($scope.search.text.toLowerCase()) !== -1 || rows[i].id == parseInt($scope.search.text)) {
                            selectedRows.push(rows[i]);
                        }
                    }
                }
                else
                    selectedRows = rows;

                // define o número de páginas da paginação em função do número de registros filtrados e o número de itens por página configurado
                $scope.tableState.numPages = Math.ceil(selectedRows.length / $scope.tableState.itemsPerPage);
            }

            $scope.isLoading = false;
            $scope.isGridEmpty = selectedRows.length === 0;

            // faz paginação
            return getPagedRows(selectedRows);
        }

        // pagina os itens filtrados na função anterior
        function getPagedRows(rows) {
            if(rows) {
                let startPageIndex = ($scope.tableState.currentPage - 1) * $scope.tableState.itemsPerPage;
                let endPageIndex = startPageIndex + $scope.tableState.itemsPerPage;

                if (startPageIndex >= rows.length)
                    startPageIndex = rows.length;

                if (endPageIndex >= rows.length)
                    endPageIndex = rows.length;

                let pagedRows = [];

                // caso os itens do array de objetos casem com a configuração da página atual (offsets e limit) os mesmos são incorporados no array do retorno
                for (let i = startPageIndex; i < endPageIndex; i++) {
                    pagedRows.push(rows[i]);
                }

                return pagedRows;
            }

        }

        // avança ou retrocede uma página na paginação (
        $scope.selectPage = function(pageNumber) {
            $scope.tableState.currentPage = pageNumber <= 0 || pageNumber > $scope.tableState.numPages? $scope.tableState.currentPage: pageNumber;
        }


        // mostra mensagem de erro
        function showErrorMessage(errorMessage) {
            alertify.error("Erro: " + errorMessage, 'error', 5);
            $scope.isLoading = false;
        }

        /*
            validação de formulário
            baseado no nome da classe passado na entrada, se adapta para validar conjunto de itens diferentes
         */
        $scope.validateForm = function (formClassName) {

            // Conterá os campos que serão validados. Seu preenchimento dependerá do formClassName informado
            let fields = {};
            switch (formClassName) {
                case "students": {
                    fields.txtName = "empty";
                    fields.txtEmail = "empty";
                    fields.txtPhone = "empty";
                    break;
                }
                case "exercises": fields.txtName = "empty"; break;
                case "trainings": fields.txtName = "empty"; break;
                case "add-exercise-to-training": {
                    fields.ddlExercises = "empty";
                    fields.txtNumberOfSessions = "empty";
                    break;
                }
                case "add-training-to-student": {
                    fields.ddlTrainings = "empty";
                }
            }

            let formValidator = $(".ui.form." + formClassName).form({
                fields: fields,
                on: "blur"
            });

            return formValidator.form("validate form");
        }

        // inicializa componentes do jquery
        function startJqueryComponents() {
            $timeout(function() {

                $('[data-phone]').mask('(00) 0000-00009');

                $('.popup').popup({
                    delay: {
                        show: 400
                    }
                });

                $(".ui.dropdown").dropdown('clear');
                $('.ui.accordion').accordion();
                $('.checkbox').checkbox({
                        uncheckable: false
                });
            })
        }
    }]);

// extensões para encapsular detalhes de opeações de requisições ajax
angular.module("angular-extensions", [])
    .config(["$httpProvider", function ($httpProvider) {
        $httpProvider.defaults.headers.post["Content-Type"] = "application/json; charset=utf-8"
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