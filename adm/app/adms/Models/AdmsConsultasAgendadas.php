<?php

namespace Adms\Models;

class AdmsConsultasAgendadas{

    public function getDataConsulta()
    {
        $AdmsSelect = new \Adms\Models\helpers\AdmsSelect();
        $AdmsSelect->fullRead("SELECT  * FROM consulta", NULL);

        $data = $AdmsSelect->getResult();
        return $data;
        
    }

}

?>