<?php
if (!isset($_SESSION)) {
    session_start();
}

if (isset($this->data[0])) {
    extract($this->data[0]);
}
if (isset($this->data)) {
    extract($this->data);
}
?>

<div class="containerImg">
    <div class="child">

        <h1 class="tituloE">Atualizar Cadastro</h1>
        <p class="subtituloE">atualize os seus dados cadastrais abaixo</p>

        <form class="form-edição3" method="post" action="">

            <div class="estilizaP">Nome: </div><br>
                
            <input type="text" placeholder="Nome Completo" name="nome_usuario" value="<?php if (isset($nome_usuario)) { echo "$nome_usuario";} ?>"> <br>
                
            <div class="estilizaP">Data de Nascimento: </div><br>
            <input type="date" placeholder="Data de Nascimento" name="data_nascimento" value="<?php if (isset($data_nascimento)) { echo $data_nascimento; } ?>"> <br>

            <div class="estilizaP"> CPF: </div><br>
            <input type="text" placeholder="CPF" name="cpf" value="<?php if (isset($cpf)) { echo "$cpf"; } ?>"><br>

            <div class="estilizaP">RG: </div><br>
            <input type="text" placeholder="RG" name="rg" value="<?php if (isset($rg)) { echo "$rg"; } ?>"> <br>

            <input name="AlterUser" type="submit" class="botaoAlterar" value="salvar alterações">

        </form>
    </div>



    <div class="child">

        <div class="child">
            <img src="<?= URL . IMGCLINICA ?>img04.png" class="img-TelaAlterar" alt="imagem de cão">
        </div>

    </div>

</div>
<script src="<?= URL . JS ?>navbar.js"> </script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
