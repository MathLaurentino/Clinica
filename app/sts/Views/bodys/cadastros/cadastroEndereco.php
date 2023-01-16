

    <form method="post" action="">

        <h2> ENDERECO </h2>

        <label>CEP: </label>
        <input name="cep" id="cep" type="text" placeholder="cep" value="<?php if(isset($cep)) {echo "$cep";} ?>" maxlength='8'> <br> <br>

        <label>NOME RUA: </label>
        <input name="rua" id="rua" type="text" placeholder="nome da rua" value="<?php if(isset($rua)) {echo "$rua";} ?>"> <br> <br>

        <label>Bairro: </label>
        <input name="bairro" id="bairro" type="text" placeholder="numero" value="<?php if(isset($numero_residencial)) {echo "$numero_residencial";} ?>"> <br> <br>

        <label>CIDADE: </label>
        <input name="cidade" id="cidade" type="text" placeholder="cidade" value="<?php if(isset($cidade)) {echo "$cidade";} ?>"> <br> <br>

        <label>ESTADO: </label>
        <input name="estado" id="estado" type="text" placeholder="estado" value="<?php if(isset($estado)) {echo "$estado";} ?>"> <br> <br>

        <label>NUMERO DA RESIDENCIA: </label>
        <input name="numero_residencial" id="numero_residencial" type="text" placeholder="numero" value="<?php if(isset($numero_residencial)) {echo "$numero_residencial";} ?>"> <br> <br>

        <input name="createAdress" type="submit" value="Enviar">

    </form>

    <script src="<?= URL . JS ?>consulta-endereco.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


