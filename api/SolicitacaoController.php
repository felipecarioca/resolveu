<?php

include_once('Cliente.php');
include_once('ClienteDAO.php');

include_once('Orcamento.php');
include_once('OrcamentoDAO.php');


include_once('Solicitacao.php');
include_once('SolicitacaoDAO.php');

include_once('Prestador.php');
include_once('PrestadorDAO.php');


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
    
    public function aceita($request, $response, $args) {

        $id = $args['id'];

        $query = "UPDATE solicitacao SET aceita = 1 WHERE id_solicitacao=:id";
        
        $pdo = PDOFactory::getConexao();
        
        $comando = $pdo->prepare($query);
        $comando->bindParam(":id",$id);
        $comando->execute();

        // Envia E-mail
        $this->email_cliente($id);
       
    }
    
    public function email_cliente($id) {
        
        $solicitacao_dao = new SolicitacaoDAO;
        $solicitacao = $solicitacao_dao->buscarPorId($id);
        

        $prestador_dao = new PrestadorDAO;
        $prestador = $prestador_dao->buscarPorId($solicitacao->id_prestador);
        $orcamento_dao = new OrcamentoDAO;
        $orcamento = $orcamento_dao->buscarPorId($solicitacao->orcamento);

        $cliente_dao = new ClienteDAO;
        $cliente = $cliente_dao->buscarPorId($orcamento->id_cliente);

        $email_remetente = "atendimento@resolveu.kinghost.net";
     
        $email_reply = "resolveu@bananamachinada.com.br";
        
        $email_assunto = "ResolveU - Contato do Prestador";
        $template_cliente = '<tr>
        <td style="padding: 0 2.5em; text-align: center; padding-bottom: 3em;">
            <div class="text">
                <h2 style="color: #000; font-size: 34px;    margin-bottom: 0;   font-weight: 200; line-height: 1.4;">'.$prestador->nome.' enviou os dados de contato para você! Entre em contato com ele!</h2>
            </div>
        </td>
        </tr>
        <tr>

        <td>
      <div class="text-author" style="bordeR: 1px solid rgba(0,0,0,.05);max-width: 50%;margin: 0 auto;padding: 2em;" >
          <div style="text-align: center;">
        <img src="'.$prestador_img.'" alt="" style="width: 100px; max-width: 600px; height: auto; margin: auto; display: block;">
          <h3 class="name" style="font-size:22px; color:#213b52">'.$prestador->empresa.'</h3><br>
        </div>
        <div style="text-align: left; color:black; font-size:16px">
          <span class="position"><b style="color:#213b52">Nome do prestador:</b> '.$prestador->nome.'</span><br>
        <span class="position"><b style="color:#213b52">Telefone: </b>'.$prestador->fone.'</span><br>
        <span class="position"><b style="color:#213b52">Endereço:</b> '.$prestador->endereco.'</span><br><br>
        <a href="https://www.google.com/maps/search/'.$prestador->endereco.'" style="color:green" >Ver no mapa</a><br>
        <a href="#" style="color:green" >Ver perfil no site</a>
      
        </div><br><br>
        <span style="color:#213b52">Se você gostou do serviço deste prestador avalie</span><br><br>
        <a href="http://resolveu.kinghost.net/app_resolveu/public/prestadores/recomendarPrestador/'.$prestador->id.'" style="border-radius: 5px;background: #28a745;color: #ffffff; padding: 10px 15px; display: inline-block;" > '.json_decode('&#128077').' Gostei</a> | <a href="http://resolveu.kinghost.net/app_resolveu/public/prestadores/naoRecomendarPrestador/'.$prestador->id.'" style="border-radius: 5px;background: #dc3545;color: #ffffff; padding: 10px 15px; display: inline-block;"> '.json_decode('&#128078').' Não gostei</a>
       </div>
  </td>
';
        $email_conteudo = '
        <!DOCTYPE html>
        <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
        <head>
            <meta charset="utf-8"> <!-- utf-8 works for most cases -->
            <meta name="viewport" content="width=device-width"> 
            <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
            <meta name="x-apple-disable-message-reformatting">  
            <title></title> 
        
            <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet">
        
            <!-- CSS Reset : BEGIN -->
            <style>
        
                /* What it does: Remove spaces around the email design added by some email clients. */
                /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
                html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            background: #f1f1f1;
        }
        
        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }
        
        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }
        
        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }
        
        /* What it does: Fixes webkit padding issue. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }
        
        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode:bicubic;
        }
        
        /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
        a {
            text-decoration: none;
        }
        
        /* What it does: A work-around for email clients meddling in triggered links. */
        *[x-apple-data-detectors],  /* iOS */
        .unstyle-auto-detected-links *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }
        
        /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }
        
        /* What it does: Prevents Gmail from changing the text color in conversation threads. */
        .im {
            color: inherit !important;
        }
        
        
        img.g-img + div {
            display: none !important;
        }
        
        
        
        
        @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            u ~ div .email-container {
                min-width: 320px !important;
            }
        }
        /* iPhone 6, 6S, 7, 8, and X */
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            u ~ div .email-container {
                min-width: 375px !important;
            }
        }
        /* iPhone 6+, 7+, and 8+ */
        @media only screen and (min-device-width: 414px) {
            u ~ div .email-container {
                min-width: 414px !important;
            }
        }
        
        
            </style>
        
            <!-- CSS Reset : END -->
        
            <!-- Progressive Enhancements : BEGIN -->
            <style>
        
                .primary{
            background: #17bebb;
        }
        .bg_white{
            background: #ffffff;
        }
        .bg_light{
            background: #f7fafa;
        }
        .bg_black{
            background: #000000;
        }
        .bg_dark{
            background: rgba(0,0,0,.8);
        }
        .email-section{
            padding:2.5em;
        }
        
        /*BUTTON*/
        .btn{
            padding: 10px 15px;
            display: inline-block;
        }
        .btn.btn-primary{
            border-radius: 5px;
            background: #17bebb;
            color: #ffffff;
        }
        .btn.btn-white{
            border-radius: 5px;
            background: #ffffff;
            color: #000000;
        }
        .btn.btn-white-outline{
            border-radius: 5px;
            background: transparent;
            border: 1px solid #fff;
            color: #fff;
        }
        .btn.btn-black-outline{
            border-radius: 0px;
            background: transparent;
            border: 2px solid #000;
            color: #000;
            font-weight: 700;
        }
        .btn-custom{
            color: rgba(0,0,0,.3);
            text-decoration: underline;
        }
        
        h1,h2,h3,h4,h5,h6{
            font-family: "Poppins", sans-serif;
            color: #000000;
            margin-top: 0;
            font-weight: 400;
        }
        
        body{
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            font-size: 15px;
            line-height: 1.8;
            color: rgba(0,0,0,.4);
        }
        
        a{
            color: #17bebb;
        }
        
        table{
        }
        /*LOGO*/
        
        .logo h1{
            margin: 0;
        }
        .logo h1 a{
            color: #10661a;
            font-size: 24px;
            font-weight: 700;
            font-family: "Poppins", sans-serif;
        }
        
        
        .hero{
            position: relative;
            z-index: 0;
        }
        
        .hero .text{
            color: rgba(0,0,0,.3);
        }
        .hero .text h2{
            color: #000;
            font-size: 34px;
            margin-bottom: 0;
            font-weight: 200;
            line-height: 1.4;
        }
        .hero .text h3{
            font-size: 24px;
            font-weight: 300;
        }
        .hero .text h2 span{
            font-weight: 600;
            color: #000;
        }
        
        .text-author{
            bordeR: 1px solid rgba(0,0,0,.05);
            max-width: 50%;
            margin: 0 auto;
            padding: 2em;
        }
        .text-author img{
            border-radius: 50%;
            padding-bottom: 20px;
        }
        .text-author h3{
            margin-bottom: 0;
        }
        ul.social{
            padding: 0;
        }
        ul.social li{
            display: inline-block;
            margin-right: 10px;
        }
        
        /*FOOTER*/
        
        .footer{
            border-top: 1px solid rgba(0,0,0,.05);
            color: rgba(0,0,0,.5);
        }
        .footer .heading{
            color: #000;
            font-size: 20px;
        }
        .footer ul{
            margin: 0;
            padding: 0;
        }
        .footer ul li{
            list-style: none;
            margin-bottom: 10px;
        }
        .footer ul li a{
            color: rgba(0,0,0,1);
        }
        
        
        @media screen and (max-width: 500px) {
        
        
        }
        
        
            </style>
        
        
        </head>
        
        <body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">
            <center style="width: 100%; background-color: #f1f1f1;">
            <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
              &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
            </div>
            <div style="max-width: 600px; margin: 0 auto;" class="email-container">
                <!-- BEGIN BODY -->
              <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                  <tr>
                  <td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;background-color:white;">
                      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tr>
                              <td class="logo" style="text-align: center;">
                                <h1><a href="#"><img src="https://iili.io/Jb0Sg2.png" width="300px" alt="Resolveu | Plataforma de serviços"/></a></h1>
                              </td>
                          </tr>
                      </table>
                  </td>
                  </tr><!-- end tr -->
                        <tr>
                  <td valign="middle" class="hero bg_white" style="padding: 2em 0 4em 0;background-color:white;">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
            
                '. $template_cliente . '
        
                        </tr>
                    </table>
                  </td>
                  </tr><!-- end tr -->
              <!-- 1 Column Text + Button : END -->
              </table>
              <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                  <tr>
                  <td valign="middle" class="bg_light footer email-section" style="padding:2.5em; background-color:#213b52; color:white">
                    <table>
                        <tr>
                        <td valign="top" width="33.333%" style="padding-top: 20px;">
                          <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                              <td style="text-align: left; padding-right: 10px;">
                                  <h3 class="heading" style="color:white">Sobre a Resolveu</h3>
                                  <p>A resolveu é uma plataforma rápida de busca de prestadores de serviços locais. <u>veja mais</u> </p>
                              </td>
                            </tr>
                          </table>
                        </td>
                        <td valign="top" width="33.333%" style="padding-top: 20px;">
                          <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                              <td style="text-align: left; padding-left: 5px; padding-right: 5px;">
                                  <h3 class="heading" style="color:white; text-align:left">Dúvidas ?</h3>
                                  <ul style="list-style-type: none; text-align:left; padding-left:0px;margin-left:0px"">
                                            <li><span class="text"> <a href="#" style="color:white">atendimento@resolveu.com.br</a></span></li>
                                            <li><span class="text">whats: 51-3333333</span></a></li>
                                          </ul>
                              </td>
                            </tr>
                          </table>
                        </td>
                        <td valign="top" width="33.333%" style="padding-top: 20px;">
                          <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                              <td style="text-align: left; padding-left: 10px;">
                                  <h3 class="heading" style="color:white">Links úteis</h3>
                                  <ul style="list-style-type: none; text-align:left; padding-left:0px;margin-left:0px">
                                            <li><a href="#" style="color:white">Buscar prestadores</a></li>
                                            <li><a href="#" style="color:white">Seja um parceiro</a></li>
                                            <li><a href="#" style="color:white">Sobre</a></li>
                                          </ul>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr><!-- end: tr -->
                <tr>
                  <td class="bg_light" style="text-align: center;">
                      <p>Se você não quer mais receber e-mails da plataforma Resolveu <a href="#" style="color: rgba(0,0,0,.8);">Clique aqui</a></p>
                  </td>
                </tr>
              </table>
        
            </div>
          </center>
        </body>
        </html>';

      /*  $email_conteudo .= "Email =".$prestador->email."\n";
        $email_conteudo .= "Telefone =".$prestador->telefone."\n"; 
        $email_conteudo .= "Mensagem =".$orcamento->descricao."\n";*/
        
        $email_headers = implode ( "\n",array ( "From: ResolveU <".$email_remetente.">", "Reply-To: ResolveU <".$email_reply.">", "Return-Path: $email_remetente","MIME-Version: 1.0","Content-Type: text/html; charset=UTF-8") );

        if (mail($cliente->email, $email_assunto, $email_conteudo, $email_headers)) { 
            echo "</b>E-Mail enviado com sucesso!</b>"; 
        } else { 
            echo "</b>Falha no envio do E-Mail!</b>"; 
        }
    
    }

}

?>