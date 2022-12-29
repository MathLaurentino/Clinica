<?php

namespace App\Adms\Controllers;

if (!defined('D7E4T2K6F4')) {
    $header = "http://localhost/Clinica/Erro?case=404"; // Erro 404
    header("Location: {$header}");
}

class Login
{

    private array|null $dataForm = null;
    private array $data;

    /**     function index()
     * Método padrão das classes controllers
     */
    public function index(): void
    {        
        $this->setLogin();
    }


    
    /**     function setLogin()
     * Carrega a view, pega as infromações do usuario e 
     *      verifica se ele já esta logado
     */
    private function setLogin(): void
    {
        
        if(!isset($_SESSION)){
            session_start();
        }
        
        // se o usuário já esta logado
        if (isset($_SESSION['tipo_usuario'])) {

            if ($_SESSION['tipo_usuario'] == 'cliente') {
                $_SESSION['msg'] = "Não é possivel fazer login como administrador";
                $header = URL . "Home";
                header("Location: {$header}");
            } elseif ($_SESSION['tipo_usuario'] == 'mantenedor') {
                $_SESSION['msg'] = "Você já esta logado como mantenedor";
                $header = URLADM . "Home";
                header("Location: {$header}");
            }   

        } else {
            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if (isset($this->dataForm['AddContMsg'])) { // se respondeu o formulário
                unset($this->dataForm['AddContMsg']);
                var_dump($this->dataForm);
                $this->createLogin();
            } else { // carrega a view
                $loadView = new \Core\LoadView('adms/Views/bodys/login/login', null, null);
                $loadView->loadViewAdm();
            }
        }
        
        
    }



    /**     function createLogin()
     * Chamado pelo método da classe index();
     * Responsavel por verificar se o email e senha do cliente existe no
     *      banco de dados. Faz isso por meio de um OBJ admsLogin;
     * A senha está criptografada, por isso a função password_verify()
     * Se existir uma conta com as informações passadas, o usuario é 
     *      redirecionado para a tela home, se não permanece na tela login.
     */
    private function createLogin(): void
    {

        $admsLogin = new \Adms\Models\AdmsLogin();
        $result = $admsLogin->login($this->dataForm);

        if (!empty($result)) { // se a conta existir
            $this->data = $result[0];
            extract($this->data);

            if ( password_verify($this->dataForm['senha_usuario'], $senha_usuario) ) { // se a senha estiver correta

                if ($tipo_usuario == "mantenedor") { // se a conta for de mantenedor
                    $this->sessionVars();
                    $header = URLADM . "Home";
                    header("Location: {$header}");
                } else { // se a conta for de cliente
                    $_SESSION['msg'] = "Essa conta não possui registro como ADM";
                    $header = URLADM . "Login";
                    header("Location: {$header}");
                }
    
            } else { // se a senha estiver errada 
                $_SESSION['msg'] = "Email ou senha incorreta2";
                $header = URLADM . "Login";
                header("Location: {$header}");
            }

        } else { // se não existir conta
            $_SESSION['msg'] = "Email ou senha incorreta3";
            $header = URLADM . "Login";
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
        $_SESSION['idendereco'] = $endereco; //enderecoUsuario

        $_SESSION['msg'] = "Login realizado com sucesso";
    }
}
?>