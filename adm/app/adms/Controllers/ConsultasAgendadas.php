<?php

namespace App\Adms\Controllers;

if (!defined('D7E4T2K6F4')) {
    $header = "http://localhost/Clinica/Erro?case=404"; // Erro 404
    header("Location: {$header}");
}

include_once 'app/Adms/controllers/helpers/protect.php';

date_default_timezone_set('America/Sao_Paulo');

class ConsultasAgendadas
{

    private array|null $data;
    private array|null $consultas;


    /**     function index()
     * Método padrão das classes controllers
     */
    public function index(): void
    {        
        $this->clientes();
    }


    /**     function clientes()
     * Pega os dados das consultas no BD e carrega a tela consulta2,
     *      no qual tem os registros de todas as consultas marcadas no BD
     */ 
    public function clientes(): void
    {

        $adms = new \Adms\Models\AdmsConsultasAgendadas(); 

        $this->data['aConfirmar'] = $adms->getBasicDataAConfirmar();
        $this->data['aCancelar'] = $adms->getBasicDataACancelar();
        $this->data['confirmados'] = $adms->getBasicDataConfirmados();
        $this->data['outros'] = $adms->getBasicDataOutros(); 

        $admsConsulta = new \Adms\Models\helpers\AdmsDateConsulta();

        $verify1 = $admsConsulta->verifyDayTimeConsulta($this->data['aConfirmar']);
        $verify2 = $admsConsulta->verifyDayTimeConsulta($this->data['confirmados']);
        $verify3 = $admsConsulta->verifyDayTimeConsulta($this->data['aCancelar']);
        $verify4 = $admsConsulta->verifyDayTimeConsulta($this->data['outros']);
        
        if ( $verify1 || $verify2 || $verify3 || $verify4) {
            $this->data['aConfirmar'] = $adms->getBasicDataAConfirmar();
            $this->data['aCancelar'] = $adms->getBasicDataACancelar();
            $this->data['confirmados'] = $adms->getBasicDataConfirmados();
            $this->data['outros'] = $adms->getBasicDataOutros(); 
        } 

        $loadView = new \Core\LoadView("adms/Views/bodys/consultasAgendadas/consulta", $this->data, null);
        $loadView->loadView_cabecalho_adm("consultasAgendadas/consultasAgendadasH");

    }



    /**     function confirmarAgendamento()
     * Undocumented function
     */
    public function confirmarAgendamento(): void
    {
        if (isset($_GET['idConsulta'])) {

            $idConsulta = $_GET['idConsulta'];

            $adms = new \Adms\Models\AdmsConsultasAgendadas();

            /** verifica se o id passado realmente é de uma consulta registrada no BD */
            if ($adms->verifyIfConsultaExist($idConsulta)) {

                /** Verifica se a sit_consulta no banco de dados coresponde com "A Confirmar"
                 *  So se pode registrar como "Confirmado" se antes for "A Confirmar" */
                if ($adms->verifySitConsulta($idConsulta, "A Confirmar")) {

                    $sit_consulta['sit_consulta'] = "Confirmado";
                    if ($adms->alterSit_Consulta($idConsulta, $sit_consulta)) {
                        $_SESSION['msgGreen'] = "Consulta confirmada com sucesso!";
                    } else {
                        $_SESSION['msgRed'] = "Falha ao confirmar consulta!";
                    } 

                } else {
                    $_SESSION['msgRed'] = "Sit_consulta não condiz com a função chamada";
                }

            } else {
                $_SESSION['msgRed'] = "Falha ao Identificar consulta!";
            } 

        } else {
            $_SESSION['msgRed'] = "Erro: Falta de dados!";
        }

        $header = URLADM . "ConsultasAgendadas/clientes";
        header("Location: {$header}");
    }



    /**     function negarAgendamento()
     * Quando o mantenedor não aceitar a solicitação de um agendamento essa function é chamada 
     */
    public function negarAgendamento(): void
    {
        if (isset($_GET['idConsulta'])) {

            $idConsulta = $_GET['idConsulta'];

            $adms = new \Adms\Models\AdmsConsultasAgendadas();

            /** verifica se o id passado realmente é de uma consulta registrada no BD */
            if ($adms->verifyIfConsultaExist($idConsulta)) {

                /** Verifica se a sit_consulta no banco de dados coresponde com "A Confirmar"
                 *  So se pode registrar como "Negado" se antes for "A Confirmar" */
                if ($adms->verifySitConsulta($idConsulta, "A Confirmar")) {
                    $sit_consulta['sit_consulta'] = "Negado";

                    if ($adms->alterSit_Consulta($idConsulta, $sit_consulta)) {
                        $_SESSION['msgGreen'] = "Consulta negada com sucesso!";
                        
                    } else {
                        $_SESSION['msgRed'] = "Falha ao negar consulta!";
                    } 
                } else {
                    $_SESSION['msgRed'] = "Sit_consulta não condiz com a função chamada";
                }

            } else {
                $_SESSION['msgRed'] = "Falha ao Identificar consulta!";
            }
            
        } else {
            $_SESSION['msgRed'] = "Erro: Falta de dados!";
        }

        $header = URLADM . "ConsultasAgendadas/clientes";
        header("Location: {$header}");
    }



    /**     function aceitarCancelamento()
     * Muda a sit_consulta da tabela consulta de "A Cancelar" para "Cancelado"
     * Verifica se o id da consulta realmente existe e se está como "A Cancelar"
     */
    public function aceitarCancelamento(): void
    {
        if (isset($_GET['idConsulta'])) {

            $idConsulta = $_GET['idConsulta'];

            $adms = new \Adms\Models\AdmsConsultasAgendadas();

            /** verifica se o id passado realmente é de uma consulta registrada no BD */
            if ($adms->verifyIfConsultaExist($idConsulta)) {

                /** Verifica se a sit_consulta no banco de dados coresponde com "A Cancelar"
                 *  So se pode registrar como "Cancelado" se antes for "A Cancelar" */
                if ($adms->verifySitConsulta($idConsulta, "A Cancelar")) {

                    $sit_consulta['sit_consulta'] = "Cancelado";

                    if ($adms->alterSit_Consulta($idConsulta, $sit_consulta)) {
                        $_SESSION['msgGreen'] = "Confirmação de cancelamento finalizada com sucesso";
                        
                    } else {
                        $_SESSION['msgRed'] = "Falha ao confirmar cancelamento";
                    } 

                } else {
                    $_SESSION['msgRed'] = "Sit_consulta não condiz com a função chamada";
                }

            } else {
                $_SESSION['msgRed'] = "Falha ao Identificar consulta";
            }  

        } else {
            $_SESSION['msgRed'] = "Erro: falta de dados";
        }

        $header = URLADM . "ConsultasAgendadas/clientes";
        header("Location: {$header}");
    }

}
?>