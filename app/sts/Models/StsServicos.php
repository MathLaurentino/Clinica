<?php

namespace Sts\Models;

class StsServicos{


    public function index():array|null
    {
        
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        
        $stsSelect->fullRead("SELECT * FROM tipo_consulta ", null); //nome_consulta, valor_consulta

        $result['tipo_consulta'] = $stsSelect->getResult();
        
        return $result;
    }

}


?>