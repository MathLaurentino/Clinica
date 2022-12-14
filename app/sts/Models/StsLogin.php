<?php

namespace Sts\Models;

class StsLogin
{

    /**     function login()
     * Chamda pela controller Login, serve para pegar a senha,
     *      o id e a chave estrangeira de endereco do usuário que
     *      tiver o email passado pelo $data
     */
    public function login(array $data): array|null
    {
        extract($data);
        
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead("SELECT  idusuario, nome_usuario, foto_usuario, senha_usuario, tipo_usuario, endereco, sit_usuario, email
                                FROM usuario 
                                WHERE email=:email", 
                                "email={$email}");

        $userDate = $stsSelect->getResult();
        
        if(!empty($userDate)){
            return $userDate;//retorna um array
        }else{
            return null;
        }
    }
}

?>