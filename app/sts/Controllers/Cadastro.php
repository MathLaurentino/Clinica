<?php

namespace Sts\Controllers;



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



    // -----------------------------------------------------------------------------------------    



    /**     function index()
     * Primeiramente carrega a views cadastro por meio do OBJ de LoadView
     * Recebe os daddos mandados pelo cliente pelo médodo post e depois
     *      chama o mérodo da classe checkIfAccountExist
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

            /* se os dados estiverem corretos ele chama o checkIfAccountExist
                se não ele carrega a view novamente informando o que está errado */
            // if ($this->checkData()) {
            //     $this->checkIfAccountExist();  
            // } else {
            //     $this->view(); 
            // }
            $this->checkIfAccountExist(); 
            
        } else {   
            $this->data=[];
            $loadView = new \Core\LoadView("sts/Views/cadastros/Cadastrocliente", $this->data, null);
            $loadView->loadView();
        }

    }


    /**     function checkIfAccountExist()
     * Verifica se a conta com dados do CPF, RG ou Email fornecidos pelo
     *      cliente já existem no banco de dados
     * Faz isso por meio do OBJ de StsCadastro
     */
    private function checkIfAccountExist(): void
    {
        $stsCadastro = new \Sts\Models\StsCadastro();
        $resultVerify = $stsCadastro->verifyAccount($this->data);
        
        // caso não tenha registro no BD com os dados da $this->data
        if ($resultVerify == true) {
            $this->createNewAccount();
        } else {
            $_SESSION['msg'] = "<p style='color:red;'>Dados fornecidos já possuem cadastro no sistema. Tente com outros dados</p>";
            $this->view();
        }
    }



    /**     function createNewAccount()
     * Cria um novo usuário inserindo os dados passados pelo cliente no BD
     * Faz isso por meio de um OBJ de stsCadastro
     */
    private function createNewAccount()
    {   
        $this->data['senha_usuario'] = password_hash($this->data['senha_usuario'], PASSWORD_DEFAULT);

        $stsCadastro = new \Sts\Models\StsCadastro();
        $idUsuario = $stsCadastro->createAccount($this->data);
        
        if(!empty($idUsuario))
        {
            $_SESSION['msg'] = "<p style='color:green;'>Usuario cadastrado com sucesso</p>";
            $header = URL . "Login";
            header("Location: {$header}");
        }else
        {   
            $header = URL . "Erro?case=2"; // Erro 002
            header("Location: {$header}");
        }    
    }



    private function checkData(): bool
    {
        $metodos = new \Sts\Controllers\helpers\Metodos();

        if (!$metodos->verifyCpf($this->data['cpf'])) {
            $_SESSION['msg'] = "CPF Incorreto";  
            return false; 
        } 
        elseif (!$metodos->verifyAge($this->data['data_nascimento'])) {
            $_SESSION['msg'] = "Menor de Idade";
            return false;
        }
        elseif (!$metodos->verifyEmail($this->data['email'])) {
            $_SESSION['msg'] = "Email Invalido";
            return false;
        }
        else {
            return true;
        }

    }

    

    // ----------------------------------------------------------------------------------------- 



    /**     function endereco()
     * Carrega a tela cadastroEndereco.php e cadastra os dados 
     *      referentes ao endereço do usuario
     */
    public function endereco()
    {
        if (!isset($_SESSION)) 
            session_start();

        if (!isset($_SESSION['idendereco']) && isset($_SESSION['idusuario'])) {
            //pega os dados do método post
            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if (!empty($this->dataForm['createAdress'])) {
                unset($this->dataForm['createAdress']);
                $this->data = $this->dataForm;
                $this->createEndereco();
            } else {
                $this->data=[];
                $loadView = new \Core\LoadView("sts/Views/cadastros/cadastroEndereco", $this->data, null);
                $loadView->loadView();
            }
        } elseif (isset($_SESSION['idendereco'])) {
            $header = URL . "Erro?case=11"; // Erro 011
            header("Location: {$header}");
        } elseif (!isset($_SESSION['idusuario'])) {
            $header = URL . "Erro?case=12"; // Erro 012
            header("Location: {$header}");
        }

    }



    private function createEndereco(): void
    {
        $stsCreate= new \Sts\Models\StsCadastro();
        $idEndereco= $stsCreate->createAdress($this->data);
        if (!empty($idEndereco)) {
            $_SESSION['idendereco'] = $idEndereco;
            $header = URL . "Home"; 
            header("Location: {$header}");
        } else {
            $header = URL . "Erro?case=8"; // Erro 008
            header("Location: {$header}");
        }
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
        $loadView = new \Core\LoadView("sts/Views/cadastros/Cadastrocliente", $this->data, null);
        $loadView->loadView();
    }
        


    /**     function pages()
     * Retorna as functions que são publicas nessa controller
     * Chamado pelo LoadView();
     */
    public function pages(): array
    {  
        return $array = ['index','usuario','endereco'];
    }
 
}

?>