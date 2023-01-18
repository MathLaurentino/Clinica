<!--CONTEÚDO PRINCIPAL-->
<main class="conteudo-principal">
    <h1 class="título">Escolha um de <br>nossos serviços</h1>


    <?php

        for ($x = 0; $x < sizeof($this->data['tipo_consulta']); $x++) {

            $servico = $this->data['tipo_consulta'];
            extract($servico[$x]);
            $tempo = explode(":", $tempo_medio); // $tempo_medio === "02:30:00"

    ?>

        <section class="conteudo-serviços">

            <?php if (!empty($foto_servico)) { echo "<img class='img' src='" . URLADM . IMGADMSERVICOS . $foto_servico . "' class=''>"; } else { echo "<img class='img' src='" . URL . IMGCLINICA . 'logo.pn' . "' class=''>"; } ?>

            <div class="procedimento">
                <h3 class="título-serviço"> <?= $nome_consulta ?> </h3>

                <p class="info">R$<?= $valor_consulta ?> <br> <?= $tempo[0] ?>h-<?= $tempo[1] ?>m</p>

                <a href="<?= URL ?>Agendamento/Horarios?servico=<?= $idtipo_consulta ?>"> <button class="botoes">AGENDAR</button></a>
            </div>

        </section>

        <hr class="linha"> <!-- LINHA PARA DIVIDIR CONTEÚDO -->

    <?php } ?>

</main>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
