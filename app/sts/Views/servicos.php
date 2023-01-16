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
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>

