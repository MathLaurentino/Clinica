<!--CONTEÚDO PRINCIPAL-->
<main class="conteudo-principal">
    <h1 class="título">Painel de Gerenciamento</h1>

    <!--COLLAPSE BOOTSTRAP-->
    <p class="center2">

        <button class="btn-areaCliente" id="bntAgendamento"> <a class="btn-areaCliente" data-toggle="collapse" href="#agendamentos" role="button" aria-expanded="true" aria-controls="agendamentos">
                Solicitações de Agendamento
            </a>
        </button>
        

        <button class="btn-areaCliente" id="bntCancelamento"> <a class="btn-areaCliente" data-toggle="collapse" href="#cancelamento" role="button" aria-expanded="true" aria-controls="cancelamento">
                Solicitações de Cancelamento
            </a>
        </button>

        <br>

        <button class="btn-areaCliente" id="bntHistorico"><a class="btn-areaCliente" data-toggle="collapse" href="#historico" role="button" aria-expanded="true" aria-controls="historico">
                Histórico
            </a>
        </button>

        

        
    </p>

    <!--COLLAPSE BOOTSTRAP-->
    <div class="opcoes">



        <!-- ---------------------------------------------------------------------------------- -->
        <!-- --------------------------- Solicitação de Agendamento --------------------------- -->
        <!-- ---------------------------------------------------------------------------------- -->



        <div class="centraliza">
            
            <div class="collapse show" id="agendamentos">

                <div class="card card-body">

                    <?php

                    if (!empty($this->data['aConfirmar'])) {
                        for ($x = 0; $x < count($this->data['aConfirmar']); $x++) {

                            $consulta = $this->data['aConfirmar'][$x];
                            extract($consulta);

                            if (empty($foto_usuario)) { $foto_usuario = "Sem_Foto.png"; }
                            if ($sit_consulta == "A Confirmar") { $sit = "Esperando Confirmação"; }

                            $day = substr($data_consulta, 8) . "/" . substr($data_consulta, 5, -3) . "/" . substr($data_consulta, 0, -6);
                            $time = substr($horario_consulta, 0, -6) . "h-00m";

                            $NascPet = substr($data_nascimento_pet, 8) . "/" . substr($data_nascimento_pet, 5, -3) . "/" . substr($data_nascimento_pet, 0, -6);
                    ?>

                        <section class="conteudo-serviçosadm">

                            <img src="<?= URL . IMGCLIENTEADM . $foto_usuario ?>" class="img-serviços">

                            <div class="procedimentoadm">

                                <h2 class="título-serviço"><?= $nome_usuario ?> </h2>

                                <div class="tipoServico">
                                    <h5> <?= $nome_consulta ?> </h5>
                                </div>

                                <div class="data">
                                    <?= $day ?> <?= $time ?><br>
                                    <button type="button" class="btn-maisinfo" data-bs-toggle="modal" data-bs-target="#agendamento<?= $idconsulta ?>"> MAIS INFO </button>    
                                    <!-- <a href="<?php // URLADM . "ConsultasAgendadas/Consulta?idConsulta=" . $idconsulta ?>"> <button class="btn-maisinfo"> MAIS INFO </button> </a> -->
                                </div>

                                <div>
                                    <a href="<?= URLADM . "ConsultasAgendadas/confirmar-Agendamento?idConsulta=" . $idconsulta ?>" class="icone-check"><i class="fa fa-check-circle-o" aria-hidden="true"></i> </a>
                                </div>

                                <div>
                                    <a href="<?= URLADM . "ConsultasAgendadas/Negar-Agendamento?idConsulta=" . $idconsulta ?>" class="icone-cancel"><i class="fa fa-times-circle-o" aria-hidden="true"></i> </a>
                                </div>

                                <div class="data"> 
                                    <h5> <?= $sit ?> </h5>
                                </div>
                            </div>

                        </section>

                        <hr class="linha"> <!-- LINHA PARA DIVIDIR CONTEÚDO -->

                        <div class="modal t-modal fade" id="agendamento<?= $idconsulta ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog"> <!-- modal-dialog modal-lg -->
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Mais Informações</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <b> Nome Usuário: </b> <?= $nome_usuario ?> <br>
                                        Email usuario: <?= $email ?> <br><br>

                                        Nome do Pet: <?= $nome_pet ?> <br>
                                        Data Nasc. Pet: <?= $NascPet ?> <br> <!-- data_nascimento_pet -->
                                        Sexo Pet: <?= $sexo ?> <br>
                                        Tipo Pet: <?= $tipo_pet ?> <br>
                                        Raca Pet: <?= $raca ?> <br><br>

                                        Data: <?= $day ?> <br>
                                        Horario: <?= $time ?> <br>
                                        Descricao: <?= $descricao ?> <br>
                                        Tipo consulta: <?= $tipo_consulta ?> <br>
                                        Situação: <?= $sit_consulta ?> <br><br>

                                        Tipo Marcada: <?= $nome_consulta ?> <br>
                                        <!-- Descrição Tipo Consulta: <?= $descricao_consulta ?> <br>
                                        Tempo Médio: <?= $tempo_medio ?> <br> -->
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                    <?php
                        }
                    } else {
                    ?>
                            <h3 class="serviços"> vazio <h3> 
                    <?php
                        }
                    ?>

                </div>
            </div>
        </div>



        <!-- ----------------------------------------------------------------------------------- -->
        <!-- --------------------------- Solicitação de Cancelamento --------------------------- -->
        <!-- ----------------------------------------------------------------------------------- -->



        <div class="centraliza">

            <div class="collapse" id="cancelamento">

                <div class="card card-body">
                    
                    <?php

                    if (!empty($this->data['aCancelar'])) {
                        for ($x = 0; $x < count($this->data['aCancelar']); $x++) {

                            $consulta = $this->data['aCancelar'][$x];
                            extract($consulta);

                            if (empty($foto_usuario)) {
                                $foto_usuario = "Sem_Foto.png";
                            }

                            if ($sit_consulta == "A Cancelar") { $sit = "Solicitação de Cancelamento"; }

                            $day = substr($data_consulta, 8) . "/" . substr($data_consulta, 5, -3) . "/" . substr($data_consulta, 0, -6);
                            $time = substr($horario_consulta, 0, -6) . "h-00m";

                            $NascPet = substr($data_nascimento_pet, 8) . "/" . substr($data_nascimento_pet, 5, -3) . "/" . substr($data_nascimento_pet, 0, -6);
                    ?>

                        <section class="conteudo-serviçosadm">

                            <img src="<?= URL . IMGCLIENTEADM . $foto_usuario ?>" class="img-serviços">

                            <div class="procedimentoadm">

                                <h2 class="título-serviço"><?= $nome_usuario ?> </h2>

                                <div class="tipoServico">
                                    <h5> <?= $nome_consulta ?> </h5>
                                </div>

                                <div class="data">
                                    <?= $day ?> <?= $time ?>h-00m<br>
                                    <button type="button" class="btn-maisinfo" data-bs-toggle="modal" data-bs-target="#cancelamento<?= $idconsulta ?>"> MAIS INFO </button>    
                                </div>

                                <div>
                                    <a href="<?= URLADM . "ConsultasAgendadas/Aceitar-Cancelamento?idConsulta=" . $idconsulta ?>" class="icone-check"><i class="fa fa-check-circle-o" aria-hidden="true"></i> </a>
                                </div>

                                <div class="data"> 
                                    <h5> <?= $sit ?> </h5>
                                </div>
                            </div>

                        </section>

                        <hr class="linha"> <!-- LINHA PARA DIVIDIR CONTEÚDO -->

                        <div class="modal t-modal fade" id="cancelamento<?= $idconsulta ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Mais Informações</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <b> Nome Usuário: </b> <?= $nome_usuario ?> <br>
                                        Email usuario: <?= $email ?> <br><br>

                                        Nome do Pet: <?= $nome_pet ?> <br>
                                        Data Nasc. Pet: <?= $NascPet ?> <br>
                                        Sexo Pet: <?= $sexo ?> <br>
                                        Tipo Pet: <?= $tipo_pet ?> <br>
                                        Raca Pet: <?= $raca ?> <br><br>

                                        Data: <?= $day ?> <br>
                                        Horario: <?= $time ?> <br>
                                        Descricao: <?= $descricao ?> <br>
                                        Tipo consulta: <?= $tipo_consulta ?> <br>
                                        Situação: <?= $sit_consulta ?> <br><br>

                                        Tipo Marcada: <?= $nome_consulta ?> <br>
                                        <!-- Descrição Tipo Consulta: <?= $descricao_consulta ?> <br>
                                        Tempo Médio: <?= $tempo_medio ?> <br> -->
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                    <?php
                        }
                    } else {
                    ?>
                            <h3 class="serviços"> vazio <h3> 
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>



        <!-- ----------------------------------------------------------------------------------- -->
        <!-- ------------------------------------ Historico ------------------------------------ -->
        <!-- ----------------------------------------------------------------------------------- --> 




        <div class="centraliza">

            <div class="collapse" id="historico">

                <div class="card card-body">

                    <h3 class='serviços'>Em Andamento</h3> 
                    <hr class='linha'> <!-- LINHA PARA DIVIDIR CONTEÚDO -->
                    <br>
                    <?php
                    if (!empty($this->data['confirmados'])) {
                        for ($x = 0; $x < count($this->data['confirmados']); $x++) {

                            $consulta = $this->data['confirmados'][$x];
                            extract($consulta);

                            if (empty($foto_usuario)) {
                                $foto_usuario = "Sem_Foto.png";
                            }

                            $day = substr($data_consulta, 8) . "/" . substr($data_consulta, 5, -3) . "/" . substr($data_consulta, 0, -6);
                            $time = substr($horario_consulta, 0, -6) . "h-00m";

                            $NascPet = substr($data_nascimento_pet, 8) . "/" . substr($data_nascimento_pet, 5, -3) . "/" . substr($data_nascimento_pet, 0, -6);
                    ?>

                        <section class="conteudo-serviçosadm">

                            <img class="img-serviços" src="<?= URL . IMGCLIENTEADM . $foto_usuario ?>" alt="icone vacina" class="img-serviços">

                            <div class="procedimentoadm">

                                <h2 class="título-serviço"><?= $nome_usuario ?> </h2>

                                <div class="tipoServico">
                                    <h5> <?= $nome_consulta ?> </h5>
                                </div>

                                <div class="data">
                                    <?= $day ?> <?= $time ?><br>
                                    <button type="button" class="btn-maisinfo" data-bs-toggle="modal" data-bs-target="#historico<?= $idconsulta ?>"> MAIS INFO </button>    
                                </div>

                                <div class="tipoServico">
                                    <h5> <?= $sit_consulta ?> </h5>
                                </div>

                            </div>

                        </section>

                        <hr class="linha"> <!-- LINHA PARA DIVIDIR CONTEÚDO -->

                        <div class="modal t-modal fade" id="historico<?= $idconsulta ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Mais Informações</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <b> Nome Usuário: </b> <?= $nome_usuario ?> <br>
                                        Email usuario: <?= $email ?> <br><br>

                                        Nome do Pet: <?= $nome_pet ?> <br>
                                        Data Nasc. Pet: <?= $NascPet ?> <br>
                                        Sexo Pet: <?= $sexo ?> <br>
                                        Tipo Pet: <?= $tipo_pet ?> <br>
                                        Raca Pet: <?= $raca ?> <br><br>

                                        Data: <?= $day ?> <br>
                                        Horario: <?= $time ?> <br>
                                        Descricao: <?= $descricao ?> <br>
                                        Tipo consulta: <?= $tipo_consulta ?> <br>
                                        Situação: <?= $sit_consulta ?> <br><br>

                                        Tipo Marcada: <?= $nome_consulta ?> <br>
                                        <!-- Descrição Tipo Consulta: <?= $descricao_consulta ?> <br>
                                        Tempo Médio: <?= $tempo_medio ?> <br> -->
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    
                    <?php
                        }} else {
                    ?>
                        <h3 class="serviços"> vazio <h3> 
                        <hr class='linha'> <!-- LINHA PARA DIVIDIR CONTEÚDO -->
                    <?php
                        }
                    ?>









                        <h3 class='serviços'>Concluídos</h3> 
                        <hr class='linha'> <!-- LINHA PARA DIVIDIR CONTEÚDO -->
                        <br>
                    <?php

                    if (!empty($this->data['outros'])) {

                        for ($x = 0; $x < count($this->data['outros']); $x++) {

                            $consulta = $this->data['outros'][$x];
                            extract($consulta);

                            if (empty($foto_usuario)) {
                                $foto_usuario = "Sem_Foto.png";
                            }

                            $day = substr($data_consulta, 8) . "/" . substr($data_consulta, 5, -3) . "/" . substr($data_consulta, 0, -6);
                            $time = substr($horario_consulta, 0, -6) . "h-00m";

                            $NascPet = substr($data_nascimento_pet, 8) . "/" . substr($data_nascimento_pet, 5, -3) . "/" . substr($data_nascimento_pet, 0, -6);

                    ?>

                        <section class="conteudo-serviçosadm">

                            <img class="img-serviços" src="<?= URL . IMGCLIENTEADM . $foto_usuario ?>" alt="icone vacina" class="img-serviços">

                            <div class="procedimentoadm">

                                <h2 class="título-serviço"><?= $nome_usuario ?> </h2>

                                <div class="tipoServico">
                                    <h5> <?= $nome_consulta ?> </h5>
                                </div>

                                <div class="data">
                                    <?= $day ?> <?= $time ?><br>
                                    <button type="button" class="btn-maisinfo" data-bs-toggle="modal" data-bs-target="#historico<?= $idconsulta ?>"> MAIS INFO </button>    
                                </div>

                                <div class="tipoServico">
                                    <h5> <?= $sit_consulta ?> </h5>
                                </div>
                            </div>

                        </section>

                        <hr class="linha"> <!-- LINHA PARA DIVIDIR CONTEÚDO -->
                        <!-- Modal -->

                        <div class="modal t-modal fade" id="historico<?= $idconsulta ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Mais Informações</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <b> Nome Usuário: </b> <?= $nome_usuario ?> <br>
                                        Email usuario: <?= $email ?> <br><br>

                                        Nome do Pet: <?= $nome_pet ?> <br>
                                        Data Nasc. Pet: <?= $NascPet ?> <br>
                                        Sexo Pet: <?= $sexo ?> <br>
                                        Tipo Pet: <?= $tipo_pet ?> <br>
                                        Raca Pet: <?= $raca ?> <br><br>

                                        Data: <?= $day ?> <br>
                                        Horario: <?= $time ?> <br>
                                        Descricao: <?= $descricao ?> <br>
                                        Tipo consulta: <?= $tipo_consulta ?> <br>
                                        Situação: <?= $sit_consulta ?> <br><br>

                                        Tipo Marcada: <?= $nome_consulta ?> <br>
                                        <!-- Descrição Tipo Consulta: <?= $descricao_consulta ?> <br>
                                        Tempo Médio: <?= $tempo_medio ?> <br> -->
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                    <?php
                    }} else {
                    ?>
                        <h3 class="serviços"> vazio <h3> 
                        <hr class='linha'> <!-- LINHA PARA DIVIDIR CONTEÚDO -->
                    <?php
                        }
                    ?>

                </div>
            </div>
        </div>

    </div>


    

</main>

<script src="<?= JSADM ?>areaCliente.js"> </script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="<?= JSADM ?>navbar.js"> </script>