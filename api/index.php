<?php
    ob_end_clean();//HOT FIX

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;
    use \Slim\Middleware\ContentLengthMiddleware;
    error_reporting(0);
    //include_once('OrcamentoController.php');

    require './vendor/autoload.php';

    // ---- Configurações ----
    $app = new \Slim\App([
        'settings' => [
            'displayErrorDetails' => true,
            'addContentLengthHeader' => false,
        ]
    ]);
    
    // ---- Clientes ----
    $app->group('/clientes', function() use ($app) {

        include_once('ClienteController.php');

        $app->get('','ClienteController:listar');
        $app->post('','ClienteController:inserir');
        
        $app->get('/{id}','ClienteController:buscarPorId');    
        $app->get('/busca-duplicidade/{cpf}','ClienteController:verificaDuplicidade');

        $app->put('/{id}','ClienteController:atualizar');
        $app->delete('/{id}', 'ClienteController:deletar');

    });

    // ---- Cliente Login ----
    $app->group('/cliente-login', function() use ($app) {
        
        include_once('ClienteController.php');

        $app->post('','ClienteController:logar');
    });

    // ---- Tipo de Serviço ----
    $app->group('/tipo-servico', function() use ($app) {
        
        include_once('TipoServicoController.php');

        // Gets
        $app->get('/busca-servico/{descricao}','TipoServicoController:buscarPorDescricao');
        $app->get('/{id}','TipoServicoController:buscarPorId');
        $app->get('','TipoServicoController:listar');

        // Posts
        //$app->post('','OrcamentoController:email_prestador');

    });

    // ---- Orçamento ----
    $app->group('/orcamento', function() use ($app) {
        
        include_once('OrcamentoController.php');

        $app->post('/orcar','OrcamentoController:orcar');

    });

    // ---- Solicitação ----
    $app->group('/solicitacao', function() use ($app) {
        
        include_once('SolicitacaoController.php');

        $app->get('/{id}','SolicitacaoController:buscarPorId');
        $app->get('/aceitar/{id}','SolicitacaoController:aceitar');

    });

    // Prestadores
    $app->group('/prestador', function() use ($app) {
        
        include_once('PrestadorController.php');

        $app->get('','PrestadorController:listar');
        $app->get('/{id}','PrestadorController:buscarPorId');    

        $app->post('','PrestadorController:inserir');
         
        $app->put('/{id}','PrestadorController:atualizar');
        $app->delete('/{id}', 'PrestadorController:deletar');

        // Busca por Serviço
        $app->get('/buscar-por-servico/{id}','PrestadorController:buscarPorServico');

        $app->get('/recomendar/{id}','PrestadorController:recomendar');

    });
    
    // Serviço
    /*
    $app->group('/servico', function() use ($app) {
        
        include_once('TipoServicoController.php');

        $app->post('','TipoServicoController:email');
        $app->get('/{id}','TipoServicoController:buscarPorId');

    });
    
    $app->group('/prestadorServ', function() use ($app) {
          
        $app->get('/{word}','TipoServicoController:buscarPorIdServ');  
      
    });
    */
    
    $app->group('/solicitacao', function() use ($app) {
          
        $app->get('/aceita/{id}','SolicitacaoController:aceita');  
      
    });
    
    $app->run();

?>
