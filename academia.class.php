<?php


    class Controle {
            

        //variaveis de tabela 
        private $email_contato;
        private $senha;
    
    

            // construtor para a conexao com o banco de dados
            public function __construct($db){
                $this->conn = $db;
            }

            public function buscaDados($urlValida, $login, $senha){
          
                switch ($urlValida) {
                    case '/academia/index2.php':
                    
                        $query = "SELECT tb_aluno.email_contato,
                                         tb_aluno.senha
                                    FROM tb_aluno 
                                   WHERE tb_aluno.email_contato ='$login'
                                     AND tb_aluno.senha = '$senha'"; 
                        $result = $this->conn->prepare( $query );
                        $result->execute();
                        return $result;
                    break;

                    
                    default:
                    break;
                }


                
            }

//--------------retorno de informaçoes
            public function buscaInfos($urlValida){

                $url          = (basename($urlValida).PHP_EOL);
                $trocaCaminho = array("cad_",".php");
                $nomeTabela   = str_replace($trocaCaminho,"",$url);

                $sql = "SELECT *";
                $sql.= " FROM tb_".$nomeTabela." ";
                $stmt = $this->conn->prepare( $sql );
                $stmt->execute();
                return $stmt;
                 
            }
            

            public function buscaTreinos(){
                $sql = "SELECT *";
                $sql.= " FROM tb_treino";
                $stmt = $this->conn->prepare( $sql );
                $stmt->execute();
                return $stmt;
            }


            
// ----------INSERE NO BANCO
            public function insereDados($infosAcademia, $urlValida){
                
                $url          = (basename($urlValida).PHP_EOL);
                $trocaCaminho = array("cad_",".php");
                $nomeTabela   = trim(str_replace($trocaCaminho,"",$url));
                
                    switch ($nomeTabela) {
                        case 'aluno':
                            $sqlInsereInfos = "INSERT INTO tb_".$nomeTabela."";
                            $sqlInsereInfos.=" (`".implode("`,`", array_keys($infosAcademia))."`)";
                            $sqlInsereInfos.= " VALUES ('".implode("', '", $infosAcademia)."') ";
                            $insereInfos = $this->conn->prepare( $sqlInsereInfos );
                            $insereInfos->execute(); 
                        break;

                        case 'treino':
                            $sqlInsereInfos = "INSERT INTO tb_".$nomeTabela."";
                            $sqlInsereInfos.=" (`".implode("`,`", array_keys($infosAcademia))."`)";
                            $sqlInsereInfos.= " VALUES ('".implode("', '", $infosAcademia)."') "; 
                            $insereInfos = $this->conn->prepare( $sqlInsereInfos );
                            $insereInfos->execute();
                        break;

                        case 'exercicio':
                            $sqlInsereInfos = "INSERT INTO tb_".$nomeTabela."";
                            $sqlInsereInfos.=" (`".implode("`,`", array_keys($infosAcademia))."`)";
                            $sqlInsereInfos.= " VALUES ('".implode("', '", $infosAcademia)."') "; 
                            $insereInfos = $this->conn->prepare( $sqlInsereInfos );
                            $insereInfos->execute();
                        break;
                        
                        default:
                            # code...
                        break;
                    }

            }

//---------------------ATUALIZAR
            public function atualizaDados($infos,$urlValida ){
                $url          = (basename($urlValida).PHP_EOL);
                $trocaCaminho = array("cad_",".php");
                $nomeTabela   = trim(str_replace($trocaCaminho,"",$url));


                switch ($nomeTabela) {
                    case 'aluno':
                        if(!$infos['senha']) $infos['senha'] = md5('teste');
                
                        $sql = "UPDATE tb_".$nomeTabela."";
                        $sql.= " SET nome_aluno      ='".$infos['nome_aluno']."',
                                    idade           ='".$infos['idade']."',
                                    email_contato   ='".$infos['email_contato']."',
                                    senha           ='".md5($infos['senha'])."'";
                        $sql.= " WHERE email_contato ='".$infos['email_contato']."'";
                        $result = $this->conn->prepare( $sql );
                        $result->execute(); 
                    break;
                    case 'treino':
                        $sql = "UPDATE tb_".$nomeTabela."";
                        $sql.= " SET nome_treino   ='".$infos['nome_treino']."'";
                        $sql.= " WHERE cod_treino  ='".$infos['cod_treino']."'";
                        var_dump($sql);
                        $result = $this->conn->prepare( $sql );
                        $result->execute(); 
                    break;
                    case 'exercicio':
                        $sql = "UPDATE tb_".$nomeTabela."";
                        $sql.= " SET nome_exercicio   ='".$infos['nome_exercicio']."'";
                        $sql.= " WHERE cod_exercicio  ='".$infos['cod_exercicio']."'";
                        var_dump($sql);
                        $result = $this->conn->prepare( $sql );
                        $result->execute(); 
                    break;
                    
                    default:
                        # code...
                    break;
                }

            }



//------------DELETAR
            public function deletaDados($id,$urlValida ){
                $url          = (basename($urlValida).PHP_EOL);
                $trocaCaminho = array("cad_",".php");
                $nomeTabela   = str_replace($trocaCaminho,"",$url);

                $sql = "DELETE FROM tb_".$nomeTabela." WHERE id_".$nomeTabela." = $id";
                $del = $this->conn->prepare( $sql );
                $del->execute(); 


            }
            
            
            

}

?>