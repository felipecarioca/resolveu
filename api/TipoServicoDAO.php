<?php

	include_once 'PDOFactory.php';

    class TipoServicoDAO
    {

        public function buscarPorId($id)
        {

            $query = "SELECT * FROM tipo_servico WHERE id_tipo_servico = :id";      
            
            $pdo = PDOFactory::getConexao(); 
            
            $comando = $pdo->prepare($query);
            $comando->bindParam ('id', $id);
            $comando->execute();
            
            $result = $comando->fetch(PDO::FETCH_OBJ);

            return new TipoServico($result->id_tipo_servico, $result->descricao);

        }
        
        public function buscarPorDescricao($descricao)
        {
            
            $descricao = "%$descricao%";

            $query = "SELECT * FROM tipo_servico WHERE descricao LIKE :descricao";	
            
            $pdo = PDOFactory::getConexao();

            $comando = $pdo->prepare($query);        
            $comando->bindParam (":descricao", $descricao);
            $comando->execute();

            $tiposServico = array();  

            while($row = $comando->fetch(PDO::FETCH_OBJ)) {
                $tiposServico[] = new TipoServico($row->id_tipo_servico,$row->descricao);
            }

            return $tiposServico;
            
        }

        /*
        
        public function buscarPorIdServ($id)
        {
            $word= "%".$id."%";
            
            $query = "SELECT * FROM tipo_servico WHERE descricao like :word";   
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);        
            $comando->bindParam (":word", $word);
            $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
            if(is_bool($result)) {
                return false;
            } else {
                
                $teste = new TipoServico($result->id_tipo_servico,$result->descricao);        
                $id_tipo_servico=$teste->id;
                $prestador= new PrestadorDAO;
                
                return $prestador->buscarPorIdServ($id_tipo_servico);
            }
            
        }
        
        */

    }

?>