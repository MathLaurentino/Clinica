<!--CONTEÚDO PRINCIPAL-->
<main class="conteudo-principal"> 
    <h1 class="título">Agendamento</h1>
    <p class="subtítulo">confira se todas as informações estão corretas</p>

        <section class="linha-agendamento"> 
            
            <!--Informações Tutor + Pet-->
            <div class="info-principal">
                Nome tutor: <br>
                E-mail: <br>
                <div class="petescolhido"> 
                    Nome pet: 
                    <select name="" size="" >
                        <i class="fa-solid fa-sort-down"></i> 
                        <!--pets cadastrados pelo usuário: pode ser um ou vários-->
                        <option> Selecione o seu pet </option>
                        <option> Belinha </option>
                        <option> Mel</option>
                        <option> Otto </option>

        </select>

                </div> 
            </div>

<!--Resumo do Agendamento-->
    <div class="info-agendamento">
        <p class="título-agen"> Resumo do Agendamento </p>
        <!--EXEMPLO DE AGENDAMENTO-->
        <strong> <?= $this->data['servico']['nome_consulta'] ?> </strong> <br> 
        <strong> <?= $_GET['dia'] ?>  <?= $_GET['horario'] . "h 00m"?> </strong>  <br> 
        <strong> <?= $this->data['servico']['valor_consulta'] . "R$" ?> </strong>
    </div>
</section>


<!--Descrição Opcional-->
<form class="info-descrição"> 
<div class="form-group">
    <label class="título-desc">Descrição Opcional: </label>
    <textarea name="textarea" rows="4" cols="4" class="form-control"> Se desejar descreva o motivo do agendamento</textarea>

    </div>
    <input type="submit" value="CONFIRMAR" class="botão-confi">
    <input type="submit" value="CANCELAR" class="botão-canc"> 
</form>

</main>
