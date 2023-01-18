<?php

namespace Adms\Models;

class AdmsSobreClientes{


    /**     function changeSitUser(string $id, array $data)
     * Muda qualquer atributo específico do usuario. 
     * Exemplos:
     *      $data['tipo_usuario'] = "mantenedor" OR "cliente";
     *      $data['sit_usuario'] = "Inativo" OR "Ativo"
     */
    public function changeUserAttributes(string $id, array $data)
    {
        $admsUpdate = new \Adms\Models\helpers\AdmsUpdate();
        $admsUpdate->exeAlter('usuario', $data, 'idusuario', $id);
        $result = $admsUpdate->getResult();

        if (!empty($result)) 
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
                                ORDER BY idusuario ASC",
                                null);

        $userData = $admsSelect->getResult();
        return $userData;
    }


    /**     function verifyIfUserExist($idUser)
     * Verifica se o id passado realmente pertence a um usuário cadastrado no BD
     * Retorna true se existir e false se não
     */
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



    /**     function verifyIfUserIsNotConfirmando()
     * Verifica se a conta passada tem a sit_usuario diferente de "Confirmando"
     */
    public function verifyIfUserIsNotConfirmando($isUser): bool
    {
        $admsSelect = new \Adms\Models\helpers\AdmsSelect();
        $admsSelect->fullRead("SELECT  sit_usuario
                                FROM usuario 
                                WHERE idusuario = :idusuario", "idusuario={$idUser}");
        $sit_usuario = $admsSelect->getResult();

        if ($sit_usuario[0]['sit_usuario'] != "Confirmando") 
            return true;
        else
            return false;
    }



    /**     function verifyTypeUser($idUser)
     * Retorna o tipo_usuario do id passado 
     */
    public function verifyTypeUser($idUser): string 
    {
        $admsSelect = new \Adms\Models\helpers\AdmsSelect();
        $admsSelect->fullRead("SELECT tipo_usuario
                                FROM usuario 
                                WHERE idusuario = :idusuario", "idusuario={$idUser}");

        $result = $admsSelect->getResult();
        return $result[0]['tipo_usuario'];
        
    }
}


?>