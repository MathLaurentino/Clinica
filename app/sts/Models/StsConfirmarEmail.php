<?php

namespace Sts\Models;

class StsConfirmarEmail
{
    
    /**     function dataPet()
     * Retorna o id do usuário a partir do chave de ativação da conta
     */
    public function getIdUser($chave): string|null
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead("SELECT idusuario FROM usuario WHERE chave = :chave", "chave={$chave}");
        $userIdFromKey = $stsSelect->getResult();

        if ($userIdFromKey) 
            return $userIdFromKey[0]['idusuario'];
        else 
            return NULL;
    }



    /**     alterSituation($id)
     * Muda o estado da conta para de confirmando para ativo
     */
    public function alterDataUsuario($id, $data): bool
    {
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
    public function getSituation(string $condition, string $value): string|null
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



    /**     verifyIfEmailExist($email)
     * Verifica se o email mandado tem registro no banco de dados
     */
    public function verifyIfEmailExist($email): array|null
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead("SELECT idusuario FROM usuario WHERE email = :email", "email={$email}");
        $idUser = $stsSelect->getResult();

        return $idUser;
    }

}


?>