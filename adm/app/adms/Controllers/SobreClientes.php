<?php

namespace App\Adms\Controllers;

include_once 'app/Adms/controllers/helpers/protect.php';

class SobreClientes
{

    private array $data;
    private array|null $dataForm;


    /**     function index()
     * Método padrão das classes controllers
     */
    public function index(): void
    {        
        $this->SobreClientes();
    }


    private function SobreClientes(): void
    {
        //informações vinda dos formulares da view sobreCliente.php
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        //Cria OBJ AdmsSobreClientes
        $modelSobreCliente = new \Adms\Models\AdmsSobreClientes();


        // se for clicado o botão changeToMantenedor
        if (isset($this->dataForm['changeToMantenedor'])) {
            unset($this->dataForm['changeToMantenedor']);

            $result = $modelSobreCliente->ConverterCargo($this->dataForm);
            
            if ($result) {
                $_SESSION['msg'] = "Alterado com sucesso";
                $this->header();
            } else {
                $_SESSION['msg'] = "Falha ao alterar";
                $this->header();
            }
        }


        // se for clicado o botão changeToCliente
        elseif (isset($this->dataForm['changeToCliente'])) {
            unset($this->dataForm['changeToCliente']);

            $result = $modelSobreCliente->ConverterCargo($this->dataForm);
            
            if ($result) {
                $_SESSION['msg'] = "Alterado com sucesso";
                $this->header();
            } else {
                $_SESSION['msg'] = "Falha ao alterar";
                $this->header();
            }
        } 
        
        
        // carrega a página
        else {
            $result = $modelSobreCliente->mostrarClientes();

            if ($result) {
                $this->data = $result;
                $this->view();
            } else {
                echo "Clientes não encontrados!";
            }
        }
    }

    
    /**
     * Método chamado pelo método index da classe
     * Carrega a view
     */
    private function view(): void
    {
        $loadView = new \Core\LoadView("adms/Views/sobreClientes", $this->data, null);
        $loadView->loadView();
    }


    // Redireciona o usuario para a mesma página
    private function header() 
    {
        $header = URLADM . "Sobre-Clientes"; 
        header("Location: {$header}");
    }

    }
    ?>