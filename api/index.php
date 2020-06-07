<?php

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    include_once('ClienteController.php');
    include_once('PrestadorController.php');
    require './vendor/autoload.php';

    $app = new \Slim\App;
    	
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


    $app->run();

?>