<?php
    if(!isset($_SESSION)){
        session_start();
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
    echo "<div style='text-align:center' >";
        echo "<h1> Erro " . $this->data['numeroErro'] . "</h1>";
        echo "<h2>" . $this->data['descricaoErro'] . "</h2>"; 
        echo "<a href='{$this->data['botao']}'> {$this->data['descricaoBotao']} </a>";
    echo "</div>";
    ?>
    
</body>
</html>