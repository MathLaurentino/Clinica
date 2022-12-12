<?php

namespace Sts\Controllers;

class ConfirmarEmail{


    public function index()
    {

        if (!isset($_SESSION)) {
            session_start();
        } 

        $chave = filter_input(INPUT_GET, "chave", FILTER_SANITIZE_STRING);

        if (!empty($chave)) {
            
            $stsKey = new \Sts\Models\StsConfirmarEmail();
            $id = $stsKey->verifyKey($chave);

            if (!empty($id)){

                if ($stsKey->alterSituation($id[0]['idusuario'])) {
                    $_SESSION['msg'] = "Email confirmado com sucesso";
                    $header = URL . "Login";
                    header("Location: {$header}");
                }

            } else {
                $_SESSION['msg'] = "Chave de confirmação invalida";
                $header = URL . "Home";
                header("Location: {$header}");
            }
        
        } else { 
            $_SESSION['msg'] = "Chave de confirmação invalida";
            $header = URL . "Home";
            header("Location: {$header}");
        }

    }

    public function pages(): array
    {  
        return $array = ['index'];
    }

}

?>