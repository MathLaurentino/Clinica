<?php

namespace App\Adms\Controllers;

if (!defined('D7E4T2K6F4')) {
    $header = "http://localhost/Clinica/Erro?case=404"; // Erro 404
    header("Location: {$header}");
}

include_once 'app/Adms/controllers/helpers/protect.php';

class FotoServico
{

    
    private array|null $data = null;
    private array|null $dataForm = null;

    private string|null $idservico = null;
    private string $nameInDB;


    public function index()
    {
        $this->adicionar();
    }



    /**     function usuario()
     * Cadastra uma foto do serviço selecionado
     * Pela URL é passado o id do serviço
     */
    public function adicionar(): void
    {

        if (isset($_GET['idservico'])) {
            $this->idservico = $_GET['idservico'];
        }   

        $AdmsFotoServico = new \Adms\Models\AdmsFotoServico();

        // verifica se o id do servico passado pela URL existe no banco de dados
        if ($AdmsFotoServico->verifyIdServico($this->idservico)) {
            
            if (!isset($_FILES['arquivo'])) {
                $this->view("fotoServico");
            } 
            
            else {
                $admsFile = new \Adms\Models\helpers\AdmsFile();
                
                if ($admsFile->verifyFile($_FILES['arquivo'])) { // se a foto segue as regras de negocio
                    
                    $nameInDB = $admsFile->saveFile($_FILES['arquivo']);

                    if (!empty($nameInDB)) { // se conseguiu salvar na pasta assets/imagens
                        $this->data = ['foto_servico' => $nameInDB];

                        $admsCreate= new \Adms\Models\AdmsFotoServico();
                        $result = $admsCreate->cadastroFoto($this->data, $this->idservico);

                        if ($result) { // se salvar corretamente no BD
                            $_SESSION['msg'] = "Foto salva com sucesso";
                            $header = URLADM . "SobreClinica"; 
                            header("Location: {$header}");
                        } else { // se não salvar corretamente no BD
                            $header = URLADM . "Erro?case=13"; // Erro 013
                            header("Location: {$header}");
                        }

                    } else { // se não conseguiu salvar na pasta assets/imagens
                        // recarrega a pagina mostrando o erro pro usuario 
                        $header = URLADM . "FotoServico/adicionar"; 
                        header("Location: {$header}");
                    }

                } else {
                    $_SESSION['msg'] = "Arquivo com problemas, tente outro";
                    $header = URLADM . "FotoServico/adicionar"; 
                    header("Location: {$header}");
                }
            }

        } else {
            $_SESSION['msg'] = "id de serviço não encontrado";
            $header = URLADM . "SobreClinica"; 
            header("Location: {$header}");
        }
    }



    /**     function apagar()
     * Apaga a foto do serviço selecionado
     * Primeiro apaga o endereço no banco de dados 
     * Depois apaga na pasta imagens_servicos
     */
    public function apagar(): void
    {
        if(isset($_GET['idservico'])){
            $this->idservico = $_GET['idservico'];
        }

        $admsFotoServico = new \Adms\Models\AdmsFotoServico();

        if ($admsFotoServico->verifyIdServico($this->idservico)) {

            $enderecoFoto = $admsFotoServico->enderecoFotoServico($this->idservico);
            $result = $admsFotoServico->apagarFotoServico($this->idservico);

            if ($result) {
                unlink( IMGADMSER .  $enderecoFoto);
                $_SESSION['msg'] = "Foto apagada com sucesso";
            } else {
                $_SESSION['msg'] = "Erro ao apagar foto no banco de dados";
            }
            
        } else {
            $_SESSION['msg'] = "Esse serviço não existe";
        }
        
        $header = URLADM . "SobreClinica/index"; 
        header("Location: {$header}");
    }



    public function alterar(): void
    {
        if(isset($_GET['idservico'])){
            $this->idservico = $_GET['idservico'];
        }

        if ($AdmsFotoServico->verifyIdServico($this->idservico)) {
            
            if (!isset($_FILES['arquivo'])) {
                $this->view("fotoServico");
            } 
            
            else {
                
            } 
        
        }
    }



    /**     function alterar()
     * Altera a foto de perfil do usuario 
     * Falta implementar 
     */
    public function alterarr(): void
    {
        // se o usuario não tiver foto de perfil
        if (!isset($_SESSION['foto_usuario'])) {
            $header = URL . "Erro?case=15"; // Erro 015
            header("Location: {$header}");
        } 

        // se o usuario ainda não mandou o arquivo da foto
        elseif (!isset($_FILES['arquivo'])) {
            $this->view("alteraFotoUsuario"); // carrega a view 
        }
        
        else {
            $StsFile = new \Sts\Models\helpers\StsFile();
                
            if ($StsFile->verifyFile($_FILES['arquivo'])) { // se a foto segue as regras de negocio

                $nameInDB = $StsFile->saveFile($_FILES['arquivo']);

                if (!empty($nameInDB)) { // se conseguiu salvar na pasta assets/imagens

                    $stsAlter= new \Sts\Models\StsFotoUsuario();
                    $resultApaga = $stsAlter->apagarFotoUsuario();

                    if ($resultApaga) {
                        unlink( IMG . $_SESSION['foto_usuario'] );
                        unset($_SESSION['foto_usuario']);

                        $this->data = ['foto_usuario' => $nameInDB];

                        $stsCreate= new \Sts\Models\StsFotoUsuario();
                        $resultCadastra = $stsCreate->cadastroFoto($this->data);

                        if ($resultCadastra) { // se salvar corretamente no BD
                            $_SESSION['foto_usuario'] = $this->data['foto_usuario'];
                            $_SESSION['msg'] = "Foto salva com sucesso";
                            $header = URL . "Sobre-Cliente/Dados"; 
                            header("Location: {$header}");
                        } else { // se não salvar corretamente no BD
                            $header = URL . "Erro?case=13"; // Erro 013
                            header("Location: {$header}");
                        }

                    } else {
                        $_SESSION['msg'] = "Erro ao apagar foto no banco de dados";
                    }

                } else { // se não conseguiu salvar na pasta assets/imagens
                    // recarrega a pagina mostrando o erro pro usuario 
                    $header = URL . "Foto/Usuario"; 
                    header("Location: {$header}");
                }
            } else { // se a foto não segue as regras de negocio
                $header = URL . "Foto/Usuario"; 
                header("Location: {$header}");
            } 
        }
    }



    private function view($view) 
    {
        $loadView = new \Core\LoadView("Adms/Views/bodys/files/" . $view, $this->data, null);
        $loadView->loadView();
    }
}

?>
