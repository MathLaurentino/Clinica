<?php
if(!isset($_SESSION)){
    session_start();
}
if (isset($this->data)) {
    //extract($this->data);
    //echo "<pre>";var_dump($this->data);echo "</pre>";
}
?>

<div class="containerImg">
    <div class="child">

        <h1 class="tituloE">Atualizar Cadastro</h1>
        <p class="subtituloE">atualize os dados do seu pet abaixo</p>
    </div>

    

    <div class="child">
        <div class="containerImg3">
            
            <div class="child">
                
            </div>

            <div class="child">

            <?php
                for($x = 0; $x < count($this->data['pet']); $x++){
                    $pet = $this->data['pet'][$x];
                    extract($pet);
            ?>
                <form form method="post" action=""class="form-alteraDadosPet">

                    <div class="center"><label>Nome: </label></div>
                    <input type="text" name="nome_pet" placeholder="Nome" class="tamanhoForm" value="<?php if(isset($nome_pet)) { echo $nome_pet; } ?>"> 
                    
                    <br><br>
                    <input type="hidden" name="idpet" value="<?php echo $idpet ?>">

                    <div class="center"><label>Data de Nascimento: </label></div>
                    <input type="date" name="data_nascimento_pet" class="tamanhoForm" value="<?php if(isset($data_nascimento_pet)) {echo $data_nascimento_pet; } ?>"> 
                        <br><br>
                        
                    <label> Sexo: </label> 
                    <select name="sexo">
                        <option value="<?= $sexo ?>"> <?= $sexo ?> </option>
                        <option value="Macho"> Macho </option>
                        <option value="Fêmea"> Fêmea </option>
                    </select> 
    
                    <br><br>
            
                    <label>Raça:</label> <br>
                    <select class="tamanhoForm" name="idraca" size="1" placeholder="Raça:">

                        <option value="<?= $idraca_pet; ?>" > <?= $raca; ?> </option>

                        <?php 
                            $arrayTipo = $this->data['tipo_pet'];
                            for($y = 0; $y < count($arrayTipo); $y++){
                                $array = $arrayTipo[$y];
                                foreach($array as $key => $value){
                                    if($key == "idraca_pet"){
                                        $idraca_pet = $value;
                                    }
                                    if($key == "raca") 
                                    {
                                        ?>  <option value="<?php echo $idraca_pet; ?>" > <?php echo $value; ?> </option> <br> <?php
                                    }
                                }
                            }
                        ?>

                    </select> 
        
                    <br> <br>
                    <p class="center"><input class="botaoAlterar" name="AlterPet" type="submit" value="salvar alterações" > </p>            

                </form>

            <?php } ?>
            
        
            </div>
            <div class="child">
                <img src="<?= URL . IMGCLINICA ?>img03.png" class="img-pet" alt="imagem de cão"> 
            </div>

        </div>

    </div>

</div>

<script src="<?= URL . JS ?>navbar.js"> </script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

