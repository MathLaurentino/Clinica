<?php

namespace Adms\Models;

class AdmsFotoServico{


    /**     verifyIdServico($id)
     * Verifica se o id do servico passado existe no banco de dados
     */
    public function verifyIdServico($id)
    {
        $AdmsSelect = new \Adms\Models\helpers\AdmsSelect();
        $AdmsSelect->fullRead("SELECT nome_consulta 
                                FROM tipo_consulta
                                WHERE idtipo_consulta  = :idtipo_consulta", 
                                "idtipo_consulta={$id}");

        $result = $AdmsSelect->getResult();
        if (!empty($result))
            return true;
        else 
            return false; 
    }



    /**     function cadastroFoto($nameInDB)
     * Cadastra a imagem do servico no banco de dados
     */
    public function cadastroFoto(array $nameInDB, $id): bool
    {
        $admsUpdate = new \Adms\Models\helpers\AdmsUpdate();
        $admsUpdate->exeAlter('tipo_consulta', $nameInDB, 'idtipo_consulta', $id);
        $resultAlter = $admsUpdate->getResult();
        if(!empty($resultAlter)){
            return true;
        } else {
            return false;
        }
    }

}


?>