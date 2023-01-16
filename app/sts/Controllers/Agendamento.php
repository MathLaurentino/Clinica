<?php

namespace Sts\Controllers;

if (!defined('D7E4T2K6F4')) {
    $header = "http://localhost/Clinica/Erro?case=404"; // Erro 404
    header("Location: {$header}");
}

include_once 'app/sts/Controllers/helpers/protect.php';

date_default_timezone_set('America/Sao_Paulo');

class Agendamento{


    private $data;
    private array|null $dataForm;
    
    public function index()
    {
        $this->horarios();
    }


    /**     function horarios()
     * Carrega a tela do Full Calendar 
     * Manda os dados da tebela consulta para o Full Calendar, mostrando ao 
     *      cliente os horarios disponíveis
     */
    public function horarios(): void
    {
        $sts = new \Sts\Models\StsAgendamento();

        // verifica se o o id do servico foi passado na url
        if (!isset($_GET['servico'])) {
            $_SESSION['msgRed'] = "Erro: dados insuficientes.";
            $header = URL . "Servicos/Clinica";
            header("Location: {$header}");
        }

        // verifica se o usuário já tem um endereço cadastrado
        elseif (!$sts->verifyUserAdress($_SESSION['idusuario'])) {
            $_SESSION['msgRed'] = "Erro: necessário cadastrar algum endereço antes de agendar uma consulta.";
            $header = URL . "Home";
            header("Location: {$header}");
        }

        // verifica se o usuário tem algum pet cadastrado na sua conta
        elseif (!$sts->verifyUserPets($_SESSION['idusuario'])) {
            $_SESSION['msgRed'] = "Erro: necessário cadastrar algum pet antes de agendar uma consulta.";
            $header = URL . "Home";
            header("Location: {$header}");
        }

        else {
            $sts = new \Sts\Models\StsAgendamento();
            $eventsArray = $sts->horariosDeConsulta();

            $this->data = json_encode($eventsArray);

            $loadView = new \Core\LoadView("sts/Views/bodys/agendamento/calendar", $this->data , NULL);
            $loadView->loadView_header3("calendarH");
        }        
      
    }



    /**     function agendar()
     * Carrega a tela para agendar uma nova consulta
     * Recebe os dados do formulário para agendar uma nova consulta
     */
    public function agendar(): void
    {
        if (isset($_SESSION['msgRed'])) {
            unset($_SESSION['msgRed']);
        }

        // se o dados de dia, horario e servico forem passados na URL
        if (isset($_GET['dia']) && isset($_GET['horario']) && isset($_GET['servico'])) {

            $dayNewEvent = $_GET['dia'];
            $timeNewEvent = $_GET['horario'];
            $idServico = $_GET['servico'];

            $sts = new \Sts\Models\StsAgendamento(); 
            $stsVerifyDate = new \Sts\Models\helpers\StsVerifyDateConsulta();            

            // se os dados passados na URL são válidos (consulta no BD)
            if ($stsVerifyDate->varificarData($dayNewEvent, $timeNewEvent) && $sts->idServicoExiste($idServico)) {

                $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                
                // se não mandou o formulário de agendar servico, então carrega a tela de agendamento
                if (!isset($this->dataForm['agendar'])) {

                    $this->data['servico'] = $sts->servicoClinica($idServico);
                    $this->data['servico'] = $this->data['servico'][0];
                    $this->data['pets'] = $sts->userPets($_SESSION['idusuario']);
                    
                    $loadView = new \Core\LoadView("sts/Views/bodys/agendamento/agendamento", $this->data , NULL);
                    $loadView->loadView_header("agendamentoH");
                
                // caso já tenha mandado o formulário de agendar servico, cadastre a consulta no banco de dados
                // a nova consulta por padrão aperecera como "AConfirmar" no BD
                } else {

                    unset($this->dataForm['agendar']);
                    
                    $idconsulta = $sts->salvarServico($this->dataForm);

                    if (!empty($idconsulta)) {
                        $_SESSION['msgGreen'] = "Consulta agendada com sucesso, aguarde a confirmação da clinica.";
                        $header = URL . "SobreCliente";
                        header("Location: {$header}");
                    } else {
                        $_SESSION['msgRed'] = "Falha ao agendar servico, tente novamente.";
                        $header = URL . "Servicos";
                        header("Location: {$header}");
                    }

                }
                
            } else {
                $_SESSION['msgRed'] = "Horario ou servico inválido, tente novamente.";
                $header = URL . "Servicos";
                header("Location: {$header}");
            }

        } else {
            $_SESSION['msgRed'] = "Dados insuficientes, tente novamente.";
            $header = URL . "Servicos";
            header("Location: {$header}");
        }

    }


    /**     function solicitarCancelamento()
     * Solicita o cancelamento de determinada consulta por ID
     * So é possivel cancelar se ainda não tiver dado o dia e horario da consulta
     */
    public function solicitarCancelamento(): void
    {

        if (isset($_GET['idConsulta']) && isset($_GET['dataConsulta']) && isset($_GET['horaConsulta'])) { 

            $idConsulta = $_GET['idConsulta'];
            $dataConsulta = $_GET['dataConsulta'];
            $horaConsulta = $_GET['horaConsulta'];

            $stsSobreCliente = new \Sts\Models\StsSobreCliente();
            $sts = new \Sts\Models\StsAgendamento();

            // verifica se o id da consulta realmente pertence ao cliente
            if ($stsSobreCliente->verifyIdConsultaIsFromUser($idConsulta)) {

                $sti_consulta = $sts->verifySitConsulta($idConsulta);

                if ($sti_consulta == "A Confirmar") {
                    $new_sit_consulta['sit_consulta'] = "Cancelado"; 
                    $result = $sts->alterSitConsulta($idConsulta, $new_sit_consulta);
                    if ($result) {
                        $_SESSION['msgGreen'] = "Consulta cancelada com sucesso.";
                    } else {
                        $_SESSION['msgRed'] = "Falha ao cancelar consulta, tente novamente mais tarde.";
                    }
                } 
                
                elseif ($sti_consulta == "Confirmado") {

                    // verifica se ainda restão 24 horas antes do horario marcado (so pode cancelar ate 24 horas de antecedência)
                    if ($sts->verifyDateConsulta($dataConsulta, $horaConsulta)) {

                        $new_sit_consulta['sit_consulta'] = "A Cancelar";
                        $result = $sts->alterSitConsulta($idConsulta, $new_sit_consulta);
                        if ($result) {
                            $_SESSION['msgGreen'] = "Solicitação de cancelamento de consulta realizado com sucesso.";
                        } else {
                            $_SESSION['msgRed'] = "Falha ao solicitar cancelamento de consulta, tente novamente mais tarde.";
                        }

                    } else {
                        $_SESSION['msgRed'] = "Erro, consulta selecionada não pode ser cancelada pois já está muito perto da data agendada"; 
                    } 
                    
                } else {
                    $_SESSION['msgRed'] = "Não é possivel cancelar essa consulta.";
                } 
            } else {
                $_SESSION['msgRed'] = "Erro, dados incongruentes"; 
            }  
        }
        else {
            $_SESSION['msgRed'] = "Erro, falta de dados";
        }

        $header = URL . "SobreCliente/Dados";
        header("Location: {$header}");
    }


    /**     function pages()
     * Function que todas as controller tem
     * Retorna as functions que são publicas nessa controller
     */
    public function pages(): array
    {  
        return $array = ['index','horarios','agendar', 'solicitarCancelamento'];
    }
    
}