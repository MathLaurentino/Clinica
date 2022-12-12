<?php

namespace Sts\Controllers;

if (!defined('D7E4T2K6F4')) {
    $header = "http://localhost/Clinica/Erro?case=404"; // Erro 404
    header("Location: {$header}");
}

include_once 'app/sts/Controllers/helpers/protect.php';

class Foto
{
    private string $nameInDB;
    private array|null $data = null;
    private array|null $dataForm = null;
    private string|null $id = null;


    public function index()
    {
        $this->adicionar();
    }



    /**     function usuario()
     * Cadastra uma foto de perfil do usuario
     */
    public function adicionar(): void
    {
        if(isset($_GET['id'])){
            $this->id = $_GET['id'];
        }

        $stsFotoPet = new \Sts\Models\StsFotoCarteira();
        
        // se o id do pet passado não pertence ao usuario
        if (!$stsFotoPet->verificaDonoPet($this->id)) {
            $header = URL . "Erro?case=20"; // Erro 020
            header("Location: {$header}");
        } 
        // se o pet ja tiver uma foto cadastrada
        elseif (!$stsFotoPet->verificarFotoCarteira($this->id)) {
            $header = URL . "Erro?case=17"; // Erro 017
            header("Location: {$header}");
        }

        $StsFile = new \Sts\Models\helpers\StsFile();

        // se o usuario não mandou o arquivo de foto
        if (!isset($_FILES['arquivo'])) {
            // carrega a tela carteira.php
            $loadView = new \Core\LoadView("sts/Views/bodys/imageFile/carteira", $this->data, null);
            $loadView->loadView_header('imageFile');
        } 
        // se a foto não segue as regras de negocio
        elseif (!$StsFile->verifyFile($_FILES['arquivo'])) {
            $header = URL . "SobreCliete/Dados"; 
            header("Location: {$header}");
        } 
        else {

            $nameInDB = $StsFile->saveFile($_FILES['arquivo']);

            // se não conseguiu salvar na pasta assets/imagens
            if (empty($nameInDB)) { 
                // recarrega a pagina mostrando o erro para o usuario 
                $header = URL . "SobreCliete/Dados"; 
                header("Location: {$header}");

            } else { 
                $this->data = ['imagem_carteira_pet' => $nameInDB];

                $stsCreate= new \Sts\Models\StsFotoCarteira();
                $result = $stsCreate->cadastroFotoCarteira($this->data, $this->id);

                if ($result) { // se salvar corretamente no BD
                    $_SESSION['msg'] = "Foto da carteira de vacina salva com sucesso";
                    $header = URL . "Sobre-Cliente/Dados"; 
                    header("Location: {$header}");
                } else { // se não salvar corretamente no BD
                    $header = URL . "Erro?case=13"; // Erro 013
                    header("Location: {$header}");
                }
            }
    
        }
    }


    /**     function pages()
     * Retorna as functions que são publicas nessa controller
     * Chamado pelo LoadView();
     */
    public function pages(): array
    {  
        return $array = ['index','adicionar','apagar'];
    }
}

?>