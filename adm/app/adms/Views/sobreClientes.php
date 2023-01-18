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
    
    <h2> Clientes </h2> <br>

    
    <?php
        if (!empty($this->data['clientes'])) {
            for($x = 0; $x < count($this->data['clientes']); $x++)
            {
                $lista = $this->data['clientes'][$x];
                extract($lista);

                if (!empty($foto_usuario)) {  echo "<img height='100' src= ' ". URL . IMGCLIENTEADM . $foto_usuario ." '> <br> <br>"; } else { echo "<img height='100' src= ' " . URL . IMGCLIENTEERRO ." '> <br> <br>"; }

                //echo "<img height='100' src= ' ".  IMGADM . $foto_usuario ." '> <br> <br>";
                echo "Id do usuário:" . "$idusuario" . "<br>";
                echo "Nome do usuário:" . "$nome_usuario" . "<br>"; 
                echo "Tipo do usuário:" . "$tipo_usuario" ."<br>"; 
                echo "E-mail:" . "$email" ."<br>"; 
                
                if ($_SESSION['idusuario'] == 1) {

                ?>
                    <a href='<?= URLADM ?>Area-Clientes/Alterar-Tipo-Usuario?idUser=<?= $idusuario ?>&tipo=tipo_usuario '> tornar mantenedor </a>

                <?php    
                } 
                echo "<br> <hr> <br>";
            }
        }
    ?>

    <h2> Mantenedores </h2> <br>

    <?php

        for($x = 0; $x < count($this->data['mantenedores']); $x++)
        {
            $lista = $this->data['mantenedores'][$x];
            extract($lista);

            if (!empty($foto_usuario)) {  echo "<img height='100' src= ' ". URL . IMGCLIENTEADM . $foto_usuario ." '> <br> <br>"; } else { echo "<img height='100' src= ' " . URL . IMGCLIENTEERRO ." '> <br> <br>"; }

            //echo "<img height='100' src= ' ".  IMGADM . $foto_usuario ." '> <br> <br>";
            echo "Id do usuário:" . "$idusuario" . "<br>";
            echo "Nome do usuário:" . "$nome_usuario" . "<br>"; 
            echo "Tipo do usuário:" . "$tipo_usuario" ."<br>"; 
            echo "E-mail:" . "$email" ."<br>"; 

            if ($_SESSION['idusuario'] == 1) {
                if ($tipo_usuario == 'mantenedor' && $idusuario != '1') {

                    ?>
                        <a href='<?= URLADM ?>Area-Clientes/Alterar-Tipo-Usuario?idUser=<?= $idusuario ?>&tipo=mantenedor '> tornar cliente </a> 
                    <?php

                } elseif($tipo_usuario == 'cliente') {
                    
                    ?>
                        <a href='<?= URLADM ?>Area-Clientes/Alterar-Tipo-Usuario?idUser=<?= $idusuario ?>&tipo=cliente '> tornar mantenedor </a>
                    <?php

                }
            } 

            echo "<br> <hr> <br>";
        }

    ?>


</body>
</html>