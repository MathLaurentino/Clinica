<?php

    if(!isset($_SESSION)){
        session_start();
    }
    
?>



<div class="containerImg">

    <div class="child">     
        <div class="linhaCab"></div>
    </div>
        
    <div class="child">
        <div class="telaErro">
            <h1 class="tituloErro"> ERRO <?= $this->data['numeroErro'] ?></h1>
            <p class="subtituloErro"><?= $this->data['descricaoErro'] ?></p>
            <br>
                <p class="center"> <a href="<?= $this->data['botao'] ?>"> <input class="botaoTelaErro" name="CreatePet" type="submit" value="<?= $this->data['descricaoBotao'] ?>"> </a> </p> 

        </div>
        <div class="containerImg2">
            <img src="<?= URL . IMGCLINICA ?>img07.png" class="img-pet07">
            
        </div>

    </div>

</div>

<script src="<?= URL . JS ?>navbar.js"> </script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
