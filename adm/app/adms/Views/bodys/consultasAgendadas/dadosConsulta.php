<?php

if (isset($_SESSION['msg']) ) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

//echo "<pre>"; var_dump($this->data); echo "</pre>";

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

    for ($x = 0; $x < count($this->data); $x++) {

        $consulta = $this->data[$x];
        extract($consulta);
        //echo "<pre>";var_dump($consulta);echo "</pre>";

        echo "<br><br>";

        echo "<b> Data: </b>" . $data_consulta . "<br>"; 
        echo "<b> Horario: </b>" . $horario_consulta . "<br>"; 
        echo "<b> Descricao: </b>" . $descricao . "<br>"; 
        echo "<b> Tipo consulta: </b>" . $tipo_consulta . "<br> "; 
        echo "<b> Situação: </b>" . $sit_consulta . "<br>"; 

        echo "<br><br>";

        echo "<b> Tipo Marcada: </b>" . $nome_consulta . "<br>"; 
        echo "<b> Descrição da necessidade: </b>" . $descricao_consulta . "<br>"; 
        echo "<b> Tempo Médio da Consulta: </b>" . $tempo_medio . "<br>"; 

        echo "<br><br>";

        echo "<b> Nome do usuario: </b>" . $nome_usuario . "<br>"; 
        echo "<b> Email do usuario: </b>" . $email . "<br>"; 

        echo "<br><br>"; 

        echo "<b> Nome do Pet: </b>" . $nome_pet . "<br>"; 
        echo "<b> Idade Pet: </b>" . $idade_pet . "<br>";
        echo "<b> Sexo Pet: </b>" . $sexo . "<br>"; 
        echo "<b> Tipo Pet: </b>" . $tipo_pet . "<br>"; 
        echo "<b> Raca Pet: </b>" . $raca . "<br>"; 

        echo "<br><br>";

        echo "<img src='" . URL . IMGCLIENTEADM . $foto_usuario . "' alt='icone vacina'>";

    }

?>

    
</body>
</html>