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
     */
    public function agendar(): void
    {

        
        if (isset($_GET['dia']) && isset($_GET['horario'])) {

            $dayNewEvent = $_GET['dia'];
            $timeNewEvent = $_GET['horario'];
            $idServico = $_GET['servico'];

            $sts = new \Sts\Models\StsAgendamento();            

            if ($this->varificarData($dayNewEvent, $timeNewEvent) && $sts->idServicoExiste($idServico)){

                $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                
                if (isset($this->dataForm['agendar'])) {

                    unset($this->dataForm['agendar']);
                    //echo "<pre>";var_dump($this->dataForm);
                    if ($sts->salvarServico($this->dataForm)) {
                        echo "deu certo";
                    } else {
                        echo "deu errado";
                    }
                    

                } else {

                    $this->data = $sts->servicoClinica($idServico);
                    $loadView = new \Core\LoadView("sts/Views/bodys/agendamento/agendamento", $this->data[0] , NULL);
                    $loadView->loadView_header3("agendamentoH");

                }
                

            } else {
                echo "DateTime inválido";
            }
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

        // Se o dia da URL já é passado
        if ($result == 1) {
            return FALSE;
        }

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