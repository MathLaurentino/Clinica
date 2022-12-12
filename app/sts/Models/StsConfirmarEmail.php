<?php

namespace Sts\Models;

class StsConfirmarEmail
{
    
    /**     function dataPet()
     * Function pública para pegar dados da tabela raca_pet
     */
    public function verifyKey($chave)
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead("SELECT idusuario FROM usuario WHERE chave = :chave", "chave={$chave}");
        $userIdFromKey = $stsSelect->getResult();

        return $userIdFromKey;
    }


    
    public function alterSituation($id): bool
    {
        $data = array('sit_usuario' => 'Ativo');
        $stsUpdate = new \Sts\Models\helpers\StsUpdate();
        $stsUpdate->exeAlter('usuario', $data, 'idusuario', $id);
        $resultAlter = $stsUpdate->getResult();

        if (!empty($resultAlter)) 
            return true;
        else 
            return false;

    }

}


?>