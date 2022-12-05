<?php

namespace Sts\Controllers;

if (!defined('D7E4T2K6F4')) {
    $header = "http://localhost/Clinica/Erro?case=404"; // Erro 404
    header("Location: {$header}");
}

include_once 'app/sts/Controllers/helpers/protect.php';

class Agendamento{


    private array|null $data = null;
    
    public function index()
    {
        $this->novaConsulta();
    }


    public function novaConsulta()
    {
        $this->data = null;
        $loadView = new \Core\LoadView("sts/Views/agendamento/userView", $this->data, null);
        $loadView->loadView_agendamento();
    }

    /**     function pages()
     * Function que todas as controller tem
     * Retorna as functions que são publicas nessa controller
     */
    public function pages(): array
    {  
        return $array = ['index','novaConsulta'];
    }
    
}