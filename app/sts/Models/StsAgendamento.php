<?php

namespace Sts\Models;

class StsAgendamento{

    public function dataFullCalendar(): array
    {   
        $stsSelect = new \Sts\Models\helpers\StsSelect();

        $stsSelect->fullRead("SELECT * FROM events", NULL);

        $resultado =  $stsSelect->getResult();

        return $resultado;
    }

}