<!-- CONTEÚDO PRINCIPAL-->
<div class="main-container">

    <!--TELA 01:CRIE UMA CONTA-->
    <div class="conteudo conteudo01">

        <div class="primeiracoluna">
            <!--COLUNA 01-->
            <h1 class="título">Já possui uma
                <br> conta?</h1>
            <p class="subtítulo"> clique no botão abaixo<br> abaixo para acessar sua conta</p>

            <a href="login.html"><button id="signin" class="botao"> login</button> </a> 
        </div>

        <div class="segundacoluna">
            <!--COLUNA 02-->
            <h1 class="título">Crie uma conta!</h1>

            <form class="form-login">
                <input type="text" placeholder="Nome Completo">

                <input type="date" placeholder="Data de Nascimento">

                <input type="texxt" placeholder="E-mail">
                
                <input type="text" placeholder="Senha">

                <input type="text" placeholder="CPF">

                <input type="text" placeholder="RG">


                <button class="botao"> Criar conta</button>
            </form>


        </div>

    </div>

    <script src="<?= JS ?>cadastro.js"> </script>
</div>

