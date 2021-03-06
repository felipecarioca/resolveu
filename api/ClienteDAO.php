<?php
    include_once 'Cliente.php';
	include_once 'PDOFactory.php';

    class ClienteDAO
    {
        public function inserir(Cliente $Cliente)
        {
            
            if($this->verificaDuplicidade($Cliente->cpf)) {
                return false;
            }

            $qInserir = "INSERT INTO cliente(nome, senha, email, cpf, cep, fone) VALUES (:nome,:senha,:email,:cpf,:cep,:fone)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":nome",$Cliente->nome);
            $comando->bindParam(":senha",$Cliente->senha);
            $comando->bindParam(":email",$Cliente->email);
            $comando->bindParam(":cpf",$Cliente->cpf);
            $comando->bindParam(":cep",$Cliente->cep);
            $comando->bindParam(":fone",$Cliente->telefone);
            $comando->execute();
            
            $Cliente->id = $pdo->lastInsertId();

            return $Cliente;           
        }

        public function deletar($id)
        {
            $qDeletar = "DELETE from cliente WHERE id_cliente=:id";            
            $Cliente = $this->buscarPorId($id);
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();
            return $Cliente;
        }
        public function atualizar(Cliente $Cliente)
        {
            $qAtualizar = "UPDATE cliente SET nome=:nome, senha=:senha, email=:email, cpf=:cpf, cep=:cep, fone=:fone WHERE id_cliente=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":nome",$Cliente->nome);
            $comando->bindParam(":senha",$Cliente->senha);
            $comando->bindParam(":email",$Cliente->email);
            $comando->bindParam(":cpf",$Cliente->cpf);
            $comando->bindParam(":cep",$Cliente->cep);
            $comando->bindParam(":fone",$Cliente->telefone);
            $comando->bindParam(":id",$Cliente->id);
            $comando->execute();
            return $Cliente;        
        }
        public function listar()
        {

	    $query = 'SELECT * FROM cliente';
    	    $pdo = PDOFactory::getConexao();
	    $comando = $pdo->prepare($query);
    	    $comando->execute();
            $Clientes=array();	
            while($result = $comando->fetch(PDO::FETCH_OBJ)){
			    $Clientes[] = new Cliente($result->id_cliente,$result->nome,$result->cpf,$result->email, $result->senha, $result->cep,$result->fone); 
            }
            return $Clientes;
        }

        public function buscarPorId($id)
        {
 		    $query = 'SELECT * FROM cliente WHERE id_Cliente=:id';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam (':id', $id);
            $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
        
            if(is_bool($result)){
                return false;
            }   else{
                $teste = new Cliente($result->id_cliente,$result->nome,$result->cpf, $result->email, $result->senha, $result->cep, $result->fone, $result->cep);        
                    return $teste;                    
                    }    
        }

        public function verificaDuplicidade($cpf)
        {
            $query = 'SELECT * FROM cliente WHERE cpf=:cpf';

            $pdo = PDOFactory::getConexao();
            
            $comando = $pdo->prepare($query);
            $comando->bindParam (':cpf', $cpf);
            $comando->execute();
            
            $result = $comando->fetch(PDO::FETCH_OBJ);

            if($result === false)
                return false; // Não há duplicidade
            else
                return true; // Há duplicidade
        }
        
        public function logar($email, $senha)
        {
            $query = 'SELECT * FROM cliente Where email=:email and senha=:senha';
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($query);
            $comando->bindParam (':email', $email);
            $comando->bindParam (':senha', $senha);
            $comando->execute();        
            $result = $comando->fetch(PDO::FETCH_OBJ);
            if(is_bool($result)){
                return false;
            }else{

                return new Cliente($result->id_cliente,$result->nome, $result->cpf, $result->email,$result->senha, $result->fone, $result->cep);        
                }
        }
}
?>
