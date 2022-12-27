<?php

namespace Adms\Models;

class AdmsFotoServico{


    public function verifyIdServico($id)
    {
        $AdmsSelect = new \Adms\Models\helpers\AdmsSelect();
        $AdmsSelect->fullRead("SELECT nome_consulta 
                                FROM tipo_consulta
                                WHERE idtipo_consulta  = :idtipo_consulta", 
                                "idtipo_consulta={$id}");

        $result = $AdmsSelect->getResult();
        if (!empty($result))
            return true;
        else 
            return false; 
    }

}


?>