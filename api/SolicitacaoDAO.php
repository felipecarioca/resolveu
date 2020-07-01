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

            $qInserir = "INSERT INTO solicitacao(id_orcamento, id_prestador) VALUES (:id_orcamento, :id_prestador)";            
            
            $pdo = PDOFactory::getConexao();
            
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":id_orcamento", $solicitacao->orcamento->id);
            $comando->bindParam(":id_prestador", $solicitacao->id_prestador);
                                             
            $comando->execute();
            
            $id= $pdo->lastInsertId();
            
            return $id;

        }

        /*

        @ Comentado por Felipe Pereira - Não haverá mais utilidade pois não trabalharemos mais com status

        public function Update(Soicitacao $retorno)
        {
            $qAtualizar = "UPDATE solicitacao SET  id_status_servico=:id_status_servico WHERE id_solicitacao=:id_solicitacao";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":id_status_servico",$retorno->id_status_servico);
            $comando->bindParam(":id_solicitacao",$solicitacao->id_solicitacao);
            return $comando;        
        }

        public function buscarIdSolicitacao(Solicitacao $solicitacao)
        {
            $query = 'SELECT id_solicitacao FROM solicitacao WHERE  id_cliente=:id_cliente and id_prestador=:id_prestador and id_tipo_servico=:id_tipo_servico and id_tipo_servico=:id_status_servico and id_orcamento=:id_orcamento';
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
            
            $comando->bindParam (':descricao', $orcamento);
          
            $comando->execute();
           
		    $result = $comando->fetch(PDO::FETCH_OBJ);
          //:id_cliente,:id_prestador,:id_tipo_servico,:id_status_servico,:id_orcamento
		    return new Prestador($result->id,$result->descricao);           

        }
        
        */

        public function buscarPorId($id) {

           
            $query = 'SELECT * FROM solicitacao WHERE id_solicitacao=:id';

           $pdo = PDOFactory::getConexao(); 

           $comando = $pdo->prepare($query);
           $comando->bindParam (':id', $id);
         
        
           $comando->execute();
          
           $result = $comando->fetch(PDO::FETCH_OBJ);

         
           $orcamentoDao = new OrcamentoDao;
           $orcamento = $orcamentoDao->buscarPorId($result->id_orcamento);
                
           return new Solicitacao($result->id_solicitacao, $orcamento->id, $result->id_prestador);   //está com problema        
       }

        
    }
?>