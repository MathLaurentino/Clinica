<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Projeto de Conclusão de Curso - Site designado para uma clínica veterinária.">
    <script src="https://kit.fontawesome.com/7f492723e7.js" crossorigin="anonymous"></script>    
    <link rel="stylesheet" type="text/css" href="<?= CSSADM ?>infoExtra.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <title>Clínica Veterinária</title>
</head>

<body id="area_cliente">

    <!--CABEÇALHO-->
    <header class="cabecalho-principal"> 
        <img class="img" src="../img/logo.png" alt="logo da clínica">

        <nav class="menu">
            <a class="item">HOME</a>
            <a class="item">SERVIÇOS</a>
            <a class="item">CORPO CLÍNICO</a>
            <a href="serviços.html"> <button class="botao">AGENDE AQUI!</button> </a> 

            <!--PARTE DE ICONE E LOGIN-->
            <a href="login.html" class="login-user"> <i class="fa fa-user-circle-o fa-2x"  aria-hidden="true"></i></a>   
        </nav>
    </header>

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
            <strong>VACINA</strong> <br> 
            <strong>13 DE JULHO DE 2022 - 08:30</strong>  <br> 
            R$ 80
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
    
</body>

</html>