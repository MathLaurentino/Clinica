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
                            FROM consulta", NULL);

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



}