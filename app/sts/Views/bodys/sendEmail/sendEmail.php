<?php
if(!empty($this->data)){
    extract($this->data);
}
?>

<!--CONTEÚDO PRINCIPAL-->
<main class="conteudo-principal">
    <h1 class="título">Informe seu E-mail</h1>
    <p class="subtítulo">caso não tenha recebido um e-mail de verificação</p>

    <form method="post" action="" class="form-email">
        <div class="center"> 
            <input type="text" name="email" placeholder="E-mail" class="tamanhoForm" value="<?php if (isset($email)) { echo $email; } else{echo "";} ?>">
            <!-- <input name="send" type="submit" value="Enviar" >   -->
            <p class="center"> <input class="botaoEnviar" name="send" type="submit" value="Enviar" > </p>
        </div>
    </form>

    
    <img src="<?= URL . IMGCLINICA ?>img08.png" class="img-pet08" alt="imagem de cão"> 

</main>    

<!-- <form method="post" action="">
        
    <h2> Informe seu email </h2>

    <label>Email: </label>
    <input name="email" type="text" value="<?php //if (isset($email)) { echo $email; } ?>" placeholder="Email"> <br> <br>

    <input name="send" type="submit" value="Enviar" >

</form> -->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
