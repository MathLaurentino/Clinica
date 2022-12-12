<?php

namespace Sts\Models;

class StsCadastro{

    /** function verifyAcount
     * verifica se os dados CPF, RG ou EMAIL que o cliente tentou
     * registrar já estão cadastradas no banco de dados (conta já criada)
     * retorna false se já existe uma conta criada com esses dados e true se não 
     */
    public function verifyAccount(array $data): bool
    {   
        extract($data);

        $stsSelect = new \Sts\Models\helpers\StsSelect();

        $stsSelect->fullRead("SELECT email FROM usuario 
                            WHERE cpf = :cpf or rg = :rg or email = :email",
                            "cpf={$cpf}&rg={$rg}&email={$email}");

        $resultado =  $stsSelect->getResult();

        if(empty($resultado)){
            return true;
        }else{
            return false;
        }
    }

    
    /**
     * Responsável por criar a conta do Usuário
     */
    public function createAccount(array $data): string|null
    {
        $stsCreate = new \Sts\Models\helpers\StsCreate();
        $stsCreate->exeCreatre("usuario",$data);
        $idCliente = $stsCreate->getResult();
        return $idCliente;
    }


    /**
     * Responsável por cadastrar o endereço do usuário
     */
    public function createAdress(array $data): string|null 
    {
        $stsCreate = new \Sts\Models\helpers\StsCreate();
        $stsCreate->exeCreatre("endereco",$data);
        $idEndereco = $stsCreate->getResult();
        if(!empty($idEndereco)){
            $data = ['endereco' => $idEndereco];
            if($this->addAdress($data)) {
                return $idEndereco;
            }else {
                return null;
            }
        } else {
            return null;
        }
        
    }



    /**     function verifyRepeatedKey($key)
     * Verifica se existe alguma consta com a mesma chave de ativação passada
     * Retorna TRUE se não tiver e FALSE se tiver
     */
    public function verifyRepeatedKey($key): bool
    {
        $stsSelect = new \Sts\Models\helpers\StsSelect();
        $stsSelect->fullRead("SELECT id FROM usuario 
                            WHERE chave = :chave",
                            "chave={$key}");

        $resultado =  $stsSelect->getResult();

        if(empty($resultado))
            return true;
        else
            return false;    
    }


    private function addAdress(array $data): bool
    {
        $stsUpdate = new \Sts\Models\helpers\StsUpdate();
        $stsUpdate->exeAlter('usuario', $data, 'idusuario', $_SESSION['idusuario']);
        $resultAlter = $stsUpdate->getResult();
        if(!empty($resultAlter)){
            return true;
        } else {
            return false;
        }
    }


}

?>