<?php

    if(!isset($_SESSION)){
        session_start();
    }
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'] . "<br>";
        unset($_SESSION['msg']);    
    }

?>

<!-- CONTEÚDO PRINCIPAL-->
<div class="main-container">

<!--TELA 02:LOGIN-->
    <div class="conteudo conteudo02">

    <div class="primeiracoluna"> <!--COLUNA 01-->
        <h1 class="título">Ainda não possui<br>uma conta?</h1>
        <p class="subtítulo"> <strong>clique no botão</strong><br> abaixo para se cadastrar no nosso site</p>
    
        <a href="<?= URL ?>Cadastro/Usuario"><button id="signup" class="botao">crie sua conta</button> </a> 
    </div>

    <div class="segundacoluna"> <!--COLUNA 02-->
        <h1 class="título">bem-vindo de volta!</h1>

        <form class="form-login" method="post" action=""> 
            
            <input type="email" placeholder="E-mail" name="email" value="joao@joao.com"> 

            <input type="password" placeholder="Senha" name="senha_usuario" value="123">

            <input class="botao" type="submit" value="Enviar" name="Login">

            <a href="#" class="senha">Esqueceu sua senha?</a>
            <a href="<?= URL ?>ConfirmarEmail/reenviarEmail" class="senha"> Reenviar e-mail de confirmação</a> <br>

        </form>
    </div>

    </div>

</div>

<script src="<?= URL . JS ?>login.js"> </script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


