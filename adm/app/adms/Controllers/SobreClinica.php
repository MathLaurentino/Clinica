<?php

namespace App\Adms\Controllers;

include_once 'app/Adms/controllers/helpers/protect.php';


class SobreClinica
{
    private array|null $data;
    private array|null $dataForm;

    public function index(): void
    {
        $this->sobreClinica();
    }

    public function sobreClinica(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $modelsClinica = new \Adms\Models\AdmsSobreClinica();


        if (!empty($this->dataForm['AddServico'])) {
            unset($this->dataForm['AddServico']);
            
            $result = $modelsClinica->createServico($this->dataForm);

            if($result){
                $_SESSION['msg'] = "Serviço cadastrado com sucesso";
                $header = URLADM . "Sobre-Clinica"; 
                header("Location: {$header}");
            }else{
                $_SESSION['msg'] = "Erro ao cadastrar serviço";
                $header = URLADM . "Sobre-Clinica"; 
                header("Location: {$header}");
            }

        } 
        

        elseif (!empty($this->dataForm['DeleteConsulta'])) {
            unset($this->dataForm['DeleteConsulta']);

            $result = $modelsClinica->deleteAll('tipo_consulta', 'idtipo_consulta', $this->dataForm['idtipo_consulta']);

            if ($result) {
                $_SESSION['msg'] = "Serviço deletado com sucesso";
                $header = URLADM . "Sobre-Clinica"; 
                header("Location: {$header}");
            } else {
                $_SESSION['msg'] = "Falha ao deletar serviço";
                $header = URLADM . "Sobre-Clinica"; 
                header("Location: {$header}");
            }

        }


        elseif (!empty($this->dataForm['AlterConsulta'])) {
            unset($this->dataForm['AlterConsulta']);

            $result = $modelsClinica->updateServico($this->dataForm);
            
            if ($result) {
                $_SESSION['msg'] = "Serviço Alterado com sucesso";
                $header = URLADM . "Sobre-Clinica"; 
                header("Location: {$header}");
            } else {
                $_SESSION['msg'] = "Problema ao alterar serviço";
                $header = URLADM . "Sobre-Clinica"; 
                header("Location: {$header}");
            }

        }

        
        else {
            $this->getData();
            $this->view();
        }

    }

    private function getData()
    {   
        $modelsClinica = new \Adms\Models\AdmsSobreClinica();
        $this->data = $modelsClinica->dadosClinica();
    }

    private function view(): void
    {
        $loadView = new \Core\LoadView("adms/Views/sobreClinica", $this->data, null);
        $loadView->loadView();
    }


}


?>