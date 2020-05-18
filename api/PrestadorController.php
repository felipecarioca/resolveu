<?php

include_once('Prestador.php');
include_once('PrestadorDAO.php');


class PrestadorController {
    public function listar($request, $response, $args) {
        $dao= new PrestadorDAO;    
        $Prestadores =  $dao->listar();
                
        return $response->withJson($Prestadores);    
    }
    
    public function buscarPorId($request, $response, $args) {
        $id = $args['id'];
        
        $dao= new PrestadorDAO;    
        $Prestador = $dao->buscarPorId($id);
        
        return $response->withJson($Prestador);
    }

    public function inserir( $request, $response, $args) {
        $prestador = $request->getParsedBody();
        $Prestador = new Prestador(0,$prestador['nome'],$prestador['cpf'],$prestador['email'], $prestador['cep'],$prestador['fone'],$prestador['senha'],$prestador['id_tipo_servico']);
        $dao = new PrestadorDAO;
        $Prestador = $dao->inserir($Prestador);
        return $response->withJson($Prestador,201);    
    }
    
    public function atualizar($request, $response, $args) {
        $id = $args['id'];
        $prestador = $request->getParsedBody();
        $Prestador = new Prestador($id, $prestador['nome'],$prestador['cpf'],$prestador['email'], $prestador['cep'],$prestador['fone'],$prestador['senha'],$prestador['id_tipo_servico']);
        $dao = new PrestadorDAO;
        $Prestador = $dao->atualizar($Prestador);
    
        return $response->withJson($Prestador);    
    }

    public function deletar($request, $response, $args) {
        $id = $args['id'];
        $dao = new PrestadorDAO;
        $Prestador = $dao->deletar($id);
        return $response->withJson($Prestador);  
    }
}
?>