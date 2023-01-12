<?php

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['msg'])) {
    echo "Mensagem: " . $_SESSION['msg'] . "<br>"; 
    unset($_SESSION['msg']);   
}
if(isset($this->data)){
    extract($this->data['user'][0]);
}
//echo"<pre>"; var_dump($this->data['agendamentos'][0]);echo"</pre>";

?>
  <!--CONTEÚDO PRINCIPAL-->
  <main class="conteudo-principal">
    <h1 class="título">Área do Cliente</h1>

    <!--COLLAPSE BOOTSTRAP-->
    <p class="center2">
      <button class="btn-areaCliente" id="infoP"><a class="btn-areaCliente" data-toggle="collapse" href="#infoPessoais"
          role="button" aria-expanded="true" aria-controls="infoPessoais">
          Informações Pessoais
        </a>
      </button>

      <button class="btn-areaCliente" id="agenda"> <a class="btn-areaCliente" data-toggle="collapse"
          href="#agendamentos" role="button" aria-expanded="true" aria-controls="agendamentos">
          Agendamentos
        </a>
      </button>
    </p>

    <div class="centraliza">

      <div class="collapse show" id="infoPessoais">

        <div class="card card-body">

          <div class="areaCliente">

            <?php
              extract($this->data['user'][0]);
              if (isset($_SESSION['foto_usuario'])) {
            ?>

              <img class="imgSCliente" src="<?= URL . IMG . $foto_usuario?>">

            <?php
              } else {
            ?> 

              <img class="imgSCliente" src="<?= URL . IMGERRO ?>">

            <?php
              }
            ?>
              <div class="form-edição2">
                <b> Nome: </b> <?= $nome_usuario ?> <br>
                <b> CPF: </b> <?= $cpf ?> <br>           
                <b> RG: </b> <?= $rg ?> <br>
                <b> Data Nasc: </b> <?= $data_nascimento ?> <br>
                <b> E-mail: </b> <?= $email ?> <br> 
              </div>

          </div>




          <div>
            <a href="<?php if (isset($_SESSION['foto_usuario'])) { echo URL . 'FotoUsuario/alterar'; } else { echo URL . 'FotoUsuario/adicionar'; } ?>" class="iconeEdita"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
            <p class="alinhaPadding"> <a href="<?= URL ?>Sobre-Cliente/Alterar-Dados"> <button class="btn-alterarDados"> alterar dados </button> </a></p>
          </div>

          <hr class="linha2"> <!-- LINHA PARA DIVIDIR CONTEÚDO -->
          <h3> Endereço</h3>




          <div class="areaCliente">

            <?php
              if (isset($_SESSION['idendereco'])) {

                extract($this->data['adress'][0]);
            ?>

              <div class="form-edição2">
                <b> CEP: </b> <?= $cep ?> <br>
                <b> Estado: </b> <?= $estado ?> <br>
                <b> Cidade: </b> <?= $cidade ?> <br>
                <b> Bairro: </b> <?= $bairro ?> <br>
                <b> Rua: </b> <?= $rua ?> <br>
                <b> Nº Residencial: </b> <?= $numero_residencial ?> <br>
              </div>

            <?php 
              }else {
            ?>

              <div class="form-edição2">
                Você ainda não tem um endereço cadastrado <br>
                <a href='<?= URL ?>CadastroEndereco/endereco'> Ir Cadastrar Endereço </a> <br>
              </div>

            <?php 
              }
            ?>

          </div>




          <p class="alinhaPadding"> <a href="<?= URL ?>Sobre-Cliente/Alterar-Dados-Endereco"> <button class="btn-alterarDados"> alterar dados </button> </a> </p>

          <hr class="linha"> <!-- LINHA PARA DIVIDIR CONTEÚDO -->

          <h3> Pets </h3>


          <?php
            if (isset($this->data['pet'])) {
              for ($x = 0; $x < count($this->data['pet']); $x++) {
                  $pet = $this->data['pet'][$x];
                  extract($pet);
                  if (empty($imagem_pet)) { $imagem_pet = "petSemFoto.png"; }
          ?>

            <div class="areaCliente">

                <img class="imgSCliente" src="<?= URL . IMG . $imagem_pet ?>">

                <div class="form-edição2">
                  <b> Nome: </b> <?= $nome_pet ?> <br>
                  <b> Idade: </b> <?= $idade_pet ?> <br>
                  <b> Espécie: </b> <?= $tipo_pet ?> <br>
                  <b> Raça: </b> <?= $raca ?> <br>
                  <b> Sexo: </b> <?= $sexo ?> <br>
                  <b> Adicione a Carteira de Vacinação </b> <br>
                </div>
                
            </div>

            <div>
              
              <a href=" " class="iconeEdita"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
              <p class="alinhaPadding"> <a href="<?= URL . "Sobre-Cliente/Alterar-Dados-Pet?id={$idpet}" ?>"> <button class="btn-alterarDados"> alterar dados </button> </a> </p>

            </div>

            <hr class="linha"> <!-- LINHA PARA DIVIDIR CONTEÚDO -->

          <?php
            }}
            else { 
          ?>

            Você ainda não tem nunhum PET cadastrado <br>;
            <a href="<?= URL .'cadastroPet'?>" > Ir Cadastrar PET </a> <br>

          <?php
            }
          ?>

          <p class="center"> <a href="<?= URL .'cadastroPet'?>"> <button class="btn-addPet"> ADICIONAR PET </button> </a> </p>

        </div>
      </div>
    </div>






    <div class="centraliza">

      <div class="collapse" id="agendamentos">
        <div class="card card-body">

          <?php
                        
            if (isset($this->data['agendamentos'])) {
                for ($x = 0; $x < count($this->data['agendamentos']); $x++) {

                    $agendamentos = $this->data['agendamentos'][$x];
                    extract($agendamentos);
                    $time = substr($horario_consulta,0, -6);

          ?>

            <section class="conteudo-serviçosadm">

              <img src="<?= URLADM . IMGADMSERVICOS . $foto_servico ?>" alt="icone vacina" class="img-serviços">

              <div class="procedimentoadm">

                <h2 class="título-serviço"><?= $nome_pet ?></h2>

                <div class="tipoServico">
                  <h5> <?= $nome_consulta ?> </h5>
                </div>

                <div class="data"> 
                  <?= $data_consulta . " " . $time ?>h 00m <br>
                  <button class="btn-maisinfo"> MAIS INFO </button>
                </div>

                <div> 
                  <a href="#" class="icone-cancel"><i class="fa fa-times-circle-o" aria-hidden="true"></i> </a>
                </div>

              </div>

            </section>

            <hr class="linha"> <!-- LINHA PARA DIVIDIR CONTEÚDO -->

          <?php
              }
            }
          ?>

        </div>
      </div>
    </div>


  </main>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
  <script src="<?= URL . JS ?>areaCliente.js"> </script>
