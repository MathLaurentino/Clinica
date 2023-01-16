<?php

namespace Sts\Controllers;

include_once 'app/sts/Controllers/helpers/protectLogin.php';

if (!defined('D7E4T2K6F4')) {
    $header = "http://localhost/Clinica/Erro?case=404"; // Erro 404
    header("Location: {$header}");
}

class Login{
    
    // Recebe as informações do usuário
    private array|string|null $dataForm;
    // Recebe as informações do cliente vindas do BD
    private array|null $data = null;


    /**     function index()
     * Chama a function padão da classe
     */
    public function index(): void
    {
        $this->usuario();
    }



    /**     function index()
     * Método chamado pela UrlController;
     * Primeiro pode receber informações do formulario login, se receber
     *      chama o método da classe createLogin();
     * Responsável por carregar a tela login por meio de um OBJ LoadView.
     */
    public function usuario(): void
    {
        $this->checkSession();

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($this->dataForm['Login'])) { // se respondeu o formulário
            unset($this->dataForm['Login']);
            $this->createLogin();
        } else { // carrega a view
            $loadView = new \Core\LoadView('sts/Views/bodys/login/login', null, null);
            $loadView->loadView_header3('login');
        }

    }

    

    /**     function createLogin()
     * Chamado pelo método da classe usuario();
     * Responsavel por verificar se o email e senha do cliente existe no
     *      banco de dados. Faz isso por meio de um OBJ StsLogin;
     * A senha está criptografada, por isso a função password_verify()
     * Se existir uma conta com as informações passadas, o usuario é 
     *      redirecionado para a tela home, se não permanece na tela login.
     */
    private function createLogin(): void
    {
        $stsLogin = new \Sts\Models\StsLogin();
        $result = $stsLogin->login($this->dataForm);

        if (!empty($result)) {

            $senha = $result[0]['senha_usuario'];
            $sitUser = $result[0]['sit_usuario'];

            if (password_verify($this->dataForm['senha_usuario'], $senha)) { // se a senha estiver correta

                if ($sitUser == "Ativo") {
                    $this->data = $result[0];

                    if ($this->data['tipo_usuario'] == "cliente") { // se a conta for de cliente
                        $this->sessionVars(); 
                        $header = URL . "Home";
                        header("Location: {$header}");
                    } else { // se a conta for de mantenedor
                        //redireciona para a tela de login do adm
                        $header = URLADM . "Login";
                        header("Location: {$header}");
                    }

                } else {
                    $_SESSION['msg'] = "Email aguardando confirmação";
                    $header = URL . "Login";
                    header("Location: {$header}");
                }
                

            } else { // se a senha estiver errada 
                $_SESSION['msgRed'] = "Email ou senha incorreta";
                $header = URL . "Login";
                header("Location: {$header}");
            }

        } else { // se não existir conta
            $_SESSION['msgRed'] = "Email ou senha incorreta";
            $header = URL . "Login";
            header("Location: {$header}");
        }
        
    }



    /**     function sessionVars()
     * Responsavel por definir as variáveis da session
     */
    private function sessionVars(): void
    {
        extract($this->data);
        
        $_SESSION['idusuario'] = $idusuario; 
        $_SESSION['nome_usuario'] = $nome_usuario; 
        $_SESSION['tipo_usuario'] = $tipo_usuario; // cliente ou mantenedor
        $_SESSION['foto_usuario'] = $foto_usuario; // foto do usuário
        $_SESSION['email_usuario'] = $email;
        
        if (!empty($endereco)) 
            $_SESSION['idendereco'] = $endereco; //enderecoUsuario
        if (!empty ($foto_usuario)) 
            $_SESSION['foto_usuario'] = $foto_usuario; //fotoUsuario
        

        /* variavel global que ajuda na confirmaçõa de email
           depois do login já não é necessária */
        if (isset($_SESSION['email_para_verificar'])) 
            unset($_SESSION['email_para_verificar']);
        
        $_SESSION['msgGreen'] = "Login realizado com sucesso";
    }



    /**     function checkSession()
     * Verifica se a session já está ligada e também verifica se o 
     *      usuario ja está logado
     */
    public function checkSession(): void
    {
        if(!isset($_SESSION)){
            session_start();
        }

        if(isset($_SESSION['idusuario'])) // Erro 002
        {
            $header = URL . "Erro?case=2"; 
            header("Location: {$header}");
        } 
    }

    

    /**     function pages()
     * Retorna as functions que são publicas nessa controller
     */
    public function pages(): array
    {  
        return $array = ['index','usuario'];
    }
}