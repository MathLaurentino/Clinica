<?php

if(!isset($_SESSION)){
    session_start();
}
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'] . "<br>";
    unset($_SESSION['msg']);    
}
if(!empty($this->data)){
    extract($this->data);
}

?>

<form method="post" action="">
        
    <h2> Informe seu email </h2>

    <label>Email: </label>
    <input name="email" type="text" value="<?php if (isset($email)) { echo $email; } ?>" placeholder="Email"> <br> <br>

    <input name="send" type="submit" value="Enviar" >

</form>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
