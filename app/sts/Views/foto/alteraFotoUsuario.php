
<?php

if (!empty($_SESSION['foto_usuario'])) {  
    echo "<img height='100' src= ' ../". IMG . $_SESSION['foto_usuario'] ." '> <br> <br>"; 
} 
else { 
    echo "<img height='100' src= ' ". IMGERRO ." '> <br> <br>"; 
}


?>


<form method="post" enctype="multipart/form-data" action="">

<h2> ALTERAR FOTO DE PERFIL </h2>

<label>Foto de Perfil: </label>
<input name="arquivo" type="file"> <br> <br> 

<input name="AddFile" type="submit" value="Enviar">

</form>