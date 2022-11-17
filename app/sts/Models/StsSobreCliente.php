<?php

namespace Sts\Models;

if(!isset($_SESSION)){
    session_start();
} 
    
class StsSobreCliente
{
    private array|null $data = null;
    private string|null $resultAlter = null;


    //------------------------ FUNÇÕES DE SELECT -----------------------
    //Funções para pegar registros no BD


    /**     function userData()
     * Busca os dados da tabela usuario no BD
     */
    public function userData(): array|null
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead("SELECT nome_usuario, cpf, rg, email, data_nascimento 
                                    FROM usuario
                                    WHERE idusuario  = :idusuario", 
                                    "idusuario={$_SESSION['idusuario']}");
        
        return $stsSelect->getResult();                            
    }



    /**     function userAdress()
     * Busca os dados do endereço no BD
     */
    public function userAdress(): array|null
    { 
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead("SELECT e.cep, e.rua, e.numero_residencial, e.cidade, e.estado
                            FROM endereco as e
                            INNER JOIN usuario as u 
                            ON u.endereco = e.idendereco 
                            WHERE u.endereco = :endereco", "endereco={$_SESSION['idendereco']}" );

        return $stsSelect->getResult();
    }



    /**     function userPet()
     * Busca os dados do pet no BD
     * Ainda não implementado
     */
    public function userPet(): array|null
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead("SELECT p.idpet, p.nome_pet, p.idade_pet, p.sexo, r.raca, r.tipo_pet 
                                    FROM pet AS p 
                                    INNER JOIN raca_pet AS r 
                                    ON p.idraca = r.idraca_pet 
                                    INNER JOIN usuario AS u 
                                    on u.idusuario = p.usuario 
                                    WHERE u.idusuario = :idusuario", "idusuario={$_SESSION['idusuario']}");
        
        return $stsSelect->getResult();
    }

    public function userPetById($idpet): array|null 
    {
        if ($this->verifyIdPetIsFromUser($idpet)) {
            $stsSelect = new \Sts\Models\helpers\StsSelect();
            $stsSelect->fullRead("SELECT p.idpet, p.nome_pet, p.idade_pet, p.sexo, p.idraca, r.raca, r.tipo_pet 
                                        FROM pet AS p 
                                        INNER JOIN raca_pet AS r 
                                        ON p.idraca = r.idraca_pet 
                                        INNER JOIN usuario AS u 
                                        ON u.idusuario = p.usuario 
                                        WHERE u.idusuario = :idusuario AND idpet = :idpet", "idusuario={$_SESSION['idusuario']}&idpet=$idpet");
            return $stsSelect->getResult();
        } else {
            return null;
        }
        
    }

    public function verifyIdPetIsFromUser($idpet): bool
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead("SELECT idpet
                                    FROM pet AS p
                                    INNER JOIN usuario AS u 
                                    ON u.idusuario = p.usuario 
                                    WHERE u.idusuario = :idusuario AND idpet = :idpet", 
                                    "idusuario={$_SESSION['idusuario']}&idpet=$idpet");
        $result = $stsSelect->getResult();

        if (!empty($result)) 
            return true;
        else 
            return false;
        
    }

    public function verifyIfPetExist(): bool
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead("SELECT idpet
                                    FROM pet AS p
                                    INNER JOIN usuario AS u 
                                    ON u.idusuario = p.usuario 
                                    WHERE u.idusuario = :idusuario", 
                                    "idusuario={$_SESSION['idusuario']}");
        $result = $stsSelect->getResult();
        if (!empty($result)) 
            return true;
        else 
            return false;
    }


    public function getRaca($tipo_pet): array|null
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead("SELECT * FROM raca_pet
                                    WHERE tipo_pet = :tipo_pet", "tipo_pet={$tipo_pet}");

        return $stsSelect->getResult();
    }



    //----------------------- FUNÇÕES DE ALTERAR -----------------------
    //Funções para alterar os registros no BD



    /**     function alterUser()
     * Function para alterar as informações do usuario
     * Ela é chamada pela controller SobreCliente
     * Altera os dados por meio de um OBJ de StsUpdate
     *      chamando o método exeAlter()
     */
    public function alterUser(array $data): string|null
    {
        ;

        if (!empty($resul)) {
            return null;
        }  else {
            $stsUpdate = new \Sts\Models\helpers\StsUpdate();
            $stsUpdate->exeAlter('usuario', $data, 'idusuario', $_SESSION['idusuario']);
            $this->resultAlter = $stsUpdate->getResult();

            return $this->resultAlter;
        }

        
    }


    public function checkEmail()
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead("SELECT idusuario 
                            FROM usuario
                            WHERE cpf = :cpf", "cpf={$data['cpf']}");
        $result = $stsSelect->getResult();
        
        return $result;
    }



    /**     function alterAdress()
     * Function para alterar as informações do endereço
     * Ela é chamada pela controller SobreCliente
     * Altera os dados por meio de um OBJ de StsUpdate
     *      chamando o método exeAlter()
     */
    public function alterAdress(array $data): string|null 
    {
        $stsUpdate = new \Sts\Models\helpers\StsUpdate();
        $stsUpdate->exeAlter('endereco', $data, 'idendereco', $_SESSION['idendereco']);
        $this->resultAlter = $stsUpdate->getResult();

        return $this->resultAlter;
    }



    /**     function alterPet()
     * Function para alterar as informações do pet
     * Ela é chamada pela controller SobreCliente
     * Altera os dados por meio de um OBJ de StsUpdate
     *      chamando o método exeAlter()
     */
    public function alterPet(array $data): string|null
    {
        $stsUpdate = new \Sts\Models\helpers\StsUpdate();

        extract($data);
        $idAnimal = $idpet;
        unset($data['idpet']);

        $stsUpdate->exeAlter('pet', $data, 'idpet', $idAnimal);
        $resultAlter = $stsUpdate->getResult();

        return $resultAlter;
    }   



    
    /**     function deleteAll()
     * Function para deletar as informações do BD
     *      - $table: em qual tabela vai ser deletada as informações
     *      - $where: qual o campo da tabela que servira de where na query
     *      - $id: o valor do where
     */
    public function deleteAll(String $table, String $where, String $id): string|null
    {
        $stsDelete = new \Sts\Models\helpers\StsDelete();
        $stsDelete->delete($table,$where, $id);
        $resultDelete = $stsDelete-> getResult();

        return $resultDelete;
    }
}

?>