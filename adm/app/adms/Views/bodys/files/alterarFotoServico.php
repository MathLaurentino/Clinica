
<?php
    if (isset($_SESSION['errFile'])) {
        echo $_SESSION['errFile'];
        unset($_SESSION['errFile']);
    }

    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }

    //var_dump($this->data);
    extract($this->data);

    if (isset($foto_servico)) { echo "<img height='100' src= '". URLADM . IMGADMSER . $foto_servico ." '> <br>"; } else { echo "sem foto <br>"; }
?>


<form method="post" enctype="multipart/form-data" action="">

    <h2> ADICIONAR FOTO DO SERVICOS </h2>

    <label>Foto do servico: </label>
    <input name="arquivo" type="file"> <br> <br> 

    <input name="AddFile" type="submit" value="Enviar">

</form>