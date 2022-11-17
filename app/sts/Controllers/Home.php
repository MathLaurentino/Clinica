<?php

namespace Sts\Controllers;

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
        
        $loadView = new \Core\LoadView('sts/Views/home', null, null);
        $loadView->loadView();
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