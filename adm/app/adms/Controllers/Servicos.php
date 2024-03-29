<?php

namespace App\Adms\Controllers;

if (!defined('D7E4T2K6F4')) {
    $header = "http://localhost/Clinica/Erro?case=404"; // Erro 404
    header("Location: {$header}");
}

include_once 'app/Adms/controllers/helpers/protect.php';

class Servicos
{
    private array|null $data;
    private array|null $dataForm;
    

    /**     function index()
     * Chama a function padrão da classe
     */
    public function index(): void
    {
        $this->clinica();
    }



    /**     function clinica()
     * Responsavel por carregar a tela "clinica.php" se não foi mandado
     *      nenhum formulário
     * Recebe os formulário de adicionar serviços e alterar serviços
     */
    public function clinica(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $modelsClinica = new \Adms\Models\AdmsSobreClinica();


        if (!empty($this->dataForm['AddServico'])) {

            unset($this->dataForm['AddServico']);
            $this->dataForm['nome_consulta'] = ucwords(strtolower($this->dataForm['nome_consulta']));
            
            $result = $modelsClinica->createServico($this->dataForm);

            if($result){
                $_SESSION['msgGreen'] = "Serviço cadastrado com sucesso!";
            }else{
                $_SESSION['msgRed'] = "Erro ao cadastrar serviço!";
            }

            $header = URLADM . "Servicos/Clinica";   
            header("Location: {$header}");
        } 

        elseif (!empty($this->dataForm['AlterServico'])) {

            unset($this->dataForm['AlterServico']);
            $this->dataForm['nome_consulta'] = ucwords(strtolower($this->dataForm['nome_consulta']));

            $result = $modelsClinica->updateServico($this->dataForm);
        
            if ($result) {
                $_SESSION['msgGreen'] = "Serviço alterado com sucesso";

            } else {
                $_SESSION['msgRed'] = "Problema ao alterar serviço";
            }

            $header = URLADM . "Servicos/Clinica"; 
            header("Location: {$header}");
        }

        else {
            $this->data['Ativos'] = $modelsClinica->getDataServicos("Ativo");
            $this->data['Inativos'] = $modelsClinica->getDataServicos("Inativo");
            $loadView = new \Core\LoadView("adms/Views/bodys/servicosClinica/servicos", $this->data, null); //servicosadm -> pagina com css clinica
            $loadView->loadView_cabecalho_adm("servicosClinica/servicosH");
        }

    }



    /**     function delete()
     * Apaga o serviço selecionando pelo ID na URL
     */
    public function delete(): void
    {
        if (isset($_GET['idServico'])) {

            $idServico = $_GET['idServico'];
            $modelsClinica = new \Adms\Models\AdmsSobreClinica();

            if ($modelsClinica->verifyTipoConsulta($idServico)) {

                if ($modelsClinica->foreignkeyTipoConsulta($idServico)) {
                    $result = $modelsClinica->deleteAll('tipo_consulta', 'idtipo_consulta', $idServico);

                    if ($result) {
                        $_SESSION['msgGreen'] = "Serviço deletado com sucesso!";
                        $header = URLADM . "Servicos/Clinica"; 
                        header("Location: {$header}");
                    } else {
                        $_SESSION['msgRed'] = "Falha ao deletar serviço!";
                        $header = URLADM . "Servicos/Clinica"; 
                        header("Location: {$header}");
                    }
                } else {
                    $_SESSION['msgRed'] = "Falha: serviço não pode ser apagado, pois já tem histórico de agendamento com clientes!";
                    $header = URLADM . "Servicos/Clinica"; 
                    header("Location: {$header}");
                }
                
            } else {
                $_SESSION['msgRed'] = "Falha: serviço inexistente!";
                $header = URLADM . "Servicos/Clinica"; 
                header("Location: {$header}");
            } 

        } else {
            $_SESSION['msgRed'] = "Falha ao identificar ID da consulta!";
            $header = URLADM . "Servicos/Clinica"; 
            header("Location: {$header}");
        }
    }



    /**     unction alterarSitServico()
     * Responsavel por alterar as a sit_tipo_consulta da tabela tipo_consulta
     * Verifica se o id passado pela URL realmente existe e se o sit também 
     *      passado pela URL corresponde ao que está no BD
     * Retorna para a tela de Servicos/Clinica em qualquer situação
     */
    public function alterarSitServico(): void
    {
        if (isset($_GET['idServico']) && $_GET['sitServico']) {

            $idServico = $_GET['idServico'];
            $sitServico = $_GET['sitServico'];

            $admsClinica = new \Adms\Models\AdmsSobreClinica();

            $sit = $admsClinica->getSitTipoConsulta($idServico);

            if (!empty($sit) && $sitServico == $sit[0]['sit_tipo_consulta']) {

                if ($sitServico == "Ativo") {
                    $converter = "Inativo";
                } elseif ($sitServico == "Inativo") {
                    $converter = "Ativo";
                }

                $alterSit['sit_tipo_consulta'] = $converter;

                if ($admsClinica->changeTipoConsultaAttributes($idServico, $alterSit)) {
                    $_SESSION['msgGreen'] = "{$sit[0]['nome_consulta']} convertido com sucesso!";
                } else {
                    $_SESSION['msgRed'] = "Falha ao alterar Sit_Tipo_Consulta!";
                }

            } else {
                $_SESSION['msgRed'] = "Erro: dados incongruentes!";
            }
            
        } else {
            $_SESSION['msgRed'] = "Erro, falta de informações!";
        }
        
        $header = URLADM . "Servicos/Clinica"; 
        header("Location: {$header}");
    }

}


?>