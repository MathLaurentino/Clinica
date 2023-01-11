

<?php

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['msg'])) {
    echo "Mensagem: " . $_SESSION['msg'] . "<br>"; 
    unset($_SESSION['msg']);   
}
if(isset($this->data)){
    extract($this->data['user'][0]);
}

?>

    <!--CONTEÚDO PRINCIPAL-->
    <main class="conteudo-principal"> 
        <h1 class="título">Área do Cliente</h1>

        <!--COLLAPSE BOOTSTRAP-->
        <div id="accordion">

            <div class="card">

                <div class="card-header" id="headingOne">

                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Informações Pessoais
                        </button>
                    </h5>
                    
                </div>
          
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">

                    <div class="card-body">
                    
                        <?php

                        if (isset($_SESSION['foto_usuario'])) {  

                            echo "<img height='100' src= '" . URL . IMG . $_SESSION['foto_usuario'] ." '> <br> <br> <hr>";
                            echo "<a href='" . URL . "FotoUsuario/alterar'> Alterar Foto de Perfil </a> <br> <br>";
                            echo "<a href='" . URL . "FotoUsuario/apagar'> Apagar Foto de Perfil </a> <br> <br> <hr> <br>";

                        } else { 
                            
                            echo "<img height='100' src= '". URL . IMGERRO ." '> <br> <br>";
                            echo "<a href='" . URL . "FotoUsuario/adicionar'> Adicionar Foto de Perfil </a> <br> <br> <hr> <br>";

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

                            echo "Nome da Rua: "; if(isset($rua)) {echo "$rua";} else {echo "vazio";}
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
                            echo "<br> <a href='" . URL . "CadastroEndereco/endereco'> Ir Cadastrar Endereço </a> <br>";

                        }




                        // -------------------------------------------------------------------------------------------------------------------




                        echo "<br> <h2> Pets </h2>";
                        if (isset($this->data['pet'])) {

                            for ($x = 0; $x < count($this->data['pet']); $x++) {

                                $pet = $this->data['pet'][$x];
                                extract($pet);
                                echo "<hr>";
                                echo "Foto: <br>"; 
                                
                                if(!empty($imagem_pet)) { 
                                    echo "<img height='100' src= '". URL . IMG . $imagem_pet ." '> <br> <br> "; 
                                } else {  
                                    if ($tipo_pet == "gato") { echo "<img height='100' src= '". URL . IMG ."Gato_Sem_Foto.jpg'> <br> <br>"; }
                                    elseif ($tipo_pet == "cachorro") { echo "<img height='100' src= '". URL . IMG ."Cachorro_Sem_Foto.png'> <br> <br>"; }
                                    elseif ($tipo_pet == "ave") { echo "<img height='100' src= '". URL . IMG ."Ave_Sem_Foto.png '> <br> <br>"; }
                                }

                                if (!empty($imagem_carteira_pet)) {
                                    echo "<img height='100' src= '". URL . IMG . $imagem_carteira_pet ." '> <br> <br> "; 
                                } else {
                                    echo "<img height='100' src= '". URL . IMGERRO . $imagem_carteira_pet ." '> <br> <br> "; 
                                }



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
                                echo "<br> <a href='" . URL . "Sobre-Cliente/apagarDadosPet?idpet={$idpet}'> Apagar Pet </a> <br>";


                                if (!empty($imagem_pet)) {
                                    echo "<br> <a href='" . URL . "FotoPet/apagar?id={$idpet}'> Apagar Foto Pet </a> <br>";
                                } else {
                                    echo "<br> <a href='" . URL . "FotoPet/Adicionar?id={$idpet}'> Adicionar Foto Pet </a> <br>";
                                }

                                if (!empty($imagem_carteira_pet)) {
                                    echo "<br> <a href='" . URL . "FotoCarteira/apagar?id={$idpet}'> Apagar Foto Carteira </a> <br>";
                                } else {
                                    echo "<br> <a href='" . URL . "FotoCarteira/Adicionar?id={$idpet}'> Adicionar Foto Carteira </a> <br>";
                                }

                            }

                        } else {

                            echo "Você ainda não tem nunhum PET cadastrado <br>";
                            echo "<br> <a href='" . URL . "cadastroPet'> Ir Cadastrar PET </a> <br>";

                        }

                        ?>

                    </div>

                </div>

            </div>
            
            <div class="card">

                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Agendamentos
                        </button>
                    </h5>
                </div>

                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">

                    <div class="card-body">
                        <?php
                        
                            if (isset($this->data['agendamentos'])) {
                                for ($x = 0; $x < count($this->data['agendamentos']); $x++) {

                                    $agendamentos = $this->data['agendamentos'][$x];
                                    extract($agendamentos);

                        ?>

                            <section class="conteudo-serviços">

                                <img src="img/" alt="icone vacina" class="">

                                <div class="procedimento">

                                    <h3 class="título-serviço"> <?= $nome_consulta ?> </h3>

                                    <p class="info">R$ <?= $valor_consulta ?> <br> <?= $tempo_medio ?></p>

                                    <a href="#"> <button class="agendar">AGENDAR</button> </a>

                                </div>

                            </section>

                            <hr class="linha"> <!-- LINHA PARA DIVIDIR CONTEÚDO -->

                        <?php
                                }
                            }
                        ?>

                    </div>

                </div>

            </div>

        </div>


    </main>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</body>

</html>