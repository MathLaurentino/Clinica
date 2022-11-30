<?php

namespace Sts\Controllers;

class AlterarFoto {



    
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
                $this->view("alteraFotoUsuario", "alterar_foto_usuario");
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