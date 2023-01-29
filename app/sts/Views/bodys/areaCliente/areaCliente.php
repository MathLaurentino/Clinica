<?php
if (!isset($_SESSION)) {
  session_start();
}
?>
<!--CONTEÚDO PRINCIPAL-->
<main class="conteudo-principal">
  <h1 class="título">Área do Cliente</h1>

  <!--COLLAPSE BOOTSTRAP-->
  <p class="center2">
    <button class="btn-areaCliente" id="infoP"><a class="btn-areaCliente" data-toggle="collapse" href="#infoPessoais" role="button" aria-expanded="true" aria-controls="infoPessoais">
        Informações Pessoais
      </a>
    </button>

    <button class="btn-areaCliente" id="agenda"> <a class="btn-areaCliente" data-toggle="collapse" href="#agendamentos" role="button" aria-expanded="true" aria-controls="agendamentos">
        Agendamentos
      </a>
    </button>
  </p>

  <div class="centraliza">

    <div class="collapse show" id="infoPessoais">

      <div class="card card-body">



        <!-- ------------------------------------------------------------------------ -->
        <!-- --------------------------- DADOS DO CLIENTE --------------------------- -->
        <!-- ------------------------------------------------------------------------ -->



        <div class="areaCliente">

          <?php
          extract($this->data['user'][0]);
          $nascimento = substr($data_nascimento, 8) . "/" . substr($data_nascimento, 5, -3) . "/" . substr($data_nascimento, 0, -6);
          if (isset($_SESSION['foto_usuario'])) {
          ?>
            <img class="imgSCliente" src="<?= URL . IMG . $foto_usuario ?>"> <!-- FOTO USUÁRIO -->
          <?php
          } else {
          ?>
            <img class="imgSCliente" src="<?= URL . IMGERRO ?>">
          <?php
          }
          ?>
          <div class="form-edição2"> <!-- DADOS DO USUÁRIO -->
            <b> Nome: </b> <?= $nome_usuario ?> <br>
            <b> CPF: </b> <?= $cpf ?> <br>
            <b> RG: </b> <?= $rg ?> <br>
            <b> Data Nascimento: </b> <?= $nascimento ?> <br>
            <b> E-mail: </b> <?= $email ?> <br>
          </div>

        </div>

        <?php
        if (isset($_SESSION['foto_usuario'])) {
        ?>
          <div class="iconeEdita"> <!-- BOTÃO DE APAGAR E ALTERAR FOTO USUÁRIO -->
            <a href="<?= URL . 'FotoUsuario/alterar' ?>"> <i class="fa fa-pencil-square" aria-hidden="true"></i> </a>
            <a href="<?= URL . 'FotoUsuario/apagar?' ?>"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
          </div>
        <?php
        } else {
        ?>
          <div class="iconeEdita"> <!-- BOTÃO DE ADICIONAR FOTO USUÁRIO -->
            <a href="<?= URL . 'FotoUsuario/adicionar' ?>"> <i class="fa fa-plus-square" aria-hidden="true"></i> </a>
          </div>
        <?php
        }
        ?>

        <div> <!-- BOTÃO PARA ALTERAR DADOS -->
          <p class="alinhaPadding"> <a href="<?= URL ?>Sobre-Cliente/Alterar-Dados"> <button class="btn-alterarDados"> alterar dados </button> </a></p>
        </div>

        <hr class="linha2"> <!-- LINHA PARA DIVIDIR CONTEÚDO -->







        <!-- --------------------------------------------------------------------------- -->
        <!-- --------------------------- ENDEREÇO DO CLIENTE --------------------------- -->
        <!-- --------------------------------------------------------------------------- -->







        <h3> Endereço </h3>



        <?php
        if (isset($_SESSION['idendereco'])) {
          extract($this->data['adress'][0]);
        ?>
          <div class="areaCliente">
            <div class="form-edição2"> <!-- DADOS DO ENDEREÇO DO USUÁRIO -->
              <b> CEP: </b> <?= $cep ?> <br>
              <b> Estado: </b> <?= $estado ?> <br>
              <b> Cidade: </b> <?= $cidade ?> <br>
              <b> Bairro: </b> <?= $bairro ?> <br>
              <b> Rua: </b> <?= $rua ?> <br>
              <b> Nº Residencial: </b> <?= $numero_residencial ?> <br>
            </div>

          </div>

          <!-- BOTÃO ALTERAR DADOS PET -->
          <p class="alinhaPadding"> <a href="<?= URL ?>Sobre-Cliente/Alterar-Dados-Endereco"> <button class="btn-alterarDados"> alterar dados </button> </a> </p>

        <?php
        } else {
        ?>

          Você ainda não tem um endereço cadastrado <br>
          <!-- BOTÃO ALTERAR DADOS PET -->
          <p class="alinhaPadding"> <a href="<?= URL ?>CadastroEndereco/Endereco"> <button class="btn-alterarDados"> adicionar endereço </button> </a> </p>

        <?php
        }
        ?>




        <!-- -------------------------------------------------------------------------->
        <!-- --------------------------- PETS DO CLIENTE --------------------------- -->
        <!-- -------------------------------------------------------------------------->






        <hr class="linha"> <!-- LINHA PARA DIVIDIR CONTEÚDO -->

        <h3> Pets </h3>


        <?php
        if (isset($this->data['pet'])) {
          for ($x = 0; $x < count($this->data['pet']); $x++) {
            $pet = $this->data['pet'][$x];
            extract($pet);
            $nascimento = substr($data_nascimento_pet, 8) . "/" . substr($data_nascimento_pet, 5, -3) . "/" . substr($data_nascimento_pet, 0, -6);

            if (empty($imagem_pet)) {
              $img_pet = "petSemFoto.png";
            } else {
              $img_pet = $imagem_pet;
            }
        ?>

            <div class="areaCliente">

              <img class="imgSCliente" src="<?= URL . IMG . $img_pet ?>">

              <div class="form-edição2">
                <b> Nome: </b> <?= $nome_pet ?> <br>
                <b> Idade: </b> <?= $nascimento ?> <br>
                <b> Espécie: </b> <?= $tipo_pet ?> <br>
                <b> Raça: </b> <?= $raca ?> <br>
                <b> Sexo: </b> <?= $sexo ?> <br>
                <b> Adicione a Carteira de Vacinação: </b> <?php if (!empty($imagem_carteira_pet)) { ?> <a href="<?= URL . IMG . $imagem_carteira_pet ?>" target="_blank"> <i class="fa fa-picture-o" aria-hidden="true"></i> </a> <?php } ?>
                <?php
                if (!empty($imagem_carteira_pet)) {
                ?>
                  <div class="iconeAdiciona center">
                    <a href="<?= URL . "FotoCarteira/Alterar?id=" . $idpet ?>"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                    <a href="<?= URL . "FotoCarteira/Apagar?id=" . $idpet ?>"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
                  </div>
                <?php
                } else {
                ?>
                  <div class="iconeAdiciona center">
                    <a href="<?= URL . "FotoCarteira/Adicionar?id=" . $idpet ?>"> <i class="fa fa-plus-square-o" aria-hidden="true"></i> </a>
                  </div>
                <?php
                }
                ?>

              </div>

            </div>

            <div>
              <?php
              if (empty($imagem_pet)) {
              ?>

                <div class="iconeEdita"> <a href="<?= URL . 'FotoPet/adicionar?id=' . $idpet; ?>"> <i class="fa fa-plus-square" aria-hidden="true"></i> </a> </div>

              <?php
              } else {
              ?>

                <div class="iconeEdita">
                  <a href="<?= URL . 'FotoPet/alterar?id=' . $idpet; ?>"> <i class="fa fa-pencil-square" aria-hidden="true"></i> </a>
                  <a href="<?= URL . 'FotoPet/apagar?id=' . $idpet; ?>"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
                </div>

              <?php
              }
              ?>
              <div class="alinhaPadding">
                <a href="<?= URL . "Sobre-Cliente/Alterar-Dados-Pet?id={$idpet}" ?>"> <button class="btn-alterarDados"> alterar dados </button> </a>
                <a href="<?= URL . "Sobre-Cliente/Apagar-Dados-Pet?idpet={$idpet}" ?>"> <button class="btn-alterarDados"> excluir </button> </a>
              </div>

            </div>

            <hr class="linha"> <!-- LINHA PARA DIVIDIR CONTEÚDO -->

          <?php
          }
          ?>

          <p class="center"> <a href="<?= URL . 'cadastroPet' ?>"> <button class="btn-addPet"> ADICIONAR PET </button> </a> </p>

        <?php
        } else {
        ?>

          Você ainda não tem nenhum PET cadastrado <br>
          <p class="alinhaPadding"> <a href="<?= URL ?>cadastroPet"> <button class="btn-alterarDados"> cadastrar pet </button> </a> </p>


        <?php
        }
        ?>



      </div>
    </div>
  </div>








  <!-- ------------------------------------------------------------------------------------------- -->
  <!-- --------------------------- HISTORICO DE AGENDAMENTO DO CLIENTE --------------------------- -->
  <!-- ------------------------------------------------------------------------------------------- -->









  <div class="centraliza">



    <!-- -------------------------------------------------------- -->
    <!-- --------------------- EM ANDAMENTO --------------------- -->
    <!-- -------------------------------------------------------- -->



    <div class="collapse" id="agendamentos">

      <div class="card card-body">


        <div class="texth2">
          <h2> Em Andamento </h2>
          <div>
            <hr class="linha"> <!-- LINHA PARA DIVIDIR CONTEÚDO -->

            <?php
            if (!empty($this->data['conusultaEmAndamento'])) {
              for ($x = 0; $x < count($this->data['conusultaEmAndamento']); $x++) {

                $agendamentos = $this->data['conusultaEmAndamento'][$x];
                extract($agendamentos);

                $day = substr($data_consulta, 8) . "/" . substr($data_consulta, 5, -3) . "/" . substr($data_consulta, 0, -6);
                $time = substr($horario_consulta, 0, -6) . "h 00m";
            ?>

                <section class="conteudo-serviçosadm">

                  <img src="<?= URLADM . IMGADMSERVICOS . $foto_servico ?>" alt="icone vacina" class="img-serviços2">

                  <div class="procedimentoadm">

                    <h2 class="título-serviço"><?= $nome_pet ?></h2>

                    <div class="tipoServico">
                      <h5> <?= $nome_consulta ?> </h5>
                    </div>

                    <div class="data">
                      <?= $day . " " . $time ?> <br>
                      <button type="button" class="btn-maisinfo" data-toggle="modal" data-target="#maisInfoAndamento<?= $idconsulta ?>"> MAIS INFO </button>
                      <!-- <a href="<?= URL . "Sobre-Cliente/Mais-Info-Consulta?idConsulta=" . $idconsulta ?>"> <button class="btn-maisinfo"> MAIS INFO </button> </a> -->
                    </div>

                    <div class="tipoServico">
                      <h5> <?= $sit_consulta ?> </h5>
                    </div>


                    <?php
                    if ($sit_consulta == "A Confirmar" || $sit_consulta == "Confirmado") { //
                    ?>

                      <div class="botaoCancela">
                        <p class="icone-cancel"> <a href="<?= URL . "Agendamento/Solicitar-Cancelamento?idConsulta=" . $idconsulta . "&dataConsulta=" . $data_consulta . "&horaConsulta=" . $time ?>" class="icone-cancel"> <i class="fa fa-times-circle-o" aria-hidden="true"></i> </a> </p>
                      </div>

                    <?php
                    } else {
                    ?>

                      <div class="botaoCancela">
                        <p class="icone-tipo"> <i class="fa fa-clock-o" aria-hidden="true"></i> </p>
                      </div>



                    <?php
                    }
                    ?>

                  </div>

                </section>

                <!-- Modal -->
                <div class="modal fade" id="maisInfoAndamento<?= $idconsulta ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">

                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Mais Informações</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                      </div>

                      <div class="modal-body">
                        <ul class="list-group">
                          <li class="list-group-item"><b> Serviço: </b> <?= $nome_consulta ?> </li>
                          <li class="list-group-item"><b> Situação: </b> <?= $sit_consulta ?> </li>
                          <li class="list-group-item"><b> Pet: </b> <?= $nome_pet ?> </li>
                          <br>
                          <li class="list-group-item"><b> Data: </b> <?= $day ?> </li>
                          <li class="list-group-item"><b> Horário: </b> <?= $time ?> </li>
                          <br>
                          <li class="list-group-item"><b> Descrição: </b> <?= $descricao ?> </li>
                        </ul>
                      </div>

                    </div>
                  </div>
                </div>

                <hr class="linha"> <!-- LINHA PARA DIVIDIR CONTEÚDO -->

              <?php
              }
            } else {
              ?>
              Sem serviços agendados! <br>
            <?php
            }
            ?>



            <!-- ------------------------------------------------------- -->
            <!-- --------------------- CONCLUOÍDOS --------------------- -->
            <!-- ------------------------------------------------------- -->



            <div class="texth2">
              <h2> Concluídos </h2>
              <div>
                <hr class="linha"> <!-- LINHA PARA DIVIDIR CONTEÚDO -->

                <?php
                if (!empty($this->data['consultasFinalizadas'])) {
                  for ($x = 0; $x < count($this->data['consultasFinalizadas']); $x++) {

                    $agendamentos = $this->data['consultasFinalizadas'][$x];
                    extract($agendamentos);

                    $day = substr($data_consulta, 8) . "/" . substr($data_consulta, 5, -3) . "/" . substr($data_consulta, 0, -6);
                    $time = substr($horario_consulta, 0, -6) . "h 00m";
                ?>

                    <section class="conteudo-serviçosadm">

                      <img src="<?= URLADM . IMGADMSERVICOS . $foto_servico ?>" alt="icone vacina" class="img-serviços2">

                      <div class="procedimentoadm">

                        <h2 class="título-serviço"><?= $nome_pet ?></h2>

                        <div class="tipoServico">
                          <h5> <?= $nome_consulta ?> </h5>
                        </div>

                        <div class="data">
                          <?= $day . " " . $time ?> <br>
                          <button type="button" class="btn-maisinfo" data-toggle="modal" data-target="#maisInfoConcluidos<?= $idconsulta ?>"> MAIS INFO </button>
                          <!-- <a href="<?= URL . "Sobre-Cliente/Mais-Info-Consulta?idConsulta=" . $idconsulta ?>"> <button class="btn-maisinfo"> MAIS INFO </button> </a> -->
                        </div>

                        <div class="tipoServico">
                          <h5> <?= $sit_consulta ?> </h5>
                        </div>

                        <div class="botaoCancela">
                          <p class="icone-check"> <i class="fa fa-check-circle-o" aria-hidden="true"></i> </p>
                        </div>

                      </div>

                    </section>

                    <!-- Modal -->
                    <div class="modal fade" id="maisInfoConcluidos<?= $idconsulta ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">

                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Mais Informações</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                          </div>

                          <div class="modal-body">
                            <ul class="list-group">
                              <li class="list-group-item"><b> Serviço: </b> <?= $nome_consulta ?> </li>
                              <li class="list-group-item"><b> Situação: </b> <?= $sit_consulta ?> </li>
                              <li class="list-group-item"><b> Pet: </b> <?= $nome_pet ?> </li>
                              <br>
                              <li class="list-group-item"><b> Data: </b> <?= $day ?> </li>
                              <li class="list-group-item"><b> Horário: </b> <?= $time ?> </li>
                              <br>
                              <li class="list-group-item"><b> Descrição: </b> <?= $descricao ?> </li>
                            </ul>
                          </div>

                        </div>
                      </div>
                    </div>

                    <hr class="linha"> <!-- LINHA PARA DIVIDIR CONTEÚDO -->

                  <?php
                  }
                } else {
                  ?>
                  Sem serviços concluídos! <br>
                <?php
                }
                ?>

              </div>
            </div>
          </div>


</main>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="<?= URL . JS ?>navbar.js"> </script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="<?= URL . JS ?>areaCliente.js"> </script>