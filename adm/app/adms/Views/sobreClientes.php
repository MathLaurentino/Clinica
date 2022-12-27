<?php 

    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
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
    
    <h2> LISTA DE USUÁRIOS </h2> <hr>

    <?php

        for($x = 0; $x < count($this->data); $x++)
        {
            $lista = $this->data[$x];
            extract($lista);

            if (!empty($foto_usuario)) {  echo "<img height='100' src= ' ". IMGCLIENTEADM . $foto_usuario ." '> <br> <br>"; } else { echo "<img height='100' src= ' ". IMGCLIENTEERRO ." '> <br> <br>"; }

            //echo "<img height='100' src= ' ".  IMGADM . $foto_usuario ." '> <br> <br>";
            echo "Id do usuário:" . "$idusuario" . "<br>";
            echo "Nome do usuário:" . "$nome_usuario" . "<br>"; 
            echo "Tipo do usuário:" . "$tipo_usuario" ."<br>"; 
            echo "E-mail:" . "$email" ."<br>"; 
            
            if ($_SESSION['idusuario'] == '1') {
                if ($tipo_usuario == 'mantenedor' && $idusuario != '1') {
                    ?>
                        <form method="post" action=""> 
                            <input type="hidden" name="idusuario" value="<?php if(isset($idusuario)) { echo $idusuario; } ?>">
                            <input type="hidden" name="tipo_usuario" value="cliente">
                            <input type="submit" name="changeToCliente" value="Tornar Cliente">
                        </form>
                    <?php
                } elseif($tipo_usuario == 'cliente') {
                    ?>
                        <form method="post" action=""> 
                            <input type="hidden" name="idusuario" value="<?php if(isset($idusuario)) { echo $idusuario; } ?>">
                            <input type="hidden" name="tipo_usuario" value="mantenedor">
                            <input type="submit" name="changeToMantenedor" value="Tornar Mantenedor">
                        </form>
                    <?php
                }
            }

            echo "<br> <hr> <br>";
        }

    ?>

</body>
</html>