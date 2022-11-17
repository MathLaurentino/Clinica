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

    <?php

        echo "Tela servicos html <br> <br> <hr> <br>";
        
        for($x = 0; $x < count($this->data['tipo_consulta']); $x++)
        {
            $lista = $this->data['tipo_consulta'][$x];
            extract($lista);

            echo "Id do tipo da consulta:" . "$idtipo_consulta" . "<br/>";
            echo "Nome da consulta:" . "$nome_consulta" . "<br/>"; 
            echo "Valor da consulta:" . "$valor_consulta" ."<br/>"; 
            echo "<br> <hr> <br>";
        }       
        
    ?>
    
</body>
</html>