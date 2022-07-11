<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Support\Facades\Route;
use App\Http\Middleware;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
//ROTAS /API
Route::group(['prefix' => 'api'], function ($router){
    $router->post('login', 'AuthController@login');
    
    $router->get('load-sidebar', 'UserController@loadSidebar');
    $router->get('load-sidebar2', 'UserController@loadSidebar2');
    $router->get('users/export', 'UserController@export');
    //$router->get('eventos-pagos/gerar-excel', 'Financeiro\RegistrosAuxiliares\EventosPagosController@gerarExcelEventosPagos');

    //ROTAS QUE NECESSITAM AUTENTICAÇÃO
    $router->group(['middleware' => 'auth'], function ($router) {
        $router->get('usuario', 'AuthController@me');
        $router->post('logout', 'AuthController@logout');
        $router->get('users', 'UserController@getUsers');
        $router->get('beneficiario', 'BeneficiarioController@getBeneficiario'); //TESTE DE SELECT
        $router->get('checktoken', 'AuthController@checkToken');

        //ROTAS /TI -> api/ti
        $router->group(['prefix' => 'ti'], function ($router){
            $router->get('menus', 'TI\MenusController@getMenus');
            $router->post('create-menu', 'TI\MenusController@criarMenu');
            $router->put('update-menu', 'TI\MenusController@atualizarMenu');
            $router->put('change-menu-status', 'TI\MenusController@mudarStatusMenu');
            $router->get('get-parent-menus', 'TI\MenusController@getParentMenus');
            $router->post('create-child-menu', 'TI\MenusController@criarMenuChild');
        });

        //ROTAS /CREDENCIAMENTO -> api/credenciamento
        $router->group(['prefix' => 'credenciamento'], function ($router){

            $router->group(['prefix' => 'importacao-tabelas'], function ($router){
                //TABELA LOG PREVIEW VISUALIZAÇÃO
                $router->get('tabela-preview', 'Credenciamento\CredenciamentoController@index');
                $router->post('tabela-preview', 'Credenciamento\CredenciamentoController@store');
                $router->put('tabela-preview/deletar/{id_preview}', 'Credenciamento\CredenciamentoController@delete');

                 //IMPORTAÇÃO TABELAS TNUMM MATERIAIS TEMP
                $router->get('tabela-tnummTmp','Credenciamento\CredenciamentoController@selectTnummMateriaisTmp');
                $router->post('tabela-tnummTmp','Credenciamento\CredenciamentoController@insertTnummMateriaisTmp');
                $router->put('tabela-tnummTmp','Credenciamento\CredenciamentoController@deleteTnummMateriaisTmp');

                //IMPORTAÇÃO TABELAS TNUMM MATERIAIS PRODUÇÃO
                $router->get('tabela-tnumm','Credenciamento\CredenciamentoController@selectTnummMateriais');
                $router->post('tabela-tnumm','Credenciamento\CredenciamentoController@insertTnummMateriais');
                $router->put('tabela-tnumm','Credenciamento\CredenciamentoController@deleteTnummMateriais');

            });
        });

        //ROTAS /FINANCEIRO  -> api/financeiro
        $router->group(['prefix' => 'financeiro'], function ($router){

            $router->group(['prefix' => 'registros-auxiliares'], function ($router){
                //Alimentar Inputs da tela
                $router->get('inputs', 'Financeiro\RegistrosAuxiliares\InputsController@index');
                $router->get('tabela-lote', 'Financeiro\RegistrosAuxiliares\TabelaLoteController@index');

                $router->post('gerar-registro', 'Financeiro\RegistrosAuxiliares\NovoRegistroController@gerarNovoRegistroConferencia');
                $router->post('gerar-registro-oficial', 'Financeiro\RegistrosAuxiliares\NovoRegistroController@gerarRegistroOficial');

                // Eventos Pagos
                $router->get('eventos-pagos/totalizador', 'Financeiro\RegistrosAuxiliares\EventosPagosController@totalizadorEventosPagos');
                $router->get('eventos-pagos/gerar-excel', 'Financeiro\RegistrosAuxiliares\EventosPagosController@gerarExcelEventosPagos');
                $router->get('eventos-pagos/gerar-excel/filename', 'Financeiro\RegistrosAuxiliares\EventosPagosController@gerarExcelEventosPagosFilename');

                 // Eventos Conhecidos
                 $router->get('eventos-conhecidos/totalizador', 'Financeiro\RegistrosAuxiliares\EventosConhecidosController@totalizadorEventosConhecidos');
                 $router->get('eventos-conhecidos/gerar-excel', 'Financeiro\RegistrosAuxiliares\EventosConhecidosController@gerarExcelEventosConhecidos');
                 $router->get('eventos-conhecidos/gerar-excel/filename', 'Financeiro\RegistrosAuxiliares\EventosConhecidosController@gerarExcelEventosConhecidosFilename');


            });
        });

        //ROTAS /GOVERNANÇA -> api/governanca
        $router->group(['prefix' => 'governanca'], function ($router){
            //ROTAS INDICADORES -> governanca/indicadores
            $router->group(['prefix' => 'indicadores'], function ($router){
                $router->get('formulas', 'Governanca\GovernancaController@getFormulas'); //BUSCAR TODAS AS FÓRMULAS                
                $router->get('mll/{id}', 'Governanca\GovernancaController@getMLL'); //FORMULA INDICADORA MLL
                $router->get('roe/{id}', 'Governanca\GovernancaController@getROE'); //FORMULA INDICADORA ROE
                $router->get('dm/{id}', 'Governanca\GovernancaController@getDM'); //FORMULA INDICADORA DM
                $router->get('da/{id}', 'Governanca\GovernancaController@getDA'); //FORMULA INDICADORA DA
                $router->get('dop/{id}', 'Governanca\GovernancaController@getDOP'); //FORMULA INDICADORA DOP
                $router->get('irf/{id}', 'Governanca\GovernancaController@getIRF'); //FORMULA INDICADORA IRF
                $router->get('lc/{id}', 'Governanca\GovernancaController@getLC'); //FORMULA INDICADORA LC
                $router->get('ctcp/{id}', 'Governanca\GovernancaController@getCTCP'); //FORMULA INDICADORA CTCP
                $router->get('pmrc/{id}', 'Governanca\GovernancaController@getPMRC'); //FORMULA INDICADORA PMRC
                $router->get('pmpe/{id}', 'Governanca\GovernancaController@getPMPE'); //FORMULA INDICADORA PMPE
                $router->get('vc/{id}', 'Governanca\GovernancaController@getVC'); //FORMULA INDICADORA VC
                //////////////////////////INDICADORES ADICIONAIS//////////////////////////
                $router->get('roa/{id}', 'Governanca\GovernancaController@getROA'); //FORMULA INDICADORA ROA
                $router->get('lg/{id}', 'Governanca\GovernancaController@getLG'); //FORMULA INDICADORA LG
                $router->get('li/{id}', 'Governanca\GovernancaController@getLI'); //FORMULA INDICADORA LI
                $router->get('ea/{id}', 'Governanca\GovernancaController@getEA'); //FORMULA INDICADORA EA
                $router->get('efp/{id}', 'Governanca\GovernancaController@getEFP'); //FORMULA INDICADORA EFP
                $router->get('ccl/{id}', 'Governanca\GovernancaController@getCCL'); //FORMULA INDICADORA CCL
                $router->get('pla/{id}', 'Governanca\GovernancaController@getPLA'); //FORMULA INDICADORA PLA           
                $router->get('detalhe/{id}', 'Governanca\GovernancaController@getFormulaDetalhe'); //DETALHAMENTO DAS FORMULAS (TÍTULO E CALCULO)
            });
        });
    });
});