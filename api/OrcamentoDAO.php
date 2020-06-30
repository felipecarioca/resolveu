 <?php 

    include_once 'Orcamento.php';
    include_once 'Solicitacao.php';
    include_once 'PDOFactory.php';

    class OrcamentoDAO
    {

        public function inserir(Orcamento $orcamento)
        {
              
            $qInserir = "INSERT INTO orcamento(descricao,id_cliente,cep,id_tipo_servico) VALUES (:descricao,:id_cliente,:cep, :id_tipo_servico)";            
            
            $pdo = PDOFactory::getConexao();
            
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":descricao",$orcamento->descricao);
            $comando->bindParam(":id_cliente",$orcamento->id_cliente);
            $comando->bindParam(":cep",$orcamento->cep);
            $comando->bindParam(":id_tipo_servico",$orcamento->id_tipo_servico);
                       
            $comando->execute();
            
            $id = $pdo->lastInsertId();
            
            return $id;
        }

        /*

        @ Comentado por Felipe Pereira 

        public function buscarOrcamento($orcamento)
        {
            $query = 'SELECT * FROM orcamento WHERE descricao=:descricao';
            
            $pdo = PDOFactory::getConexao(); 
            
            $comando = $pdo->prepare($query);
            $comando->bindParam (':descricao', $orcamento);
          
            $comando->execute();
           
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
            return new Orcamento($result->id,$result->descricao);           
        }
        */

        public function buscarPorId($id) {

            $query = 'SELECT * FROM orcamento WHERE id_orcamento=:id';

           $pdo = PDOFactory::getConexao(); 

           $comando = $pdo->prepare($query);
           $comando->bindParam (':id', $id);
         
           $comando->execute();
          
           $result = $comando->fetch(PDO::FETCH_OBJ);

           return new Orcamento($result->id, $result->descricao, $result->id_cliente, $result->cep, $result->id_tipo_servico);
           
       }
           
        
    }
    
?>
