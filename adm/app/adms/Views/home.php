<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
    echo "<hr>";

    if(!isset($_SESSION)){
        session_start();
    }
    if(isset($_SESSION['msg']))
    {   
        echo "Mensagem: " . $_SESSION['msg'] . "<br>";
        unset($_SESSION['msg']);
    }
    if(isset($_SESSION['idusuario']))
    {
        echo "Seja bem vindo, " . $_SESSION['nome_usuario'] . "<br>";
        echo "Tipo usuário: " . $_SESSION['tipo_usuario'] . "<br>";
        echo "Id: " . $_SESSION['idusuario'] . "<br>";
        echo "Endereco: " . $_SESSION['idendereco'] . "<br>";
    }

    echo "<hr>";
    echo "<a href='" . URLADM . "AreaClientes/Dados'> Sobre Cliente </a> <br>";
    echo "<a href='" . URLADM . "Sobre-Clinica'> Sobre Clinica </a> <br>";
    echo "<a href='" . URLADM . "ConsultasAgendadas/clientes'> Consultas Agendadas </a> <br>"; 
    echo "<a href='" . URL . "Logout/Index'> Logout </a> <br>"; 
   
?>

</body>
</html>