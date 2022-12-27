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
     */
    public function apagar(): void
    {
        if(isset($_GET['idservico'])){
            $this->id = $_GET['idservico'];
        }

        $admsFotoServico = new \Adms\Models\AdmsFotoServico();

        if ($admsFotoServico->verifyIdServico()) {

        }

    }


    /**     function apagar()
     * Responsavel por apagar a foto de perfil do usuario
     * Primeiro apaga o endereco da imagem no BD
     * Se der certo, apaga a imagem da pasta assets/imagens  
     */
    public function apagarr(): void
    {

        if(isset($_GET['id'])){
            $this->id = $_GET['id'];
        }

        $stsFotoPet = new \Sts\Models\StsFotoPet();

        if ($stsFotoPet->verificaDonoPet($this->id)) { // verifica se o pet pertence ao usuario

            if (!$stsFotoPet->verificarFoto($this->id)) { // verifica se o pet realmente tem uma foto

                unlink( IMG .  $stsFotoPet->enderecoImagemPet($this->id));
                $result = $stsFotoPet->apagarFotoPet($this->id);

                if ($result) {
                    $_SESSION['msg'] = "Foto apagada com sucesso";
                } else {
                    $_SESSION['msg'] = "Erro ao apagar foto no banco de dados";
                }
    
                $header = URL . "SobreCliente/Dados";
                header("Location: {$header}");
    
            } else {
                $header = URL . "Erro?case=19"; // Erro 019
                header("Location: {$header}");
            }

        } else {
            $header = URL . "Erro?case=20"; // Erro 020
            header("Location: {$header}");
        }
    }




    private function view($view) 
    {
        $loadView = new \Core\LoadView("Adms/Views/bodys/files/" . $view, $this->data, null);
        $loadView->loadView();
    }
}

?>
