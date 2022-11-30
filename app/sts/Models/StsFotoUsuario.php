<?php

namespace Sts\Models;

include_once 'app/sts/Controllers/helpers/protect.php';

class StsFotoUsuario
{
    public function cadastroFoto($nameInDB): bool
    {
        $stsUpdate = new \Sts\Models\helpers\StsUpdate();
        $stsUpdate->exeAlter('usuario', $nameInDB, 'idusuario', $_SESSION['idusuario']);
        $resultAlter = $stsUpdate->getResult();
        if(!empty($resultAlter)){
            return true;
        } else {
            return false;
        }
    }


    public function apagarFotoUsuario(): bool 
    {
        $data = ['foto_usuario'=> NULL];
        $stsUpdate = new \Sts\Models\helpers\StsUpdate();
        $stsUpdate->exeAlter('usuario', $data, 'idusuario', $_SESSION['idusuario']);
        $resultAlter = $stsUpdate->getResult();
        if(!empty($resultAlter)){
            return true;
        } else {
            return false;
        }
    }

}

?>