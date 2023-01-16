
<?php
    if (isset($_SESSION['errFile'])) {
        echo $_SESSION['errFile'];
        unset($_SESSION['errFile']);
    }
?>

<?php

if (!empty($this->data[0]['imagem_pet'])) {  
    echo "<img height='100' src= ' ../". IMG . $this->data[0]['imagem_pet'] ." '> <br> <br>"; 
} 
else { 
    echo "<img height='100' src= ' ". IMGERRO ." '> <br> <br>"; 
}

?>  


<form method="post" enctype="multipart/form-data" action="">

    <h2> ALTERAR FOTO DE PET </h2>

    <label>Foto do Pet: </label>
    <input name="arquivo" type="file"> <br> <br> 

    <input name="AddFile" type="submit" value="Enviar">

</form>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
