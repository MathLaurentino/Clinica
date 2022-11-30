<?php

namespace Sts\Controllers;

include_once 'app/sts/Controllers/helpers/protect.php';

class FotoUsuario 
{
    private string $nameInDB;
    private array|null $data = null;
    private array|null $dataForm = null;


    public function index()
    {
        $this->adicionar();
    }




    /**     function usuario()
     * Cadastra uma foto de perfil do usuario
     */
    public function adicionar(): void
    {
        // so é possivel acessar o método se não existir a $_SESSION['foto_usuario'] 
        // (no caso se não tiver foto cadastrada)
        if (!isset($_SESSION['foto_usuario'])) { 

            if (isset($_FILES['arquivo'])) { // se o usuario mandou o arquivo de foto 

                $foto = new \Sts\Controllers\helpers\Metodos();
                
                if ($foto->verifyFile($_FILES['arquivo'])) { // se a foto segue as regras de negocio

                    $nameInDB = $foto->saveFile($_FILES['arquivo']);

                    if (!empty($nameInDB)) { // se conseguiu salvar na pasta assets/imagens
                        $this->data = ['foto_usuario' => $nameInDB];

                        $stsCreate= new \Sts\Models\StsFotoUsuario();
                        $result = $stsCreate->cadastroFoto($this->data);

                        if ($result) { // se salvar corretamente no BD
                            $_SESSION['foto_usuario'] = $this->data['foto_usuario'];
                            $_SESSION['msg'] = "Foto salva com sucesso";
                            $header = URL . "Sobre-Cliente/Dados"; 
                            header("Location: {$header}");
                        } else { // se não salvar corretamente no BD
                            $header = URL . "Erro?case=13"; // Erro 013
                            header("Location: {$header}");
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

            } else { // caso n tenha arquivo enviado, carrega a tela
                $this->view("usuario", "foto_usuario");
            }

        } else {
            $header = URL . "Erro?case=14"; // Erro 014
            header("Location: {$header}");
        }   
    }



    /**     function apagar()
     * Responsavel por apagar a foto de perfil do usuario
     * Primeiro apaga o endereco da imagem no BD
     * Se der certo, apaga a imagem da pasta assets/imagens  
     */
    public function apagar(): void
    {
        if (isset($_SESSION['foto_usuario'])) {

            $stsdelete= new \Sts\Models\StsFotoUsuario();
            $result = $stsdelete->apagarFotoUsuario();
            if ($result) {
                unlink( IMG . $_SESSION['foto_usuario'] );
                unset($_SESSION['foto_usuario']);
                $_SESSION['msg'] = "Foto apagada com sucesso";
            } else {
                $_SESSION['msg'] = "Erro ao apagar foto no banco de dados";
            }

        } else {
            $_SESSION['msg'] = "Você não tem uma foto de perfil cadastrada para apaga-la"; 
        }

        $header = URL . "SobreCliente/Dados"; // Erro 014
        header("Location: {$header}");
    }



    /**     function alterar()
     * Altra a foto de perfil do usuario 
     * Falta implementar 
     */
    public function alterar(): void
    {

    }



    // Outros Métodos -----------------------------------------------


    private function view($view, $header) 
    {
        $loadView = new \Core\LoadView("sts/Views/foto/" . $view, $this->data, null);
        $loadView->loadView_header($header);
    }

    /**     function pages()
     * Retorna as functions que são publicas nessa controller
     * Chamado pelo LoadView();
     */
    public function pages(): array
    {  
        return $array = ['index','adicionar','apagar','alterar'];
    }
}

?>