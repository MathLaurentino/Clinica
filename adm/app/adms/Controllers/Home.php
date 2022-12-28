<?php

namespace App\Adms\Controllers;

if (!defined('D7E4T2K6F4')) {
    $header = "http://localhost/Clinica/Erro?case=404"; // Erro 404
    header("Location: {$header}");
}

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
        $loadView->loadViewAdm();
    }

}


?>