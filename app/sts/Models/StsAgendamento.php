<?php

namespace Sts\Models;

date_default_timezone_set('America/Sao_Paulo');

class StsAgendamento{


    /**     function horariosDeConsulta()
     * Responsalver por pegar os horarios das consultas marcadas no banco de dados
     */
    public function horariosDeConsulta(): array
    {   
        $stsSelect = new \Sts\Models\helpers\StsSelect();

        $stsSelect->fullRead("SELECT data_consulta, horario_consulta 
                            FROM consulta
                            WHERE sit_consulta = 'A Confirmar' 
                            OR sit_consulta = 'Confirmado'
                            OR sit_consulta = 'A Cancelar'", NULL);

        $resultado =  $stsSelect->getResult();

        return $resultado;
    }



    /**     function idServicoExiste($id)
     * Verifica se o id passado realmente corresponde a um servico cadastrado no BD
     * Retorna true se o servico existir e false se não
     */
    public function idServicoExiste($id): bool
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();

        $stsSelect->fullRead("SELECT nome_consulta
                            FROM tipo_consulta
                            WHERE idtipo_consulta = :idtipo_consulta", "idtipo_consulta={$id}");

        $resultado =  $stsSelect->getResult();

        if (!empty($resultado))
            return true;
        else 
            return false; 
    }



    /**     function getSitSertico($id)
     * Retorna a situação do servico selecionado
     *      se é Ativo ou Inativo
     */
    public function getSitSertico($id): bool
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();

        $stsSelect->fullRead("SELECT sit_tipo_consulta
                            FROM tipo_consulta
                            WHERE idtipo_consulta = :idtipo_consulta", "idtipo_consulta={$id}");

        $resultado =  $stsSelect->getResult();

        if ($resultado[0]['sit_tipo_consulta'] == "Ativo")
            return true; 
        else 
            return false;
    }



    /**     function servicoClinica()
     * Devolve dados de nome_consulta, valor_consulta, tempo_medio 
     *      da tabela tipo_consulta com id
     */
    public function servicoClinica($id): array
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();

        $stsSelect->fullRead("SELECT nome_consulta, valor_consulta, tempo_medio 
                            FROM tipo_consulta
                            WHERE idtipo_consulta = :idtipo_consulta", "idtipo_consulta={$id}");

        $resultado =  $stsSelect->getResult();

        return $resultado;
    }



    /**
     * Salva na tebela consulta o servico agendado pelo cliente 
     * com os seguintes dadod: 
     *      - data_consulta
     *      - horario_consulta
     *      - tipo_consulta
     *      - descricao
     *      - pet
     */
    public function salvarServico(array $data)
    {
        $stsCreate = new \Sts\Models\helpers\StsCreate();
        $stsCreate->exeCreatre("consulta", $data);
        $result = $stsCreate->getResult();

        return $result;
    }



    /**     function userPets($idusuario)
     * Retorna os pets do cliente que está logado
     */
    public function userPets($idusuario): array|null
    { 
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead("SELECT p.idpet , p.nome_pet, p.imagem_pet
                            FROM pet as p
                            INNER JOIN usuario as u 
                            ON u.idusuario = p.usuario 
                            WHERE u.idusuario = :idusuario", "idusuario={$idusuario}" );

        return $stsSelect->getResult();
    }



    /**     function verifySitConsulta($idConsulta)
     * Retorna a sit_consulta de uma determinada consulta definida pelo ID
     */
    public function verifySitConsulta($idConsulta): string
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead("SELECT sit_consulta
                            FROM consulta 
                            WHERE idconsulta= :idconsulta", "idconsulta={$idConsulta}" );

        $data = $stsSelect->getResult();

        return $data[0]['sit_consulta'];
    }



    /**     function alterSitConsulta($id, $data)
     * Muda a sit_consulta da tabela consulta conforme passado na $data
     * $data deve ser um array e se comportar da seguinte forma:
     *      data -> ['sit_consulta'] = "Confirmado" / "Negado" ...
     */
    public function alterSitConsulta(string $id, array $data): bool
    {
        $stsUpdate = new \Sts\Models\helpers\StsUpdate();
        $stsUpdate->exeAlter('consulta', $data, 'idconsulta', $id);

        $resultAlter = $stsUpdate->getResult();

        if(!empty($resultAlter))
            return true;
        else 
            return false;
    }



    /**     function verifyDateConsulta($dateConsulta)
     * Verifica se a data passada pertence a um dia afrente do dia atual (futuro)
     */
    // verifica se ainda restão 24 horas antes do horario marcado (so pode cancelar ate 24 horas de antecedência)
    public function verifyDateConsulta(string $dateConsulta, string $horaConsulta)
    {

        $dayTimeNow = date('d/m/Y H:i');
        $dayNow = substr($dayTimeNow, 0, 10); // 01/01/2023
        $dayNow = substr($dayNow,6) . "-" . substr($dayNow, 3, -5) . "-" . substr($dayNow, 0, -8); // 2023-01-01
        $timeNow = substr($dayTimeNow,10, -3);

        $horaConsulta = substr($horaConsulta,0,-5);

        $dateDayNew = date_create($dateConsulta);
        $dateDayNow = date_create($dayNow);
        $diff=date_diff($dateDayNow, $dateDayNew); //$result = $diff->format("%a"); -> diferença de dias
      
        $diferença = $diff->format("%a"); // retorna a diferença de dias entre uma data e outra
        $negativo = $diff->invert; // retorna 1 se o dia é passado e 0 se for presente o futuro

        if ($diferença != 0 && $negativo == 0){

            if ($diferença == 1 && $horaConsulta > $timeNow) {
                return true;
            } else {
                return false;
            }
            
        } else {
            return false;
        }

    }


    /**     function verifyUserAdress(): bool
     * Verifica se o usuário tem um endereço cadastrado
     */
    public function verifyUserAdress($idusuario): bool
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead("SELECT endereco
                            FROM usuario 
                            WHERE idusuario= :idusuario", "idusuario={$idusuario}" );

        $endereco = $stsSelect->getResult(); 

        if (!empty($endereco[0]['endereco'])) 
            return true;
        else 
            return false;
    }




    /**     function verifyUserPets(): bool
     * Verifica se o usuário tem algum pet cadastrado
     */
    public function verifyUserPets($idusuario): bool
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead("SELECT idpet
                            FROM pet 
                            WHERE usuario = :usuario", "usuario={$idusuario}" );

        $pet = $stsSelect->getResult();

        if (!empty($pet)) 
            return true;
        else 
            return false;
    }



    /**     function verifySitUser($idUser)
     * Retorna a sit_usuario do usuário logado
     */
    public function verifySitUser($idUser): string
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead("SELECT sit_usuario
                            FROM usuario 
                            WHERE idusuario = :idusuario ", "idusuario={$idUser}" );

        $data = $stsSelect->getResult();
        return $data[0]['sit_usuario'];
    }

}