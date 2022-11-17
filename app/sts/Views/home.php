
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
        if (!empty($_SESSION['foto_usuario'])) {  echo "<img height='100' src= ' ". IMG . $_SESSION['foto_usuario'] ." '> <br> <br>"; } else { echo "<img height='100' src= ' ". IMGERRO ." '> <br> <br>"; }
        echo "Seja bem vindo, " . $_SESSION['nome_usuario'] . "<br>";
        echo "Tipo usuário: " . $_SESSION['tipo_usuario'] . "<br>";
        echo "Id: " . $_SESSION['idusuario'] . "<br>";
        if (!empty($_SESSION['idendereco'])) {  echo "Endereco: " . $_SESSION['idendereco'] . "<br>"; }
        
    }

echo "<hr>";
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
    
<?php
    
    echo "<h2>View Home</h2>";
    echo "<a href='" . URL . "Cadastro/Usuario'> Cadastro Usuario</a> <br>";
    echo "<a href='" . URL . "Cadastro/Endereco'> Cadastro Endereço</a> <br>";

    echo "<a href='" . URL . "Login'> Login </a> <br> <br>";

    echo "<a href='" . URL . "Sobre-Cliente/Dados'> Dados Cliente </a> <br><br>";

    echo "<a href='" . URL . "Cadastro-Pet'> Cadastro Pet </a> <br><br>";

    echo "<a href='" . URL . "Servicos'> Serviços da Clinica</a> <br><br>";

    echo "<a href='" . URL . "FotoPerfil/usuario'> Foto de Perfil </a> <br>";


?>

<form method="post" action="">

    <br>
    <input name="session_destroy" type="submit" value="session_destroy" >

</form>

</body>
</html>