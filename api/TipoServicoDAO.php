<?php
    include_once 'Cliente.php';
	include_once 'PDOFactory.php';

    class TipoServicoDAO
    {

        public function buscarPorIdServ($id)
        {
            $word= "%".$id."%";
            
            $query = "SELECT * FROM tipo_servico WHERE descricao like :word";	
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);        
            $comando->bindParam (":word", $word);
            $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
            if(is_bool($result)){
                return false;
            }   else{
                $teste = new TipoServico($result->id_tipo_servico,$result->descricao);        
                $id_tipo_servico=$teste->id;
                $prestador= new PrestadorDAO;
                return $prestador->buscarPorIdServ($id_tipo_servico);
                }
            
        }
        
        public function buscarPorWordServ($string)
        {
            $word= "%".$string."%";
            
            $query = "SELECT * FROM tipo_servico WHERE descricao like :word";	
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);        
            $comando->bindParam (":word", $word);
            $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            if(is_bool($result)){
                return false;
            }   else{
                $teste = new TipoServico($result->id_tipo_servico,$result->descricao);        
                                
                return $teste;
                }
            
        }
        public function buscarPorId($id)
        {
           $query = "SELECT * FROM tipo_servico WHERE id_tipo_servico=:id";		
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
                
            $comando->bindParam (":id", $id);
            
            $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
            if(is_bool($result)){
                return false;
            }   else{
                $teste = new TipoServico($result->id_tipo_servico,$result->descricao);        
                return $teste;
                }
            
        }
    }

?>