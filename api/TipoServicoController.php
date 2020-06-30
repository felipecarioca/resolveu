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

    public function email($request, $response, $args){

        $mensagem = $request->getParsedBody();             
        $id_cliente = $mensagem['id_cliente'];
        $email_remetente = "resolveu@bananamachinada.com.br"; 
        // deve ser uma conta de email do seu dominio 
        //Configurações do email, ajustar conforme necessidade
        $email_reply=$mensagem['email'];
        //$email_destinatario = "resolveu@bananamachinada.com.br"; // pode ser qualquer email que receberá as mensagens
        $email_assunto = "Consultou ResolveU"; // Este será o assunto da mensagem
        $email_conteudo = "Nome = ".$mensagem['nome'] ."\n"; 
        $email_conteudo .= "Email =".$mensagem['email']."\n";
        $email_conteudo .= "Telefone =".$mensagem['telefone']."\n"; 
        $email_conteudo .= "Mensagem =".$mensagem['mensagem']."\n"; 
        //$email_headers = implode ( "\n",array ( "From: $email_remetente", "Reply-To: $email_reply", "Return-Path: $email_remetente","MIME-Version: 1.0","X-Priority: 3","Content-Type: text/html; charset=UTF-8" ) );
        $id_tipo_servico = $mensagem['id_tipo_servico'];
        $prestadores = new PrestadorDAO;        

        $orcamento = new OrcamentoDAO;        
        $mensagem = $mensagem['mensagem'];
        $id_orcamento=$orcamento->inserir(0,$mensagem);
      
        $emails_destinatarios = $prestadores->buscarPorIdServ($id_tipo_servico);
       // var_dump($emails_destinatarios);    
        foreach($emails_destinatarios as $prestador){       
            //Criando os campos das mensagens para fazer a inserção
            $id_prestador = $prestador->id_prestador;
            $id_status_servico = "0";
            $solicitacao = new SolicitacaoDAO;
            //solicitacao
            $solicita = new Solicitacao(0,$id_cliente,$id_prestador,$id_tipo_servico,$id_status_servico,$id_orcamento);
            $id_solicitacao=$solicitacao->inserir($solicita);
            
            //$solicitacao->buscarIdSolicitacao($solicitacao);


            $email_conteudo .= "Email =".$mensagem['email']."\n";
            $email_conteudo .="<a href='".$id_msgs."'>Aceito</><a href=''".$id_msgs."'>Recuso</a>";
            $email_conteudo .="Aceito: https://www.google.com/".$id_solicitacao."\n";
            $email_conteudo .="Recuso: https://www.google.com/".$id_solicitacao."\n"; 
 
            $email_headers = implode ( "\n",array ( "From: $email_remetente", "Reply-To: $email_reply", "Return-Path: $email_remetente","MIME-Version: 1.0","X-Priority: 3","Content-Type: text/html; charset=UTF-8" ) );
            $email=$prestador->email;
           if (mail($email, $email_assunto, nl2br($email_conteudo), $email_headers)){ 
                echo "</b>E-Mail enviado com sucesso!</b>"; 
                }    
                else{ 
                echo "</b>Falha no envio do E-Mail!</b>"; } 
        }

    }

}