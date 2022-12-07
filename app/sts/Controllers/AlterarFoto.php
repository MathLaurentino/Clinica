<?php

namespace Sts\Controllers;

if (!defined('D7E4T2K6F4')) {
    $header = "http://localhost/Clinica/Erro?case=404"; // Erro 404
    header("Location: {$header}");
}

include_once 'app/sts/Controllers/helpers/protect.php';

class AlterarFoto {

    private array|null $data = null;
    /**     function alterarFotoUsuario()
     * Function responsavel por altarar a foto do usuario
     */
    public function usuario()
    {
        if (isset($_SESSION['foto_usuario'])) {

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
                $loadView = new \Core\LoadView("sts/Views/foto/alteraFotoUsuario", $this->data, null);
                $loadView->loadView_header("alterar_foto_usuario");
            }

        } else {
            $header = URL . "Erro?case=15"; // Erro 015
            header("Location: {$header}");
        }
    }

    public function pages(): array
    {  
        return $array = ['index','usuario','pet'];
    }

}


?>