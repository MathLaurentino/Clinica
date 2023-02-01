<?php

namespace Sts\Controllers;

if (!defined('D7E4T2K6F4')) {
    $header = "http://localhost/Clinica/Erro?case=404"; // Erro 404
    header("Location: {$header}");
}

include_once 'app/sts/Controllers/helpers/protect.php';

class FotoPet
{
    private string $nameInDB;
    private array|null $data = null;
    private array|null $dataForm = null;
    private string|null $id = null;


    public function index()
    {
        $header = URL . "Home"; 
        header("Location: {$header}");
    }



    /**     function usuario()
     * Cadastra uma foto de perfil do usuario
     */
    public function adicionar(): void
    {
        if(!isset($_GET['id'])){
            $_SESSION['magRed'] = "Erro, falta de informações";
            $header = URL . "SobreCliente/Dados"; 
            header("Location: {$header}");
        } 
        
        else {
            $this->id = $_GET['id'];
            $stsFotoPet = new \Sts\Models\StsFotoPet();

            // verifica se id do pet passado pela URL pertence ao usuario da sessão
            if ($stsFotoPet->verificaDonoPet($this->id)) {

                //verifica se ja existe uma foto de pet no BD
                if ($stsFotoPet->verificarFoto($this->id)) { 
                    
                    if (isset($_FILES['arquivo'])) { // se o usuario mandou o arquivo de foto 

                        $StsFile = new \Sts\Models\helpers\StsFile();
                        
                        if ($StsFile->verifyFile($_FILES['arquivo'])) { // se a foto segue as regras de negocio

                            $nameInDB = $StsFile->saveFile($_FILES['arquivo']);

                            if (!empty($nameInDB)) { // se conseguiu salvar na pasta assets/imagens
                                $this->data = ['imagem_pet' => $nameInDB];

                                $stsCreate= new \Sts\Models\StsFotoPet();
                                $result = $stsCreate->cadastroFotoPet($this->data, $this->id);

                                if ($result) { // se salvar corretamente no BD
                                    $_SESSION['msgGreen'] = "Foto do Pet salva com sucesso";
                                    $header = URL . "Sobre-Cliente/Dados"; 
                                    header("Location: {$header}");
                                } else { // se não salvar corretamente no BD
                                    $header = URL . "Erro?case=13"; // Erro 013
                                    header("Location: {$header}");
                                }

                            } else { // se não conseguiu salvar na pasta assets/imagens
                                // recarrega a pagina mostrando o erro pro usuario 
                                $header = URL . "SobreCliente/Dados"; 
                                header("Location: {$header}");
                            }

                        } else { // se a foto não segue as regras de negocio
                            $header = URL . "SobreCliente/Dados"; 
                            header("Location: {$header}");
                        } 

                    } else { // caso n tenha arquivo enviado, carrega a tela
                        $loadView = new \Core\LoadView("sts/Views/bodys/imageFile/pet", $this->data, null);
                        $loadView->loadView_header("imageFile/fileHeader");
                    }

                } else {
                    $header = URL . "Erro?case=17"; // Erro 017
                    header("Location: {$header}");
                }

            } else {
                $header = URL . "Erro?case=20"; // Erro 020
                header("Location: {$header}");
            }
        }
    }



    /**     function alterar()
     * Altera a foto de perfil do usuario 
     */
    public function alterar(): void
    {

        if(!isset($_GET['id'])){
            $_SESSION['magRed'] = "Erro, falta de informações";
            $header = URL . "SobreCliente/Dados"; 
            header("Location: {$header}");
        } 

        else {

            $this->id = $_GET['id'];

            $stsFotoPet = new \Sts\Models\StsFotoPet();

            // verifica se id do pet passado pela URL pertence ao usuario da sessão
            if ($stsFotoPet->verificaDonoPet($this->id)) {

                //verifica se ja existe uma foto de pet no BD
                if (!$stsFotoPet->verificarFoto($this->id)) { 

                    if (isset($_FILES['arquivo'])) { // se o usuario mandou o arquivo de foto 

                        $StsFile = new \Sts\Models\helpers\StsFile();
                        
                        if ($StsFile->verifyFile($_FILES['arquivo'])) { // se a foto segue as regras de negocio

                            $nameInDB = $StsFile->saveFile($_FILES['arquivo']);

                            if (!empty($nameInDB)) { // se conseguiu salvar na pasta assets/imagens

                                unlink( IMG .  $stsFotoPet->enderecoImagemPet($this->id));
                                $result = $stsFotoPet->apagarFotoPet($this->id);

                                $this->data = ['imagem_pet' => $nameInDB];

                                $stsCreate= new \Sts\Models\StsFotoPet();
                                $result = $stsCreate->cadastroFotoPet($this->data, $this->id);

                                if ($result) { // se salvar corretamente no BD
                                    $_SESSION['msgGreen'] = "Foto do Pet salva com sucesso";
                                    $header = URL . "Sobre-Cliente/Dados"; 
                                    header("Location: {$header}");
                                } else { // se não salvar corretamente no BD
                                    $header = URL . "Erro?case=13"; // Erro 013
                                    header("Location: {$header}");
                                }

                            } else { // se não conseguiu salvar na pasta assets/imagens
                                // recarrega a pagina mostrando o erro pro usuario 
                                $header = URL . "SobreCliente/Dados"; 
                                header("Location: {$header}");
                            }

                        } else { // se a foto não segue as regras de negocio
                            $header = URL . "SobreCliente/Dados"; 
                            header("Location: {$header}");
                        } 

                    } else { // caso n tenha arquivo enviado, carrega a tela
                        $this->data = $stsFotoPet->getFotoPet($this->id);
                        $loadView = new \Core\LoadView("sts/Views/bodys/imageFile/alterarPet", $this->data, null);
                        $loadView->loadView_header("imageFile/fileHeader");
                    }

                } else {
                    $header = URL . "Erro?case=17"; // Erro 017
                    header("Location: {$header}");
                }

            } else {
                $header = URL . "Erro?case=20"; // Erro 020
                header("Location: {$header}");
            }
            
        }

            
    }



    /**     function apagar()
     * Responsavel por apagar a foto de perfil do usuario
     * Primeiro apaga o endereco da imagem no BD
     * Se der certo, apaga a imagem da pasta assets/imagens  
     */
    public function apagar(): void
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
                    $_SESSION['msgGreen'] = "Foto apagada com sucesso";
                } else {
                    $_SESSION['msgRed'] = "Erro ao apagar foto no banco de dados";
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



    /**     function pages()
     * Retorna as functions que são publicas nessa controller
     * Chamado pelo LoadView();
     */
    public function pages(): array
    {  
        return $array = ['index','adicionar','alterar','apagar'];
    }
}

?>