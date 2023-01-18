<!DOCTYPE html>
<html lang="pt-BR">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Projeto de Conclusão de Curso - Site designado para uma clínica veterinária.">
  <script src="https://kit.fontawesome.com/7f492723e7.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="<?= CSSADM ?>styleNavBar.css">
  <link rel="stylesheet" type="text/css" href="<?= CSSADM ?>style.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Clínica Veterinária</title>

</head>

<body id="area_cliente" class="fundoBody">

  <!--CABEÇALHO-->
  <header class="cabecalho-principal">
    <img class="img" src="<?= URLADM . IMGADMCLINICA ?>logo.png" alt="logo da clínica">
    <nav class="menu">
      <a class="item" href="<?= URLADM ?>AreaClientes/Dados"> ÁREA CLIENTES </a>
      <a class="item" href="<?= URLADM ?>Sobre-Clinica"> SOBRE CLÍNICA </a>
      <a href="<?= URLADM ?>ConsultasAgendadas/Clientes"> <button class="botao">SOLICITAÇÕES</button> </a>

      <!--PARTE DE ICONE E LOGIN-->
      <a href="login.html" class="login-user"> <i class="fa fa-user-circle-o fa-2x" aria-hidden="true"></i></a>
    </nav>
  </header>


  <!--CONTEÚDO PRINCIPAL-->
  <main class="conteudo-principal1">
    <h1 class="título">Seja bem-vindo, Admin!</h1>
    <h5 class="subtítulo"> Verifique as solitações de agendamento e otimize <br>a gestao de tempo da sua Clínica!</h5>
    <img class="imgHomeAdm" src="<?= URLADM . IMGADMCLINICA ?>img02.png">
  </main>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>