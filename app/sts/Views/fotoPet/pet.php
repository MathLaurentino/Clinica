
<?php
    if (isset($_SESSION['errFile'])) {
        echo $_SESSION['errFile'];
        unset($_SESSION['errFile']);
    }
?>


<form method="post" enctype="multipart/form-data" action="">

    <h2> ADICIONAR FOTO DE PET </h2>

    <label>Foto do Pet: </label>
    <input name="arquivo" type="file"> <br> <br> 

    <input name="AddFile" type="submit" value="Enviar">

</form>