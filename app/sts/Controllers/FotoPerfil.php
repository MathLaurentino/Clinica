<?php

namespace Sts\Controllers;

include_once 'app/sts/Controllers/helpers/protect.php';

class FotoPerfil 
{
    private string $nameInDB;
    private array|null $data = null;

    public function index()
    {
        $this->usuario();
    }

    /**     function usuario()
     * Cadastra uma foto de perfil do usuario
     */
    public function usuario()
    {
        if (!isset($_SESSION['foto_usuario'])) {

            if (isset($_FILES['arquivo'])) {
                if ($this->verifyFile()) {
    
                    $this->data = ['foto_usuario' => $this->nameInDB];
    
                    $stsCreate= new \Sts\Models\StsFotoPerfil();
                    $result = $stsCreate->cadastroFoto($this->data);
                    if ($result) {
                        $_SESSION['foto_usuario'] = $this->data['foto_usuario'];
                        $_SESSION['msg'] = "Foto salva com sucesso";
                        $header = URL . "Sobre-Cliente/Dados"; 
                        header("Location: {$header}");
                    } else {
                        $header = URL . "Erro?case=13"; // Erro 013
                        header("Location: {$header}");
                    }
                        
    
                } else {
                    echo $_SESSION['errFile'];
                }
            } else {
                $this->view("usuario");
            }

        } else {
            $header = URL . "Erro?case=14"; // Erro 014
            header("Location: {$header}");
        }   
    }


    /**     function pet()
     * Cadastra uma foto de perfil de um pet do usuario
     */
    public function pet()
    {

    }

    private function view($view) 
    {
        $loadView = new \Core\LoadView("sts/Views/fotoPerfil/" . $view, $this->data, null);
        $loadView->loadView2();
    }

    /**     function pages()
     * Retorna as functions que são publicas nessa controller
     * Chamado pelo LoadView();
     */
    public function pages(): array
    {  
        return $array = ['index','usuario','pet'];
    }




    // -------------------------- IMAGENS ----------------------------

    /**
     * Undocumented function
     *
     */
    private function verifyFile(): bool
    {
        if (isset($_FILES['arquivo'])){
            $this->dataFile = $_FILES['arquivo'];

            if ($this->dataFile['error']) // falha ao carregar arquivo
            {
                $_SESSION['errFile'] = "Erro ao receber imagem";
                return false;
            }

            elseif ($this->dataFile['size'] > 2097152) // arquivo maior que 2 mg
            { 
                $_SESSION['errFile'] = "Arquivo muito grande";
                return false;
            } 

            else // arquivo recebido
            {
                // pega o tipo do arquivo (.pdf, .png ...)
                $extensao = strtolower(pathinfo($this->dataFile['name'], PATHINFO_EXTENSION));

                if ($extensao != "jpg" && $extensao != "png") // se não for um arquivo jpg ou png
                {
                    $_SESSION['errFile'] = "tipo de arquivo não aceito";
                    return false;
                } else 
                {
                    return $this->saveFile($extensao);
                }
            }
        } 

        else 
        {
            $_SESSION['errFile'] = "Não anexou imagem";
            return false;
        }
    }



    /**
     * Undocumented function
     *
     */
    private function saveFile($extensao): bool 
    {
        $pasta = "app\sts\Helpers\imagens/";
        $nomeUnicoArquivo = uniqid(); // nome aleatorio de arquivo
        $path = $pasta . $nomeUnicoArquivo . "." . $extensao;
        $this->nameInDB = $nomeUnicoArquivo . "." . $extensao;

        $save = move_uploaded_file($this->dataFile['tmp_name'], $path); // salvar o arquivo na pasta
        if($save){ // se salvar corretamente 
            return true;
        }
        else { // se tiver algum erro no save
            $_SESSION['errFile'] = "falha ao salvar arquivo";
            return false;
        }
        
    }
}

?>