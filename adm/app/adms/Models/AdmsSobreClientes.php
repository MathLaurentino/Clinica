<?php

namespace Adms\Models;

class AdmsSobreClientes{


    public function ConverterCargo(array $data): string|null 
    {
        $id = $data['idusuario'];
        unset($data['idusuario']);

        $AdmsUpdate = new \Adms\Models\helpers\AdmsUpdate();
        $AdmsUpdate->exeAlter('usuario', $data, 'idusuario', $id);
        $result = $AdmsUpdate->getResult();
        if(!empty($result)){
            return $result;//retorna um sring
        }else{
            return null;
        }
    }



    public function mostrarClientes(): array|null
    {
        
        $AdmsSelect = new \Adms\Models\helpers\AdmsSelect();
        $AdmsSelect->fullRead("SELECT  idusuario, nome_usuario, tipo_usuario, email, foto_usuario
                                FROM usuario order by tipo_usuario DESC",null);

        $userDate = $AdmsSelect->getResult();
        if(!empty($userDate)){
            return $userDate;//retorna um array
        }else{
            return null;
        }
    }
    

}


?>