<?php

namespace Sts\Models;

class StsServicos{


    /**     function dataServicos()
     * Retorna todos so dados da tabela tipo_consulta
     */
    public function dataServicos():array|null
    {
        
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        
        $stsSelect->fullRead("SELECT * FROM tipo_consulta ", null); //nome_consulta, valor_consulta

        $result['tipo_consulta'] = $stsSelect->getResult();
        
        return $result;
    }

}


?>