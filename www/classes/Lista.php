<?php

class Lista {
    public $tabela;
    public $consulta;

    function dados()
    {
        $erro = "";
        $res = mysqli_query($GLOBALS['my'], $this->consulta) or ($erro = "Erro na consulta dos dados");

        if (!$erro) {
			$status = 'OK';
		} else {
			$status = 'ERRO';
		}
		return array('STATUS' => $status, 'MSG' => $erro,'RES'=>$res);
    }

    function sessoesSelect($idSel='')
    {
        $limite = '10';
        $opcoes = '<option value="" '.($idSel?'':'selected').'>Inativo</option>';

        for($i=1;$i<=$limite;$i++){
            $opcoes .= '<option value="'.$i.'" '.($i==$idSel?' selected':'').'>'.$i.'</option>';
        }
        return $opcoes;
    }

    function exerciciosCheck($idAluno)
    {
        $lista = new Lista;
        $treino = array();

        if($idAluno){
            $lista->consulta = "SELECT idExercicio, sessoes FROM treino WHERE idAluno = ".$idAluno." AND finalizado = 0";
            $result = $lista->dados();
            while($res = mysqli_fetch_assoc($result['RES'])){
                $treino[$res['idExercicio']] = $res['sessoes'];
            }
        }

        //echo 'cadastrar<pre>'.print_r($treino,1).'</pre>';
        //die();
        $campo = '';
        $lista->consulta = "SELECT id, nome FROM exercicio WHERE ativo = 1 ORDER BY nome ASC";
        $result = $lista->dados();
        while($res = mysqli_fetch_assoc($result['RES'])){
            $qtdSessao = isset($treino[$res['id']])?$treino[$res['id']]:'';
            $campo .= '<div class="form-check">';
            $campo .= '<select class="form-select form-select-lg" name="exercicios['.$res['id'].']" id="exe'.$res['id'].'" autocomplete="off">';
            $campo .= $this->sessoesSelect($qtdSessao);
            $campo .= '</select>';
            $campo .= '<label class="form-check-label" for="exe'.$res['id'].'"> '.$res['nome'].'</label>';
            $campo .= "</div>\n";
        }
        return $campo;
    }


	/**
	 * Função para Insert / Update
     * 
	 */
	function upserting($campos, $idUp = null)
	{
		$queryCampos 	= '';
		$queryValores 	= '';
		$queryUp		= '';
		$erro 			= '';
		$showErro 		= 'hide';

		
		if ($idUp == null) {
			foreach ($campos as $key => $value) {
				$queryCampos .= $key . ',';
				$queryValores .= "'" . $value . "',";
			}
			$query = "INSERT INTO {$this->tabela} (" . $queryCampos . " dtCria) VALUES(" . $queryValores . " NOW())";
			mysqli_query($GLOBALS['my'], $query) or ($erro = "Erro na insercao dos dados ".$query);
            $idUp = mysqli_insert_id($GLOBALS['my']);
		} else {
			foreach ($campos as $key => $value) {
				$queryUp .= $key . "='".$value."', ";
			}
			$query = "UPDATE {$this->tabela} SET ".$queryUp." dtAcao = NOW() WHERE id = $idUp";
			mysqli_query($GLOBALS['my'], $query) or ($erro = "Erro na atualizacao dos dados ".$query);
		}

		if (!$erro) {
			$status = 'OK';
		} else {
			$status = 'ERRO';
		}
		return array('STATUS' => $status, 'MSG' => $erro, 'SHOWERRO'=>$showErro,'ID'=>$idUp);
	}

    function atualizaTreino($exercicios,$idAluno)
    {
        //echo 'cadastrar<pre>'.print_r($exercicios,1).'</pre>';
        $lista = new Lista;
        $lista->tabela = 'treino';
        $lista->consulta = "SELECT id, idExercicio, sessoes FROM treino WHERE idAluno = ".$idAluno." AND finalizado = 0 ORDER BY idExercicio ASC";
        $result = $lista->dados();

        // CARREGA OS EXERCICIOS ATUAIS
        $atual = array();
        while($res = mysqli_fetch_assoc($result['RES'])){
            $atual[$res['idExercicio']] = $res;
        }
        //echo 'ATUAIS<pre>'.print_r($atual,1).'</pre>';

        // NOVA LISTA EXERCICIOS
        foreach ($exercicios as $idExercicio => $sessoes) {
            if(isset($atual[$idExercicio])){ //EXISTE NA LISTA ATUAL
                $campos = array('sessoes'=>$sessoes);
                $lista->upserting($campos,$atual[$idExercicio]['id']);
                unset($atual[$idExercicio]);
            }else{// NAO EXISTE NO TREINO ATUAL, ADICIONAR
                $campos = array('idAluno'=>$idAluno,'idExercicio'=>$idExercicio,'sessoes'=>$sessoes);
                $result = $lista->upserting($campos);
                //echo 'add<pre>'.print_r($campos,1).'</pre>';
                //echo 'add<pre>'.print_r($result,1).'</pre>';
                unset($atual[$idExercicio]);
            }
        }
        

        // REMOVE EXERCICIOS
        foreach ($atual as $key => $value) {
            $campos = array('finalizado'=>2);
            $lista->upserting($campos,$atual[$key]['id']);
            //echo 'REMOVE ['.$atual[$key]['id'].']<pre>'.print_r($upserting,1).'</pre>';
        }
        //echo $idAluno.'<pre>'.print_r($exercicios,1).'</pre>';
        //die();
    }

    function alunoTreino($idAluno)
    {
        $campo = '';
        $lista = new Lista;
        $lista->consulta = "SELECT e.nome as exercicio, t.sessoes, t.finalizado
        FROM treino t 
        left join exercicio e on (e.id = t.idExercicio)
        WHERE 
        t.idAluno = ".$idAluno." 
        AND finalizado IN (0,1)
        ORDER BY t.finalizado ASC, e.nome ASC";
        $result = $lista->dados();
        while($res = mysqli_fetch_assoc($result['RES'])){
            $final = $res['finalizado']=='1'?'text-muted':'';
            $finaltxt = $res['finalizado']=='1'?'*':'';
            $campo .= '<li class="'.$final.'">';
            $campo .= '<span class="badge">'.$res['sessoes'].'</span> '.$res['exercicio'].$finaltxt;
            $campo .= "</li>\n";
        }
        return $campo;
    }
}
?>