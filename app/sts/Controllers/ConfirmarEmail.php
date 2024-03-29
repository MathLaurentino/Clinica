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

                $idUser = $stsKey->getIdUser($chave);
    
                if (!empty($idUser)){
    
                    $this->data['sit_usuario'] = "Ativo";
                    $this->data['chave'] = NULL;

                    if ($stsKey->alterDataUsuario($idUser, $this->data)) {
                        $_SESSION['msgGreen'] = "Email confirmado com sucesso";
                    } else {
                        $_SESSION['msgRed'] = "Falha ao confirmar Email";  
                    }

                    $header = URL . "Login";
                    header("Location: {$header}");
    
                } else {
                    $_SESSION['msgRed'] = "Chave de confirmação invalida";
                    $header = URL . "Home";
                    header("Location: {$header}");
                }

            } elseif ($userSituation == "Inativo") {

                $_SESSION['msgRed'] = "Lamentamos, mas essa conta foi bloqueada!";
                $header = URL . "Login";
                header("Location: {$header}");

            } elseif ($userSituation == "Ativo") {

                $_SESSION['msgGreen'] = "Conta já está ativa!";
                $header = URL . "Login";
                header("Location: {$header}");

            } else { // caso chave não tenha registro no BD
                $_SESSION['msgRed'] = "Chave de ativação incorreta!";
                $header = URL . "Home";
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
    public function informarEmail()
    {
        
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        /** Se o formulário com o email foi enviado */
        if (isset($this->dataForm['send'])) {

            $stsEmail = new \Sts\Models\StsConfirmarEmail();
            /** Se o email realmente existir */
            $idUser = $stsEmail->verifyIfEmailExist($this->dataForm['email']);
            if (!empty($idUser)){

                $idUsuario = $idUser[0]['idusuario'];

                $stsKey = new \Sts\Models\StsConfirmarEmail();
                $userSituation = $stsKey->getSituation("email", $this->dataForm['email']);

                if ($userSituation == "Confirmando") {

                    $key = password_hash($this->dataForm['email'] . date("Y-m-d H:i:s"), PASSWORD_DEFAULT);
                    $sit = array('chave' => $key);

                    if ($stsKey->alterDataUsuario($idUsuario, $sit)) {
                        $this->reenviarEmail($this->dataForm['email'], $key);
                    } else {
                        $_SESSION['msgRed'] = "Falha ao reenviar email!";
                        $header = URL . "Login";
                        header("Location: {$header}");
                    }
   
                } elseif ($userSituation == "Inativo") {

                    $_SESSION['msgRed'] = "Lamentamos, mas essa conta foi bloqueada!";
                    $header = URL . "Login";
                    header("Location: {$header}");
    
                } elseif ($userSituation == "Ativo") {
    
                    $_SESSION['msg'] = "Conta já está ativa!";
                    $header = URL . "Login";
                    header("Location: {$header}");
    
                }

            } else {
                $_SESSION['msgRed'] = "Email informado é inválido";
                $this->data['email'] = $this->dataForm['email'];
                $loadView = new \Core\LoadView("sts/Views/bodys/sendEmail/sendEmail", $this->data, null);
                $loadView->loadView_header("sendEmail/sendEmailH");
            }

        } else {
            $loadView = new \Core\LoadView("sts/Views/bodys/sendEmail/sendEmail", null, null);
            $loadView->loadView_header("sendEmail/sendEmailH");
        }
         
    }



    /**
     * Reenvia o email de ativação de conta 
     */
    private function reenviarEmail($email, $chave)
    {

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
            $mail->Subject = 'Confirma o e-mail';
            $mail->Body    = "Prezado(a) Cliente.<br><br>Agradecemos a sua solicitação de cadastramento em nosso site!<br><br>Para que possamos confirmar o seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicanco no link abaixo: <br><br> <a href='http://localhost/Clinica/ConfirmarEmail?chave=$chave'>Clique aqui</a><br><br>Esta mensagem foi enviada a você pela empresa Clínica Veterinária.<br>Você está recebendo porque está cadastrado no banco de dados da empresa Clínica Veterinária. Nenhum e-mail enviado pela empresa Clínica Veterinária tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.<br><br>" ;
            $mail->AltBody = "Prezado(a) Cliente.\n\nAgradecemos a sua solicitação de cadastramento em nosso site!\n\nPara que possamos confirmar o seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicanco no link abaixo: \n\n http://localhost/Clinica/ConfirmarEmail?chave=$chave \n\nEsta mensagem foi enviada a você pela empresa Clínica Veterinária.\nVocê está recebendo porque está cadastrado no banco de dados da empresa Clínica Veterinária. Nenhum e-mail enviado pela empresa Clínica Veterinária tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.\n\n";

            $mail->send();

            $_SESSION['msgGreen'] = "Chave reenviada com sucesso! Confirme seu Email para acessar sua conta";
            $header = URL . "Login/Usuario";
            header("Location: {$header}");

        } catch (Exception $e) {
            $_SESSION['msgRed'] = "Falha ao reenviar email, tente novamente mais tarde!";
            $header = URL . "ConfirmarEmail/reenviarEmail!";
            header("Location: {$header}");
        }
    }



    /**     function pages()
     * Retorna os métodos publicos da classe
     */
    public function pages(): array
    {  
        return $array = ['index', 'verificarChave', 'informarEmail'];
    }

}

?>