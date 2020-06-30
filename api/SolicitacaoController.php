<?php

include_once('Solicitacao.php');
include_once('SolicitacaoDAO.php');


class SolicitacaoController {
    
    public function buscarPorId($request, $response, $args) {
        
        $id = $args['id'];
        
        $dao = new SolicitacaoDAO();    
        
        $serv = $dao->buscarPorId($id);
        
        if(is_bool($serv)) {
            
            return $response->withJson(array("retorno"=>"0","msg"=>"Serviço não existe."));
        
        } else {
            
            return $response->withJson($serv);
        
        }
    }
}

?>