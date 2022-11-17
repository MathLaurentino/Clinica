
<?php

    if(!isset($_SESSION)){
        session_start();
    }
    if(isset($_SESSION['msg'])){
        echo "Mensagem: " . $_SESSION['msg'] . "<br>";
        unset($_SESSION['msg']);    
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="">
        
        <h2> Login </h2>

        <label>EMAIL: </label>
        <input name="email" type="text" placeholder="email"> <br> <br>
        
        <label>SENHA: </label>
        <input name="senha_usuario" type="text" placeholder="senha"> <br> <br>

        <input name="Login" type="submit" value="Enviar" >

    </form>

</body>
</html>