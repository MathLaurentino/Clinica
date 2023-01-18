<?php

namespace Sts\Controllers;

if (!defined('D7E4T2K6F4')) {
    $header = "http://localhost/Clinica/Erro?case=404"; // Erro 404
    header("Location: {$header}");
}

class Home{

    public function index()
    {   
        $dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(!isset($_SESSION)){
            session_start();
        }

        if(!empty($dataForm['session_destroy']))
        {
            unset($dataForm['session_destroy']);
            session_destroy();
        }
        
        $loadView = new \Core\LoadView('sts/Views/bodys/home/home', null, null);
        $loadView->loadView_cabecalho('home/index');
    }


    /**     function pages()
     * Function que todas as controller tem
     * Retorna as functions que são publicas nessa controller
     */
    public function pages(): array
    {  
        return $array = ['index'];
    }
}