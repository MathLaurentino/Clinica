<?php

    if(!isset($_SESSION)){
        session_start();
    }
    if(isset($_SESSION['msg']))
    {
        echo "Mensagem: " . $_SESSION['msg'] . "<br>"; 
        unset($_SESSION['msg']);   
    }

    if(isset($this->data)){
        extract($this->data['user'][0]);
    }

?>


    <h2> Dados da Conta</h2>

    <?php

        if (!empty($_SESSION['foto_usuario'])) {  

            echo "<img height='100' src= '../". IMG . $_SESSION['foto_usuario'] ." '> <br> <br>";

        } else { 
            
            echo "<img height='100' src= ' ../". IMGERRO ." '> <br> <br>";
            echo "<a href='" . URL . "FotoPerfil/usuario'> Foto de Perfil </a> <br>";

        }

        echo "Nome: "; if(isset($nome_usuario)) {echo "$nome_usuario";} 
        echo "<br>";
        echo "Data de Nas.: "; if(isset($data_nascimento)) {echo "$data_nascimento";}
        echo "<br>";
        echo "Email: "; if(isset($email)) {echo "$email";} else {echo "vazio";} 
        echo "<br>";
        echo "CPF: "; if(isset($cpf)) {echo "$cpf";} else {echo "vazio";}
        echo "<br>";
        echo "RG: "; if(isset($rg)) {echo "$rg";} else {echo "vazio";}
        echo "<br> <a href='" . URL . "Sobre-Cliente/Alterar-Dados'> Alterar Dados </a> <br>";
        



        // -------------------------------------------------------------------------------------------------------------------



        
        echo "<br> <h2> Endereço </h2>";

        if (isset($_SESSION['idendereco'])) {

            extract($this->data['adress'][0]);

            echo "Nome da Rua: "; if(isset($cep)) {echo "$cep";} else {echo "vazio";}
            echo "<br>";
            echo "Número da Residência: "; if(isset($numero_residencial)) {echo "$numero_residencial";} else {echo "vazio";}
            echo "<br>";
            echo "Cidade: "; if(isset($cidade)) {echo "$cidade";} else {echo "vazio";}
            echo "<br>";
            echo "Estado: "; if(isset($estado)) {echo "$estado";} else {echo "vazio";}
            echo "<br>";
            echo "CEP: "; if(isset($cep)) {echo "$cep";} else {echo "vazio";}
            echo "<br> <a href='" . URL . "Sobre-Cliente/Alterar-Dados-Endereco'> Alterar Dados </a> <br>";

        } else {

            echo "Você ainda não tem um endereço cadastrado <br>";
            echo "<br> <a href='" . URL . "Cadastro/Endereco'> Ir Cadastrar Endereço </a> <br>";

        }

        


        // -------------------------------------------------------------------------------------------------------------------



        
        echo "<br> <h2> Pets </h2>";
        if (isset($this->data['pet'])) {

            for ($x = 0; $x < count($this->data['pet']); $x++) {

                $pet = $this->data['pet'][$x];
                extract($pet);
                echo "<hr>";
                echo "id: " . $idpet . "<br>";
                echo "Nome: "; if(isset($nome_pet)) { echo $nome_pet; } else { echo "vazio"; }
                echo "<br>";
                echo "Idade: "; if(isset($idade_pet)) {echo $idade_pet; } else {echo "vazio";}
                echo "<br>";
                echo "Sexo: "; if(isset($sexo)) {echo $sexo;} else {echo "vazio";}
                echo "<br>";
                echo "Raça: "; if(isset($raca)) {echo $raca;} else {echo "vazio";}
                echo "<br>";
                echo "Espécie: "; if(isset($tipo_pet)) {echo $tipo_pet;} else {echo "vazio";}
                echo "<br> <a href='" . URL . "Sobre-Cliente/Alterar-Dados-Pet?id={$idpet}'> Alterar Dados </a> <br>";

            }

        } else {

            echo "Você ainda não tem nunhum PET cadastrado <br>";
            echo "<br> <a href='" . URL . "cadastroPet'> Ir Cadastrar PET </a> <br>";

        }
        
    ?>
