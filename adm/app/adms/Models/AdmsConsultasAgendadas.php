<?php

namespace Adms\Models;

class AdmsConsultasAgendadas{

    public function getBasicDataAConfirmar()
    {
        $admsSelect = new \Adms\Models\helpers\AdmsSelect();

        $admsSelect->fullRead("SELECT c.idconsulta, c.data_consulta, c.horario_consulta, c.sit_consulta, c.tipo_consulta,
                            t.nome_consulta,
                            u.nome_usuario, u.foto_usuario
                            FROM consulta as c
                            INNER JOIN tipo_consulta as t
                            ON c.tipo_consulta = t.idtipo_consulta
                            INNER JOIN pet as p
                            ON c.pet = p.idpet
                            INNER JOIN usuario AS u 
                            ON p.usuario = u.idusuario
                            WHERE c.pet != 'NULL' AND c.sit_consulta = 'A Confirmar' OR c.sit_consulta = 'A Cancelar'", NULL);

        $data = $admsSelect->getResult();
        return $data;
        
    }


    public function getBasicDataOutros()
    {
        $admsSelect = new \Adms\Models\helpers\AdmsSelect();

        $admsSelect->fullRead("SELECT c.idconsulta, c.data_consulta, c.horario_consulta, c.sit_consulta, c.tipo_consulta,
                            t.nome_consulta,
                            u.nome_usuario, u.foto_usuario
                            FROM consulta as c
                            INNER JOIN tipo_consulta as t
                            ON c.tipo_consulta = t.idtipo_consulta
                            INNER JOIN pet as p
                            ON c.pet = p.idpet
                            INNER JOIN usuario AS u 
                            ON p.usuario = u.idusuario
                            WHERE c.pet != 'NULL' AND c.sit_consulta != 'A Confirmar'
                            ORDER BY c.sit_consulta", NULL);

        $data = $admsSelect->getResult();
        return $data;
    }

    public function getFullDataConsulta($idConsulta)
    {
        $admsSelect = new \Adms\Models\helpers\AdmsSelect();

        $admsSelect->fullRead("SELECT c.data_consulta, c.horario_consulta, c.descricao, c.sit_consulta, c.tipo_consulta,
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

        $data = $admsSelect->getResult();
        return $data;
    }


    /**     function verifyIfConsultaExist($idConsulta)
     * Verifica se o id da consulta passada realmente existe
     */
    public function verifyIfConsultaExist($idConsulta): bool
    {
        $admsSelect = new \Adms\Models\helpers\AdmsSelect();

        $admsSelect->fullRead("SELECT data_consulta FROM consulta 
                            WHERE idconsulta = :idconsulta", "idconsulta={$idConsulta}");

        $data = $admsSelect->getResult();

        if (!empty($data))
            return true;
        else
            return false;
    }


    /**     function alterSit_Consulta($id, $data)
     * Muda a sit_consulta da tabela consulta conforme passado na $data
     * $data deve ser um array e se comportar da seguinte forma:
     *      data -> ['sit_consulta'] = "Confirmado" / "Negado" ...
     *
     */
    public function alterSit_Consulta(string $id, array $data): bool
    {
        $admsUpdate = new \Adms\Models\helpers\AdmsUpdate();
        $admsUpdate->exeAlter('consulta', $data, 'idconsulta', $id);

        $resultAlter = $admsUpdate->getResult();

        if(!empty($resultAlter))
            return true;
        else 
            return false;
    }

}

?>