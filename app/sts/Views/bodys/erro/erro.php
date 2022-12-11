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