<?php

namespace Sts\Controllers;

class Erro{

    //recebe a descrição do erro
    private array $data;
    private string|int $case = 0;

    public function index(){
        
        if(!isset($_SESSION)){
            session_start();
        } 
        if(isset($_GET['case'])){
            $this->case = $_GET['case'];
        }
        
        switch ($this->case) {
            case 0 :
                $this->data['numeroErro'] = "000";
                $this->data['descricaoErro'] = "Página não encontrada";
                $this->data['botao'] = "Home";
                $this->data['descricaoBotao'] = "Ir para a HOME";
                break;
            case 1:
                $this->data['numeroErro'] = "001";
                $this->data['descricaoErro'] = "Erro ao cadastrar novo usuario, entre em contato conosco no nosso email: " . EMAILADM;
                $this->data['botao'] = "Home";
                $this->data['descricaoBotao'] = "Ir para a HOME";
                break;
            case 2:
                $this->data['numeroErro'] = "002";
                $this->data['descricaoErro'] =  "Você já está logado, para cadastrar ou logar com outra conta é necessario fazer logout";
                $this->data['botao'] = "Home";
                $this->data['descricaoBotao'] = "Ir para a HOME";
                break;
            case 3:
                $this->data['numeroErro'] = "003";
                $this->data['descricaoErro'] =  "Erro ao cadastrar novo pet, entre em contato com o ADM: " . EMAILADM;
                $this->data['botao'] = "Cadastro-Pet";
                $this->data['descricaoBotao'] = "Voltar para tela de Cadastro Pet";
                break;
            case 4:
                $this->data['numeroErro'] = "004";
                $this->data['descricaoErro'] =  "Erro ao alterar dados do usuario, tente novamente ou entre em contato com o ADM: " . EMAILADM;
                $this->data['botao'] = "Sobre-Cliente/alterar-Dados";
                $this->data['descricaoBotao'] = "Voltar para tela de Sobre Cliente";
                break;
            case 5:
                $this->data['numeroErro'] = "005";
                $this->data['descricaoErro'] =  "Erro ao alterar dados do endereço, tente novamente ou entre em contato com o ADM: " . EMAILADM;
                $this->data['botao'] = "Sobre-Cliente/Alterar-Dados-Endereco";
                $this->data['descricaoBotao'] = "Voltar para tela de Sobre Cliente";
                break;
            case 6:
                $this->data['numeroErro'] = "006";
                $this->data['descricaoErro'] =  "Erro ao alterar dados do pet, tente novamente ou entre em contato com o ADM: " . EMAILADM;
                $this->data['botao'] = "Sobre-Cliente/Alterar-Dados-Pet";
                $this->data['descricaoBotao'] = "Voltar para tela de Sobre Cliente";
                break;
            case 7:
                $this->data['numeroErro'] = "007";
                $this->data['descricaoErro']  = "Não é possível acessar essa página pois você não está logado";
                $this->data['botao'] = "Login/Usuario";
                $this->data['descricaoBotao'] = "Realizar Login";
                break;
            case 8:
                $this->data['numeroErro'] = "008";
                $this->data['descricaoErro']  = "Erro ao cadastrar endereço, entre em contato conosco no nosso email: " . EMAILADM;
                $this->data['botao'] = "Cadastro/Endereco";
                $this->data['descricaoBotao'] = "Voltar a tela de Cadastro";
                break;
            case 9:
                $this->data['numeroErro'] = "009";
                $this->data['descricaoErro']  = "Pagina não encontrada";
                $this->data['botao'] = "Sobre-Cliente/Dados";
                $this->data['descricaoBotao'] = "Ir para a tela de Dados Pessoais";
                break;
            case 10:
                $this->data['numeroErro'] = "010";
                $this->data['descricaoErro']  = "Você não pode alterar os dados do endereço antes de cadastralo";
                $this->data['botao'] = "Cadastro/Endereco";
                $this->data['descricaoBotao'] = "Ir para a tela de Cadastro de Endereço";
                break;
            case 11:
                $this->data['numeroErro'] = "011";
                $this->data['descricaoErro']  = "Você não pode cadastrar um endereço pois ele já está cadastrado em sua conta";
                $this->data['botao'] = "Sobre-Cliente/Alterar-Dados-Endereco";
                $this->data['descricaoBotao'] = "Ir para a tela de Alterar Endereço";
                break;
            case 12:
                $this->data['numeroErro'] = "012";
                $this->data['descricaoErro']  = "Você não pode alterar um endereço sem antes realizar o login";
                $this->data['botao'] = "Login/Usuario";
                $this->data['descricaoBotao'] = "Ir para a tela de Login";
                break;
            case 13:
                $this->data['numeroErro'] = "013";
                $this->data['descricaoErro']  = "Falha ao salvar nova foto, entre em contato conosco no nosso email: " . EMAILADM;
                $this->data['botao'] = "Home";
                $this->data['descricaoBotao'] = "Ir para a Home";
                break;
            case 14:
                $this->data['numeroErro'] = "014";
                $this->data['descricaoErro']  = "Você não pode acessar a página de cadastro de foto pois você ja tem uma foto de perfil";
                $this->data['botao'] = "Home";
                $this->data['descricaoBotao'] = "Ir para a Home";
                break;
            case 15:
                $this->data['numeroErro'] = "015";
                $this->data['descricaoErro']  = "Você não pode acessar a página de alterar foto pois você não tem uma foto de perfil";
                $this->data['botao'] = "Home";
                $this->data['descricaoBotao'] = "Ir para a Home";
                break;
            case 16:
                $this->data['numeroErro'] = "016";
                $this->data['descricaoErro']  = "Você não pode apagar a foto pois você não tem uma foto de perfil";
                $this->data['botao'] = "SobreCliente/Dados";
                $this->data['descricaoBotao'] = "Ir para a Sobre Cliente";
                break;
            case 17:
                $this->data['numeroErro'] = "017";
                $this->data['descricaoErro']  = "Você não pode acessar a pagina de adicionar foto pois ja tem uma foto adicionada";
                $this->data['botao'] = "SobreCliente/Dados";
                $this->data['descricaoBotao'] = "Ir para a Sobre Cliente";
                break;
            case 18:
                $this->data['numeroErro'] = "018";
                $this->data['descricaoErro']  = "Você não pode acessar a pagina de alterar foto pois ainda não tem uma foto cadastrada";
                $this->data['botao'] = "SobreCliente/Dados";
                $this->data['descricaoBotao'] = "Ir para a Sobre Cliente";
                break;
            case 19:
                $this->data['numeroErro'] = "019";
                $this->data['descricaoErro']  = "Você não pode apagar a foto pois ainda não tem uma foto cadastrada";
                $this->data['botao'] = "SobreCliente/Dados";
                $this->data['descricaoBotao'] = "Ir para a Sobre Cliente";
                break;
            case 20:
                $this->data['numeroErro'] = "020";
                $this->data['descricaoErro']  = "Id do pet fornecido não pertence a sua conta";
                $this->data['botao'] = "SobreCliente/Dados";
                $this->data['descricaoBotao'] = "Ir para a Sobre Cliente";
                break;
            case 21:
                $this->data['numeroErro'] = "021";
                $this->data['descricaoErro']  = "Você já está logado e por isso não pode acessar essa página";
                $this->data['botao'] = "Home";
                $this->data['descricaoBotao'] = "Ir para a Home";
                break;
            case 404:
                $this->data['numeroErro'] = "404";
                $this->data['descricaoErro']  = "Página não encontrada";
                $this->data['botao'] = "Home";
                $this->data['descricaoBotao'] = "Ir para Home";
                break;

        }

        $loadView = new \Core\LoadView("sts/Views/bodys/erro/erro", $this->data, null);
        $loadView->loadView_header2();

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