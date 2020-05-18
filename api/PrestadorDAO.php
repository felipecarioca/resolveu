<?php
    include_once 'Prestador.php';
	include_once 'PDOFactory.php';

    class PrestadorDAO
    {
        public function inserir(Prestador $Prestador)
        {
            $qInserir = "INSERT INTO prestador(nome, cpf, email, cep, fone, senha, id_tipo_servico) VALUES (:nome,:cpf,:email,:cep,:fone,:senha,:id_tipo_servico)";            
            
            $pdo = PDOFactory::getConexao();
            
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":nome",$Prestador->nome);
            $comando->bindParam(":cpf",$Prestador->cpf);
            $comando->bindParam(":email",$Prestador->email);
            $comando->bindParam(":cep",$Prestador->cep);
            $comando->bindParam(":fone",$Prestador->fone);
            $comando->bindParam(":senha",$Prestador->senha);
            $comando->bindParam(":id_tipo_servico",$Prestador->id_tipo_servico);
            $comando->execute();
            
            $Prestador->id = $pdo->lastInsertId();
            
            return $Prestador;
        }

        public function deletar($id)
        {
            $qDeletar = "DELETE from prestador WHERE id=:id";            
            $Prestador = $this->buscarPorId($id);
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();

            return $Prestador;
        }

        public function atualizar(Prestador $Prestador)
        {
            $qAtualizar = "UPDATE prestador SET nome=:nome, cpf=:cpf, email=:email, cep=:cep, fone=:fone, senha=:senha WHERE id=:id";            
            
            $pdo = PDOFactory::getConexao();

            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":nome",$Prestador->nome);
            $comando->bindParam(":cpf",$Prestador->cpf);
            $comando->bindParam(":email",$Prestador->email);
            $comando->bindParam(":cep",$Prestador->cep);
            $comando->bindParam(":fone",$Prestador->fone);
            $comando->bindParam(":senha",$Prestador->senha);
            $comando->bindParam(":id_tipo_servico",$Prestador->id_tipo_servico);
            $comando->execute();

            return $Prestador;        
        }

        public function listar()
        {
		    $query = 'SELECT * FROM prestador';

    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $Prestadores=array();

		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			    $Prestadores[] = new Prestador($row->id,$row->nome,$row->cpf, $row->email, $row->cep, $row->fone, $row->senha, $row->id_tipo_servico);
            }

            return $Prestadores;
        }

        public function buscarPorId($id)
        {
 		    $query = 'SELECT * FROM prestador WHERE id=:id';
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam (':id', $id);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);

		    return new Prestador($result->id,$result->nome,$result->cpf,$result->email, $result->cep,$result->fone, $result->senha, $result->id_tipo_servico);           
        }
       
    }
?>