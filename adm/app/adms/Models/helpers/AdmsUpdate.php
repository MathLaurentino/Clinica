<?php

namespace Adms\Models\helpers;

use PDOException;
use PDO;

class AdmsUpdate extends AdmsConn
{
    //Variáveis para receber a tabela e os dados a serem alterados
    private string $table;
    private array $data;
    //Variáveis para receber as condições do update
    private string|null $where;
    private string|null $parseString;
    //recebe a quantidade de linhas afetadas
    private string|null $result = null;
    //variáveis para fazer a query update
    private object $alter;
    private string $query;
    private object $conn;


    /**     function getResult()
     * Metodo chamado pela Models para pegar o resultado
     *      (último id inserido)
     */
    public function getResult(): string|null
    {
        return $this->result;
    }


    /**     function exeAlter()
     * Método chamado pelas Models
     * Pega a tabela e os dados enviado pela model e insere dentro de variaveis da classe
     *      - $table: tabela em que se vai fazer alter
     *      - $data: chaves da tabela junto com dados a serem mudados
     *      - $where: chave da tabela em que se vai fazer a condição where
     *      - $parseString: valor do where
     */
    public function exeAlter(string $table, array $data, string|null $where, string|null $parseString): void
    {
        $this->table = $table;
        $this->data = $data;
        $this->where = $where;
        $this->parseString = $parseString;
        $this->exeReplaceValues();
    }


    /**     function exeReplaceValues()
     * Método chamado por exeAlter
     * Pega as chaves do array date e transforma em uma string
     *      com os termos que serão alterados
     * 
     * Ex: nome_usuario = :nome_usuario, data_nascimento = :data_nascimento
     */
    private function exeReplaceValues(): void
    {

        $dataString = array_keys($this->data);
        $updateValues = '';

        foreach($dataString as $key)
        {
            $updateValues = $updateValues . $key . " = :" . $key . ", ";
        }

        $updateValues = rtrim($updateValues, ", ");

        //-------------------------------------------------------------------------------
        
        $this->w = $this->where . " = :" . $this->where;

        $this->query = "UPDATE {$this->table} SET {$updateValues} WHERE {$this->w}";      

        if(!empty($this->parseString)){
            $this->addParseString();
        }
        //var_dump($this->data);

        //echo $this->query;

        $this->exeInstruction();
    }

    


    /**     function exeInstruction()
     * Chama o metodo conectar e executa o query($this->alter)
     */
    private function exeInstruction(): void 
    {   
        $this->connection();
        try
        {
            $this->alter->execute($this->data);
            //Resultado quantas linhas foram afetadas
            $this->result = $this->alter->rowCount(); // string 
        }
        catch(PDOException $err)
        {
            $this->result = null;
        }
    }



    /**     function connection()
     * Cria o OBJ PDO e prepara a query($this->alter)
     */
    private function connection(): void 
    {
        $this->conn = $this->connectDb();
        $this->alter = $this->conn->prepare($this->query);
    }


    /**     function addParseString()
     * Adiciona no final do array data o valor da condição where
     *      da query UPDATE
     */
    private function addParseString(): void 
    {
        $this->data[$this->where] = $this->parseString;
    }
}
?>