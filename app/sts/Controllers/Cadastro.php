<?php

namespace Sts\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (!defined('D7E4T2K6F4')) {
    $header = "http://localhost/Clinica/Erro?case=404"; // Erro 404
    header("Location: {$header}");
}

/**     class Cadastro
 * Responsavel por realizar o cadastro dos dados pessoas do cliente
 *      e também pelos dados do endereço
 * Tem duas functions principais, a function usuario() e a function endereco()
 *      sendo cada uma delas responsavel por carregar telas e cadastrar dados diferentes
 */
class Cadastro{

    private array|string|null $data = [];
    private array|string|null $dataForm;

    private array|null $dataFile = null;
    private string|null $path = null;

    private object $stsCadastro;


    /**     function index()
     * Chama a function padão da classe
     */
    public function index(): void
    {      
        $this->usuario();
    }
   

    /**     function usuario()
     * Primeiramente carrega a views cadastro por meio do OBJ de LoadView
     * Recebe os dados mandados pelo cliente pelo médodo post e depois
     *      chama o método da classe checkIfAccountExist
     * Ela é responsavel por cadastrar apenas os dados de
     *      - nome, email, senha, cpf, rg e data de nascimento
     */
    public function usuario()
    {
        $this->checkSession();
        
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($this->dataForm['createAccount'])) {

            unset($this->dataForm['createAccount']);
            $this->data = $this->dataForm;
            
            $stsVeriry = new \Sts\Models\helpers\StsVerifyRegistrationData();

            // se os dados não estão informados corretamente
            if (!$stsVeriry->verifyCpf($this->data['cpf']) || !$stsVeriry->verifyAge($this->data['data_nascimento']) || !$stsVeriry->verifyEmail($this->data['email'])) { 

                $this->view();

            } else {

                if ($this->checkIfAccountExist()) {

                    if ($this->createNewAccount()) {

                        $mail = new PHPMailer(true);
                        $chave = $this->data['chave'];

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
                            $_SESSION['msgGreen'] = "Usuario cadastrado com sucesso. Confirme seu Email para acessar sua conta";
                            $header = URL . "Home";
                            header("Location: {$header}");
            
                        } catch (Exception $e) {
                            echo "ERRO";
                        }

                    } else {
                        $header = URL . "Erro?case=2"; // Erro 002
                        header("Location: {$header}");
                    }
    
                } else {
                    $_SESSION['msgRed'] = "<p style='color:red;'>Dados fornecidos já possuem cadastro no sistema. Tente com outros dados</p>";
                    $this->view();
                } 

            }
            

        } else {   
            $this->data=[];
            $this->view();
        }

    }



    /**     function checkIfAccountExist()
     * Verifica se a conta com dados do CPF, RG ou Email fornecidos pelo
     *      cliente já existem no banco de dados
     */
    private function checkIfAccountExist(): bool
    {
        $stsCadastro = new \Sts\Models\StsCadastro();
        $resultVerify = $stsCadastro->verifyAccount($this->data);
        
        // retorna true caso não tenha registro no BD com esse email, rg ou cpf
        return $resultVerify; 
    }



    /**     function createNewAccount()
     * Cria um novo usuário inserindo os dados passados pelo cliente no BD
     */
    private function createNewAccount(): bool
    {   
        $this->data['senha_usuario'] = password_hash($this->data['senha_usuario'], PASSWORD_DEFAULT);
        $this->data['nome_usuario'] = ucwords(strtolower($this->data['nome_usuario']));
        
        $this->createKey();

        $stsCadastro = new \Sts\Models\StsCadastro();
        $idUsuario = $stsCadastro->createAccount($this->data);

        // se conseguir criar a conta corretamente
        if(!empty($idUsuario)) 
            return true;
        else
            return false;
    }


    /**     function createKey()
     * Cria uma chave unica de ativação para a conta
     * É uma função recursiva 
     */
    private function createKey()
    {
        //cria uma chave aleatória
        $key = password_hash($this->data['email'] . date("Y-m-d H:i:s"), PASSWORD_DEFAULT);

        $stsCadastro = new \Sts\Models\StsCadastro();
        if ($stsCadastro->verifyRepeatedKey($key))
            // se nenhuma conta tiver essa chave de ativação
            $this->data['chave'] = $key;
        else 
            $this->createKey();
    }



    // ---------------------------------------------------------------------



    /**     function checkSession()
     * Undocumented function
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


    private function view() 
    {
        $loadView = new \Core\LoadView("sts/Views/bodys/cadastros/cadastro_cliente", $this->data, null);
        $loadView->loadView_header3("cadastro_cliente");
    }
        


    /**     function pages()
     * Retorna as functions que são publicas nessa controller
     * Chamado pelo LoadView();
     */
    public function pages(): array
    {  
        return $array = ['index','usuario'];
    }
 
}

?>