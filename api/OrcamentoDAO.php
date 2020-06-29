 <?php 

    include_once 'Orcamento.php';
    include_once 'Solicitacao.php';
    include_once 'PDOFactory.php';

    class OrcamentoDAO
    {

        public function inserir(Orcamento $orcamento)
        {
              
            $qInserir = "INSERT INTO orcamento(descricao) VALUES (:descricao)";            
            
            $pdo = PDOFactory::getConexao();
            
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":descricao",$orcamento->descricao);
                       
            $comando->execute();
            
            $id = $pdo->lastInsertId();
            
            return $id;
        }

        public function buscarOrcamento($orcamento)
        {
            $query = 'SELECT id_orcamento FROM orcamento WHERE descricao=:descricao';
            
            $pdo = PDOFactory::getConexao(); 
            
            $comando = $pdo->prepare($query);
            $comando->bindParam (':descricao', $orcamento);
          
            $comando->execute();
           
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
            return new Orcamento($result->id,$result->descricao);           
        }

        public function buscarPorId($id) {

            $query = 'SELECT * FROM orcamento WHERE id_orcamento=:id';

           $pdo = PDOFactory::getConexao(); 

           $comando = $pdo->prepare($query);
           $comando->bindParam (':id', $id);
         
           $comando->execute();
          
           $result = $comando->fetch(PDO::FETCH_OBJ);
           return new Orcamento($result->id, $result->descricao);           
       }
           
        
    }
    
?>
