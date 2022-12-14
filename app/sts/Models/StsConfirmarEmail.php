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


    /**     function getKey()
     * Pega a chave de ativação do cliente no BD
     *
     * @return void
     */
    public function getKey($email)
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead("SELECT chave FROM usuario WHERE email = :email", "email={$email}");
        $userKey = $stsSelect->getResult();
        var_dump($userKey);
        //return $userKey;
    }

}


?>