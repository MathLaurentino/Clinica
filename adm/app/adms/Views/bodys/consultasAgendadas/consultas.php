<?php

if(!isset($_SESSION)){
    session_start();
}
if (isset($_SESSION['msg'])) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>" 
            . $_SESSION['msg'] 
        . "</div>";
    unset($_SESSION['msg']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    

    <?php

    for ($x = 0; $x < count($this->data); $x++) {

        $consulta = $this->data[$x];
        extract($consulta);

        echo "Id: " . $idconsulta . "<br>"; 
        echo "Data: " . $data_consulta . "<br>"; 
        echo "Horario: " . $horario_consulta . "<br>"; 
        echo "Descricao: " . $descricao . "<br>"; 
        echo "Tipo consulta: " . $tipo_consulta . "<br> "; 
        echo "situação: " . $sit_consulta . "<br>"; 

        if ($sit_consulta == "A Confirmar") {
            echo "<a href='" . URLADM . "ConsultasAgendadas/Confirmar'> Confirmar </a> <br>"; 
            echo "<a href='" . URLADM . "ConsultasAgendadas/Negar'> Negar </a> <br> <br>";

        } elseif ($sit_consulta == "Confirmado <br> <br>") {
            echo "Confirmado";
        } elseif ($sit_consulta == "Cancelado <br> <br>") {
            echo "Cancelado";
        } elseif ($sit_consulta == "Concluido <br> <br>") {
            echo "Concluido";
        } elseif ($sit_consulta == "Negado <br> <br>") {
            echo "Negado";
        }
         
    }
        
    ?>

</body>
</html>