<?php
    if (!isset($_session)) {
        session_start();
    }
    
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }

?>
    <!--CONTEÚDO PRINCIPAL-->
    <main class="conteudo-principal">
        <section id="" class="apresentação">
            

            <img src="app\sts\assets\imagens_clinica\img01.png" alt="img cães" class="img" id="circulo"> 
             
            <div class="introdução">
                <h1 class="título"> Invista na saúde e bem estar <br> do seu pet! </h1> <br> <br> 

                <p class="subtítulo"> Agendamento fácil e rápido pelo site </p>
            </div>

        </section>
    
        <section id="serviços" class="">
            
            <h2 class="serviços">CONHEÇA <br> NOSSOS SERVIÇOS</h1>

                <!-- CARROSSEL 
                <div class="container">
                    <script type="text/javascript" src="/carrossel.js"></script>
                    botões
                    <button class="arrow-left control" aria-label="Previous image">◀</button>
                    
                    <button class="arrow-right control" aria-label="Next Image">▶</button>

                    <div class="gallery-wrapper">
                        <div class="gallery">

                            <div class="serviço01"> 
                                <img src="https://source.unsplash.com/random/100x100/?arara" alt="icone vacina" class="item">
                                <h4> VACINAÇÃO </h4>
                                <p> descrição do serviço </p>
                            </div>
                            
                            <div class="serviço02"> 
                                <img src="https://source.unsplash.com/random/100x100/?puppy" alt="icone exames" class="item">
                                <h4> EXAMES </h4>
                                <p> descrição do serviço </p>
                            </div>

                            <div class="serviço03"> 
                                <img src="https://source.unsplash.com/random/100x100/?pet" alt="icone consulta" class="item">
                                <h4> CONSULTAS </h4>
                                <p> descrição do serviço </p>
                            </div>

                            <div class="serviço04"> 
                                <img src="https://source.unsplash.com/random/100x100/?bird" alt="icone raio-x" class="item">
                                <h4>DIAGNÓSTICO POR IMAGEM</h4>
                                <p> descrição do serviço</p>
                            </div>

                            <div class="serviço05"> 
                                <img src="https://source.unsplash.com/random/100x100/?dog" alt="icone cirurgia" class="item">
                                <h4>PROCEDIMENTOS CIRÚRGICOS</h4>
                                <p> descrição do serviço</p>
                            </div>

                            <div class="serviço06">  
                                <img src="https://source.unsplash.com/random/100x100/?cat" alt="icone gato" class="item">
                                <h4> ESPECIALISTAS EM FELINOS</h4>
                                <p> descrição do serviço</p>
                            </div>
                        </div>

                    </div>

                    <script src="/Frontend/ClinicaNova/carrossel.js"></script>
                </div>   --> 
        
        </section>
<br>
        <section id="corpoclinico" class="">
            <h2 class="corpoclinico">CONHEÇA <br> NOSSO CORPO CLÍNICO</h2> 
           
                <!-- slider - imagem com capa médico com opção de selecionar para o prox, sem andar sozinho --> 
           
            <p class="descricao"> descrição do profissional, especificações</p>
        </section> 
    </main> 

    <!--RODAPÉ-->

    <footer class="rodape-principal"> 
        <img class="logo" src="app\sts\assets\imagens_clinica\logo.png" alt="logo da clínica"> 

        <a href="#endereço" class="endereco"> <i class="fa fa-map-marker fa-1x" aria-hidden="true" ></i> Rua Girassol, 000 - Foz do Iguaçu, PR</a>

        <nav class="informações">
            <a href="#"><i class="fa fa-whatsapp fa-2x" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-envelope-o fa-2x" aria-hidden="true"></i></a>
        </nav>

        <p class="direitos">direitos autorais</p>
    </footer>
    <script src="app\sts\assets\js\navbar.js"> </script>