<?php

namespace Adms\Models;

class AdmsLogin{

    public function login(array $data)
    {
        extract($data);
        
        $AdmsSelect = new \Adms\Models\helpers\AdmsSelect();
        $AdmsSelect->fullRead("SELECT  idusuario, nome_usuario, senha_usuario, tipo_usuario, endereco 
                                FROM usuario 
                                WHERE email=:email", 
                                "email={$email}");

        $userDate = $AdmsSelect->getResult();
        if(!empty($userDate)){
            return $userDate;//retorna um array
        }else{
            return null;
        }
    }

}


?>