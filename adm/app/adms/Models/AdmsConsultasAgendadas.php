<?php

namespace Adms\Models;

class AdmsConsultasAgendadas{



    /**     function getBasicDataACancelar()
     * Retorna as informações das consultas com sit_consulta = 'A Confirmar' 
     */
    public function getBasicDataAConfirmar(): array|null
    {
        $admsSelect = new \Adms\Models\helpers\AdmsSelect();

        $admsSelect->fullRead("SELECT c.data_consulta, c.horario_consulta, c.descricao, c.sit_consulta, c.tipo_consulta, c.idconsulta,
                            p.nome_pet, p.data_nascimento_pet, p.sexo, p.imagem_carteira_pet,
                            r.tipo_pet, r.raca,
                            t.nome_consulta, t.descricao_consulta, t.tempo_medio,
                            u.nome_usuario, u.email, foto_usuario
                            FROM consulta as c
                            INNER JOIN tipo_consulta as t
                            ON c.tipo_consulta = t.idtipo_consulta
                            INNER JOIN pet as p
                            ON c.pet = p.idpet
                            INNER JOIN raca_pet AS r
                            ON p.idraca = r.idraca_pet
                            INNER JOIN usuario AS u 
                            ON p.usuario = u.idusuario
                            WHERE c.pet != 'NULL' AND c.sit_consulta = 'A Confirmar'
                            ORDER BY c.data_consulta", NULL);

        $data = $admsSelect->getResult();
        return $data;
        
    }



    /**     function getBasicDataACancelar()
     * Retorna as informações das consultas com sit_consulta = 'A Cancelar' 
     */
    public function getBasicDataACancelar(): array|null
    {
        $admsSelect = new \Adms\Models\helpers\AdmsSelect();

        $admsSelect->fullRead("SELECT c.data_consulta, c.horario_consulta, c.descricao, c.sit_consulta, c.tipo_consulta, c.idconsulta,
                            p.nome_pet, p.data_nascimento_pet, p.sexo, p.imagem_carteira_pet,
                            r.tipo_pet, r.raca,
                            t.nome_consulta, t.descricao_consulta, t.tempo_medio,
                            u.nome_usuario, u.email, foto_usuario
                            FROM consulta as c
                            INNER JOIN tipo_consulta as t
                            ON c.tipo_consulta = t.idtipo_consulta
                            INNER JOIN pet as p
                            ON c.pet = p.idpet
                            INNER JOIN raca_pet AS r
                            ON p.idraca = r.idraca_pet
                            INNER JOIN usuario AS u 
                            ON p.usuario = u.idusuario
                            WHERE c.pet != 'NULL' AND c.sit_consulta = 'A Cancelar'
                            ORDER BY c.sit_consulta ASC", NULL);

        $data = $admsSelect->getResult();
        return $data;
        
    }



    /**     function getBasicDataConfirmados()
     * Retorna as informações das consultas com sit_consulta = 'Confirmado' 
     */
    public function getBasicDataConfirmados(): array|null
    {
        $admsSelect = new \Adms\Models\helpers\AdmsSelect();

        $admsSelect->fullRead("SELECT c.data_consulta, c.horario_consulta, c.descricao, c.sit_consulta, c.tipo_consulta, c.idconsulta,
                            p.nome_pet, p.data_nascimento_pet, p.sexo, p.imagem_carteira_pet,
                            r.tipo_pet, r.raca,
                            t.nome_consulta, t.descricao_consulta, t.tempo_medio,
                            u.nome_usuario, u.email, foto_usuario
                            FROM consulta as c
                            INNER JOIN tipo_consulta as t
                            ON c.tipo_consulta = t.idtipo_consulta
                            INNER JOIN pet as p
                            ON c.pet = p.idpet
                            INNER JOIN raca_pet AS r
                            ON p.idraca = r.idraca_pet
                            INNER JOIN usuario AS u 
                            ON p.usuario = u.idusuario
                            WHERE c.pet != 'NULL' AND c.sit_consulta = 'Confirmado'
                            ORDER BY c.sit_consulta", NULL);

        $data = $admsSelect->getResult();
        return $data;
    }



    /**     function getBasicDataACancelar()
     * Retorna as informações das consultas com sit_consulta != 'A Confirmar' != 'A Cancelar' != 'Confirmado'
     */
    public function getBasicDataOutros(): array|null
    {
        $admsSelect = new \Adms\Models\helpers\AdmsSelect();

        $admsSelect->fullRead("SELECT c.data_consulta, c.horario_consulta, c.descricao, c.sit_consulta, c.tipo_consulta, c.idconsulta,
                            p.nome_pet, p.data_nascimento_pet, p.sexo, p.imagem_carteira_pet,
                            r.tipo_pet, r.raca,
                            t.nome_consulta, t.descricao_consulta, t.tempo_medio,
                            u.nome_usuario, u.email, foto_usuario
                            FROM consulta as c
                            INNER JOIN tipo_consulta as t
                            ON c.tipo_consulta = t.idtipo_consulta
                            INNER JOIN pet as p
                            ON c.pet = p.idpet
                            INNER JOIN raca_pet AS r
                            ON p.idraca = r.idraca_pet
                            INNER JOIN usuario AS u 
                            ON p.usuario = u.idusuario
                            WHERE c.pet != 'NULL' AND c.sit_consulta != 'A Confirmar' AND c.sit_consulta != 'A Cancelar' AND c.sit_consulta != 'Confirmado'
                            ORDER BY c.sit_consulta", NULL);

        $data = $admsSelect->getResult();
        return $data;
    }


    /**     function getBasicDataACancelar()
     * Retorna as informações das consultas com sit_consulta != 'A Confirmar' != 'A Cancelar' != 'Confirmado'
     */
    public function getEveryting(): array|null
    {
        $admsSelect = new \Adms\Models\helpers\AdmsSelect();

        $admsSelect->fullRead("SELECT c.data_consulta, c.horario_consulta, c.descricao, c.sit_consulta, c.tipo_consulta, c.idconsulta,
                            p.nome_pet, p.data_nascimento_pet, p.sexo, p.imagem_carteira_pet,
                            r.tipo_pet, r.raca,
                            t.nome_consulta, t.descricao_consulta, t.tempo_medio,
                            u.nome_usuario, u.email, foto_usuario
                            FROM consulta as c
                            INNER JOIN tipo_consulta as t
                            ON c.tipo_consulta = t.idtipo_consulta
                            INNER JOIN pet as p
                            ON c.pet = p.idpet
                            INNER JOIN raca_pet AS r
                            ON p.idraca = r.idraca_pet
                            INNER JOIN usuario AS u 
                            ON p.usuario = u.idusuario
                            WHERE c.pet != 'NULL'
                            ORDER BY c.sit_consulta", NULL);

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



    /**     function verifySitConsulta($idConsulta)
     * Compara a sitConsulta registrada no BD com a que for passsado pela $sitVerify
     */
    public function verifySitConsulta($idConsulta, $sitVerify): bool
    {
        $admsSelect = new \Adms\Models\helpers\AdmsSelect();

        $admsSelect->fullRead("SELECT sit_consulta FROM consulta 
                            WHERE idconsulta = :idconsulta", "idconsulta={$idConsulta}");

        $sit_consulta = $admsSelect->getResult();

        if ($sit_consulta[0]['sit_consulta'] == $sitVerify)
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