<?php

namespace Sts\Models;

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
                            OR sit_consulta = 'Confirmado'", NULL);

        $resultado =  $stsSelect->getResult();

        return $resultado;
    }



    public function idServicoExiste($id)
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();

        $stsSelect->fullRead("SELECT nome_consulta, valor_consulta, tempo_medio
                            FROM tipo_consulta
                            WHERE idtipo_consulta = :idtipo_consulta", "idtipo_consulta={$id}");

        $resultado =  $stsSelect->getResult();

        if (!empty($resultado))
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

}