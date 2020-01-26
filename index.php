<?php include('header.php') ?>
	<body>
		<div class="container">
			<div class="row">
				<div class="panel panel-default users-content">
					<div class="panel-heading">Sistema Tecnofit
                        <span style="float: right; cursor: pointer;">Alternar para visão do aluno</span>
                    </div>

				</div>
                <div class="row" style="margin-left: 0px">
                    <div class="col-lg-4">
                        <div class="card card-blue1" onclick="location.href='alunos.php';">
                            <span style="position: absolute; top: 10px; bottom: 10px; left: 160px">Alunos</span>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card card-blue2" onclick="location.href='exercicios.php';">
                            <span style="position: absolute; top: 10px; bottom: 10px; left: 160px">Exercícios</span>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card card-blue3" onclick="location.href='treinos.php';">
                            <span style="position: absolute; top: 10px; bottom: 10px; left: 160px">Treinos</span>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</body>
</html>