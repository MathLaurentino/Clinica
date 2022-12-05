<?php

namespace Sts\Controllers;

if (!defined('D7E4T2K6F4')) {
    $header = "http://localhost/Clinica/Erro?case=404"; // Erro 404
    header("Location: {$header}");
}

include_once 'app/sts/Controllers/helpers/protect.php';

class CadastroEndereco {


    private array|string|null $data = [];
    private array|string|null $dataForm;



    public function index()
    {
        $this->endereco();
    }


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
                $loadView->loadView_header('cadastro_endereco');
            }
        } elseif (isset($_SESSION['idendereco'])) {
            $header = URL . "Erro?case=11"; // Erro 011
            header("Location: {$header}");
        } elseif (!isset($_SESSION['idusuario'])) {
            $header = URL . "Erro?case=12"; // Erro 012
            header("Location: {$header}");
        }

    }



    /**
     * Undocumented function
     *
     */
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


    /**     function pages()
     * Retorna as functions que são publicas nessa controller
     * Chamado pelo LoadView();
     */
    public function pages(): array
    {  
        return $array = ['index','endereco'];
    }

}

?>