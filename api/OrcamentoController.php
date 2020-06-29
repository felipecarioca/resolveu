<?php

include_once('Orcamento.php');
include_once('OrcamentoDAO.php');
include_once('SolicitacaoDAO.php');
include_once('ClienteDAO.php');

class OrcamentoController {

     public function Aceita($request, $response, $args) {

        $id = $args['id_solicitacao'];
        $dao = new OrcamentoDAO;    
        $msg = $dao->buscarPorId($id);
        $msg->flag = '2';
        
        $dao->Update($msg);

        $this->email_cliente($id);
       
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
    public function email_cliente($id){
        $solicitacao_dao = new SolicitacaoDAO;
        $solicitacao = $solicitacao_dao->buscarPorId($id);
        
        $cliente_dao = new ClienteDAO;                
        $cliente = $cliente_dao->buscarPorId($solicitacao->id_cliente);
        $prestador_dao = new PrestadorDAO;
        $prestador = $prestador_dao->buscarPorId($solicitacao->id_prestador);
        $orcamento_dao = new OrcamentoDAO;
        $orcamento = $orcamento_dao->buscarPorId($solicitacao_dao->id_orcamento);

        $email_remetente = $prestador->email;
     
        $email_reply="resolveu@bananamachinada.com.br";
        
        $email_assunto = "Consultou ResolveU";
        
        $email_conteudo = "Nome = ".$prestador->nome."\n"; 
        $email_conteudo .= "Email =".$prestador->email."\n";
        $email_conteudo .= "Telefone =".$prestador->telefone."\n"; 
        $email_conteudo .= "Mensagem =".$orcamento->descricao."\n";
        
        $email_headers = implode ( "\n",array ( "From: $email_remetente", "Reply-To: $email_reply", "Return-Path: $email_remetente","MIME-Version: 1.0","X-Priority: 3","Content-Type: text/html; charset=UTF-8" ) );

        if (mail($cliente->email, $email_assunto, nl2br($email_conteudo), $email_headers)){ 
            echo "</b>E-Mail enviado com sucesso!</b>"; 
            }    
            else{ 
            echo "</b>Falha no envio do E-Mail!</b>"; } 
        }

   
   
}
?>