<?php

namespace Sts\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (!defined('D7E4T2K6F4')) {
    $header = "http://localhost/Clinica/Erro?case=404"; // Erro 404
    header("Location: {$header}");
}

if (!isset($_SESSION)) {
    session_start();
} 

class RecuperarSenha{
    
    // Recebe as informações do usuário
    private array|string|null $dataForm;
    // Recebe as informações do cliente vindas do BD
    private array|null $data = null;

    /**     function index()
     * Chama a function padão da classe
     */
    public function index(): void
    {
        $this->informarEmail();
    }



    public function informarEmail (): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->checkSession();

        /** Se o formulário com o email foi enviado */
        if (isset($this->dataForm['send'])) {
            unset($this->dataForm['send']);

            $stsSenha = new \Sts\Models\StsRecuperarSenha();

            $userData = $stsSenha->getUserData($this->dataForm['email']);
            $idUser = $userData[0]['idusuario'];
            $sitUser = $userData[0]['sit_usuario'];

            if ($sitUser == "Ativo") {

                if ($userData) {
                    $this->data['recuperar_senha'] = password_hash($idUser, PASSWORD_DEFAULT);
    
                    if ($stsSenha->alterUserData($idUser, $this->data)) {
    
                        $this->enviarEmailSenha($this->dataForm['email'], $this->data['recuperar_senha'], $userData[0]['nome_usuario']);
    
                    } else {
                        $_SESSION['msgRed'] = "Falha ao gerar chave!";
                        $header = URL . "RecuperarSenha/Informar-Email";
                        header("Location: {$header}");
                    }
                    
                } else {
                    $_SESSION['msgRed'] = "Email informado é inválido!";
                    $header = URL . "RecuperarSenha/Informar-Email";
                    header("Location: {$header}");
                }

            } elseif($sitUser == "Inativo") {
                $_SESSION['msgRed'] = "Conta bloqueada!";
                $header = URL . "Login/Usuario";
                header("Location: {$header}");

            } elseif ($sitUser == "Confirmando") {
                $_SESSION['msgRed'] = "É necessário confirma o endereço de email antes de mudar a senha!";
                $header = URL . "Login/Usuario";
                header("Location: {$header}");
                
            } else {
                $header = URL . "Home";
                header("Location: {$header}");
            }

           

        } else {
            $loadView = new \Core\LoadView("sts/Views/bodys/novaSenha/informarEmail", null, null);
            $loadView->loadView_header("novaSenha/novaSenhaH");
        }
        
    }



    public function atualizarSenha():void
    {
        $chave = filter_input(INPUT_GET, "chave", FILTER_SANITIZE_STRING);

        if ($chave) {
            $stsSenha = new \Sts\Models\StsRecuperarSenha();
            $user = $stsSenha->verifyKeyUser($chave);

            if ($user) {
                
                $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                if (isset($this->dataForm['senha_usuario'])) {

                    $this->data['senha_usuario'] = password_hash($this->dataForm['senha_usuario'], PASSWORD_DEFAULT);
                    $this->data['recuperar_senha'] = NULL;
                    
                    $result = $stsSenha->alterUserData($user[0]['idusuario'], $this->data);

                    if ($result) {
                        $_SESSION['msgGreen'] = "Senha alterada com secesso!";
                        $header = URL . "Login/Usuario";
                        header("Location: {$header}");
                    } else {
                        $_SESSION['msgRed'] = "Falha ao alterar senha!";
                        $header = URL . "RecuperarSenha/Informar-Email";
                        header("Location: {$header}");
                    }
                    
                } else {
                    $loadView = new \Core\LoadView("sts/Views/bodys/novaSenha/novaSenha", null, null);
                    $loadView->loadView_header("novaSenha/novaSenhaH");
                }
                
            } else {
                $_SESSION['msgRed'] = "Chave inválida!";
                $header = URL . "RecuperarSenha/Informar-Email";
                header("Location: {$header}");
            }

        } else {
            $_SESSION['msgRed'] = "Falta de informações!";
            $header = URL . "RecuperarSenha/Informar-Email";
            header("Location: {$header}");
        }
    }



   
        



    /**
     * Reenvia o email de ativação de conta 
     */
    private function enviarEmailSenha($emailUser, $key, $name):void
    {
        $email = $emailUser; 
        $chave = $key;
        $nome  = $name;
        
        $mail = new PHPMailer(true);
        
        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->CharSet = "UTF-8";
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = HOSTTRAP;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = USERNAME;                     //SMTP username
            $mail->Password   = PASSWORD;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = PORTTRAP;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom(EMAILTRAP, NOME);
            $mail->addAddress($email);

            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Redefinição de senha';
            $mail->Body    = "Prezado(a) {$nome}.<br><br>Agradecemos a sua solicitação para redefinição de senha no nosso site!<br><br>Para que possamos liberar essa ação, solicitamos que clique no link abaixo: <br><br> <a href='http://localhost/Clinica/RecuperarSenha/Atualizar-Senha?chave=$chave'>Clique aqui</a>" ;
            $mail->AltBody = "Prezado(a) {$nome}.\n\nAgradecemos a sua solicitação para redefinição de senha no nosso site!\n\nPara que possamos liberar essa ação, solicitamos que clique no link abaixo: \n\n http://localhost/Clinica/RecuperarSenha/Atualizar-Senha?chave=$chave";

            $mail->send();

            $_SESSION['msgGreen'] = "Email para redefinição de senha enviado com sucesso";
            $header = URL . "Login";
            header("Location: {$header}");

        } catch (Exception $e) {
            $_SESSION['msgRed'] = "Falha ao reenviar email de redefifição de senha, tente novamente mais tarde!";
            $header = URL . "Login";
            header("Location: {$header}");
        }
    }


    /**     function checkSession()
     * Verifica se já existe a $_SESSION['idusuario'], se existir o usuário já está logado
     */
    public function checkSession() 
    {
        if (!isset($_SESSION)) {
            session_start();
        } 

        if (isset($_SESSION['idusuario'])) {
            $header = URL . "Erro?case=2"; // Erro 002
            header("Location: {$header}");
        }
    }



    /**     function pages()
     * Retorna as functions que são publicas nessa controller
     */
    public function pages(): array
    {  
        return $array = ['index','informarEmail','atualizarSenha'];
    }




}