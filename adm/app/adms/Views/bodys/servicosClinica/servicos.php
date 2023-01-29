<!--CONTEÚDO PRINCIPAL-->
<main class="conteudo-principal">

    <h1 class="título">Serviços da Clínica</h1> <br>
       
    <?php
        if ($this->data['Ativos']){
            echo "<h3 class='subtítulo'>Ativos</h3>";
            for ($x = 0; $x < count($this->data['Ativos']); $x++) {
                $servico = $this->data['Ativos'][$x];
                extract($servico);
                $tempo = explode(":",$tempo_medio); 
    ?>

    <section class="conteudo-serviços">

        <div class="procedimento">
         
            <?php // relacionado a imagem do servico
                if (!empty($foto_servico)) { 
            ?>

                <img src="<?= URLADM . IMGADMSER . $foto_servico ?>" class='img-serviços'>
                <a href="<?= URLADM . "FotoServico/Apagar?idservico={$idtipo_consulta}" ?>"> <button class='editaexclui'>APAGAR</button>  </a> <br> <br>
                <a href="<?= URLADM . "FotoServico/Alterar?idservico={$idtipo_consulta}"?>"> <button class='editaexclui'>EDITAR</button>  </a> <br>

            <?php
                }else { 
            ?>
                <p class="info"> SEM IMAGEM </p>
                <a href="<?=  URLADM . "FotoServico/Adicionar?idservico={$idtipo_consulta}"?>"> <button class='editaexclui'>ADICONAR</button></a> <br>
            <?php
                }
            ?>
        
            <h3 class="título-serviço"> <?= $nome_consulta; ?> </h3>

            <!-- <h3 class="info"> <?php  //echo $sit_tipo_consulta; ?> </h3> -->

            <p class="info">R$<?= $valor_consulta . "<br>" . $tempo[0] . "h-" . $tempo[1] . "m";   ?> </p>

            <a> <button type="button" class="agendar" data-bs-toggle="modal" data-bs-target="#alterServiceModal<?= $idtipo_consulta ?>">ALTERAR</button> </a> 

            <a href="<?=  URLADM . "Servicos/Alterar-Sit-Servico?idServico={$idtipo_consulta}&sitServico={$sit_tipo_consulta}" ?>"> <button class="agendar">PRIVAR</button> </a>
            <!-- <a href="<?php  //URLADM . "Servicos/Delete?idServico={$idtipo_consulta}" ?>"> <button class="agendar">EXCLUIR</button> </a> -->
            
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
        } 
    } 
    ?>





    
        
    <?php
        if ($this->data['Inativos']){
            echo "<h3 class='subtítulo'>Inativos</h3>";
            for ($x = 0; $x < count($this->data['Inativos']); $x++) {
                $servico = $this->data['Inativos'][$x];
                extract($servico);
                $tempo = explode(":",$tempo_medio); 
    ?>


    <section class="conteudo-serviços">

        <div class="procedimento">
        
            <?php // relacionado a imagem do servico
                if (!empty($foto_servico)) { 
            ?>
                <img src="<?= URLADM . IMGADMSER . $foto_servico ?>" class='img-serviços'>
                <a href="<?= URLADM . "FotoServico/Apagar?idservico={$idtipo_consulta}" ?>"> <button class='editaexclui'>APAGAR</button>  </a> <br> <br>
                <a href="<?= URLADM . "FotoServico/Alterar?idservico={$idtipo_consulta}"?>"> <button class='editaexclui'>EDITAR</button>  </a> <br>
            <?php
                }else { 
            ?>
                <p class="info"> SEM IMAGEM </p>
                <a href="<?=  URLADM . "FotoServico/Adicionar?idservico={$idtipo_consulta}"?>"> <button class='editaexclui'>ADICONAR</button></a> <br>
            <?php
                }
            ?>
        
            <h3 class="título-serviço"> <?= $nome_consulta; ?> </h3>

            <!-- <h3 class="info"> <?php  //echo $sit_tipo_consulta; ?> </h3> -->

            <p class="info">R$<?= $valor_consulta . "<br>" . $tempo[0] . "h-" . $tempo[1] . "m";   ?> </p>

            <a> <button type="button" class="agendar" data-bs-toggle="modal" data-bs-target="#alterServiceModal<?= $idtipo_consulta ?>">EDITAR</button> </a> 

            <a href="<?= URLADM . "Servicos/Delete?idServico={$idtipo_consulta}" ?>"> <button class="agendar">EXCLUIR</button> </a>
            
            <a href="<?=  URLADM . "Servicos/Alterar-Sit-Servico?idServico={$idtipo_consulta}&sitServico={$sit_tipo_consulta}" ?>"> <button class="agendar">PUBLICAR</button> </a>

        </div>

    </section>


    <!-- LINHA PARA DIVIDIR CONTEÚDO -->
    <hr class="linha"> 


    <!-- JANELA MODAL -->
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
        } 
    } 
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

<script src="<?= JSADM ?>navbar.js"> </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
