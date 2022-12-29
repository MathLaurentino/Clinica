<?php
    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'] . "<br>";
        unset($_SESSION['msg']);
    }

    if(isset($this->data)){
        extract($this->data);
    }
?>

<!-- CONTEÚDO PRINCIPAL-->
<div class="main-container">

    <!--TELA 01:CRIE UMA CONTA-->
    <div class="conteudo conteudo01">

        <div class="primeiracoluna">
            <!--COLUNA 01-->
            <h1 class="título">Já possui uma
                <br> conta?</h1>
            <p class="subtítulo"> clique no botão abaixo<br> para acessar sua conta</p>

            <a href="<?= URL ?>Login/Usuario"><button id="signin" class="botao"> login</button> </a> 
        </div>

        <div class="segundacoluna">
            <!--COLUNA 02-->
            <h1 class="título">Crie uma conta!</h1>

            <form class="form-login" method="post" enctype="multipart/form-data" action=""> 
                <input type="text" placeholder="Nome Completo" name="nome_usuario" value="<?php if(isset($nome_usuario)) {echo "$nome_usuario";} ?>">

                <input type="date" placeholder="Data de Nascimento" name="data_nascimento" value="<?php if(isset($data_nascimento)) {echo "$data_nascimento";} ?>">

                <input type="text" placeholder="E-mail" name="email" value="<?php if(isset($email)) {echo "$email";} ?>">

                <input type="hidden" name="tipo_usuario" value="cliente">
                
                <input type="text" placeholder="Senha" name="senha_usuario" value="<?php if(isset($senha_usuario)) {echo "$senha_usuario";} ?>">

                <input type="text" placeholder="CPF" name="cpf" value="<?php if(isset($cpf)) {echo "$cpf";} ?>">

                <input type="text" placeholder="RG" name="rg" value="<?php if(isset($rg)) {echo "$rg";} ?>">

                <!-- <button class="botao"> Criar conta</button> --> 
                <input name="createAccount" class="botao" type="submit" value="Criar Conta">
            </form>

        </div>

    </div>

    <script src="<?= URL . JS ?>cadastro.js"> </script>
</div>

