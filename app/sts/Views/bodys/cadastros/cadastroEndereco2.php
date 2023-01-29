<!-- CONTEÚDO PRINCIPAL-->
<div class="main-container">

    <!--TELA 01:CRIE UMA CONTA-->
    <div class="conteudo conteudo01">

        <div class="primeiracoluna">
            <div class="divCadastro">
                <h1 class="título">Complete seu
                    <br> cadastro!
                </h1>
            </div>
        </div>

        <div class="segundacoluna">
            <!--COLUNA 02-->
            <div class="título">Informe seu Endereço</div>


            <form method="post" class="form-login">


                <input type="text" id="cep" name="cep" placeholder="CEP" class="tamanhoForm" minlength="8" maxlength="8"  required>
                <br>
                <input type="text" id="rua" name="rua" placeholder="Rua" class="tamanhoForm" readonly required>
                <br>
                <input type="text" id="bairro" name="bairro" placeholder="Bairro" class="tamanhoForm" readonly required>
                <br>
                <input type="text" id="cidade" name="cidade" placeholder="Cidade" class="tamanhoForm" readonly required>
                <br>
                <input type="text" id="estado" name="estado" placeholder="Estado" class="tamanhoForm" readonly required>
                <br>
                <input type="number" id="numero_residencial" name="numero_residencial" placeholder="Nº" class="tamanhoForm" required>
                <br>
                <br>
                <p class="center"><input class="botao" name="createAdress" type="submit" value="Enviar"> </p>


            </form>
        </div>

    </div>
</div>

<script src="<?= URL . JS ?>navbar.js"> </script>
<script src="<?= URL . JS ?>consulta-endereco.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>




