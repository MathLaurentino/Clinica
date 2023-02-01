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

        $loadView = new \Core\LoadView("adms/Views/bodys/areaCliente/areaCliente", $this->data, null); //areaCliente
        $loadView->loadView_cabecalho_adm("areaCliente/areaClienteH");
    }



    /**     function alterarTipoUsuario()
     * Muda o tipo de usuário 
     * Cliente -> Mantenedor
     * Mantenedor -> Cliente
     */
    public function alterarTipoUsuario(): void
    {
        if ($_SESSION['idusuario'] == 1) {

            if (isset($_GET['idUser']) && isset($_GET['tipo'])) {

                $idUser = $_GET['idUser'];
                $tipo = $_GET['tipo'];
                $modelSobreCliente = new \Adms\Models\AdmsSobreClientes();

                if ($tipo == $modelSobreCliente->getTypeUser($idUser)) {
                    // verifica se o usuário existe && se o ususário não está com sit_usuario == Confirmando && $idUser != id mantenedorBOSS && $idUser != usuário logado
                    if ($modelSobreCliente->verifyIfUserExist($idUser) && $modelSobreCliente->verifyIfUserIsNotConfirmando($idUser) && $idUser != 1 && $_SESSION['idusuario'] != $idUser) {

                        if ($tipo == "mantenedor") {
                            $converter = "cliente";
                        } elseif ($tipo == "cliente") {
                            $converter = "mantenedor";
                        }

                        $tipo_usuario['tipo_usuario'] = $converter;

                        if ($modelSobreCliente->changeUserAttributes($idUser, $tipo_usuario))
                            $_SESSION['msgGreen'] = "Cargo do usuario convertido com sucesso!";
                        else
                            $_SESSION['msgRed'] = "Falha ao converte tipo usuario!"; 
        
                    } else {
                        $_SESSION['msgRed'] = "Erro, usuário inválido!";  
                    }

                } else {
                    $_SESSION['msgRed'] = "Erro, informações inválidas!";
                }
    
            } else {
                $_SESSION['msgRed'] = "Erro, falta de informações!";
            }

        } else {
            $_SESSION['msgRed'] = "Erro: nível de mantenedor insuficiente!";
        }
        
        $header = URLADM . "AreaClientes/dados"; 
        header("Location: {$header}");
    }



    /**
     * Altera a sit_usuario do usuário selecionado
     * Ativo -> Inativo
     * Inativo -> Ativo
     */
    public function alterarSitUsuario(): void
    {
        if ($_SESSION['idusuario'] == 1) {

            if (isset($_GET['idUser']) && isset($_GET['sit'])) {

                $idUser = $_GET['idUser'];
                $sit = $_GET['sit'];
                $modelSobreCliente = new \Adms\Models\AdmsSobreClientes();

                if ($sit == "Ativo" || $sit == "Inativo" && $sit == $modelSobreCliente->getSitUser($idUser)) {

                    if ($sit == "Ativo") 
                    $converte = "Inativo";

                    elseif($sit == "Inativo")
                        $converte = "Ativo";
                        
                    if ($modelSobreCliente->verifyIfUserExist($idUser) && $modelSobreCliente->verifyIfUserIsNotConfirmando($idUser) && $idUser != 1 && $_SESSION['idusuario'] != $idUser) {

                        $alterSit['sit_usuario'] = $converte;

                        if ($modelSobreCliente->changeUserAttributes($idUser, $alterSit)) 
                            $_SESSION['msgGreen'] = "Sit_Usuario alterado com sucesso!"; 

                        else 
                            $_SESSION['msgRed'] = "Falha ao alterar Sit_Usuario!";  
                        
                    } else {
                        $_SESSION['msgRed'] = "Erro, usuário inválido!";  
                    }

                } else {
                    $_SESSION['msgRed'] = "Erro, informações inválidas!";
                }

            } else {
                $_SESSION['msgRed'] = "Erro, falta de informações!";
            }

        } else {
            $_SESSION['msgRed'] = "Erro: nível de mantenedor insuficiente!";
        }

        $header = URLADM . "AreaClientes/dados"; 
        header("Location: {$header}");
    }

    }
    ?>