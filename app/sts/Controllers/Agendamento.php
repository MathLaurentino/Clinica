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
     * Manda os dados da tebela consulta para o Full Calendar 
     */
    public function horarios(): void
    {

        $sts = new \Sts\Models\StsAgendamento();
        $eventsArray = $sts->horariosDeConsulta();

        $this->data = json_encode($eventsArray);

        $loadView = new \Core\LoadView("sts/Views/bodys/agendamento/calendar", $this->data , NULL);
        $loadView->loadView_header3("calendarH");
      
    }







    /**     function agendar()
     * Carrega a tela para agendar uma nova consulta
     * Recebe os dados do formulário para agendar uma nova consulta
     */
    public function agendar(): void
    {

        // se o dados de dia, horario e servico forem passados na URL
        if (isset($_GET['dia']) && isset($_GET['horario']) && isset($_GET['servico'])) {

            $dayNewEvent = $_GET['dia'];
            $timeNewEvent = $_GET['horario'];
            $idServico = $_GET['servico'];

            $sts = new \Sts\Models\StsAgendamento();            

            // se os dados passados na URL são válidos (consulta no BD)
            if ($this->varificarData($dayNewEvent, $timeNewEvent) && $sts->idServicoExiste($idServico)) {

                $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                
                // se não mandou o formulário de agendar servico, então carrega a tela de agendamento
                if (!isset($this->dataForm['agendar'])) {

                    $this->data['servico'] = $sts->servicoClinica($idServico);
                    $this->data['servico'] = $this->data['servico'][0];
                    $this->data['pets'] = $sts->userPets($_SESSION['idusuario']);
                    
                    $loadView = new \Core\LoadView("sts/Views/bodys/agendamento/agendamento", $this->data , NULL);
                    $loadView->loadView_header3("agendamentoH");
                
                // caso já tenha mandado o formulário de agendar servico, cadastre a consulta no banco de dados
                // a nova consulta por padrão aperecera como "AConfirmar" no BD
                } else {

                    unset($this->dataForm['agendar']);
                    
                    $idconsulta = $sts->salvarServico($this->dataForm);

                    if (!empty($idconsulta)) {
                        $_SESSION['msg'] = "Consulta agendada com sucesso, aguarde a confirmação da clinica";
                        $header = URL . "Sobre Cliente";
                        header("Location: {$header}");
                    } else {
                        $_SESSION['msg'] = "Falha ao agendar servico, tente novamente.";
                        $header = URL . "Servicos";
                        header("Location: {$header}");
                    }

                }
                
            } else {
                $_SESSION['msg'] = "Horario ou servico inválido, tente novamente.";
                $header = URL . "Servicos";
                header("Location: {$header}");
            }

        } else {
            $_SESSION['msg'] = "Dados insuficientes, tente novamente.";
            $header = URL . "Servicos";
            header("Location: {$header}");
        }

    }


        





    /**     function varificarData()
     * Verifica se a data e hora passada pela URL está 
     *      disponivel no banco de dados
     */
    private function varificarData($dayNewEvent, $timeNewEvent): bool
    {

        $dayTimeNow = date('d/m/Y H:i');
        $dayNow = substr($dayTimeNow, 0, 10); // 01/01/2023
        $dayNow = substr($dayNow,6) . "-" . substr($dayNow, 3, -5) . "-" . substr($dayNow, 0, -8); // 2023-01-01
        $timeNow = substr($dayTimeNow,10, -3);

        $dateDayNew = date_create($dayNewEvent); 
        $dateDayNow = date_create($dayNow);
        $diff=date_diff($dateDayNow, $dateDayNew); //$result = $diff->format("%a"); -> diferença de dias
        $result = $diff->invert; // retorna 1 se o dia da URL é passado e 0 se for presente o futuro

        // se o dia da URL já é passado
        if ($result == 1) {
            return FALSE;
        }

        // se o horario passado estiver fora dos horarios estabelecidos pela clinica
        if ($timeNewEvent < 12 || $timeNewEvent > 18) {
            return FALSE;
        }   

        // se tiver no mesmo dia mas o horario já é passado
        if ($dayNewEvent == $dayNow && $timeNewEvent <= $timeNow) {
            return FALSE;
        }

        $sts = new \Sts\Models\StsAgendamento();
        $eventsArray = $sts->horariosDeConsulta();

        for ($x = 0; $x <count($eventsArray); $x++) {

            $event = $eventsArray[$x];

            $dayEventDB = $event['data_consulta'];
            $timeEventDB = $event['horario_consulta'];
            $timeEventDB = substr($timeEventDB, 0, 2);

            // se tiver um evento no mesmo dia e mesmo horario
            if ($dayEventDB == $dayNewEvent && $timeEventDB == $timeNewEvent) {
                return FALSE;
            }
        
        }

        return TRUE;
    }


    /**     function pages()
     * Function que todas as controller tem
     * Retorna as functions que são publicas nessa controller
     */
    public function pages(): array
    {  
        return $array = ['index','horarios','agendar'];
    }
    
}