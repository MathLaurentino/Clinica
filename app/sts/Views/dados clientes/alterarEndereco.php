<?php

    if(!isset($_SESSION)){
        session_start();
    }
    
    if(isset($_SESSION['msg']))
    {
        echo "Mensagem: " . $_SESSION['msg'] . "<br>"; 
        unset($_SESSION['msg']);   
    }
    
    if (isset($this->data)) {
        extract($this->data[0]);
    }

?>

<form method="post" action="">

    <h4> ENDERECO </h4>

    <label>CEP: </label>
    <input name="cep" type="text" placeholder="cep" value="<?php if(isset($cep)) {echo "$cep";} ?>"> <br> <br>

    <label>NOME RUA: </label>
    <input name="rua" type="text" placeholder="nome da rua" value="<?php if(isset($rua)) {echo "$rua";} ?>"> <br> <br>

    <label>NUMERO DA RESIDENCIA: </label>
    <input name="numero_residencial" type="text" placeholder="numero" value="<?php if(isset($numero_residencial)) {echo "$numero_residencial";} ?>"> <br> <br>

    <label>CIDADE: </label>
    <input name="cidade" type="text" placeholder="cidade" value="<?php if(isset($cidade)) {echo "$cidade";} ?>"> <br> <br>

    <label>ESTADO: </label>
    <input name="estado" type="text" placeholder="estado" value="<?php if(isset($estado)) {echo "$estado";} ?>"> <br> <br>

    <input name="AlterAdress" type="submit" value="Alterar">

</form>