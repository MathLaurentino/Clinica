
<?php
    if (isset($_SESSION['errFile'])) {
        echo $_SESSION['errFile'];
        unset($_SESSION['errFile']);
    }
?>


<form method="post" enctype="multipart/form-data" action="">

    <h2> ADICIONAR FOTO DO SERVICOS </h2>

    <label>Foto do servico: </label>
    <input name="arquivo" type="file"> <br> <br> 

    <input name="AddFile" type="submit" value="Enviar">

</form>