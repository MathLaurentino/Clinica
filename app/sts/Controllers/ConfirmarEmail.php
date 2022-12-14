<?php

namespace Sts\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ConfirmarEmail{


    public function index()
    {
        $this->verificarChave();
    }


    /**     function verificarChave()
     * Verifica se a chave passada pela URL é a mesma
     *      que está registrada no abnco de dados da conta
     *      que está sendo verificada
     */
    public function verificarChave()
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



    /**     function reenviarEmail()
     * Responsvel por Reenviar o Email de verificação de email
     */
    public function reenviarEmail()
    {
        if (isset($_SESSION['email_para_verificar'])) {
            
            if (isset($_SESSION['email_para_verificar'])) {
                $email = $_SESSION['email_para_verificar'];
            } else {

            }

            $mail = new PHPMailer(true);
            $stsEmail = new \Sts\Models\StsConfirmarEmail();
            $stsEmail->getKey($email);

            /*
            try {
                //Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->CharSet = "UTF-8";
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = '5b0b0de0c72429';                     //SMTP username
                $mail->Password   = '1dcc7c242ab250';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
                $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('matheuscalifornia29@gmail.com', 'Matheus');
                $mail->addAddress($this->dataForm['email'], $this->dataForm['nome_usuario']);

                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Confirma o e-mail';
                $mail->Body    = "Prezado(a) " . $this->dataForm['nome_usuario'] . ".<br><br>Agradecemos a sua solicitação de cadastramento em nosso site!<br><br>Para que possamos liberar o seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicanco no link abaixo: <br><br> <a href='http://localhost/Clinica/ConfirmarEmail?chave=$chave'>Clique aqui</a><br><br>Esta mensagem foi enviada a você pela empresa XXX.<br>Você está recebendo porque está cadastrado no banco de dados da empresa XXX. Nenhum e-mail enviado pela empresa XXX tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.<br><br>" ;
                $mail->AltBody = "Prezado(a) " . $this->dataForm['nome_usuario'] . ".\n\nAgradecemos a sua solicitação de cadastramento em nosso site!\n\nPara que possamos liberar o seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicanco no link abaixo: \n\n http://localhost/Clinica/ConfirmarEmail?chave=$chave \n\nEsta mensagem foi enviada a você pela empresa XXX.\nVocê está recebendo porque está cadastrado no banco de dados da empresa XXX. Nenhum e-mail enviado pela empresa XXX tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.\n\n";

                $mail->send();

                $_SESSION['email_para_verificar'] = $this->dataForm['email'];
                $_SESSION['msg'] = "<p style='color:green;'>Usuario cadastrado com sucesso</p> <p style='color:green;'>Confirme seu Email para acessar sua conta</p>";
                $header = URL . "Home";
                header("Location: {$header}");

            } catch (Exception $e) {
                echo "ERRO";
            }
            */

        } else {

        }
    }



    /**     function pages()
     * Retorna os métodos publicos da classe
     */
    public function pages(): array
    {  
        return $array = ['index', 'verificarChave', 'reenviarEmail'];
    }

}

?>