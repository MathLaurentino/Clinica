<?php

    if(!isset($_SESSION)){
        session_start();
    }
    
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'] . "<br>"; 
        unset($_SESSION['msg']);   
    }
    
    if (isset($this->data)) {
        extract($this->data[0]);
    }

?>

<!--CONTEÚDO PRINCIPAL-->
<main class="conteudo-principal">
    <h1 class="título">Atualizar Cadastro</h1>
    <p class="subtítulo">atualize o seu endereço cadastrais abaixo</p>

    <!--formulário para alterar dados-->
    <form class="form-edição1" method="post" action="" >
        
        <input type="text" placeholder="CEP" name="cep" value="<?php if(isset($cep)) {echo "$cep";} ?>">

        <input type="text" placeholder="Estado" name="estado" value="<?php if(isset($estado)) {echo "$estado";} ?>">

        <input type="text" placeholder="Cidade" name="cidade" value="<?php if(isset($cidade)) {echo "$cidade";} ?>">

        <input type="text" placeholder="Rua" name="rua" value="<?php if(isset($rua)) {echo "$rua";} ?>">

        <input type="text" placeholder="N°" name="numero_residencial" value="<?php if(isset($numero_residencial)) {echo "$numero_residencial";} ?>">

        <input name="AlterAdress" type="submit" class="botao" value="salvar alterações">
        
    </form>

</main>   

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

