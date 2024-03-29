<?php

namespace Sts\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (!defined('D7E4T2K6F4')) {
    $header = "http://localhost/Clinica/Erro?case=404"; // Erro 404
    header("Location: {$header}");
}

include_once 'app/sts/Controllers/helpers/protectLogin.php';

/**     class Cadastro
 * Responsavel por realizar o cadastro dos dados pessoas do cliente
 *      e também pelos dados do endereço
 * Tem duas functions principais, a function usuario() e a function endereco()
 *      sendo cada uma delas responsavel por carregar telas e cadastrar dados diferentes
 */
class Cadastro{

    private array|string|null $data = null;
    private array|string|null $dataForm;


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

            // se os dados não estão informados corretamente (cpf, idade ou email)
            if (!$stsVeriry->verifyCpf($this->data['cpf']) || !$stsVeriry->verifyAge($this->data['data_nascimento']) || !$stsVeriry->verifyEmail($this->data['email']) || !$stsVeriry->verifyRg($this->data['rg'])) { 

                $this->view();

            } else {

                $stsCadastro = new \Sts\Models\StsCadastro();

                if ($stsCadastro->verifyAccount($this->data)) {

                    if ($this->createNewAccount()) {

                        $mail = new PHPMailer(true);
                        $chave = $this->data['chave'];

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
                            $mail->addAddress($this->dataForm['email'], $this->dataForm['nome_usuario']);
            
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->Subject = 'Confirma o e-mail';
                            $mail->Body    = "Prezado(a) " . $this->dataForm['nome_usuario'] . ".<br><br>Agradecemos a sua solicitação de cadastramento em nosso site!<br><br>Para que possamos confirmar o seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicanco no link abaixo: <br><br> <a href='http://localhost/Clinica/ConfirmarEmail?chave=$chave'>Clique aqui</a><br><br>Esta mensagem foi enviada a você pela empresa Clínica Veterinária.<br>Você está recebendo porque está cadastrado no banco de dados da empresa Clínica Veterinária. Nenhum e-mail enviado pela empresa Clínica Veterinária tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.<br><br>" ;
                            $mail->AltBody = "Prezado(a) " . $this->dataForm['nome_usuario'] . ".\n\nAgradecemos a sua solicitação de cadastramento em nosso site!\n\nPara que possamos confirmar o seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicanco no link abaixo: \n\n http://localhost/Clinica/ConfirmarEmail?chave=$chave \n\nEsta mensagem foi enviada a você pela empresa Clínica Veterinária.\nVocê está recebendo porque está cadastrado no banco de dados da empresa Clínica Veterinária. Nenhum e-mail enviado pela empresa Clínica Veterinária tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.\n\n";
            
                            $mail->send();

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
                    $_SESSION['msgRed'] = "Dados fornecidos já possuem cadastro no sistema. Tente com outros dados";
                    $this->view();
                } 

            }
            

        } else {   
            $this->data=null;
            $this->view();
        }

    }



    /**     function createNewAccount()
     * Cria um novo usuário inserindo os dados passados pelo cliente no BD
     */
    private function createNewAccount(): bool
    {   
        // criptografia de senha
        $this->data['senha_usuario'] = password_hash($this->data['senha_usuario'], PASSWORD_DEFAULT);
        // primeiras letras para maiusculo
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


    private function view(): void
    {
        $loadView = new \Core\LoadView("sts/Views/bodys/cadastros/cadastro_cliente", $this->data, null);
        $loadView->loadView_header("cadastros/cadastro_clienteH");
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