<?php
if(!isset($_SESSION)){
    session_start();
}
if (isset($this->data)) {
    //extract($this->data);
    //echo "<pre>";var_dump($this->data);echo "</pre>";
}
?>
<!--CONTEÚDO PRINCIPAL-->
<main class="conteudo-principal4">
    <h1 class="título">Atualizar Cadastro</h1>
    <p class="subtítulo">atualize os dados do seu pet abaixo</p>

    <?php
        for($x = 0; $x < count($this->data['pet']); $x++){
            $pet = $this->data['pet'][$x];
            extract($pet);
    ?>
    <form method="post" class="form-edição4" action="">

        <div class="center"><label>Nome: </label></div>

        <input type="text" name="nome_pet" value="<?php if(isset($nome_pet)) { echo $nome_pet; } ?>" placeholder="Nome" class="tamanhoForm">

        <input type="hidden" name="idpet" value="<?php echo $idpet ?>">

        <div class="center"><label> Idade Pet: </label> </div>
        <input type="date" name="data_nascimento_pet" class="tamanhoForm" placeholder="Data de Nascimento" value="<?php if(isset($data_nascimento_pet)) {echo $data_nascimento_pet; } ?>"> 


        <br><br>
        
        <select name="sexo">
            <option value="<?= $sexo ?>"> <?= $sexo ?> </option>
            <option value="Macho"> Macho </option>
            <option value="Fêmea"> Fêmea </option>
        </select> 

        <br><br>

        <label>Raça:</label> <br>
        <select class="tamanhoForm" name="idraca" size="1" placeholder="Raça:">

            <option value="<?= $idraca_pet; ?>" > <?= $raca; ?> </option>

            <?php 
                $arrayTipo = $this->data['tipo_pet'];
                for($y = 0; $y < count($arrayTipo); $y++){
                    $array = $arrayTipo[$y];
                    foreach($array as $key => $value){
                        if($key == "idraca_pet"){
                            $idraca_pet = $value;
                        }
                        if($key == "raca") 
                        {
                            ?>  <option value="<?php echo $idraca_pet; ?>" > <?php echo $value; ?> </option> <br> <?php
                        }
                    }
                }
            ?>

        </select> 

        <br> <br>
        <p class="center"><input class="botao" name="AlterPet" type="submit" value="salvar alterações" > </p>

    </form>

    <?php } ?>



    <img src="<?= URL . IMGCLINICA ?>img03.png" class="img-pet" alt="imagem de cão"> 

</main>    
