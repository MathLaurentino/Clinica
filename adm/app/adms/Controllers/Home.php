<?php

namespace App\Adms\Controllers;

include_once 'app/adms/Controllers/helpers/protect.php';

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
        
        $loadView = new \Core\LoadView('adms/Views/home', null, null);
        $loadView->loadView();
    }

}


?>