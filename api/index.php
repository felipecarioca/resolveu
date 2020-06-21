<?php

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    include_once('ClienteController.php');
    include_once('PrestadorController.php');
    include_once('TipoServicoController.php');
    include_once('OrcamentoController.php');
    require './vendor/autoload.php';


   $app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);    	



    $app->group('/clientes', function() use ($app) {

        $app->get('','ClienteController:listar');
        $app->post('','ClienteController:inserir');
        
        $app->get('/{id}','ClienteController:buscarPorId');    
        //$app->get('/{email}','ClienteController:logar');
        $app->put('/{id}','ClienteController:atualizar');
        $app->delete('/{id}', 'ClienteController:deletar');

    });

    $app->group('/prestadores', function() use ($app) {
        
        $app->get('','PrestadorController:listar');
        $app->post('','PrestadorController:inserir');
         
        $app->get('/{id}','PrestadorController:buscarPorId');    
        $app->put('/{id}','PrestadorController:atualizar');
        $app->delete('/{id}', 'PrestadorController:deletar');

    });

    $app->group('/clientelogin', function() use ($app) {
       
        $app->post('','ClienteController:logar');
    });
    
    $app->group('/servico', function() use ($app) {
        $app->post('','TipoServicoController:email'); 
        $app->get('/{id}','TipoServicoController:buscarPorId');   
                   
    });
    $app->group('/tiposervico', function() use ($app) {
        $app->get('/{word}','TipoServicoController:buscarPorWordServ');             
    });
    
    $app->group('/prestadorServ', function() use ($app) {
          
        $app->get('/{word}','TipoServicoController:buscarPorIdServ');  
      
    });
   
    $app->group('/solicitacaoAceita', function() use ($app) {
          
        $app->get('/{id}','OrcamentoController:Aceita');  
      
    });     
    $app->group('/solicitacaoRecusada', function() use ($app) {
          
        $app->get('/{id_solicitacao}','OrcamentoController:Recusada');  
      
    });   
    $app->run();

?>
