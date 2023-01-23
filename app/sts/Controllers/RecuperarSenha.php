<?php

namespace Sts\Controllers;

if (!defined('D7E4T2K6F4')) {
    $header = "http://localhost/Clinica/Erro?case=404"; // Erro 404
    header("Location: {$header}");
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

        /** Se o formulário com o email foi enviado */
        if (isset($this->dataForm['send'])) {

            unset($this->dataForm['send']);

            $stsSenha = new \Sts\Models\StsRecuperarSenha();

            $userData = $stsSenha->getUserData($this->dataForm['email']);
            $idUser = $userData[0]['idusuario'];

            if ($userData) {
                
                $this->data['recuperar_senha'] = password_hash($idUser, PASSWORD_DEFAULT);

                if ($stsSenha->alterUserData($idUser, $this->data)) {

                    $this->enviarEmailSenha($this->dataForm['email'], $this->data['recuperar_senha']);

                } else {

                    $_SESSION['msgRed'] = "Falha ao gerar chave!";
                    $header = URL . "RecuperarSenha/Informar-Email";
                    header("Location: {$header}");

                }
                
            } else {
                $_SESSION['msgRed'] = "Email informado é inválido!";
                $this->data['email'] = $this->dataForm['email'];

                $header = URL . "RecuperarSenha/Informar-Email";
                header("Location: {$header}");
            }

        } else {
            $loadView = new \Core\LoadView("sts/Views/bodys/novaSenha/novaSenha", null, null);
            $loadView->loadView_header("novaSenha/novaSenhaH");
        }
        
    }



    public function atualizarSenha()
    {
        $chave = filter_input(INPUT_GET, "chave", FILTER_SANITIZE_STRING);
    }



    /**
     * Reenvia o email de ativação de conta 
     */
    private function enviarEmailSenha($emailUser, $key)
    {
        $email = $emailUser; 
        $chave = $key;
        
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

            $_SESSION['msgGreen'] = "Email para redefinição de senha enviado com sucesso";
            $header = URL . "Login/Usuario";
            header("Location: {$header}");

        } catch (Exception $e) {
            $_SESSION['msgRed'] = "Falha ao reenviar email de redefifição de senha, tente novamente mais tarde!";
            $header = URL . "Login/usuario!";
            header("Location: {$header}");
        }
    }



    /**     function pages()
     * Retorna as functions que são publicas nessa controller
     */
    public function pages(): array
    {  
        return $array = ['index','informarEmail'];
    }




}