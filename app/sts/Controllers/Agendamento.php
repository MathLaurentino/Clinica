<?php

namespace Sts\Controllers;

if (!defined('D7E4T2K6F4')) {
    $header = "http://localhost/Clinica/Erro?case=404"; // Erro 404
    header("Location: {$header}");
}

include_once 'app/sts/Controllers/helpers/protect.php';

date_default_timezone_set('America/Sao_Paulo');

class Agendamento{


    private $events;
    private array|null $dataForm;
    
    public function index()
    {
        $this->novaConsulta();
    }


    public function novaConsulta()
    {

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (empty($this->dataForm['CadEvent'])) {

            $sts = new \Sts\Models\StsAgendamento();
            $eventsArray = $sts->dataFullCalendar();
            // echo "<pre>";var_dump($eventsArray);
            // $eventsArray[11]['url']  = 'http://localhost/Clinica/Sobre-Cliente/Dados';

            $this->events = json_encode($eventsArray);
        
            $loadView = new \Core\LoadView("sts/Views/agendamento", $this->events , NULL);
            $loadView->loadView_agendamento();


            /*
            $hojeDia = date('d/m/Y', time());
            $hojeDia = explode("/",$hojeDia);

            $horaHoje = date('H/i', time());
            $horaHoje = explode("/", $horaHoje);
            echo $horaHoje;


            for ($x = 0; $x <count($eventsArray); $x++) {

                $event = $eventsArray[$x];

                //echo "<pre>";var_dump($event);

                $dayTime = $event['start'];
                $dayTime = explode(" ",$dayTime);
                $day = $dayTime[0];
                $time = $dayTime[1];
                $day = explode("-", $day);

                if ($day[0] == $hojeDia[2] && $day[1] == $hojeDia[1] && $day[2] == $hojeDia[0]) {
                    echo "Aqui: " . $x;
                    var_dump($dayTime); echo "<br>";
                    var_dump($time);
                    $time = explode(":",$time);
                    var_dump( $time);
                    
                }

                // var_dump($day); // ano mes dia
                // var_dump($hoje); // dia mes ano

                // $timeString = $timeArray[1];

                // $timeArray = explode(":", $timeString);

            }
            */

        } else {
            echo "<pre>";var_dump($this->dataForm);
        }

        
    }



    public function dataEvents()
    {
        $sts = new \Sts\Models\StsAgendamento();
        $eventsArray = $sts->dataFullCalendar();

        $events = json_encode($eventsArray);
        return $events;
    }

    /**     function pages()
     * Function que todas as controller tem
     * Retorna as functions que são publicas nessa controller
     */
    public function pages(): array
    {  
        return $array = ['index','novaConsulta'];
    }
    
}