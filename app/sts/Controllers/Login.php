<?php

namespace Sts\Controllers;

class Login{
    
    // Recebe as informações do usuário
    private array|string|null $dataForm;
    // Recebe as informações do cliente vindas do BD
    private array|null $data = null;
    // OBJ da classe StsLogin
    private object $stsLogin;


    /**     function index()
     * Chama a function padão da classe
     */
    public function index(): void
    {
        $this->usuario();
    }



    /**     function pages()
     * Retorna as functions que são publicas nessa controller
     */
    public function pages(): array
    {  
        return $array = ['index','usuario'];
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
            $loadView = new \Core\LoadView('sts/Views/login', null, null);
            $loadView->loadView();
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
        $this->stsLogin = new \Sts\Models\StsLogin();
        $result = $this->stsLogin->login($this->dataForm);

        if(!empty($result))
        {
            $senha = $result[0]['senha_usuario'];

            if(password_verify($this->dataForm['senha_usuario'], $senha)) // se a senha estiver correta
            {
                $this->data = $result[0];

                if($this->data['tipo_usuario'] == "cliente"){ // se a conta for de cliente
                    $this->sessionVars(); 
                    $header = URL . "Home";
                    header("Location: {$header}");
                } else { // se a conta for de mantenedor
                    //redireciona para a tela de login do adm
                    $header = URLADM . "Login";
                    header("Location: {$header}");
                }

            } else { // se a senha estiver errada 
                $_SESSION['msg'] = "Email ou senha incorreta";
                $header = URL . "Login";
                header("Location: {$header}");
            }

        } else { // se não existir conta
            $_SESSION['msg'] = "Email ou senha incorreta";
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
        
        if (!empty($endereco)) 
            $_SESSION['idendereco'] = $endereco; //enderecoUsuario
        if (!empty ($foto_usuario)) 
            $_SESSION['foto_usuario'] = $foto_usuario; //fotoUsuario

        $_SESSION['msg'] = "Login realizado com sucesso";
    }



    /**     function checkSession()
     * Undocumented function
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
}