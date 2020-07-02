<?php

include_once('Cliente.php');
include_once('ClienteDAO.php');


class ClienteController {
   

    public function inserir( $request, $response, $args) {
        
        $c = $request->getParsedBody();
        
        $Cliente = new Cliente($c['id'],$c['nome'], $c['cpf'], $c['email'],$c['senha'],$c['cep'],$c['fone'] );
        
        $dao = new ClienteDAO;
        
        $Cliente = $dao->inserir($Cliente);

        if(!$Cliente)
            return $response->withJson(array("retorno"=>"0","msg"=>"CPF já existente."));
        else
            return $response->withJson($Cliente, 201);

    }
    
     public function listar($request, $response, $args) {
        $dao = new ClienteDAO;    
        $Cliente =  $dao->listar();
        
        return $response->withJson($Cliente);    
    }

    public function buscarPorId($request, $response, $args) {
        $id = $args['id'];
        $dao= new ClienteDAO;    
        $Cliente = $dao->buscarPorId($id);
        //var_dump($Cliente);
        if(is_bool($Cliente)){ $response->withJson($Cliente);}
        else{
        return $response->withJson($Cliente);}
    }

    public function atualizar($request, $response, $args) {
        $id = $args['id'];
        $c = $request->getParsedBody();
        $Cliente = new Cliente($c['id'],$c['nome'], $c['cpf'], $c['email'], $c['cep'],$c['telefone'], $c['senha'] );
        $dao = new ClienteDAO;
        $Cliente = $dao->atualizar($Cliente);
        return $response->withJson($Cliente);    
    }

    public function deletar($request, $response, $args) {
        $id = $args['id'];

        $dao = new ClienteDAO;
        $Cliente = $dao->deletar($id);
    
        return $response->withJson($Cliente);  
    }
    public function logar( $request, $response, $args)
    {
        $c = $request->getParsedBody();
        
        if(is_null($c['email']) || is_null($c['senha'])){
            $msg="Os campos não foram preenchidos por completo";
            return $msg;
        }   
        else{        
            $dao = new ClienteDAO;
            $Cliente = $dao->logar($c['email'],$c['senha']);
            if(is_bool($Cliente))
            {
                return $response->withJson(array("retorno"=>"0","msg"=>"Usuario não existe."));
            }
            else
            {
            return $response->withJson($Cliente);
            }
            
        }
    }
}