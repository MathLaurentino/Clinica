<?php
    if(!isset($_SESSION)){ session_start(); }

    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'] . "<br>";
        unset($_SESSION['msg']);    
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Projeto de Conclusão de Curso - Site designado para uma clínica veterinária">
    <link rel="stylesheet" type="text/css" href="<?= CSSADM ?>loginstyle.css">

    <title>Login Administração</title>
</head>

<body>
    <!--CONTEÚDO PRINCIPAL-->
    <div class="main-container">

        <div class="conteudo-principal">

            <h1 class="título">Administração</h1>

            <form class="form-login" method="post" action="">
                <input type="email" placeholder="E-mail" name="email">

                <input type="password" placeholder="Senha" name="senha_usuario">

                <!-- <button class="botao-adm"> login </button> --> 
                <input  class="botao-adm" type="submit" value="Enviar" name="AddContMsg">
            </form>

        </div>

    </div>
    
</body>
</html>