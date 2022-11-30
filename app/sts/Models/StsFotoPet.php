<?php

namespace Sts\Models;

include_once 'app/sts/Controllers/helpers/protect.php';

class StsFotoPet
{
    public function cadastroFotoPet($nameInDB, $id): bool
    {
        $stsUpdate = new \Sts\Models\helpers\StsUpdate();
        $stsUpdate->exeAlter('pet', $nameInDB, 'idpet', $id);
        $resultAlter = $stsUpdate->getResult();
        if(!empty($resultAlter)){
            return true;
        } else {
            return false;
        }
    }


    public function apagarFotoPet(): bool 
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


    /**
     * Retorna true se não existir foto de pet no bd
     *      caso contrario retorna false
     */
    public function verificarFoto($idpet): bool
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead("SELECT imagem_pet
                                    FROM pet
                                    WHERE idpet  = :idpet", 
                                    "idpet={$idpet}");
        
        $result = $stsSelect->getResult();

        if (!empty($result[0]['imagem_pet']))
            return false;
        else 
            return true; 
    }

}

?>