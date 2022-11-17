<?php

namespace Sts\Models;

class StsFotoPerfil
{


    public function cadastroFoto($nameInDB): bool
    {
        if (!isset($_SESSION)) {
            session_start();
        } 

        $stsUpdate = new \Sts\Models\helpers\StsUpdate();
        $stsUpdate->exeAlter('usuario', $nameInDB, 'idusuario', $_SESSION['idusuario']);
        $resultAlter = $stsUpdate->getResult();
        if(!empty($resultAlter)){
            return true;
        } else {
            return false;
        }
    }

}

?>