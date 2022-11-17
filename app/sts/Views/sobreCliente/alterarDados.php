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

    <h2> DADOS PESSOAIS </h2>

    <label>NOME: </label>
    <input name="nome_usuario" type="text" placeholder="Nome Completo" value="<?php if(isset($nome_usuario)) {echo "$nome_usuario";} ?>"> <br> <br> 

    <label>DATA DE NAS.: </label>
    <input name="data_nascimento" type="date" placeholder="data" value="<?php if(isset($data_nascimento)) {echo "$data_nascimento";} ?>"> <br> <br>

    <label>CPF: </label>
    <input name="cpf" type="text" placeholder="CPF" value="<?php if(isset($cpf)) {echo "$cpf";} ?>"> <br> <br>

    <label>RG: </label>
    <input name="rg" type="text" placeholder="RG" value="<?php if(isset($rg)) {echo "$rg";} ?>"> <br> <br>

    <input name="AlterUser" type="submit" value="Alterar">

</form>

