<?php

include_once('Solicitacao.php');
include_once('SolicitacaoDAO.php');


class SolicitacaoController {
    

    public function buscarPorId($request, $response, $args) {
        
        $id = $args['id'];
        
        $dao = new SolicitacaoDAO();    
        
        $solicitacao = $dao->buscarPorId($id);
        
        if(is_bool($solicitacao)) {
            
            return $response->withJson(array("retorno"=>"0","msg"=>"Solicitação não existe."));
        
        } else {
            
            return $response->withJson($solicitacao);
        
        }
    }

    public function aceitar($request, $response, $args) {
        
        // Deixar no link algo como "localhost/api/solicitacao/aceitar/is=sdasio2j1i3oj12io3j12ioj3jcfoiasjd" = SIMULAÇÃO DE UM ID_SOLICITACAO EM BASE_64
        $id_solicitacao = base64_decode($args['is']); // is = id_solicitacao "mascarado"
        
        $solicitacaoDao = new SolicitacaoDAO;
        $solicitacao = $solicitacaoDao->buscarPorId($id_solicitacao);
        
        $prestadorDao = new PrestadorDao;
        $prestador = $prestadorDao->buscarPorId($solicitacao->id_prestador);

        $clienteDao = new ClienteDao;
        $cliente = $clienteDao->buscarPorId($solicitacao->orcamento->id_cliente);

        // Enviar E-mail para o cliente agora que já temos as informações necessárias da solicitação (dados do cliente, prestador e etc)
        // ENVIAR AQUI
        
    }

}

?>