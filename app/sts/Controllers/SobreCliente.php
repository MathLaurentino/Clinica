<?php

namespace Sts\Controllers;

if (!defined('D7E4T2K6F4')) {
    $header = "http://localhost/Clinica/Erro?case=404"; // Erro 404
    header("Location: {$header}");
}

include_once 'app/sts/Controllers/helpers/protect.php';

class SobreCliente{

private array|null $data; // dados que vem do banco de dados
private array|null $dataForm; // dados que vem do formulario



    /**     function index()
     * Chama a function padão da classe
     */
    public function index()
    {
        $this->dados();
    }



    /**     function dados()
     * Pega os dados do cliente no banco de dados por meio
     *      da function da classe $this->getData e depois  
     *      carrega a tela sobreCliente
     */
    public function dados(): void
    {
        $stsSobreCliente = new \Sts\Models\StsSobreCliente();

        $this->data['user'] = $stsSobreCliente->userData();
        
        if (isset($_SESSION['idendereco'])) 
            $this->data['adress'] = $stsSobreCliente->userAdress(); 

        
        if ($this->verifyIfUserHasAPet()) 
            $this->data['pet'] = $stsSobreCliente->userPet();

        $loadView = new \Core\LoadView("sts/Views/bodys/areaCliente/sobreCliente", $this->data, null);
        $loadView->loadView_header('sobre_cliente');
    }


    private function verifyIfUserHasAPet(): bool
    {
        $stsSobreCliente = new \Sts\Models\StsSobreCliente();
        return $stsSobreCliente->verifyIfPetExist();
    }



    /**
     * Undocumented function
     */
    public function alterarDados()
    {
        //informações vinda dos formulares da view sobreCliente.php
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        if (!empty($this->dataForm['AlterUser'])) {

            unset($this->dataForm['AlterUser']);

            $stsverify = new \Sts\Models\helpers\StsVerifyRegistrationData();
            //echo "<pre>" ;var_dump($this->dataForm['cpf']);
            
            if ($stsverify->verifyCpf($this->dataForm['cpf']) && $stsverify->verifyAge($this->dataForm['data_nascimento'])) {
                
                $stsSobreCliente = new \Sts\Models\StsSobreCliente();

                // Se não existir um CPF igual no banco de dados
                if ($stsSobreCliente->verifyRepeatedCpf($this->dataForm['cpf']) || $stsSobreCliente->verifySameCpf($_SESSION['idusuario'], $this->dataForm['cpf'])) { 

                    $result = $stsSobreCliente->alterUser($this->dataForm);

                    if(!empty($result)) // Se os dados foram alterados com sucesso
                    {
                        $_SESSION['msg'] = "Dados do usuario alterados com sucesso";
                        $header = URL . "Sobre-Cliente/Dados"; 
                        header("Location: {$header}");
                    } else {
                        $header = URL . "Erro?case=4"; // Erro 004
                        header("Location: {$header}");
                    }

                } else {
                    $_SESSION['msg'] = "CPF informado já possui cadastro no banco de dados";
                    $this->data = $this->dataForm;
                    $this->view2('alterarDados');
                } 

            } else {
                $this->data = $this->dataForm;
                $this->view2('alterarDados');
            }
            
        } else {
            $this->getData('usuario');
            $this->view2('alterarDados');
        }
    }



    /**
     * Undocumented function
     *
     * @return void
     */
    public function alterarDadosEndereco()
    {
        if (isset($_SESSION['idendereco'])) {

            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if (!empty(($this->dataForm['AlterAdress']))) {   

                unset($this->dataForm['AlterAdress']);

                $stsSobreCliente = new \Sts\Models\StsSobreCliente();
                $result = $stsSobreCliente->alterAdress($this->dataForm);

                if (!empty($result)) {
                    $_SESSION['msg'] = "Dados de endereço alterados com sucesso";
                    $header = URL . "Sobre-Cliente/Dados"; 
                    header("Location: {$header}");
                } else {
                    $header = URL . "Erro?case=5"; // Erro 005
                    header("Location: {$header}");
                }

            } else {
                $this->getData('endereco');
                $this->view2('alterarEndereco2');
            }

        } else { 
            $header = URL . "Erro?case=10"; // Erro 010
            header("Location: {$header}");
        }
    }



    /**
     * Undocumented function
     *
     * @return void
     */
    public function alterarDadosPet() 
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            
        
        if (!empty($this->dataForm['AlterPet'])) {

            unset($this->dataForm['AlterPet']);
            //var_dump($this->dataForm);
            
            $stsSobreCliente = new \Sts\Models\StsSobreCliente();
            $resultPet = $stsSobreCliente->alterPet($this->dataForm);

            if(!empty($resultPet))
            {
                $_SESSION['msg'] = "Dados do pet alterados com sucesso";
                $header = URL . "Sobre-Cliente/Dados"; 
                header("Location: {$header}");
            }else{
                $header = URL . "Erro?case=6"; // Erro 006
                header("Location: {$header}");
            }
            

        } 
        
        elseif (!empty($this->dataForm['DeleteU'])) {
            $this->apagarDadosPet();
        }
            
        else {
            if (isset($_GET['id'])) {

                $idpet = $_GET['id'];
                $stsSobreCliente = new \Sts\Models\StsSobreCliente();
                $this->data['pet'] = $stsSobreCliente->userPetById($idpet);

                if (!empty($this->data['pet'])){
                    $this->data['tipo_pet'] = $stsSobreCliente->getRaca($this->data['pet'][0]['tipo_pet']);
                    $this->view('alterarPet');
                } else {
                    $header = URL . "Erro?case=0"; // Erro 000
                    header("Location: {$header}");
                }

            } else {
                $header = URL . "Erro?case=0"; // Erro 000
                header("Location: {$header}");
            }
        }
    }



    /**     function apagarDadosPet()
     * Apaga o pet selecionado pelo cliente
     * Verifica se o pet pertence ao cliente antes de apagar
     */
    public function apagarDadosPet()
    {
        if (isset($_GET['idpet'])) {

            $idpet = $_GET['idpet'];

            $stsSobreCliente = new \Sts\Models\StsSobreCliente();

            if ($stsSobreCliente->verifyIdPetIsFromUser($idpet)){

                $resultD =  $stsSobreCliente-> deleteAll("pet","idpet",$idpet);

                if (!empty($resultD)){
                    $_SESSION['msg'] = "Dados do pet apagados com sucesso";
                    $header = URL . "Sobre-Cliente/Dados"; 
                    header("Location: {$header}");
                } else {
                    $_SESSION['msg'] = "Falha ao apagar dados";
                    $header = URL . "Sobre-Cliente/Dados"; 
                    header("Location: {$header}");
                }

            } else {
                $header = URL . "Erro?case=20"; // Erro 020
                header("Location: {$header}");
            }
            
        } else {
            $header = URL . "SobreCliente/Dados";
            header("Location: {$header}");
        }
    }



    /**
     * Método chamado pelo método index da classe
     * Busca os dados no BD 
     */
    private function getData($table): void
    {
        $stsSobreCliente = new \Sts\Models\StsSobreCliente();

        if ($table == "usuario")
            $this->data = $stsSobreCliente->userData();
        elseif ($table == "endereco")
            $this->data = $stsSobreCliente->userAdress();
        elseif ($table == "pet") {
            $this->data['pet'] = $stsSobreCliente->userPet();
            $this->data['tipo_pet'] = $stsSobreCliente->getRaca();
        }
    }


    
    /**
     * Undocumented function
     *
     */
    private function view(string $view): void
    {
        $loadView = new \Core\LoadView("sts/Views/bodys/areaCliente/" . $view, $this->data, null);
        $loadView->loadView_header2();
    }

    private function view2(string $view): void
    {
        $loadView = new \Core\LoadView("sts/Views/bodys/areaCliente/" . $view, $this->data, null);
        $loadView->loadView_header3("alterarDados");
    }


    
    /**     function pages()
     * Retorna os métodos publicos da classe
     */
    public function pages(): array
    {  
        return $array = ['index', 'dados', 'alterarDados'];
    }

}