<?php
    if(!isset($_SESSION)){
        session_start();
    }
?>


<!--CONTEÚDO PRINCIPAL-->
<main class="conteudo-principal">
    <section id="" class="apresentação">


        <img src="<?= URL . IMGCLINICA ?>img01.png" alt="img cães" class="img" id="circulo">

        <div class="introdução">
            <h1 class="título"> Invista na saúde e bem estar <br> do seu pet! </h1> <br> <br>

            <p class="subtítulo"> Agendamento fácil e rápido pelo site </p>
        </div>

    </section>

    <section id="opções" class="serviços">

        <h2 class="serviços">CONHEÇA <br> NOSSOS SERVIÇOS</h1>

            <!-- Bot Carrossel-->
            <div id="carouselExampleIndicators" class="carousel" data-ride="carousel">
                <!--classe que deu problema na configuração do carrossel: class="carousel slide" -->
                <div class="carousel-inner">

                    <div class="carousel-item active">
                        <img src="<?= URL . IMGCLINICA ?>serviços01.png" alt="serviços oferecidos" class="">
                    </div>

                    <div class="carousel-item">
                        <img src="<?= URL . IMGCLINICA ?>serviços02.png" alt="serviços oferecidos" class="">
                    </div>

                </div>

            </div>

    </section>
    <br>
    <br>
    <br>
    <br>
    <br>

    <section class="corpoclinico" id="corpoclinico">
        
        <div class="alinhamentoCorpo"> 
        <h2 class="corpoclinico">CONHEÇA <br> NOSSO CORPO CLÍNICO</h2>
        <p class="descricao"> Trabalhar com medicina <br> veterinária é preciso amar e <br> respeitar os
            animais, tendo <br> como objetivo priorizar seu <br> bem-estar físico e emocional. <br> Nossos
            profissionais fazem o <br> máximo para alcançar esse <br> objetivo</p>
        </div>
        <div class="gapCorpo"></div>
        <div class="slider">
            <div class="slides">
                <input type="radio" name="radio-btn" id="radio1">
                <input type="radio" name="radio-btn" id="radio2">
                <input type="radio" name="radio-btn" id="radio3">
                <input type="radio" name="radio-btn" id="radio4">

                <div class="slide first">
                    Dra. Lara A.
                    <img src="<?= URL . IMGCLINICA ?>img10.png" id="img-corpo" alt="">
                </div>

                <div class="slide">
                Dr. João S.

                    <img src="<?= URL . IMGCLINICA ?>img09.png" id="img-corpo" alt="">
                </div>
                <div class="slide">
                Dr. Nicolas H.

                    <img src="<?= URL . IMGCLINICA ?>img11.png" id="img-corpo" alt="">
                </div>
                <div class="slide">
                Dr. Matheus L.
                    <img src="<?= URL . IMGCLINICA ?>img10.png" id="img-corpo" alt="">
                </div>

                <div class="navigation-auto">

                    <div class="auto-btn1"> </div>
                    <div class="auto-btn2 afastab2"> </div>
                    <div class="auto-btn3 afastab3"> </div>
                    <div class="auto-btn4 afastab4"> </div>

                </div>
            </div>

            <div class="manual-navigation">
                <label for="radio1" class="manual-btn"></label>
                
                <div class="afasta2">
                    <label for="radio2" class="manual-btn"></label>
                </div>

                <div class="afasta3">
                    <label for="radio3" class="manual-btn"></label>
                </div>

                <div class="afasta4">
                    <label for="radio4" class="manual-btn"></label>
                </div>
            </div>
        </div>

    </section></main>


<script src="<?= URL . JS ?>navbar.js"> </script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>