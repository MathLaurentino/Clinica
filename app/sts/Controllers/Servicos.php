<?php

namespace Sts\Controllers;

if (!defined('D7E4T2K6F4')) {
    $header = "http://localhost/Clinica/Erro?case=404"; // Erro 404
    header("Location: {$header}");
}

include_once 'app/sts/Controllers/helpers/protect.php';

class Servicos{
    
    private array|string|null $data;

    public function index()
    {    
        $this->clinica();
    }



    /**     function clinica()
     * Pega as informações da tabela tipo_consulta (os seriços ofertados pela clinica)
     * Após isso carrega a página servicos
     */
    public function clinica(): void
    {
        $servico = new \Sts\Models\StsServicos();
        $this->data = $servico->dataServicos();

        $loadView = new \Core\LoadView("sts/Views/bodys/servicos/servicos", $this->data, null);
        $loadView->loadView_cabecalho('servicos/servicosH');
    }



    /**     function pages()
     * Function que todas as controller tem
     * Retorna as functions que são publicas nessa controller
     */
    public function pages(): array
    {  
        return $array = ['index','clinica'];
    }
    
}