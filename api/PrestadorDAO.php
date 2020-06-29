<?php
    include_once 'Prestador.php';
	include_once 'PDOFactory.php';

    class PrestadorDAO
    {
        public function inserir(Prestador $Prestador)
        {
            $qInserir = "INSERT INTO prestador(nome, cpf, email, cep, fone, senha, id_tipo_servico,endereco,empresa) VALUES (:nome,:cpf,:email,:cep,:fone,:senha,:id_tipo_servico,:endereco,:empresa)";            
            
            $pdo = PDOFactory::getConexao();
            
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":nome",$Prestador->nome);
            $comando->bindParam(":cpf",$Prestador->cpf);
            $comando->bindParam(":email",$Prestador->email);
            $comando->bindParam(":cep",$Prestador->cep);
            $comando->bindParam(":fone",$Prestador->fone);
            $comando->bindParam(":senha",$Prestador->senha);
            $comando->bindParam(":id_tipo_servico",$Prestador->id_tipo_servico);
            $comando->bindParam(":endereco",$Prestador->endereco);
            $comando->bindParam(":empresa",$Prestador->empresa);
            $comando->execute();
            
            $Prestador->id = $pdo->lastInsertId();
            
            return $Prestador;
        }

        public function deletar($id)
        {
            $qDeletar = "DELETE from prestador WHERE id_prestador=:id";            
            
            $prestador = $this->buscarPorId($id);
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();

            return $prestador;
        }

        public function atualizar(Prestador $prestador)
        {
            
            $query = "UPDATE prestador SET nome=:nome, cpf=:cpf, email=:email, cep=:cep, fone=:fone, senha=:senha, id_tipo_servico=:id_tipo_servico, endereco=:endereco, empresa=:empresa WHERE id_prestador=:id";            
                                  
            $pdo = PDOFactory::getConexao();
            
            $comando = $pdo->prepare($query);

            $comando->bindParam(":nome",$prestador->nome);
            $comando->bindParam(":cpf",$prestador->cpf);
            $comando->bindParam(":email",$prestador->email);
            $comando->bindParam(":cep",$prestador->cep);
            $comando->bindParam(":fone",$prestador->fone);
            $comando->bindParam(":senha",$prestador->senha);
            $comando->bindParam(":id_tipo_servico",$prestador->id_tipo_servico);
            $comando->bindParam(":endereco",$prestador->endereco);
            $comando->bindParam(":empresa",$prestador->empresa);
            $comando->bindParam(":id",$prestador->id);

            $comando->execute();
            
            return $prestador;        
        }

        public function listar() {

		    $query = 'SELECT * FROM prestador';

    		$pdo = PDOFactory::getConexao();

	    	$comando = $pdo->prepare($query);
    		$comando->execute();

            $prestadores=array();

		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			    $prestadores[] = new Prestador($row->id_prestador,$row->nome,$row->cpf, $row->email, $row->cep, $row->fone, $row->senha, $row->id_tipo_servico, $row->endereco, $row->empresa);
            }

            return $prestadores;
        }

        public function buscarPorId($id) {

 		    $query = 'SELECT * FROM prestador WHERE id_prestador=:id';

            $pdo = PDOFactory::getConexao(); 

		    $comando = $pdo->prepare($query);
            $comando->bindParam (':id', $id);
          
            $comando->execute();
           
		    $result = $comando->fetch(PDO::FETCH_OBJ);
          
		    return new Prestador($result->id_prestador,$result->nome,$result->cpf,$result->email, $result->cep,$result->fone, $result->senha, $result->id_tipo_servico, $result->endereco, $result->empresa);           
        }

        public function buscarPorServico($id) {

 		    $query = 'SELECT * FROM prestador WHERE id_tipo_servico=:id LIMIT 5';
            
            $pdo = PDOFactory::getConexao(); 
		    
            $comando = $pdo->prepare($query);
		    $comando->bindParam (':id', $id);
		    $comando->execute();
            
            $prestadores = array();	
		    
            while($row = $comando->fetch(PDO::FETCH_OBJ)){
			    $prestadores[] = new Prestador($row->id_prestador,$row->nome,$row->cpf, $row->email, $row->senha,$row->cep, $row->fone,$row->id_tipo_servico, $row->endereco, $row->empresa);
            }

            return $prestadores;
		    
        }
       
    }
?>