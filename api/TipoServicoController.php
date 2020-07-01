<?php

include_once('TipoServico.php');
include_once('TipoServicoDAO.php');


class TipoServicoController {
    
    public function buscarPorId($request, $response, $args) {
        
        $id = $args['id'];
        
        $dao = new TipoServicoDAO();    
        
        $serv = $dao->buscarPorId($id);
        
        if(is_bool($serv)) {
            
            return $response->withJson(array("retorno"=>"0","msg"=>"Serviço não existe."));
        
        } else {
            
            return $response->withJson($serv);
        
        }
    }

    public function buscarPorDescricao($request, $response, $args){
        
        $descricao = $args['descricao'];
        
        $dao = new TipoServicoDAO;    
        
        $serv = $dao->buscarPorDescricao($descricao);

        if(is_bool($serv)) 
            return $response->withJson(array("retorno"=>"0","msg"=>"Serviço não existe."));
        else
            return $response->withJson($serv);
        
    }

    public function listar($request, $response, $args) {
        
        $dao = new TipoServicoDAO;    
        $tipos =  $dao->listar();
                
        return $response->withJson($tipos);    
    }

    

}