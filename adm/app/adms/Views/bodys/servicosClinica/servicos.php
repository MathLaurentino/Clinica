
<!--CABEÇALHO-->
<header class="cabecalho-principal">

    <img class="img" src="<?= URLADM . IMGADMCLINICA ?>logo.png" alt="logo da clínica">

    <nav class="menu">
        <a class="item">HOME</a>
        <a class="item">SERVIÇOS</a>
        <a class="item">CORPO CLÍNICO</a>
        <a href="#"> <button class="botao">AGENDE AQUI!</button> </a> 

        <!--PARTE DE ICONE E LOGIN-->
        <nav class="nav__bar">

            <div class="mobile-menu">
                <div class="icone"> 
                    <i class="fa fa-user-circle-o fa-2x"  aria-hidden="true"></i> 
                </div>
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

    <h1 class="título">Serviços da Clínica</h1>

    <?php
        if ($this->data){
            for ($x = 0; $x < count($this->data); $x++) {
                $servico = $this->data[$x];
                extract($servico);
                $tempo = explode(":",$tempo_medio); 
    ?>

    <section class="conteudo-serviços">

        <div class="procedimento">

            <?php // relacionado a imagem do servico
                if (!empty($foto_servico)) { 
                    echo "<img src='". URLADM . IMGADMSER . $foto_servico ."' class='img-serviços'>";
                    echo "<a href='" . URLADM . "FotoServico/Apagar?idservico={$idtipo_consulta}'> <button class='editaexclui'>APAGAR</button>  </a> <br>"; 
                    echo "<br>";
                    echo "<a href='" . URLADM . "FotoServico/Alterar?idservico={$idtipo_consulta}'> <button class='editaexclui'>EDITAR</button>  </a> <br>"; 
                } else { 
                    echo "sem foto <br>";
                    echo "<a href='" . URLADM . "FotoServico/Adicionar?idservico={$idtipo_consulta}'> <button class='editaexclui'>ADICONAR</button></a> <br>"; 
                } 
            ?>
        
            <h3 class="título-serviço"> <?php  echo $nome_consulta; ?> </h3>

            <p class="info">R$<?php  echo $valor_consulta . "<br>" . $tempo[0] . "h-" . $tempo[1] . "m";   ?> </p>

            <a> <button type="button" class="agendar" data-bs-toggle="modal" data-bs-target="#alterServiceModal<?= $idtipo_consulta ?>"> Alterar </button> </a> 

            <a href="<?= URLADM . "Sobre-Clinica/delete?idServico={$idtipo_consulta}" ?>"> <button class="agendar">EXCLUIR</button> </a>
            
        </div>

    </section>

    <hr class="linha"> <!-- LINHA PARA DIVIDIR CONTEÚDO -->

    <div class="container"> 
                <!-- Modal -->
        <div class="modal fade" id="alterServiceModal<?= $idtipo_consulta ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog">

                <div class="modal-content">
                    
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Altera Dados Serviço</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body"> <!-- Formulário dentro do modal -->

                        <form id="alter-service-form" method="post" action="">

                            <input type="hidden" name="idtipo_consulta" value="<?php if(isset($idtipo_consulta)) { echo $idtipo_consulta; } ?>">

                            <div class="mb-3"> <!-- Nome -->
                                <label for="nome" class="col-form-label">Nome:</label>
                                <input type="text" class="form-control" id="nome" name="nome_consulta" required value="<?php if(isset($nome_consulta)) { echo $nome_consulta; } ?>">
                            </div>

                            <div class="mb-3"> <!-- Descrição -->
                                <label for="descricao" class="col-form-label">Descrição:</label>
                                <textarea class="form-control" id="descricao" name="descricao_consulta" required><?php if(isset($descricao_consulta)) {echo $descricao_consulta; } ?> </textarea>
                                <!-- <input type="text" class="form-control" id="descricao" name="descricao_consulta"> -->
                            </div>

                            <div class="mb-3"> <!-- Valor -->
                                <label for="valor" class="col-form-label">Valor:</label>
                                <input type="text" class="form-control" id="valor" name="valor_consulta" required value="<?php if(isset($valor_consulta)) {echo $valor_consulta; } ?>">
                            </div>

                            <div class="mb-3"> <!-- Valor -->
                                <label for="tempo" class="col-form-label">Tempo Médio:</label>
                                <input type="time" class="form-control" id="tempo" name="tempo_medio" required value="<?php if(isset($tempo_medio)) {echo $tempo_medio; } ?>">
                            </div>

                            <div class="mb-3"> <!-- Botão -->
                                <input type="submit" class="btn btn-primary bt-sm" value="alterar" id="alter-service-bnt" name="AlterServico" >
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php     
        } } 
    ?>


    
    <div class="addServicos">
        
        <a> <button type="button" class="addServicosBotao" data-bs-toggle="modal" data-bs-target="#newServiceModal">ADICIONAR SERVIÇO</button> </a>

        <div class="container"> 
                    <!-- Modal -->
            <div class="modal fade" id="newServiceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                <div class="modal-dialog">

                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Serviço</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body"> <!-- Formulário dentro do modal -->

                            <form id="submit-new-service-form" method="post" action="">

                                <div class="mb-3"> <!-- Nome -->
                                    <label for="nome" class="col-form-label">Nome:</label>
                                    <input type="text" class="form-control" required id="nome" name="nome_consulta">
                                </div>

                                <div class="mb-3"> <!-- Descrição -->
                                    <label for="descricao" class="col-form-label">Descrição:</label>
                                    <textarea class="form-control" required id="descricao" name="descricao_consulta"></textarea>
                                    <!-- <input type="text" class="form-control" id="descricao" name="descricao_consulta"> -->
                                </div>

                                <div class="mb-3"> <!-- Valor -->
                                    <label for="valor" class="col-form-label">Valor:</label>
                                    <input type="text" class="form-control" required id="valor" name="valor_consulta">
                                </div>

                                <div class="mb-3"> <!-- Valor -->
                                    <label for="tempo" class="col-form-label">Tempo Médio:</label>
                                    <input type="time" class="form-control" required id="tempo" name="tempo_medio">
                                </div>

                                <div class="mb-3"> <!-- Botão -->
                                    <input type="submit" class="btn btn-primary bt-sm" value="Adicionar" id="submit-new-service-bnt" name="AddServico" >
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
