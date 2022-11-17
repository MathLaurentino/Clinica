<?php

namespace Sts\Models\helpers;

use PDO;
use PDOException;

abstract class StsConn
{
    private string $host = HOST;
    private string $user = USER;
    private string $pass = PASS;
    private string $dbname = DBNAME;
    private object $connect;

    public function connectDb(): object
    {
        try{
            //conexao com o banco de dados / retorna um objeto PDO
            $this->connect = new PDO("mysql:host={$this->host};dbname=" . $this->dbname, $this->user, $this->pass);

            return $this->connect;
        }catch(PDOException $e){
            die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM);
        }
    }
}