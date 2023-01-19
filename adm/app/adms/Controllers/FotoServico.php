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
                            $_SESSION['msgGreen'] = "Foto salva com sucesso";
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
                    $_SESSION['msgRed'] = "Arquivo com problemas, tente outro";
                    $header = URLADM . "FotoServico/adicionar"; 
                    header("Location: {$header}");
                }
            }

        } else {
            $_SESSION['msgRed'] = "id de serviço não encontrado";
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
                $_SESSION['msgGreen'] = "Foto apagada com sucesso";
            } else {
                $_SESSION['msgRed'] = "Erro ao apagar foto no banco de dados";
            }
            
        } else {
            $_SESSION['msgRed'] = "Esse serviço não existe";
        }
        
        $header = URLADM . "SobreClinica/index"; 
        header("Location: {$header}");
    }



    public function alterar(): void
    {
        if(isset($_GET['idservico'])){
            $this->idservico = $_GET['idservico'];
        }

        $admsFotoServico = new \Adms\Models\AdmsFotoServico();

        if (!$admsFotoServico->verifyIdServico($this->idservico)) {
            $_SESSION['msgRed'] = "Id serviço inválida, tente novamente";
            $header = URL . "SobreClinica/index"; 
            header("Location: {$header}");
        }
   
        if (!isset($_FILES['arquivo'])) {
            $this->data['foto_servico'] = $admsFotoServico->enderecoFotoServico($this->idservico);
            $this->view("alterarFotoServico");
        } 
        
        else {

            $admsFile = new \Adms\Models\helpers\AdmsFile();

            if ($admsFile->verifyFile($_FILES['arquivo'])) {

                $nameInDB = $admsFile->saveFile($_FILES['arquivo']);

                if (!empty($nameInDB)) { // se conseguiu salvar na pasta assets/imagens

                    $enderecoFoto = $admsFotoServico->enderecoFotoServico($this->idservico);
                    $resultApaga = $admsFotoServico->apagarFotoServico($this->idservico);

                    if ($resultApaga) {

                        unlink( IMGADMSER . $enderecoFoto);

                        $this->data = ['foto_servico' => $nameInDB];
                        $resultCadastra = $admsFotoServico->cadastroFoto($this->data, $this->idservico);

                        if ($resultCadastra) { // se salvar corretamente no BD
                            $_SESSION['msgGreen'] = "Foto alterada com sucesso";
                        } else { // se não salvar corretamente no BD
                            $_SESSION['msgRed'] = "Falha ao alterar foto";
                        }

                    } else { // não conseguiu apagar dados no banco de dados
                        $_SESSION['msgRed'] = "Erro ao apagar foto no banco de dados";
                    }

                } else { // se não conseguiu salvar na pasta assets/imagens
                    $_SESSION['msgRed'] = "falha ao salvar arquivo";
                }

            } else { // se o arquinvo não segue as regras de negócio
                $_SESSION['msgRed'] = "Arquivo com problemas, tente outro";
            }

            $header = URLADM . "SobreClinica/index"; 
            header("Location: {$header}");

        } 
    } 
    

    private function view($view) 
    {
        $loadView = new \Core\LoadView("Adms/Views/bodys/files/" . $view, $this->data, null);
        $loadView->loadViewAdm();
    }
}

?>
