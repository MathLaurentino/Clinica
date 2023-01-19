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
    private array|null $dataForm;


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
        $this->data['outros'] = $adms->getBasicDataOutros(); 
        //echo "<pre>"; var_dump($this->data);

        if (!empty($this->data['aConfirmar'])) {

            $admsConsulta = new \Adms\Models\helpers\AdmsDateConsulta();

            $veryfiDate1 = $admsConsulta->verifyDayTimeConsulta($this->data['aConfirmar']);
            $veryfiDate2 = $admsConsulta->verifyDayTimeConsulta($this->data['outros']);

            if ( $veryfiDate1 || $veryfiDate2 ) {
                $this->data['aConfirmar'] = $adms->getBasicDataAConfirmar();
                $this->data['outros'] = $adms->getBasicDataOutros(); 
            } 

        }

        $loadView = new \Core\LoadView("adms/Views/bodys/consultasAgendadas/consulta", $this->data, null);
        $loadView->loadView_headerAdm("consultasAgendadas/consultasAgendadasH");
    }



    public function confirmarAgendamento(): void
    {
        if (isset($_GET['idConsulta'])) {

            $idConsulta = $_GET['idConsulta'];

            $adms = new \Adms\Models\AdmsConsultasAgendadas();

            if ($adms->verifyIfConsultaExist($idConsulta)) {

                $sit_consulta['sit_consulta'] = "Confirmado";
                if ($adms->alterSit_Consulta($idConsulta, $sit_consulta)) {
                    $_SESSION['msgGreen'] = "Consulta confirmada com sucesso!";
                } else {
                    $_SESSION['msgRed'] = "Falha ao confirmar consulta!";
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



    public function negarAgendamento(): void
    {
        if (isset($_GET['idConsulta'])) {

            $idConsulta = $_GET['idConsulta'];

            $adms = new \Adms\Models\AdmsConsultasAgendadas();

            if ($adms->verifyIfConsultaExist($idConsulta)) {

                $sit_consulta['sit_consulta'] = "Negado";
                if ($adms->alterSit_Consulta($idConsulta, $sit_consulta)) {
                    $_SESSION['msgGreen'] = "Consulta negada com sucesso!";
                    
                } else {
                    $_SESSION['msgRed'] = "Falha ao negar consulta!";
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
     * 
     */
    public function aceitarCancelamento(): void
    {
        if (isset($_GET['idConsulta'])) {

            $idConsulta = $_GET['idConsulta'];

            $adms = new \Adms\Models\AdmsConsultasAgendadas();

            if ($adms->verifyIfConsultaExist($idConsulta)) {

                if ($adms->verifyIfConsultaIsACancelar($idConsulta)) {

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