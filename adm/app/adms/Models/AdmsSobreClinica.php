<?php

namespace Adms\Models;

class AdmsSobreClinica{


    /**     function getDataServicosAtivo()
     * Retorna todas as informações de um tipo_consulta específico
     */
    public function getDataServicos($sit_tipo_consulta): array|null
    {   
        $AdmsSelect = new \Adms\Models\helpers\AdmsSelect();
        $AdmsSelect->fullRead("SELECT * 
                                FROM tipo_consulta
                                WHERE sit_tipo_consulta = :sit_tipo_consulta", "sit_tipo_consulta={$sit_tipo_consulta}");

        $userDate = $AdmsSelect->getResult();
        if(!empty($userDate)){
            return $userDate;//retorna um array
        }else{
            return null;
        }
    }



    /**     function createServico()
     *  Insere um novo tipo_consulta no banco de dados
     */
    public function createServico(array $data): string|null
    {
        $admsCreate = new \Adms\Models\helpers\AdmsCreate();
        $admsCreate->exeCreate("tipo_consulta", $data);

        $idServico = $admsCreate->getResult();

        if(!empty($idServico)){
            return $idServico;
        }else{
            return null;
        }
    }



    /**     function deleteAll()
     * Deleta qualquer informação do BD
     */
    public function deleteAll(string $table, string $where, string $id): string|null
    {
        $admsDelete = new \Adms\Models\helpers\AdmsDelete();
        $admsDelete->delete($table, $where, $id);
        return $admsDelete->getResult();
    }


    /**     function updateServico()
     * Modifica determinadas informações da tabela tipo_consulta
     */
    public function updateServico(array $data): string|null
    {   
        $idServico = $data['idtipo_consulta'];
        unset($data['idtipo_consulta']);

        $admsUpdate = new \Adms\Models\helpers\AdmsUpdate();
        $admsUpdate->exeAlter('tipo_consulta', $data, 'idtipo_consulta', $idServico);
        
        return $admsUpdate->getResult();
    }



    /**     function getSitTipoConsulta()
     *  Retorna a sit_tipo_consulta (Ativo ou Inativo) de um tipo_consulta
     */
    public function getSitTipoConsulta($idServico): array
    {
        $admsSelect = new \Adms\Models\helpers\AdmsSelect();
        $admsSelect->fullRead("SELECT sit_tipo_consulta
                                FROM tipo_consulta
                                WHERE idtipo_consulta = :idtipo_consulta", 
                                "idtipo_consulta={$idServico}");

        $sit = $admsSelect->getResult();
        return $sit;
    }



    /**     function changeTipoConsultaAttributes(string $id, array $data)
     * Muda qualquer atributo específico do tipo_consulta. 
     * Exemplos:
     *      $data['sit_tipo_consulta'] = "Inativo" OR "Ativo";
     */
    public function changeTipoConsultaAttributes(string $id, array $data): bool
    {
        $admsUpdate = new \Adms\Models\helpers\AdmsUpdate();
        $admsUpdate->exeAlter('tipo_consulta', $data, 'idtipo_consulta', $id);
        $result = $admsUpdate->getResult();

        if (!empty($result)) 
            return true;
        else 
            return false;
    }


    
    /**     function verifyTipoConsulta
     * Verifica se o id de determinado tipo_consulta realmente existe
     */
    public function verifyTipoConsulta($idtipo_consulta): bool
    {
        $admsSelect = new \Adms\Models\helpers\AdmsSelect();
        $admsSelect->fullRead("SELECT nome_consulta
                                FROM tipo_consulta
                                WHERE idtipo_consulta = :idtipo_consulta", 
                                "idtipo_consulta={$idtipo_consulta}");

        $result = $admsSelect->getResult();
        if (!empty($result)) 
            return true;
        else 
            return false;
    }



    /**     function foreignkeyTipoConsulta
     * Verifica se determinado tipo_consulta NÃO tem algum relacionamento de chave estrangeira no BD
     *      retorna true se NÃO tiver e false se tiver
     */
    public function foreignkeyTipoConsulta($idtipo_consulta): bool
    {
        $admsSelect = new \Adms\Models\helpers\AdmsSelect();
        $admsSelect->fullRead("SELECT c.idconsulta
                                FROM consulta AS c
                                INNER JOIN tipo_consulta AS t
                                ON c.tipo_consulta  = t.idtipo_consulta
                                WHERE idtipo_consulta = :idtipo_consulta", 
                                "idtipo_consulta={$idtipo_consulta}");

        $result = $admsSelect->getResult();
        if ($result)
            return false;
        else 
            return true;
    }
    

}

?>