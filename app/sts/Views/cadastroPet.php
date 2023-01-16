<?php
    if(!isset($_SESSION)){
        session_start();
    }
    if(isset($_SESSION['msg'])){
        echo "Mensagem: " . $_SESSION['msg'] . "<br>";
        unset($_SESSION['msg']);    
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php if ($this->more == "PetType") { ?>
        <!-- Formulario para definir a espécie do animal a ser cadastrado (cachorro, gato ou ave) -->
        <form method="post" action="">

            <input type="radio" value="cachorro" name="animal">
            <label>Cachorro</label> <br>

            <input type="radio" value="gato" name="animal">
            <label>Gato</label> <br>

            <input type="radio" value="ave" name="animal">
            <label>Ave</label> <br>

            <input name="PetType" type="submit" value="Enviar" >

        </form>

    <?php } elseif($this->more == "CreatePet"){  ?>
        <!-- Fromulário para adicionar as demais informações do pet -->
        <form method="post" action="">

            <label>Nome: </label>
            <input type="text" name="nome_pet"> <br> <br>

            <label>Idade Pet: </label>
            <input type="text" name="idade_pet"> <br> <br>

            <label> Sexo: </label> <br>
            <input type="radio" name="sexo" value="masculino"> <label> masculino </label> <br>
            <input type="radio" name="sexo" value="feminino"> <label> feminino </label> <br> <br>

            <input type="hidden" name="usuario" value="<?php echo $_SESSION['idusuario']; ?>">

            <label>Raça:</label> <br>
            <select name="idraca" size="10">
                <?php 
                
                    for($y = 0; $y < count($this->data); $y++){
                        $array = $this->data[$y];
                        foreach($array as $key => $value){
                            if($key == "idraca_pet"){
                                $idRaca = $value;
                            }
                            if($key == "raca") 
                            {
                                ?>  <option value="<?php echo $idRaca; ?>" > <?php echo $value; ?> </option> <br> <?php
                            }
                        }
                    }
                ?>
            </select> <br> <br>

            <input name="CreatePet" type="submit" value="Enviar" >

        </form>

    <?php } ?>
    
</body>
</html>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
