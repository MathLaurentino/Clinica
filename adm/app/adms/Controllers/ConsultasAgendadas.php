<?php

namespace App\Adms\Controllers;

if (!defined('D7E4T2K6F4')) {
    $header = "http://localhost/Clinica/Erro?case=404"; // Erro 404
    header("Location: {$header}");
}

include_once 'app/Adms/controllers/helpers/protect.php';

class ConsultasAgendadas
{

    private array|null $data;
    private array|null $dataForm;


    /**     function index()
     * Método padrão das classes controllers
     */
    public function index(): void
    {        
        $this->clientes();
    }


    public function clientes()
    {

        $adms = new \Adms\Models\AdmsConsultasAgendadas();
        $this->data = $adms->getDataConsulta();

        $this->view();
        

    }

    
    /**
     * Método chamado pelo método index da classe
     * Carrega a view
     */
    private function view(): void
    {
        $loadView = new \Core\LoadView("adms/Views/bodys/consultasAgendadas/consultas", $this->data, null);
        $loadView->loadViewAdm();
    }




    }
    ?>