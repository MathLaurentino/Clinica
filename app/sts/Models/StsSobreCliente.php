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
        $stsSelect->fullRead("SELECT nome_usuario, cpf, rg, email, data_nascimento, foto_usuario 
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
        $stsSelect->fullRead("SELECT e.cep, e.rua, e.numero_residencial, e.cidade, e.estado, e.bairro
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
        $stsSelect->fullRead("SELECT p.idpet, p.nome_pet, p.idade_pet, p.sexo, p.imagem_pet, p.imagem_carteira_pet, r.raca, r.tipo_pet 
                                    FROM pet AS p 
                                    INNER JOIN raca_pet AS r 
                                    ON p.idraca = r.idraca_pet 
                                    INNER JOIN usuario AS u 
                                    on u.idusuario = p.usuario 
                                    WHERE u.idusuario = :idusuario", "idusuario={$_SESSION['idusuario']}");
        
        return $stsSelect->getResult();
    }



    // ------------------- CONSULTAS -------------------



    /**     function getBasicDataConsultas()
     * Retorna o historico de agendamonto do  cliente logado
     */
    public function getBasicDataConsultas(): array|null
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead( "SELECT c.idconsulta, c.data_consulta, c.horario_consulta, c.sit_consulta,
                                t.nome_consulta, t.tempo_medio, t.valor_consulta, t.foto_servico,
                                p.nome_pet
                                FROM consulta as c
                                INNER JOIN tipo_consulta as t
                                ON c.tipo_consulta = t.idtipo_consulta
                                INNER JOIN pet as p
                                ON c.pet = p.idpet
                                INNER JOIN usuario AS u 
                                ON p.usuario = u.idusuario
                                WHERE u.idusuario = :idusuario
                                ORDER BY c.data_consulta", "idusuario={$_SESSION['idusuario']}");
        
        return $stsSelect->getResult();
    }



    public function getDataConsultaEmAndamento(): array|null
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead( "SELECT c.sit_consulta, c.idconsulta, c.data_consulta, c.horario_consulta,
                                t.nome_consulta, t.tempo_medio, t.valor_consulta, t.foto_servico,
                                p.nome_pet
                                FROM consulta as c
                                INNER JOIN tipo_consulta as t
                                ON c.tipo_consulta = t.idtipo_consulta
                                INNER JOIN pet as p
                                ON c.pet = p.idpet
                                INNER JOIN usuario AS u 
                                ON p.usuario = u.idusuario
                                WHERE u.idusuario = :idusuario
                                AND c.sit_consulta = 'A Confirmar'
                                OR  c.sit_consulta = 'Confirmado'
                                OR  c.sit_consulta = 'A Cancelar'
                                ORDER BY c.data_consulta", "idusuario={$_SESSION['idusuario']}");
        
        return $stsSelect->getResult();
    }



    public function getDataConsultasFinalizadas(): array|null
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead( "SELECT c.sit_consulta, c.idconsulta, c.data_consulta, c.horario_consulta,
                                t.nome_consulta, t.tempo_medio, t.valor_consulta, t.foto_servico,
                                p.nome_pet
                                FROM consulta as c
                                INNER JOIN tipo_consulta as t
                                ON c.tipo_consulta = t.idtipo_consulta
                                INNER JOIN pet as p
                                ON c.pet = p.idpet
                                INNER JOIN usuario AS u 
                                ON p.usuario = u.idusuario
                                WHERE u.idusuario = :idusuario
                                AND c.sit_consulta != 'A Confirmar'
                                AND  c.sit_consulta != 'Confirmado'
                                AND  c.sit_consulta != 'A Cancelar'
                                ORDER BY c.data_consulta", "idusuario={$_SESSION['idusuario']}");
        
        return $stsSelect->getResult();
    }



    /**     function getFullDataConsulta($idConsulta)
     * Retorna os dados de determinada consulta, juntamente com informações
     *      da tabela pet, raca_pet, tipo_consulta e usuario
     */
    public function getFullDataConsulta($idConsulta): array
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead("SELECT c.data_consulta, c.horario_consulta, c.descricao, c.sit_consulta, c.tipo_consulta,
                                p.nome_pet, p.idade_pet, p.sexo,
                                r.tipo_pet, r.raca,
                                t.nome_consulta, t.descricao_consulta, t.tempo_medio,
                                u.nome_usuario, u.email, foto_usuario
                                FROM consulta as c
                                INNER JOIN pet as p 
                                ON c.pet = p.idpet
                                INNER JOIN raca_pet AS r
                                ON p.idraca = r.idraca_pet
                                INNER JOIN tipo_consulta as t
                                ON c.tipo_consulta = t.idtipo_consulta
                                INNER JOIN usuario AS u 
                                ON p.usuario = u.idusuario
                                WHERE c.idconsulta = :idconsulta", "idconsulta={$idConsulta}");
        $result = $stsSelect->getResult();

        return $result;
    }




    // -------------------------------------------------



    /**     function userPetById($idpet)
     * Retorna dados de um pet específico do cliente pelo ID
     */
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


    /**     function verifyIdPetIsFromUser($idpet)
     * Verifica se o id do pet pessado realmente pertence ao usuario logado
     */
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


    /**     function verifyIdConsultaIsFromUser($idConsulta)
     * Verifica se a consulta passada pertence ao cliente que está logado
     */
    public function verifyIdConsultaIsFromUser($idConsulta): bool
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead("SELECT u.idusuario
                                    FROM usuario AS u
                                    INNER JOIN pet AS p 
                                    ON u.idusuario = p.usuario 
                                    INNER JOIN consulta AS c
                                    ON c.pet = p.idpet
                                    WHERE c.idconsulta = :idconsulta", 
                                    "idconsulta={$idConsulta}");
        $result = $stsSelect->getResult();

        if ($result[0]['idusuario'] == $_SESSION['idusuario']) 
            return true;
        else 
            return false;
    }


    
    /**     function verifyIfPetExist()
     * Verifica se o cliente logado tem algum pet cadastrado
     */
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



    /**     function getRaca($tipo_pet)
     * Retorna todas as informações sobre a espécie e raça do pet do cliente
     */
    public function getRaca($tipo_pet): array|null
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead("SELECT * FROM raca_pet
                                    WHERE tipo_pet = :tipo_pet", "tipo_pet={$tipo_pet}");

        return $stsSelect->getResult();
    }



    /**     function alterUser()
     * Function para alterar as informações do usuario
     * Ela é chamada pela controller SobreCliente
     * Altera os dados por meio de um OBJ de StsUpdate
     *      chamando o método exeAlter()
     */
    public function alterUser(array $data): string|null
    {

        if (!empty($resul)) {
            return null;
        }  else {
            $stsUpdate = new \Sts\Models\helpers\StsUpdate();
            $stsUpdate->exeAlter('usuario', $data, 'idusuario', $_SESSION['idusuario']);
            $this->resultAlter = $stsUpdate->getResult();

            return $this->resultAlter;
        }

        
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



    /**     function verifyRepeatedCpf($cpf)
     * Verifica se o novo cpf passado pelo cliente já possui cadastro no BD
     */
    public function verifyRepeatedCpf($cpf): bool
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead("SELECT idusuario 
                            FROM usuario
                            WHERE cpf = :cpf", "cpf={$cpf}");
        $result = $stsSelect->getResult();
        
        if (empty($result))
            return true;
        else 
            return false;
    }



    /**     function verifySameCpf()
     * Verifica se o cpf passado é o mesmo que esta cadastrado na conta do cliente
     * (Acontece quando o usuario faz alteração nos dados da conta mas não muda a parte 
     *      do formulário referente ao CPF)
     */
    public function verifySameCpf($idusuario, $formCpf)
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead("SELECT cpf 
                            FROM usuario
                            WHERE idusuario = :idusuario", "idusuario={$idusuario}");
        $result = $stsSelect->getResult();
        $userCpf = $result[0]['cpf'];

        if ($userCpf == $formCpf)
            return true;
        else 
            return false;
    }
}

?>