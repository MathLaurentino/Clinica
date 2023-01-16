<?php

namespace Sts\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once 'app/sts/Controllers/helpers/protectLogin.php';

class ConfirmarEmail{

    private array|null $dataForm = null;
    private array|null $data = null;

    public function index()
    {
        $this->verificarChave();
    }


    /**     function verificarChave()
     * Verifica se a chave passada pela URL é a mesma
     *      que está registrada no banco de dados da conta
     *      que está sendo verificada
     */
    public function verificarChave()
    {

        $chave = filter_input(INPUT_GET, "chave", FILTER_SANITIZE_STRING);
        $stsKey = new \Sts\Models\StsConfirmarEmail();

        if (!empty($chave)) {

            $userSituation = $stsKey->getSituation("chave", $chave);

            if ($userSituation == "Confirmando") {

                $id = $stsKey->verifyKey($chave);
    
                if (!empty($id)){
    
                    if ($stsKey->alterSituation($id[0]['idusuario'])) {
                        $_SESSION['msgGreen'] = "Email confirmado com sucesso";
                        $header = URL . "Login";
                        header("Location: {$header}");
                    }
    
                } else {
                    $_SESSION['msgRed'] = "Chave de confirmação invalida";
                    $header = URL . "Home";
                    header("Location: {$header}");
                }

            } elseif ($userSituation == "Inativo") {

                $_SESSION['msgRed'] = "Conta Inativa ou com falha";
                $header = URL . "Login";
                header("Location: {$header}");

            } elseif ($userSituation == "Ativo") {

                $_SESSION['msgGreen'] = "Conta Ativada";
                $header = URL . "Login";
                header("Location: {$header}");

            }

        } else { 
            $_SESSION['msgRed'] = "Falha ao indentificar chave de ativação";
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
            } 

            $stsEmail = new \Sts\Models\StsConfirmarEmail();
            $chave = $stsEmail->getKey($email);
            
            $mail = new PHPMailer(true);
            
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
                $mail->addAddress($email);

                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Confirma o e-mail';
                $mail->Body    = "Prezado(a) Cliente.<br><br>Agradecemos a sua solicitação de cadastramento em nosso site!<br><br>Para que possamos liberar o seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicanco no link abaixo: <br><br> <a href='http://localhost/Clinica/ConfirmarEmail?chave=$chave'>Clique aqui</a><br><br>Esta mensagem foi enviada a você pela empresa XXX.<br>Você está recebendo porque está cadastrado no banco de dados da empresa XXX. Nenhum e-mail enviado pela empresa XXX tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.<br><br>" ;
                $mail->AltBody = "Prezado(a) Cliente.\n\nAgradecemos a sua solicitação de cadastramento em nosso site!\n\nPara que possamos liberar o seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicanco no link abaixo: \n\n http://localhost/Clinica/ConfirmarEmail?chave=$chave \n\nEsta mensagem foi enviada a você pela empresa XXX.\nVocê está recebendo porque está cadastrado no banco de dados da empresa XXX. Nenhum e-mail enviado pela empresa XXX tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.\n\n";

                $mail->send();

                $_SESSION['msgGreen'] = "Chave reenviada com sucesso, confirme no seu email. Confirme seu Email para acessar sua conta";
                $header = URL . "Login";
                header("Location: {$header}");

            } catch (Exception $e) {
                echo "ERRO";
            }
            
        } else {

            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (isset($this->dataForm['send'])) {
 
                $stsEmail = new \Sts\Models\StsConfirmarEmail();
                if ($stsEmail->verifyIfEmailExist($this->dataForm['email'])){

                    $stsKey = new \Sts\Models\StsConfirmarEmail();
                    $userSituation = $stsKey->getSituation("email", $this->dataForm['email']);

                    if ($userSituation == "Confirmando") {
                        $_SESSION['email_para_verificar'] = $this->dataForm['email'];
                        $header = URL . "ConfirmarEmail/reenviarEmail";
                        header("Location: {$header}");
                    } elseif ($userSituation == "Inativo") {

                        $_SESSION['msgRed'] = "Conta Inativa ou com falha";
                        $header = URL . "Login";
                        header("Location: {$header}");
        
                    } elseif ($userSituation == "Ativo") {
        
                        $_SESSION['msg'] = "Conta já está ativada";
                        $header = URL . "Login";
                        header("Location: {$header}");
        
                    }

                } else {
                    $_SESSION['msgRed'] = "Email informado é inválido";
                    $this->data['email'] = $this->dataForm['email'];
                    $loadView = new \Core\LoadView("sts/Views/bodys/sendEmail/sendEmail", $this->data, null);
                    $loadView->loadView_header2();
                }

            } else {
                $loadView = new \Core\LoadView("sts/Views/bodys/sendEmail/sendEmail", null, null);
                $loadView->loadView_header2();
            }
            
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