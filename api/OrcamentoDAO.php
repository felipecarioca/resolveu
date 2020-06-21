 <?php 
    include_once 'Orcamento.php';
    include_once 'Solicitacao.php';
	include_once 'PDOFactory.php';

    class MensagemDAO
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
           
        
    }
?>
