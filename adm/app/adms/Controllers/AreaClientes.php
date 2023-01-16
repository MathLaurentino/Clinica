<?php

namespace App\Adms\Controllers;

if (!defined('D7E4T2K6F4')) {
    $header = "http://localhost/Clinica/Erro?case=404"; // Erro 404
    header("Location: {$header}");
}

include_once 'app/Adms/controllers/helpers/protect.php';

class AreaClientes
{

    private array $data;
    private array|null $dataForm;


    /**     function index()
     * Método padrão das classes controllers
     */
    public function index(): void
    {        
        $this->dados();
    }


    public function dados(): void
    {
        $modelSobreCliente = new \Adms\Models\AdmsSobreClientes();
        $this->data['mantenedores'] = $modelSobreCliente->getManagerUsers();
        $this->data['clientes'] = $modelSobreCliente->getClientUsers();

        $loadView = new \Core\LoadView("adms/Views/sobreClientes", $this->data, null); //areaCliente
        $loadView->loadViewAdm();
    }


    public function alterarTipoUsuario(): void
    {
        if (isset($_GET['idUser']) && isset($_GET['tipo'])) {

            $idUser = $_GET['idUser'];
            $tipo = $_GET['tipo'];

            if ($tipo == "mantenedor") 
                $converter = "cliente";

            elseif($tipo == "cliente")
                $converter = "mantenedor";

            $modelSobreCliente = new \Adms\Models\AdmsSobreClientes();

            if ($modelSobreCliente->verifyIfUserExist($idUser)) {

                if ($tipo == $modelSobreCliente->verifyTypeUser($idUser)) {
                    $tipo_usuario['tipo_usuario'] = $converter;
                    $result = $modelSobreCliente->changeTypeUser($idUser, $tipo_usuario);

                    if ($result) { $_SESSION['msg'] = "Tipo usuario convertido com sucesso"; }
                    
                    else { $_SESSION['msg'] = "Falha ao converte tipo usuario"; } 

                } else {
                    $_SESSION['msg'] = "Erro, dados inválidos";  
                }

            } else {
                $_SESSION['msg'] = "Erro, usuário não existe";  
            }
        } else {
            $_SESSION['msg'] = "Erro, falta de informações";
        }

        $header = URLADM . "AreaClientes/dados"; 
        header("Location: {$header}");
    }

    
    /**
     * Método chamado pelo método index da classe
     * Carrega a view
     */
    private function view(): void
    {
        $loadView = new \Core\LoadView("adms/Views/sobreClientes", $this->data, null); //areaCliente
        $loadView->loadViewAdm();
    }


    // Redireciona o usuario para a mesma página
    private function header() 
    {
        $header = URLADM . "Sobre-Clientes"; 
        header("Location: {$header}");
    }

    }
    ?>