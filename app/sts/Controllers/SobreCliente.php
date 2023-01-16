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
        $stsVerifyDate = new \Sts\Models\helpers\StsVerifyDateConsulta(); 

        $this->data['user'] = $stsSobreCliente->userData();
        
        if (isset($_SESSION['idendereco'])) {
            $this->data['adress'] = $stsSobreCliente->userAdress(); 
        }

        if ($this->verifyIfUserHasAPet()) {
            $this->data['pet'] = $stsSobreCliente->userPet();
        }
        
        $this->data['agendamentos'] = $stsSobreCliente->getBasicDataConsultas();
        $stsVerifyDate->verifyDayTimeConsulta($this->data['agendamentos']);
        $this->data['agendamentos'] = $stsSobreCliente->getBasicDataConsultas();
        //unset($this->data['agendamentos']);

        $this->data['conusultaEmAndamento'] = $stsSobreCliente->getDataConsultaEmAndamento();
        $this->data['consultasFinalizadas'] = $stsSobreCliente->getDataConsultasFinalizadas();
            
        $loadView = new \Core\LoadView("sts/Views/bodys/areaCliente/areaCliente2", $this->data, null); // sobreCliente // areaCliente2
        $loadView->loadView_header('areaCliente/areaCliente'); //sobre_cliente // areaCliente2H
    }


    private function verifyIfUserHasAPet(): bool
    {
        $stsSobreCliente = new \Sts\Models\StsSobreCliente();
        return $stsSobreCliente->verifyIfPetExist();
    }



    /**
     * Undocumented function
     */
    public function alterarDados(): void
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
                        $_SESSION['msgGreen'] = "Dados do usuario alterados com sucesso";
                        $header = URL . "Sobre-Cliente/Dados"; 
                        header("Location: {$header}");
                    } else {
                        $header = URL . "Erro?case=4"; // Erro 004
                        header("Location: {$header}");
                    }

                } else {
                    $_SESSION['msgRed'] = "CPF informado já possui cadastro no sistema";
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
    public function alterarDadosEndereco(): void
    {
        if (isset($_SESSION['idendereco'])) {

            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if (!empty(($this->dataForm['AlterAdress']))) {   

                unset($this->dataForm['AlterAdress']);

                $stsSobreCliente = new \Sts\Models\StsSobreCliente();
                $result = $stsSobreCliente->alterAdress($this->dataForm);

                if (!empty($result)) {
                    $_SESSION['msgGreen'] = "Dados de endereço alterados com sucesso";
                    $header = URL . "Sobre-Cliente/Dados"; 
                    header("Location: {$header}");
                } else {
                    $header = URL . "Erro?case=5"; // Erro 005
                    header("Location: {$header}");
                }

            } else {
                $this->getData('endereco');
                $this->view2('alterarEndereco');
            }

        } else { 
            $header = URL . "Erro?case=10"; // Erro 010
            header("Location: {$header}");
        }
    }



    /**     function alterarDadosPet()
     * Responsavel por carregar a tela de alterar dados pet e receber 
     *      os dados do formulário para fazer a alteração no BD
     */
    public function alterarDadosPet(): void 
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        /** Os dados dos formulário de alterar dados pet NÃO foi enviado, carrega a tela 'alterarPet'
         *  Verifica se o id pet passado realmente existe e se pertence ao cliente logado */
        if (empty($this->dataForm['AlterPet'])) {

            if (isset($_GET['id'])) {

                $idpet = $_GET['id'];
                $stsSobreCliente = new \Sts\Models\StsSobreCliente();
                $this->data['pet'] = $stsSobreCliente->userPetById($idpet);

                if (!empty($this->data['pet'])) {
                    $this->data['tipo_pet'] = $stsSobreCliente->getRaca($this->data['pet'][0]['tipo_pet']);
                    $this->view2('alterarPet2');
                } else {
                    $_SESSION['msgRed'] = "Erro, dados incorretos";
                    $header = URL . "Sobre-Cliente/Dados"; 
                    header("Location: {$header}");
                }

            } else {
                $_SESSION['msgRed'] = "Erro, falta de dados";
                $header = URL . "Sobre-Cliente/Dados"; 
                header("Location: {$header}");
            }

        } 

        /** Se os dados dos formulário de alterar dados pet FOI enviado
         *  Faz a alterção no banco de dados */
        else {
            unset($this->dataForm['AlterPet']);
            
            $stsSobreCliente = new \Sts\Models\StsSobreCliente();
            $resultPet = $stsSobreCliente->alterPet($this->dataForm);

            if (!empty($resultPet)) {
                $_SESSION['msgGreen'] = "Dados do pet alterados com sucesso";
            } else {
                $_SESSION['msgRed'] = "Falha ao alterar dados do pet, tente novamente mais tarde";
            }

            $header = URL . "Sobre-Cliente/Dados"; 
            header("Location: {$header}");
        }

    }



    /**     function apagarDadosPet()
     * Apaga o pet selecionado pelo cliente
     * Verifica se o pet pertence ao cliente antes de apagar
     */
    public function apagarDadosPet(): void
    {
        if (isset($_GET['idpet'])) {

            $idpet = $_GET['idpet'];

            $stsSobreCliente = new \Sts\Models\StsSobreCliente();

            if ($stsSobreCliente->verifyIdPetIsFromUser($idpet)){

                $resultD =  $stsSobreCliente-> deleteAll("pet","idpet",$idpet);

                if (!empty($resultD)){
                    $_SESSION['msgGreen'] = "Dados do pet apagados com sucesso";
                    $header = URL . "Sobre-Cliente/Dados"; 
                    header("Location: {$header}");
                } else {
                    $_SESSION['msgRed'] = "Falha ao apagar dados";
                    $header = URL . "Sobre-Cliente/Dados"; 
                    header("Location: {$header}");
                }

            } else {
                $header = URL . "Erro?case=20"; // Erro 020
                header("Location: {$header}");
            }
            
        } else {
            $_SESSION['msgRed'] = "Erro, falta de dados";
            $header = URL . "SobreCliente/Dados";
            header("Location: {$header}");
        }
    }


    /**     function maisInfoConsulta()
     * Carrega a tela sobre mais informações de determinada consulta pelo ID
     * 
     */
    public function maisInfoConsulta(): void
    {
        if (isset($_GET['idConsulta'])) {

            $idConsulta = $_GET['idConsulta'];

            $stsCliente = new \Sts\Models\StsSobreCliente();
            if ($stsCliente->verifyIdConsultaIsFromUser($idConsulta)) {

                $this->data = $stsCliente->getFullDataConsulta($idConsulta);
                $this->view2('maisInfo');

            } else {
                $_SESSION['msgRed'] = "Erro, dados incongruentes";
                $header = URL . "SobreCliente/Dados";
                header("Location: {$header}");
            }
        }  
    
        else {
            $_SESSION['msgRed'] = "Erro, falta de dados";
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
        return $array = ['index', 'dados', 'alterarDados', 'alterarDadosPet', 'alterarDadosEndereco', 'apagarDadosPet', 'maisInfoConsulta'];
    }

}