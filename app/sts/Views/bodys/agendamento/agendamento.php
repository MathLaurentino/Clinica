<?php
    $dia = $_GET['dia'];
    $dia = substr($dia,8) . "/" . substr($dia, 5, -3) . "/" . substr($dia, 0, -6);
    $hora = $_GET['horario'] . "h00m";
?>

<!--CONTEÚDO PRINCIPAL-->
<main class="conteudo-principal"> 

    <h1 class="título">Agendamento</h1>
    <p class="subtítulo">confira se todas as informações estão corretas</p>

    <section class="linha-agendamento"> 
        <!--Informações Tutor + Pet-->

        <div class="info-principal">
            <b> Nome tutor: </b><?= $_SESSION['nome_usuario'] ?> <br>
            <b> E-mail: </b> <?= $_SESSION['email_usuario'] ?> <br>
        </div>

        <!--Resumo do Agendamento-->
        <div class="info-agendamento">
            <p class="título-agen"> Resumo do Agendamento </p>
            <strong> <?= $this->data['servico']['nome_consulta'] ?> </strong> <br> 

            <strong> <?= $dia ?>  <?= $hora ?> </strong> <br> 
            <strong> <?= $this->data['servico']['valor_consulta'] ?>R$ </strong>
        </div>

    </section>

    <br>


    <!--FORMULÁRIO-->
    <form method="post" action="" class="info-descrição"> 

        <input type="hidden" name="data_consulta" value="<?= $_GET['dia'] ?>">
        <input type="hidden" name="horario_consulta" value="<?= $_GET['horario'] . ":00:00"?>">
        <input type="hidden" name="tipo_consulta" value="<?= $_GET['servico'] ?>">
        
        <div class="petescolhido"> 
            Nome pet: 
            <select name="pet" size="" >

                <i class="fa-solid fa-sort-down"></i> 
                    <!--pets cadastrados pelo usuário: pode ser um ou vários-->
                <?php  
                    $pets = $this->data['pets'];
                    for ($x = 0; $x < count($pets); $x++) {
                        $pet = $pets[$x];
                        extract($pet);            
                ?>
                    <option value='<?= $idpet ?>'><?= $nome_pet ?></option>
                <?php
                    }
                ?>

            </select>
        </div> 

        <!--Descrição Opcional-->
        <div class="form-group">
            <label class="título-desc">Descrição Opcional: </label>
            <textarea name="descricao" rows="4" cols="4" class="form-control"> Se desejar descreva o motivo do agendamento</textarea>
        </div>

        <input type="submit" name="agendar" value="CONFIRMAR" class="botão-confi">
        <input type="submit" name="cancelar" value="CANCELAR" class="botão-canc"> 

    </form>

</main>
