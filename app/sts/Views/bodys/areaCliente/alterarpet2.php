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
        <input class="tamanhoForm" name="idade_pet" type="text" value="<?php if(isset($idade_pet)) {echo $idade_pet; } ?>">

        <br><br>

        <!-- <div class="center">
            <label>Data de Nascimento: </label>
        </div>

        <input type="date" name="idade_pet" class="tamanhoForm">  -->

        <!-- <br><br> -->
        
        <!-- <label> Sexo: </label> 
        <br>
        <input type="checkbox"> Fêmea <br>
        <input type="checkbox"> Macho -->
        
        <select name="sexo">
            <option value="<?php echo $sexo ?>"> <?php echo $sexo ?> </option>
            <option value="masculino"> Masculino </option>
            <option value="feminino"> Feminino </option>
        </select> 

        

        <br><br>

        <label>Raça:</label> <br>
        <select class="tamanhoForm" name="idraca" size="1" placeholder="Raça:">

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
