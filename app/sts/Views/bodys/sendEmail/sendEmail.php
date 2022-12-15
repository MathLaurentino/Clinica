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