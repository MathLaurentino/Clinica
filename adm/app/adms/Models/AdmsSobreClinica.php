<?php

namespace Adms\Models;

class AdmsSobreClinica{


    /**     function dadosClinica()
     * Undocumented function
     *
     * @return void
     */
    public function dadosClinica(): array|null
    {   
        $AdmsSelect = new \Adms\Models\helpers\AdmsSelect();
        $AdmsSelect->fullRead("SELECT * 
                                FROM tipo_consulta", null);

        $userDate = $AdmsSelect->getResult();
        if(!empty($userDate)){
            return $userDate;//retorna um array
        }else{
            return null;
        }
    }



    /**     function createServico()
     * 
     *
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
     * Undocumented function
     *
     * @return void
     */
    public function deleteAll(string $table, string $where, string $id): string|null
    {
        $admsDelete = new \Adms\Models\helpers\AdmsDelete();
        $admsDelete->delete($table, $where, $id);
        return $admsDelete->getResult();
    }



    public function updateServico(array $data): string|null
    {   
        $idServico = $data['idtipo_consulta'];
        unset($data['idtipo_consulta']);

        $admsUpdate = new \Adms\Models\helpers\AdmsUpdate();
        $admsUpdate->exeAlter('tipo_consulta', $data, 'idtipo_consulta', $idServico);
        
        return $admsUpdate->getResult();
    }
    

}

?>