<div class="containerImg">
    <div class="child">

        <h1 class="tituloE">Informe seu E-mail</h1>
        <p class="subtituloE">para redefinir sua senha</p>

    </div>


    <div class="child">
        <div class="containerImg3">
            
            <div class="child">
                <div class="vazio"></div>
            </div>

            <div class="child">

                <form method="post" class="form-enviaEmail" action="">
                    <div class="center"> 
                        <input type="text" name="email" placeholder="E-mail" class="tamanhoForm" value="<?php if (isset($this->data['email'])) { echo $this->data['email']; }  ?>"> 
                    </div>
                    <p class="center"><input class="botaoEnviaEmail" name="send" type="submit" value="enviar"> </p>
                </form>

                
            </div>

            <div class="child">
                <div class="vazio"></div>
                <!-- <img src="<?= URL . IMGCLINICA ?>img08.png" class="img-pet08" alt="imagem de cão"> -->
            </div>

        </div>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
