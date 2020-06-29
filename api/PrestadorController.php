<?php

include_once('Prestador.php');
include_once('PrestadorDAO.php');


class PrestadorController {

    public function listar($request, $response, $args) {
        $dao= new PrestadorDAO;    
        $prestadores =  $dao->listar();
                
        return $response->withJson($prestadores);    
    }
    
    public function buscarPorId($request, $response, $args) {
        $id = $args['id'];
        
        $dao= new PrestadorDAO;    
        $prestador = $dao->buscarPorId($id);
        
        return $response->withJson($prestador);
    }

    public function buscarPorServico($request, $response, $args) {
        $id = $args['id'];
        
        $dao= new PrestadorDAO;    
        $prestador = $dao->buscarPorServico($id);
        
        return $response->withJson($prestador);
    }

    public function inserir( $request, $response, $args) {
        $prestador = $request->getParsedBody();
        $prestador = new Prestador(0,$prestador['nome'],$prestador['cpf'],$prestador['email'], $prestador['cep'],$prestador['fone'],$prestador['senha'],$prestador['id_tipo_servico']);
        $dao = new PrestadorDAO;
        $prestador = $dao->inserir($prestador);
        return $response->withJson($prestador,201);    
    }
    
    public function atualizar($request, $response, $args) {
        $id = $args['id'];
        $prestador = $request->getParsedBody();
        $prestador = new Prestador($id, $prestador['nome'],$prestador['cpf'],$prestador['email'], $prestador['cep'],$prestador['fone'],$prestador['senha'],$prestador['id_tipo_servico']);
        $dao = new PrestadorDAO;
        $prestador = $dao->atualizar($prestador);
    
        return $response->withJson($prestador);    
    }

    public function deletar($request, $response, $args) {
        $id = $args['id'];
        $dao = new PrestadorDAO;
        $prestador = $dao->deletar($id);
        return $response->withJson($prestador);  
    }

}

?>