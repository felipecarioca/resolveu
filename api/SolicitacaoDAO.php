<?php 
    
    include_once 'Orcamento.php';
    include_once 'OrcamentoDao.php';

    include_once 'Solicitacao.php';
	include_once 'PDOFactory.php';

    class SolicitacaoDAO
    {   

        public function inserir(Solicitacao $solicitacao)
        {

            //print_r($solicitacao); die;

            $qInserir = "INSERT INTO solicitacao(id_orcamento, id_prestador, aceita) VALUES (:id_orcamento, :id_prestador, 0)";            
            
            $pdo = PDOFactory::getConexao();
            
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":id_orcamento", $solicitacao->orcamento->id);
            $comando->bindParam(":id_prestador", $solicitacao->id_prestador);
                                             
            $comando->execute();
            
            $id= $pdo->lastInsertId();
            
            return $id;

        }

        public function buscarPorId($id) {

           
            $query = 'SELECT * FROM solicitacao WHERE id_solicitacao=:id';

           $pdo = PDOFactory::getConexao(); 

           $comando = $pdo->prepare($query);
           $comando->bindParam (':id', $id);
         
        
           $comando->execute();
          
           $result = $comando->fetch(PDO::FETCH_OBJ);

         
           $orcamentoDao = new OrcamentoDao;
           $orcamento = $orcamentoDao->buscarPorId($result->id_orcamento);
                
           return new Solicitacao($result->id_solicitacao, $orcamento->id, $result->id_prestador, $result->aceita);   //está com problema        
        }
        
    }
?>