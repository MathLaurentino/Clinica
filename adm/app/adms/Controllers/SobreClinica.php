<?php

namespace App\Adms\Controllers;

if (!defined('D7E4T2K6F4')) {
    $header = "http://localhost/Clinica/Erro?case=404"; // Erro 404
    header("Location: {$header}");
}

include_once 'app/Adms/controllers/helpers/protect.php';

class SobreClinica
{
    private array|null $data;
    private array|null $dataForm;
    

    /**     function index()
     * Chama a function padrão da classe
     */
    public function index(): void
    {
        $this->sobreClinica();
    }



    /**     function sobreClinica()
     * Responsavel por carregar a tela "clinica.php" se não foi mandado
     *      nenhum formulário
     * Recebe os formulário de adicionar serviços e alterar serviços
     */
    public function sobreClinica(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $modelsClinica = new \Adms\Models\AdmsSobreClinica();


        if (!empty($this->dataForm['AddServico'])) {

            unset($this->dataForm['AddServico']);
            $this->dataForm['nome_consulta'] = ucwords(strtolower($this->dataForm['nome_consulta']));
            
            $result = $modelsClinica->createServico($this->dataForm);

            if($result){
                $_SESSION['msg'] = "Serviço cadastrado com sucesso";
            }else{
                $_SESSION['msg'] = "Erro ao cadastrar serviço";
            }

            $header = URLADM . "Sobre-Clinica";   
            header("Location: {$header}");
        } 

        elseif (!empty($this->dataForm['AlterServico'])) {

            unset($this->dataForm['AlterServico']);
            $this->dataForm['nome_consulta'] = ucwords(strtolower($this->dataForm['nome_consulta']));

            $result = $modelsClinica->updateServico($this->dataForm);
        
            if ($result) {
                $_SESSION['msg'] = "Serviço alterado com sucesso";

            } else {
                $_SESSION['msg'] = "Problema ao alterar serviço";
            }

            $header = URLADM . "Sobre-Clinica"; 
            header("Location: {$header}");
        }

        else {
            $this->view();
        }

    }



    /**     function delete()
     * Apaga o serviço selecionando pelo ID na URL
     */
    public function delete()
    {
        if (isset($_GET['idServico'])) {

            $idServico = $_GET['idServico'];

            $modelsClinica = new \Adms\Models\AdmsSobreClinica();
            $result = $modelsClinica->deleteAll('tipo_consulta', 'idtipo_consulta', $idServico);

            if ($result) {
                $_SESSION['msg'] = "Serviço deletado com sucesso";
                $header = URLADM . "Sobre-Clinica"; 
                header("Location: {$header}");
            } else {
                $_SESSION['msg'] = "Falha ao deletar serviço";
                $header = URLADM . "Sobre-Clinica"; 
                header("Location: {$header}");
            }

        } else {
            $_SESSION['msg'] = "Falha ao identificar ID da consulta";
            $header = URLADM . "Sobre-Clinica"; 
            header("Location: {$header}");
        }
    }



    /**     function getData()
     * Pega os dados no BD necessarios para a tela "clinica.php"
     */
    private function getData(): void
    {   
        $modelsClinica = new \Adms\Models\AdmsSobreClinica();
        $this->data = $modelsClinica->dadosClinica();
    }



    /**
     * Carrega a tela "clinica.php"
     */
    private function view(): void
    {
        $this->getData();
        $loadView = new \Core\LoadView("adms/Views/servicosadm", $this->data, null); //servicosadm -> pagina com css clinica
        $loadView->loadViewAdm();
    }

}


?>