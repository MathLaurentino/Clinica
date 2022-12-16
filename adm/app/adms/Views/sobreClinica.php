<?php

if(!isset($_SESSION)){
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    

    <title>Document</title>
</head>
<body>
    
    <h2> Servicos da Clinica </h2>
    <hr>

    <?php
        if ($this->data){

        for ($x = 0; $x < count($this->data); $x++) {
            $servico = $this->data[$x];
            extract($servico);
    ?>

    <form method="post" action="">
        
        <label>Id Consulta: <?php if(isset($idtipo_consulta)) { echo $idtipo_consulta; } ?></label> <br> <br>
        <input type="hidden" name="idtipo_consulta" value="<?php if(isset($idtipo_consulta)) { echo $idtipo_consulta; } ?>">

        <label>Nome Consulta: </label>
        <input name="nome_consulta" type="text" value="<?php if(isset($nome_consulta)) { echo $nome_consulta; } ?>"> <br> <br>

        <label>Valor Consulta </label>
        <input name="valor_consulta" type="text" value="<?php if(isset($valor_consulta)) {echo $valor_consulta; } ?>"> <br> <br>

        <input name="AlterConsulta" type="submit" value="Alterar" >
        <input name="DeleteConsulta" type="submit" value="Delete" >

        <hr>

    </form>

    <?php } } ?>

    <br> <br>
    <h2> Adicionar Serviço a Clinica </h2>

    <form method="post" action="">

        <label>Nome: </label>
        <input name="nome_consulta" type="text"> <br> <br>

        <label>Descrição: </label>
        <input name="descricao_consulta" type="text"> <br> <br>

        <label>Valor </label>
        <input name="valor_consulta" type="text"> <br> <br>

        <input type="submit" name="AddServico" value="Salvar">

    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="adm\app\adms\assets\js\custom.js"></script>
</body>
</html>