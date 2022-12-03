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
    private string|null $whichForm = null;

    private string|null $tipoAnimal;
    private string|null $result;
    

    /**     function index()
     * Chamda pela UrlController
     * Responsavel por carregar e pegar as informações de dois formularios
     *      diferentes da view sobreCliente
     */
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $this->whichForm = "PetType";

        if(isset($this->dataForm['PetType']))
        {
            unset($this->dataForm['PetType']);

            $this->tipoAnimal = $this->dataForm['animal'];
            $this->getDataPet();

            $this->whichForm = "CreatePet";
            $this->view();
        }

        elseif(isset($this->dataForm['CreatePet']))
        {
            unset($this->dataForm['CreatePet']);
            
            $this->createNewPet();

            if(!empty($this->result)){
                $_SESSION['msg'] = "Pet Cadastrado com sucesso";
                $header = URL . "Home";
                header("Location: {$header}");
            }else{ // erro 003
                $header = URL . "Erro?case=3";
                header("Location: {$header}");
            }
        }else{
            $this->view();
        }
    }



    /**     function getDataPet()
     * Function para pegar os dados da tabela tipo_pet 
     *      por meio de um OBJ StsCadastroPet
     */
    private function getDataPet(): void
    {
        $stsPet = new \Sts\Models\StsCadastroPet();
        $this->data = $stsPet->dataPet($this->tipoAnimal); 
    }



    /**     function createNewPet()
     *Function para criar no pet por meio de um OBJ StsCadastroPet
     */
    private function createNewPet()
    {
        $stsPet = new \Sts\Models\StsCadastroPet();
        $this->result = $stsPet->createPet($this->dataForm);
    }   



    /**     function view()
     * Function para carregar a view cadastroPet 
     *      por meio de um OBJ LoadView
     */
    private function view(): void
    {
        $loadView = new \Core\LoadView('sts/Views/cadastroPet', $this->data, $this->whichForm);
        $loadView->loadView();
    }



    /**     function pages()
     * Function que todas as controller tem
     * Retorna as functions que são publicas nessa controller
     */
    public function pages(): array
    {  
        return $array = ['index'];
    }
}

?>

