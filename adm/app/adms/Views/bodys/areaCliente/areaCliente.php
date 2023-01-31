<!--CONTEÚDO PRINCIPAL-->
<main class="conteudo-principal1">

    <h1 class="título">Usuários Cadastrados</h1>

    <div class="usuariosAdm"> <h3> Clientes </h3> </div>
    <hr class="linha2"> <!-- LINHA PARA DIVIDIR CONTEÚDO -->

    <?php
        if (!empty($this->data['clientes'])) {
            for ($x = 0; $x < count($this->data['clientes']); $x++) {

                $lista = $this->data['clientes'][$x];
                extract($lista);
                if(empty($foto_usuario)){ $foto_usuario = "Sem_Foto.png"; }
                if($sit_usuario == "Ativo") {$textoBnt2 = "Bloquear";} elseif ($sit_usuario == "Inativo") {$textoBnt2 = "Desbloquear";}
    ?>

        <div class="usuariosAdm">
            <div> <img class="imgSCliente" src="<?= URL . IMGCLIENTEADM . $foto_usuario ?>"> </div>
            <div class="form-edição2">
                <b> Nome: </b> <?= $nome_usuario ?> <br>
                <b> E-mail: </b> <?= $email ?> <br>
                <b> Cargo: </b> <?= $tipo_usuario ?> <br>
                <b> Situação: </b> <?= $sit_usuario ?> <br>
                <b> ID: </b> <?= $idusuario ?><br><br> 
            </div>
        </div>

    <?php 
        if ($_SESSION['idusuario'] == 1) {
    ?>

        <div class="estilizaUsuariosAdm">
            <div class="alinhaPadding2"> 
                <a href="<?= URLADM ?>Area-Clientes/Alterar-Tipo-Usuario?idUser=<?= $idusuario ?>&tipo=<?= $tipo_usuario ?>"> <button class="btn-usuariosAdm"> Alterar Cargo </button> </a>
                <a href="<?= URLADM ?>Area-Clientes/alterar-Sit-Usuario?idUser=<?= $idusuario ?>&sit=<?= $sit_usuario ?>"> <button class="btn-usuariosAdmBlock"> <?= $textoBnt2 ?> </button> </a>
            </div>
        </div>

    <?php
        } else {
    ?>
        <div class="estilizaUsuariosAdm">
            <div class="alinhaPadding2"> 
                <a href="<?= URLADM ?>Area-Clientes/alterar-Sit-Usuario?idUser=<?= $idusuario ?>&sit=<?= $sit_usuario ?>"> <button class="btn-usuariosAdmBlock"> <?= $textoBnt2 ?>  </button> </a>
            </div>
        </div>
    <?php
        }
    ?>

        <hr class="linha2"> <!-- LINHA PARA DIVIDIR CONTEÚDO -->

    <?php
        }} else {
    ?>
    
        <h1 class="título">VAZIO</h1>
        
    <?php
        }
    ?>



    <div class="usuariosAdm"> <h3> Mantenedor </h3> </div>
    <hr class="linha2"> <!-- LINHA PARA DIVIDIR CONTEÚDO -->


    <?php
        if (!empty($this->data['mantenedores'])) {
            for ($x = 0; $x < count($this->data['mantenedores']); $x++) {

                $lista = $this->data['mantenedores'][$x];
                extract($lista);
                if(empty($foto_usuario)){ $foto_usuario = "Sem_Foto.png"; }
                if($sit_usuario == "Ativo") {$textoBnt2 = "Bloquear";} elseif ($sit_usuario == "Inativo") {$textoBnt2 = "Desbloquear";}
    ?>

        <div class="usuariosAdm">
            <img class="imgSCliente" src="<?= URL . IMGCLIENTEADM . $foto_usuario ?>">
            <div class="form-edição2">
                <b> Nome: </b> <?= $nome_usuario ?> <br>
                <b> E-mail: </b> <?= $email ?> <br>
                <b> Cargo: </b> <?= $tipo_usuario ?> <br>
                <b> Situação: </b> <?= $sit_usuario ?> <br>
                <b> ID: </b> <?= $idusuario ?><br><br> 
                
            </div>
        </div>

    <?php 
        if ($_SESSION['idusuario'] == 1) { // se o usuário logado for o mantenedorBOSS
            if ($idusuario != 1) { // somente se o usuário do FOR for diferente do mantenedorBOSS
    ?>

        <div class="estilizaUsuariosAdm">
            <div class="alinhaPadding2"> 
                <a href="<?= URLADM ?>Area-Clientes/Alterar-Tipo-Usuario?idUser=<?= $idusuario ?>&tipo=<?= $tipo_usuario ?>"> <button class="btn-usuariosAdm"> Alterar Cargo </button> </a>
                <a href="<?= URLADM ?>Area-Clientes/alterar-Sit-Usuario?idUser=<?= $idusuario ?>&sit=<?= $sit_usuario ?>"> <button class="btn-usuariosAdmBlock"> <?= $textoBnt2 ?> </button> </a>
            </div>
        </div>

    <?php
        }} elseif ($_SESSION['idusuario'] != $idusuario) {
            if ($idusuario != 1) {
    ?>
        <div class="estilizaUsuariosAdm">
            <div class="alinhaPadding2"> 
                <a href="<?= URLADM ?>Area-Clientes/alterar-Sit-Usuario?idUser=<?= $idusuario ?>&sit=<?= $sit_usuario ?>"> <button class="btn-usuariosAdmBlock"> <?= $textoBnt2 ?>  </button> </a>
            </div>
        </div>
    <?php
        }}
    ?>

        <hr class="linha2"> <!-- LINHA PARA DIVIDIR CONTEÚDO -->

    <?php
        }} else {
    ?>
    
        <h1 class="título">VAZIO</h1>
        
    <?php
        }
    ?>

</main>

<script src="<?= JSADM ?>navbar.js"> </script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="<?= JSADM ?>areaCliente.js"> </script>


