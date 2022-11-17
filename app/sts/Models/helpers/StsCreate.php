<?php

namespace Sts\Models\helpers;

use PDOException;
use PDO;

class StsCreate extends StsConn
{

    private string $table;
    private array $data;
    private string|null $result = null;
    private object $insert;
    private string $query;
    private object $conn;


    /**
     * Metodo chamado pela Models para pegar o resultado
     */
    public function getResult(): string|null 
    {
        return $this->result;
    }



    /**
     * Método chamado pelas Models
     * Pega a tabela e os dados enviado pela model e insere dentro de 
     *      variaveis da classe
     * Depois chama o método exeReplaceValues
     */
    public function exeCreatre(string $table, array $data): void
    {
        $this->table = $table;
        $this->data = $data;
        $this->exeReplaceValues();
    }



    /**
     * criar os elementos do insert a partir dos dados mandados pela model
     * Ex: 
     *      -(cep, rua, numero_residencial, cidade, estado)
     *      -(:cep, :rua, :numero_residencial, :cidade, :estado)
     */
    private function exeReplaceValues(): void
    {
        // string que vai referenciar as posições da tabela (ex: cep, cidade, estado)
        $coluns = implode(', ' , array_keys($this->data)); //var_dump($coluns)."<br>";

        // string que vai referenciar as chaves dos valores (ex: :cep, :cidade, :estado)
        $values = ':' . implode(', :' , array_keys($this->data)); //var_dump($values)."<br>";

        $this->query = "INSERT INTO {$this->table} ({$coluns}) VALUES ({$values})";
        //var_dump($this->query); echo "<br>";

        $this->exeInstruction();
    }



    /**
     * Chama o metodo conectar e executa o query($this->insert)
     */
    private function exeInstruction(): void 
    {   
        $this->connection();
        try{
            $this->insert->execute($this->data);
            //Resultado recebe o id do último  registro inserido
            $this->result = $this->conn->lastInsertId(); 
        }catch(PDOException $err){
            $this->result = null;
        }
    }



    /**
     * Cria o OBJ PDO e prepara a query($this->insert)
     */
    private function connection(): void 
    {
        $this->conn = $this->connectDb();
        $this->insert = $this->conn->prepare($this->query);
    }
}