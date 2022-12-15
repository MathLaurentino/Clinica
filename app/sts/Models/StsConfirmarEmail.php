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



    /**     alterSituation($id)
     * Muda o estado da conta para ativo
     */
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



    /**
     * Pega qual o estado da conta
     *      Ativa, Inativa ou Confirmando
     */
    public function getSituation($condition, $value): string|null
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead("SELECT sit_usuario FROM usuario WHERE {$condition} = :{$condition}", "{$condition}={$value}");
        $userSituation = $stsSelect->getResult();
        
        if (!empty($userSituation)) {
            return $userSituation[0]['sit_usuario'];
        } else {
            return null;
        }
    }



    /**     function getKey()
     * Pega a chave de ativação do cliente no BD
     *
     * @return void
     */
    public function getKey($email): string|null
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead("SELECT chave FROM usuario WHERE email = :email", "email={$email}");
        $userKey = $stsSelect->getResult();
        if (!empty($userKey)) 
            return $userKey[0]['chave'];
        else 
            return null;
    }



    /**     verifyIfEmailExist($email)
     * Verifica se o email mandado tem registro no banco de dados
     */
    public function verifyIfEmailExist($email): bool
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead("SELECT idusuario FROM usuario WHERE email = :email", "email={$email}");
        $idUser = $stsSelect->getResult();
        if (!empty($idUser)) 
            return true;
        else 
            return false;
    }

}


?>