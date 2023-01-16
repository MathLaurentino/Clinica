<?php

    if(!isset($_SESSION)){
        session_start();
    }
    
    if(isset($_SESSION['msg']))
    {
        echo "Mensagem: " . $_SESSION['msg'] . "<br>"; 
        unset($_SESSION['msg']);   
    }
    
    if (isset($this->data)) {
        extract($this->data);
        //echo "<pre>";var_dump($this->data);echo "</pre>";
    }

    for($x = 0; $x < count($this->data['pet']); $x++){
        $pet = $this->data['pet'][$x];
        extract($pet);
        echo "<h4> Pet: " . $nome_pet . "</h4>";
?> 

<form method="post" action="">

        <?php echo " idPet: " . $idpet . "<br> <br>" ?>

        <label>Nome: </label>
        <input name="nome_pet" type="text" value="<?php if(isset($nome_pet)) { echo $nome_pet; } ?>"> <br> <br>

        <label>Idade Pet: </label>
        <input name="idade_pet" type="text" value="<?php if(isset($idade_pet)) {echo $idade_pet; } ?>"> <br> <br>

        <label>Sexo: </label>
        <select name="sexo">
            <option value="<?php echo $sexo ?>"> <?php echo $sexo ?> </option>
            <option value="masculino"> Masculino </option>
            <option value="feminino"> Feminino </option>
        </select> <br> <br>
            

        <input type="hidden" name="idpet" value="<?php echo $idpet ?>">

         <!-- <label>Espécie: </label>
        <input name="raca" type="text" value="<?php //if(isset($tipo_pet)) { echo $tipo_pet; } ?>"> <br> <br> -->

        <label>Raca: </label>

        <select name="idraca" >
            <option value="<?php echo $idraca; ?>"> <?php echo $raca; ?> </option>
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
        </select> <br> <br>
        
        <input name="AlterPet" type="submit" value="Alterar" >
        <input name="DeleteU" type="submit" value="Delete" >

        <hr>
</form>

<?php } ?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
