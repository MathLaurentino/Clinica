<?php

namespace Sts\Models;

class StsRecuperarSenha{



    /**     function horariosDeConsulta()
     * Informa se email informado realmente existe no BD
     */
    public function getUserData($email): array|null
    {   
        $stsSelect = new \Sts\Models\helpers\StsSelect();

        $stsSelect->fullRead("SELECT idusuario, nome_usuario, email, sit_usuario
                            FROM usuario
                            WHERE email = :email", "email={$email}");

        return $stsSelect->getResult();
    }



    /**     function verifyKeyUser()
     * Informa se a chave informada realmente existe no BD
     *      sa existir retorna o id do usuário que a tem
     */
    public function verifyKeyUser($key): array|null
    {   
        $stsSelect = new \Sts\Models\helpers\StsSelect();

        $stsSelect->fullRead("SELECT idusuario
                            FROM usuario
                            WHERE recuperar_senha = :recuperar_senha", "recuperar_senha={$key}");

        return $stsSelect->getResult();
    }



    /**     function alterSitConsulta($id, $data)
     * Altera qualquer informação da tabela usuario
     * $data deve ser um array e se comportar da seguinte forma
     * Exemplo:
     *      data -> ['recuperar_senha'] = "$key"
     */
    public function alterUserData(string $id, array $data): bool
    {
        $stsUpdate = new \Sts\Models\helpers\StsUpdate();
        $stsUpdate->exeAlter('usuario', $data, 'idusuario', $id);

        $resultAlter = $stsUpdate->getResult();

        if(!empty($resultAlter))
            return true;
        else 
            return false;
    }
    

}