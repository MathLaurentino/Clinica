<?php
    if (isset($_SESSION['errFile'])) {
        echo $_SESSION['errFile'];
        unset($_SESSION['errFile']);
    }
?>

<!-- <div class="tituloAdd"> Adicione foto da carteira de vacina do pet</div> -->

<div class="tituloAdd"> Alterar Foto</div>
<div class="subtituloAdd"> da carteira de vacina do pet</div>

<!-- CONTEÚDO PRINCIPAL-->
<div class="main-container2">
    <!--TELA 01:CRIE UMA CONTA-->
    <div class="conteudoImg">

        <div class="conteudoPrincipal"> 
            <div class="colorImg"><i class="fa fa-cloud-upload" aria-hidden="true"></i></div>

            <form method="post" enctype="multipart/form-data" action="">
            <label for="arquivo" class="inputImg">escolher arquivo</label>
            <input name="arquivo" type="file" id="arquivo"> <!-- tem que ter o id arquivo para a label funcionar --> <br><br><br>
            <input class="botao" name="AddFile" type="submit" value="enviar" id="arquivo" >
            </form>
        
        </div>
        
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
