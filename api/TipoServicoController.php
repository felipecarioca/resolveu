<?php

include_once('TipoServico.php');
include_once('TipoServicoDAO.php');


class TipoServicoController {
    
    public function buscarPorId($request, $response, $args) {
        $id = $args['id'];
        
        $dao= new TipoServicoDAO;    
        $serv = $dao->buscarPorId($id);
        if(is_bool($serv)){ return $response->withJson(array("retorno"=>"0","msg"=>"Serviço não existe."));}
        else{
        return $response->withJson($serv);}
    }
    //busca prestador por servico
    public function buscarPorIdServ($request, $response, $args) {
        $id = $args['word'];
        
        $dao= new TipoServicoDAO;    
        $serv = $dao->buscarPorIdServ($id);
        if(is_bool($serv)){ return $response->withJson(array("retorno"=>"0","msg"=>"Serviço não existe."));}
        else{
        return $response->withJson($serv);}
    }
    public function buscarPorWordServ($request, $response, $args){
        $word = $args['word'];
        
        $dao= new TipoServicoDAO;    
        $serv = $dao->buscarPorWordServ($word);
        if(is_bool($serv)){ return $response->withJson(array("retorno"=>"0","msg"=>"Serviço não existe."));;}
        else{
        return $response->withJson($serv);}
    }
    public function email($request, $response, $args){
        $mensagem = $request->getParsedBody();             
        
        $email_remetente = "resolveu@bananamachinada.com.br"; // deve ser uma conta de email do seu dominio 
        //Configurações do email, ajustar conforme necessidade
        $email_reply=$mensagem['email'];
        //$email_destinatario = "resolveu@bananamachinada.com.br"; // pode ser qualquer email que receberá as mensagens
        $email_assunto = "Consultou ResolveU"; // Este será o assunto da mensagem
        $email_conteudo = "Nome = ".$mensagem['nome'] ."\n"; 
        $email_conteudo .= "Email =".$mensagem['email']."\n";
        $email_conteudo .= "Telefone =".$mensagem['telefone']."\n"; 
        $email_conteudo .= "Mensagem =".$mensagem['mensagem']."\n"; 
        $email_headers = implode ( "\n",array ( "From: $email_remetente", "Reply-To: $email_reply", "Return-Path: $email_remetente","MIME-Version: 1.0","X-Priority: 3","Content-Type: text/html; charset=UTF-8" ) );
        $id_tipo_servico = $mensagem['id_tipo_servico'];
        $prestadores = new PrestadorDAO;
        $emails_destinatarios = $prestadores->buscarPorIdServ($id_tipo_servico);
       // var_dump($emails_destinatarios);    
        foreach($emails_destinatarios as $prestador){                
            //$email=$obj->email_contratante;
            $email=$prestador->email;
           if (mail($email, $email_assunto, nl2br($email_conteudo), $email_headers)){ 
                echo "</b>E-Mail enviado com sucesso!</b>"; 
                }    
                else{ 
                echo "</b>Falha no envio do E-Mail!</b>"; } 
        }

    }

}