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
         
        $this->view("consulta2");

    }


    /**     function consulta()
     * Carrega as informaçoes extras de uma determinada consulta pelo id passada pela URL
     */
    public function consulta()
    {
        if (isset($_GET['idConsulta'])) {

            $idConsulta = $_GET['idConsulta'];

            $adms = new \Adms\Models\AdmsConsultasAgendadas();
            $this->data = $adms->getFullDataConsulta($idConsulta);

            $this->view("dadosConsulta");

        } else {
            $this->clientes();
        }
        
    }



    




    public function confirmar()
    {
        if (isset($_GET['idConsulta'])) {

            $idConsulta = $_GET['idConsulta'];

            $adms = new \Adms\Models\AdmsConsultasAgendadas();

            if ($adms->verifyIfConsultaExist($idConsulta)) {

                $sit_consulta['sit_consulta'] = "Confirmado";
                if ($adms->alterSit_Consulta($idConsulta, $sit_consulta)) {
                    $_SESSION['msg'] = "Consulta confirmada com sucesso";
                } else {
                    $_SESSION['msg'] = "Falha ao confirmar consulta";
                } 

            } else {
                $_SESSION['msg'] = "Falha ao Identificar consulta";
            }

        } else {
            $_SESSION['msg'] = "Falta de dados";
        }

        $header = URLADM . "ConsultasAgendadas/clientes";
        header("Location: {$header}");
    }



    public function negar(): void
    {
        if (isset($_GET['idConsulta'])) {

            $idConsulta = $_GET['idConsulta'];

            $adms = new \Adms\Models\AdmsConsultasAgendadas();

            if ($adms->verifyIfConsultaExist($idConsulta)) {

                $sit_consulta['sit_consulta'] = "Negado";
                if ($adms->alterSit_Consulta($idConsulta, $sit_consulta)) {
                    $_SESSION['msg'] = "Consulta negada com sucesso";
                    
                } else {
                    $_SESSION['msg'] = "Falha ao negar consulta";
                } 

            } else {
                $_SESSION['msg'] = "Falha ao Identificar consulta";
            }
            
        } else {
            $_SESSION['msg'] = "Falta de dados";
        }

        $header = URLADM . "ConsultasAgendadas/clientes";
        header("Location: {$header}");
    }



    

    
    /**
     * Método chamado pelo método index da classe
     * Carrega a view
     */
    private function view($page): void
    {
        $loadView = new \Core\LoadView("adms/Views/bodys/consultasAgendadas/{$page}", $this->data, null);
        $loadView->loadViewAdm();
    }




    }
    ?>