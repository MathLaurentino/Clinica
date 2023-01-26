<?php    
    if (isset($this->data)) {
        extract($this->data[0]);
    }
?>

<!--CONTEÚDO PRINCIPAL-->

<main class="conteudo-principal">

    <h1 class="título">Atualizar Cadastro</h1>

    <p class="subtítulo">atualize o seu endereço cadastrais abaixo</p>

    <!--formulário para alterar dados-->

    <form class="form-edição3" method="post" action="">

        <div class="estilizaP">CEP: </div><br><input type="text"  id="cep" placeholder="CEP" name="cep" value="<?php if(isset($cep)) {echo "$cep";} ?>" required> <br>

        <div class="estilizaP">Estado: </div><br><input type="text" id="rua" placeholder="Estado" name="estado" value="<?php if(isset($estado)) {echo "$estado";} ?>" readonly required><br>

        <div class="estilizaP">Cidade: </div><br><input type="text" id="bairro" placeholder="Cidade" name="cidade" value="<?php if(isset($cidade)) {echo "$cidade";} ?>" readonly required><br>
        
        <div class="estilizaP">Bairro: </div><br><input type="text" id="cidade" placeholder="Estado" name="bairro" value="<?php if(isset($bairro)) {echo "$bairro";} ?>" readonly required><br>

        <div class="estilizaP">Rua: </div><br><input type="text" id="estado" placeholder="Rua" name="rua" value="<?php if(isset($rua)) {echo "$rua";} ?>" readonly required ><br>

        <div class="estilizaP">N°: </div><br><input type="number" id="numero_residencial" placeholder="N°" name="numero_residencial" value="<?php if(isset($numero_residencial)) {echo "$numero_residencial";} ?>" required><br>

        <input name="AlterAdress" type="submit" class="botao" value="salvar alterações">

    </form>

</main>    

<script src="<?= URL . JS ?>navbar.js"> </script>
<script src="<?= URL . JS ?>consulta-endereco.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



 