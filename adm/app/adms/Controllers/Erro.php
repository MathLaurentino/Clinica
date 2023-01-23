<?php

namespace App\Adms\Controllers;

class Erro
{

    //recebe a descrição do erro
    private array $data;
    private string|int $case = 0;

    public function index(){
        
        if(!isset($_SESSION)){
            session_start();
        } 
        if(isset($_GET['case'])){
            $this->case = $_GET['case'];
        }
        
        switch ($this->case) {
            case 404:
                $this->data['numeroErro'] = "404";
                $this->data['descricaoErro'] = "Página não encontrada!";
                $this->data['botao'] = "Home/Index";
                $this->data['descricaoBotao'] = "HOME";
                break;
        }

        $loadView = new \Core\LoadView("adms/Views/bodys/erro/erro", $this->data, null);
        $loadView->loadView_cabecalho_adm("erro/erroH");
    }

}

?>