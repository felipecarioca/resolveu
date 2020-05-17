<?php
    include_once 'Prestador.php';
	include_once 'PDOFactory.php';

    class PrestadorDAO
    {
        public function inserir(Prestador $Prestador)
        {
            $qInserir = "INSERT INTO Prestadores(nome, senha, email, cpf, cep, fone) VALUES (:nome,:senha,:email,:cpf,:cep,:telefone)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":nome",$Prestador->nome);
            $comando->bindParam(":cpf",$Prestador->cpf);
            $comando->bindParam(":email",$Prestador->email);
            $comando->bindParam(":senha",$Prestador->senha);
            $comando->bindParam(":cep",$Prestador->cep);
            $comando->bindParam(":telefone",$Prestador->telefone);
            $comando->execute();
            $Prestador->id = $pdo->lastInsertId();
            return $Prestador;
        }

        public function deletar($id)
        {
            $qDeletar = "DELETE from Prestadores WHERE id_prestador=:id";            
            $Prestador = $this->buscarPorId($id);
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();
            return $Prestador;
        }

        public function atualizar(Prestador $Prestador)
        {
            $qAtualizar = "UPDATE Prestadores SET nome=:nome, senha=:senha, email=:email, cpf=:cpf, cep=:cep, fone=:telefone WHERE id_prestador=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":nome",$Prestador->nome);
            $comando->bindParam(":cpf",$Prestador->cpf);
            $comando->bindParam(":email",$Prestador->email);
            $comando->bindParam(":senha",$Prestador->senha);
            $comando->bindParam(":cep",$Prestador->cep);
            $comando->bindParam(":telefone",$Prestador->telefone);
            $comando->bindParam(":id",$Prestador->id);
            $comando->execute();
            return $Prestador;        
        }

        public function listar()
        {
		    $query = 'SELECT * FROM prestadores';
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $Prestadores=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			    $Prestadores[] = new Prestador($row->id_prestador,$row->nome,$row->cpf, $row->email, $row->senha,$row->cep, $row->fone);
            }
            return $Prestadores;
        }

        public function buscarPorId($id)
        {
 		    $query = 'SELECT * FROM Prestadores WHERE id_Prestador=:id';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam (':id', $id);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new Prestador($result->id_prestador,$result->nome,$result->cpf,$result->email, $result->senha,$result->cep,$result->fone);           
        }
       
    }
?>