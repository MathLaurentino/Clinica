<!--CONTEÚDO PRINCIPAL-->
<main class="conteudo-principal">
    <h1 class="título">Escolha um de <br>nossos serviços</h1>


    <?php
        if (!empty($this->data)) {
            for ($x = 0; $x < sizeof($this->data); $x++) {

                $servico = $this->data;
                extract($servico[$x]);
                $tempo = explode(":", $tempo_medio); // $tempo_medio === "02:30:00"
                if (empty($foto_servico)) { $foto_servico = "logo.png"; }

    ?>

        <section class="conteudo-serviços">
            
            <img class='imgServico' src="<?= URLADM . IMGADMSERVICOS . $foto_servico ?>">

            <div class="procedimento">
                <h3 class="título-serviço"> <?= $nome_consulta ?> </h3>

                <p class="info">R$<?= $valor_consulta ?> <br> <?= $tempo[0] ?>h-<?= $tempo[1] ?>m</p>

                <a href="<?= URL ?>Agendamento/Horarios?servico=<?= $idtipo_consulta ?>"> <button class="botoes">AGENDAR</button></a>
            </div>

        </section>

        <hr class="linha"> <!-- LINHA PARA DIVIDIR CONTEÚDO -->

    <?php 
            }
        } else {
    ?>
           <h2> Sem servicos disponíveis! </h2>
    <?php 
        }
    ?>

</main>

<script src="<?= URL . JS ?>navbar.js"> </script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
