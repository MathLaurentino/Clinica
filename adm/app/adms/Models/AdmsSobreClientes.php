<?php

namespace Adms\Models;

class AdmsSobreClientes{


    /**     function changeTypeUser(array $data)
     * Modifica a sit_usuario no banco de dados
     *
     */
    public function changeTypeUser(string $id, array $data): bool
    {
        $admsUpdate = new \Adms\Models\helpers\AdmsUpdate();
        $admsUpdate->exeAlter('usuario', $data, 'idusuario', $id);
        $result = $admsUpdate->getResult();

        if (empty($resul)) 
            return true;
        else 
            return false;
    }


    

    /**     function getManagerUsers()
     * Retorna todos os usuários com tipo_usuario == 'mantenedor' 
     */
    public function getManagerUsers(): array|null
    {
        $admsSelect = new \Adms\Models\helpers\AdmsSelect();
        $admsSelect->fullRead("SELECT  idusuario, nome_usuario, tipo_usuario, email, foto_usuario, 	data_nascimento, sit_usuario
                                FROM usuario 
                                WHERE tipo_usuario  = 'mantenedor' 
                                ORDER BY nome_usuario ASC",
                                null);

        $userData = $admsSelect->getResult();
        return $userData;
    }



    /**     function getClientUsers()
     * Retorna todos os usuários com tipo_usuario == 'cliente' 
     */
    public function getClientUsers(): array|null
    {
        $admsSelect = new \Adms\Models\helpers\AdmsSelect();
        $admsSelect->fullRead("SELECT  idusuario, nome_usuario, tipo_usuario, email, foto_usuario, 	data_nascimento, sit_usuario
                                FROM usuario 
                                WHERE tipo_usuario  = 'cliente' 
                                ORDER BY nome_usuario ASC",
                                null);

        $userData = $admsSelect->getResult();
        return $userData;
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


    public function verifyIfUserExist($idUser): bool
    {
        $admsSelect = new \Adms\Models\helpers\AdmsSelect();
        $admsSelect->fullRead("SELECT  nome_usuario
                                FROM usuario 
                                WHERE idusuario = :idusuario", "idusuario={$idUser}");

        $result = $admsSelect->getResult();
        if(!empty($result))
            return true;
        else
            return false;
        
    }


    public function verifyTypeUser($idUser): string 
    {
        $admsSelect = new \Adms\Models\helpers\AdmsSelect();
        $admsSelect->fullRead("SELECT tipo_usuario
                                FROM usuario 
                                WHERE idusuario = :idusuario", "idusuario={$idUser}");

        $result = $admsSelect->getResult();
        return $result[0]['tipo_usuario'];
        
    }





    // /**     function getUserAtivo()
    //  * Retorna todos os usuários com sit_usuario == 'Ativo'
    //  */
    // public function getUserAtivo(): array|null
    // {
    //     $admsSelect = new \Adms\Models\helpers\AdmsSelect();
    //     $admsSelect->fullRead("SELECT   sit_usuario, nome_usuario, tipo_usuario, email, foto_usuario, 	data_nascimento, idusuario
    //                             FROM usuario 
    //                             WHERE sit_usuario  = 'Ativo' 
    //                             ORDER BY tipo_usuario DESC, nome_usuario",
    //                             null);

    //     $userData = $admsSelect->getResult();
    //     return $userData;
    // }


    // /**     function getUserAtivo()
    //  * Retorna todos os usuários com sit_usuario == 'Inativo'
    //  */
    // public function getUserInativo(): array|null
    // {
    //     $admsSelect = new \Adms\Models\helpers\AdmsSelect();
    //     $admsSelect->fullRead("SELECT  idusuario, nome_usuario, tipo_usuario, email, foto_usuario, 	data_nascimento, sit_usuario
    //                             FROM usuario 
    //                             WHERE sit_usuario  = 'Inativo' 
    //                             ORDER BY tipo_usuario DESC, nome_usuario",
    //                             null);

    //     $userData = $admsSelect->getResult();
    //     return $userData;
    // }



    // /**     function getUserAtivo()
    //  * Retorna todos os usuários com sit_usuario == 'Confirmando' 
    //  */
    // public function getUserConfirmando(): array|null
    // {
    //     $admsSelect = new \Adms\Models\helpers\AdmsSelect();
    //     $admsSelect->fullRead("SELECT  idusuario, nome_usuario, tipo_usuario, email, foto_usuario, 	data_nascimento, sit_usuario
    //                             FROM usuario 
    //                             WHERE sit_usuario  = 'Confirmando' 
    //                             ORDER BY nome_usuario ASC",
    //                             null);

    //     $userData = $admsSelect->getResult();
    //     return $userData;
    // }
    

}


?>