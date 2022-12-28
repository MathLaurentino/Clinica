<?php

if(!isset($_SESSION)){
    session_start();
}
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Clinica</title>

</head>

<body>

    <h2> Servicos da Clinica </h2>
    <hr>

    <!-- --------------- PARTE QUE MOSTRA OS SERVIÇOS --------------- -->

    <?php
        if ($this->data){

            for ($x = 0; $x < count($this->data); $x++) {
                $servico = $this->data[$x];
                extract($servico);

                if (!empty($foto_servico)) {  echo "<img height='100' src= '". URLADM . IMGADMSER . $foto_servico ." '> <br>"; } else { echo "sem foto <br>"; }

                if (empty($foto_servico)) {
                    echo "<a href='" . URLADM . "FotoServico/Adicionar?idservico={$idtipo_consulta}'> Adicionar foto</a> <br>"; 
                } else {
                    echo "<a href='" . URLADM . "FotoServico/Apagar?idservico={$idtipo_consulta}'> Apagar </a> <br>"; 
                    echo "<a href='" . URLADM . "FotoServico/Alterar?idservico={$idtipo_consulta}'> Alterar </a> <br>"; 
                }

                echo "<br>id "; 
                    if(isset($idtipo_consulta)) { echo $idtipo_consulta; };
                echo "<br>Nome: ";
                    if(isset($nome_consulta)) { echo $nome_consulta; }
                echo "<br>Valor: ";
                    if(isset($valor_consulta)) { echo $valor_consulta; }
                echo "<br>Descrição: ";
                    if(isset($descricao_consulta)) { echo $descricao_consulta; }     
                echo "<br>Tempo Médio: ";
                    if(isset($tempo_medio)) { echo $tempo_medio; }  
    ?>


        <div class="container"> 

            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#alterServiceModal<?= $idtipo_consulta ?>">
                Alterar
            </button>

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
            echo "<a href='" . URLADM . "Sobre-Clinica/delete?idServico={$idtipo_consulta}'> Deletar </a> <br>"; 
            echo "<hr>";
            
        } } 
    ?>


    <!-- --------------- PARTE DE ADICIONAR NOVO SERVIÇO --------------- -->

    <div class="container"> 

        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#newServiceModal">
            Adicionar Serviço
        </button>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>
