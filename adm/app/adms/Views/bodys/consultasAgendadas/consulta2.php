<?php

if (isset($_SESSION['msg']) ) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

//echo "<pre>"; var_dump($this->data); echo "</pre>";

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Projeto de Conclusão de Curso - Site designado para uma clínica veterinária">

    <script src="https://kit.fontawesome.com/7f492723e7.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="<?= CSSADM ?>styleNavBar.css">
    <link rel="stylesheet" type="text/css" href="<?= CSSADM ?>style.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Clínica Veterinária</title>
</head>

<body>

    <!--CABEÇALHO-->
    <header class="cabecalho-principal">
        <img class="img" src="<?= IMGADMCLINICA ?>logo.png" alt="logo da clínica">

        <nav class="menu">
            <a class="item">HOME</a>
            <a class="item">SERVIÇOS</a>
            <a class="item">CORPO CLÍNICO</a>
            <a href="#"> <button class="botao">AGENDE AQUI!</button> </a>

            <!--PARTE DE ICONE E LOGIN-->
            <nav class="nav__bar">
                <div class="mobile-menu">
                    <div class="icone"> <i class="fa fa-user-circle-o fa-2x" aria-hidden="true"></i> </div>
                </div>
                <ul class="nav-list">

                    <li><a href="#" class="item-nav">Ver perfil</a></li>
                    <li><a href="#" class="item-nav">Sair da conta</a></li>
                </ul>

            </nav> <!-- fim navbar -->

        </nav>
    </header>

    <!--CONTEÚDO PRINCIPAL-->

    <main class="conteudo-principal">
        <h1 class="título">Painel de Gerenciamento</h1>

        <!--COLLAPSE BOOTSTRAP-->
        <div class="opcoes">
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne">
                                Solicitações de Agendamento
                            </button>
                        </h5>

                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">

                            <?php
                                for ($x=0; $x < count($this->data['aConfirmar']); $x++) {

                                    $consulta = $this->data['aConfirmar'][$x];
                                    extract($consulta);

                                    if (empty($foto_usuario)) { $foto_usuario = "Sem_Foto.png"; }

                                    $day = substr($data_consulta,8) . "/" . substr($data_consulta,5,-3). "/" . substr($data_consulta,0,-6); 
                                    $time = substr($horario_consulta,0,-6);

                            ?>

                                <section class="conteudo-serviçosadm">

                                    <img src="<?= URL . IMGCLIENTEADM . $foto_usuario?>" alt="icone vacina" class="img-serviços">

                                    <div class="procedimentoadm">

                                        <h2 class="título-serviço"><?= $nome_usuario ?> </h2>

                                        <div class="tipoServico">
                                            <h5> <?= $nome_consulta ?> </h5>
                                        </div>

                                        <div class="data"> 
                                            <?= $day ?>   <?= $time ?>h-00m<br> 
                                            <a href="<?= URLADM . "ConsultasAgendadas/Consulta?idConsulta=" . $idconsulta?>"> <button class="btn-maisinfo"> MAIS INFO </button> </a>
                                        </div>
                                        
                                        <div>
                                            <a href="<?= URLADM . "ConsultasAgendadas/Confirmar?idConsulta=" . $idconsulta?>" class="icone-check"><i class="fa fa-check-circle-o" aria-hidden="true"></i> </a>
                                        </div>

                                        <div> 
                                            <a href="<?= URLADM . "ConsultasAgendadas/Negar?idConsulta=" . $idconsulta?>" class="icone-cancel"><i class="fa fa-times-circle-o" aria-hidden="true"></i> </a>
                                        </div>

                                        <div>
                                            <h5> Esperando Confirmação </h5>
                                        </div>
                                    </div>

                                </section>

                                <hr class="linha"> <!-- LINHA PARA DIVIDIR CONTEÚDO -->

                            <?php 
                                } 
                            ?>

                        </div>
                    </div>

                </div>









                <div class="card">

                    <div class="card-header" id="headingTwo">

                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                aria-expanded="false" aria-controls="collapseTwo">
                                Histórico de Agendamentos
                            </button>
                        </h5>

                    </div>

                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">

                        <div class="card-body">

                            <section class="conteudo-serviçosadm">

                                <img src="../img/icone_vacina.png" alt="icone vacina" class="img-serviços">

                                <div class="procedimentoadm">
                                    <h2 class="título-serviço">Lara Alanis de Araújo </h2>
                                    <div class="tipoServico">
                                        <h5>CONSULTA</h5>
                                    </div>
                                    <div class="data"> 13 DE JULHO DE 2022 - 08:30 <br> <button class="btn-maisinfo"> MAIS
                                            INFO </button></div>

                                </div>

                            </section>

                            <hr class="linha"> <!-- LINHA PARA DIVIDIR CONTEÚDO -->


                            
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </main>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src="../js/navbar.js"> </script>
</body>

</html>