
    <?php
    if(!isset($_SESSION)){
        session_start();
    }
    ?>
    
    <?php if ($this->more == "PetType") { ?>

    <!-- CONTEÚDO PRINCIPAL-->
    <div class="main-container">

        <!--TELA 01:CRIE UMA CONTA-->
        <div class="conteudo conteudo01">

            <div class="primeiracoluna">
              <img class="imagemPet" src="<?= URL . IMGCLINICA ?>img05.png">
            </div>

            <div class="segundacoluna">
                <!--COLUNA 02-->
                <div class="título">cadastre seu pet</div>
                <p class="subtítulo"> para agendar serviços pelo site!</p>
                <br>
                
                <form method="post" class="form-cadastroPet">
                    <h4 class="subtítulo"> Qual a espécie do seu pet?</h4>
                    <input type="radio" value="cachorro" name="animal">
                    <label>Cachorro</label> <br>
        
                    <input type="radio" value="gato" name="animal">
                    <label>Gato</label> <br>
        
                    <input type="radio" value="ave" name="animal">
                    <label>Ave</label> <br>
        
                    <p class="center"><input class="botao" name="PetType" type="submit" value="próximo" > </p>
        
                </form>

            </div>

        </div>
    </div>


    <?php } elseif($this->more == "CreatePet") {  ?>


    <!-- CONTEÚDO PRINCIPAL-->
    <div class="main-container">

        <!--TELA 01:CRIE UMA CONTA-->
        <div class="conteudo conteudo01">

            <div class="primeiracoluna">
              <img class="imagemPet2" src="<?= URL . IMGCLINICA ?>img06.png">
            </div>

            <div class="segundacoluna">
                <!--COLUNA 02-->
                <div class="título">finalize o cadastro!</div> <br>
           
                
                <form method="post" class="form-login">

                    <input type="text" name="nome_pet" placeholder="Nome" class="tamanhoForm"> 

                    <br>

                    <div class="center"> <label>Data de Nascimento: </label> </div>

                    <input type="date" name="data_nascimento_pet" class="tamanhoForm" placeholder="Data de Nascimento"> 
                    <br>
            
                    <label name="sexo"> Sexo: </label> 
                    <br>

                    <input type="radio" name="sexo" value="Macho"> <label> Macho </label>
                    <input type="radio" name="sexo" value="Fêmea"> <label> Fêmea </label>

                    <br><br>

                    <input type="hidden" name="usuario" value="<?php echo $_SESSION['idusuario']; ?>">
                
                    <label>Raça:</label> 
                    
                    <select class="tamanhoForm" name="idraca" size="1" placeholder="Raça:"> 

                        <?php 
                            for($y = 0; $y < count($this->data); $y++){
                                $array = $this->data[$y];
                                foreach($array as $key => $value){
                                    if($key == "idraca_pet"){
                                        $idRaca = $value;
                                    }
                                    if($key == "raca") 
                                    {
                                        ?>  <option value="<?php echo $idRaca; ?>" > <?php echo $value; ?> </option> <br> <?php
                                    }
                                }
                            }
                        ?>

                    </select> 
               
                    <br> <br>
                    <p class="center"><input class="botao" name="CreatePet" type="submit" value="Criar conta" > </p>

        
                </form>

            </div>

        </div>
    </div>

    <?php } ?>
