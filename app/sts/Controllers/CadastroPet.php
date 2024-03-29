<?php

namespace Sts\Controllers;

if (!defined('D7E4T2K6F4')) {
    $header = "http://localhost/Clinica/Erro?case=404"; // Erro 404
    header("Location: {$header}");
}

include_once 'app/sts/Controllers/helpers/protect.php';

class CadastroPet
{

    private array|null $data = null;
    private array|null $dataForm;
    private string|null $whichForm = "PetType";

    
    public function index()
    {
        $this->cadastro();
    }


    /**     function cadastro()
     * Chamda pela UrlController
     * Responsavel por carregar e pegar as informações de dois formularios
     *      diferentes da view sobreCliente
     */
    public function cadastro(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        // se for enviado o formulário de qual a raça do pet
        if(isset($this->dataForm['PetType']))
        {
            unset($this->dataForm['PetType']);
            $tipoAnimal = $this->dataForm['animal'];

            $stsPet = new \Sts\Models\StsCadastroPet();
            $this->data = $stsPet->dataPet($tipoAnimal); 

            $this->whichForm = "CreatePet";

            $loadView = new \Core\LoadView('sts/Views/bodys/cadastroPet/cadastroPet', $this->data, $this->whichForm);
            $loadView->loadView_header('cadastroPet/cadastroPetH');
        }

        // se for enviado o formulário de cadastro do pet
        elseif(isset($this->dataForm['CreatePet']))
        {
            unset($this->dataForm['CreatePet']);

            $this->dataForm['nome_pet'] = ucwords(strtolower($this->dataForm['nome_pet'])); 

            $stsPet = new \Sts\Models\StsCadastroPet();
            $result = $stsPet->createPet($this->dataForm);

            if(!empty($result)){
                $_SESSION['msgGreen'] = "Pet Cadastrado com sucesso.";
            }else{ 
                $_SESSION['msgRed'] = "Falha ao cadastrar pet, tente novamente mais tarde.";
            }

            $header = URL . "SobreCliente/Dados";
            header("Location: {$header}");

        }else{
            $loadView = new \Core\LoadView('sts/Views/bodys/cadastroPet/cadastroPet', $this->data, $this->whichForm);
            $loadView->loadView_header('cadastroPet/cadastroPetH');
        }
    }



    /**     function pages()
     * Function que todas as controller tem
     * Retorna as functions que são publicas nessa controller
     */
    public function pages(): array
    {  
        return $array = ['index', 'cadastro'];
    }
}

?>

