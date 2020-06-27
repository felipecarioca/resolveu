<?php

include_once('Orcamento.php');
include_once('OrcamentoDAO.php');
include_once('SolicitacaoDAO.php');

class OrcamentoController {

     public function Aceita($request, $response, $args) {

        $id = $args['id_solicitacao'];
        $dao = new OrcamentoDAO;    
        $msg = $dao->buscarPorId($id);
        $msg->flag = '2';
        
        $dao->Update($msg);
        
        if(
            is_bool($Cliente)){ $response->withJson($Cliente);
        }
        else {
            return $response->withJson($Cliente);
        }
    }
    public function Recusada($request, $response, $args) {
        
        $id = $args['id_solicitacao'];
        
        $dao = new OrcamentoDAO;    
        $msg = $dao->buscarPorId($id);
        $msg->flag = '1';
        $dao->Update($msg);
        
        if(
            is_bool($Cliente)){ $response->withJson($Cliente);
        }
        else {
            return $response->withJson($Cliente);
        }
    }

}
?>