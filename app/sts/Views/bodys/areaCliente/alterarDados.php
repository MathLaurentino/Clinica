
<?php
if (!isset($_SESSION)) { session_start(); }

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'] . "<br>"; 
    unset($_SESSION['msg']);   
}

if (isset($this->data[0])) { extract($this->data[0]); }
if (isset($this->data)) { extract($this->data); }
?>  


<!--CONTEÚDO PRINCIPAL-->
<main class="conteudo-principal">
    <h1 class="título">Atualizar Cadastro</h1>
    <p class="subtítulo">atualize os seus dados cadastrais abaixo</p>

    <!--formulário para alterar dados-->
    <form class="form-edição" method="post" action="">

        <input type="text" placeholder="Nome Completo" name="nome_usuario" value="<?php if(isset($nome_usuario)) {echo "$nome_usuario";} ?>">

        <input type="date" placeholder="Data de Nascimento" name="data_nascimento" value="<?php if(isset($data_nascimento)) { echo $data_nascimento; } ?>">

        <input type="text" placeholder="CPF" name="cpf" value="<?php if(isset($cpf)) {echo "$cpf";} ?>">

        <input type="text" placeholder="RG" name="rg" value="<?php if(isset($rg)) {echo "$rg";} ?>">

        <input name="AlterUser" type="submit" class="botao" value="salvar alterações">

    </form>

    <img src="<?= URL . IMGCLINICA ?>img04.png" class="img-donopet" alt="imagem com modelo afro segurando cão"> 

</main>    
