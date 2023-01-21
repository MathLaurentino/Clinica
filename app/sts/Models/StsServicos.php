<?php

namespace Sts\Models;

class StsServicos{


    /**     function getServicosAtivos()
     * Retorna todos os servicos que emtão com sit = Ativo
     */
    public function getServicosAtivos(): array|null
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        
        $stsSelect->fullRead("SELECT * FROM tipo_consulta
                             WHERE sit_tipo_consulta = 'Ativo'", null); //nome_consulta, valor_consulta

        $result= $stsSelect->getResult();
        
        return $result;
    }

}


?>