<?php

namespace Adms\Models\helpers;

use PDOException;
use PDO;

class AdmsDelete extends AdmsConn
{
    //parámetros exigidos pela function delete()
    private string $table;
    private string $where;
    private string $id;

    //para manipular a query delete 
    private object $conn; // OBJ PDO
    private string $query; // Query sem preparo
    private object $delete; //Query preparada (OBJ PDO)

    //armazena a quantidade de linhas afetadas pelo delete
    private string|null $result = null;



    /**     function getResult()
     *Function chamada pela model para pegar o resultado do delete
     */
    public function getResult(): string|null
    {
        return $this->result;
    }



    /**     function delete()
     * Function chamada pelas models
     * Serve para apagar informações no BD
     *      - $table: em qual tabela vai ser deletada as informações
     *      - $where: qual o campo da tabela que servira de where na query
     *      - $id: o valor do where
     */
    public function delete(String $table, String $where, String $id): void
    {
        $this->table = $table;
        $this->where = $where;
        $this->id = $id;

        $this->exeReplaceValues();
    }



    /**     function exeReplaceValues()
     * Cria uma string armazenando a query 
     * A query ainda não está preparada
     */
    private function exeReplaceValues(): void
    {
        $w = $this->where . " = " . $this->id;
        $this->query =  "DELETE FROM {$this->table} WHERE {$w}";

        $this->exeInstruction();
    }



    /**     function exeInstruction()
     * Primeiro chama a function connection() para criar um OBJ PDO
     * Logo após executa a query e pede a quantidade de linhas 
     *      afetadas pelo delelte rowCount(), atribuindo o resultado
     *      a $this->result
     */
    private function exeInstruction(): void 
    {   
        $this->connection();
        try{
            $this->delete->execute();
            //Resultado recebe o id do último  registro inserido
            $this->result = $this->delete->rowCount();
        }catch(PDOException $err){
            $this->result = null;
        }
    }



    /**     function connection()
     * Cria o OBJ PDO e prepara a query($this->insert)
     */
    private function connection(): void 
    {
        $this->conn = $this->connectDb();
        $this->delete = $this->conn->prepare($this->query);
    }
}

?>