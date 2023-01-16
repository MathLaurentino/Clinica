<?php

    if(!isset($_SESSION)){
        session_start();
    }

    echo "<div style='text-align:center' >";
        echo "<h1> Erro " . $this->data['numeroErro'] . "</h1>";
        echo "<h2>" . $this->data['descricaoErro'] . "</h2>"; 
        echo "<a href='{$this->data['botao']}'> {$this->data['descricaoBotao']} </a>";
    echo "</div>";
    
?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
