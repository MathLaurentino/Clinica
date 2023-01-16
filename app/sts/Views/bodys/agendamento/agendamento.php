<?php

    if(!isset($_SESSION)){
        session_start();
    }
    
    if(isset($_SESSION['msg']))
    {
        echo $_SESSION['msg'] . "<br>"; 
        unset($_SESSION['msg']);   
    }

    echo "<pre>"; var_dump($this->data); echo "</pre>";

?>

<br> 

Servico selecionado: <?= $this->data['servico']['nome_consulta'] ?> <br>
Valor consulta: <?= $this->data['servico']['valor_consulta'] . "R$" ?> <br>
Tempo médio: <?= substr($this->data['servico']['tempo_medio'], 0, -6) . "h" ?> <br> <br>

<form method="post" action="">

    <input type="hidden" name="data_consulta" value="<?= $_GET['dia'] ?>">

    <input type="hidden" name="horario_consulta" value="<?= $_GET['horario'] . ":00:00"?>">

    <input type="hidden" name="tipo_consulta" value="<?= $_GET['servico'] ?>">

    
    <select name="pet">
        <?php  
            $pets = $this->data['pets'];
            for ($x = 0; $x < count($pets); $x++) {
                $pet = $pets[$x];
                extract($pet);
                echo "<option value='$idpet'>$nome_pet</option>";
                //var_dump($pet);
            }   
        ?>
    </select> <br> <br>

    Descreva o motivo da consulta para o seu pet: <br>
    <textarea name="descricao"> </textarea>  <br>

    

    <input name="agendar" type="submit" value="agendar">

</form>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
