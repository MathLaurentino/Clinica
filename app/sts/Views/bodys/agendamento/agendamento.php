<?php

    if(!isset($_SESSION)){
        session_start();
    }
    
    if(isset($_SESSION['msg']))
    {
        echo $_SESSION['msg'] . "<br>"; 
        unset($_SESSION['msg']);   
    }

    echo "<pre>"; var_dump($this->data);

?>

<br>

Servico selecionado: <?= $this->data['nome_consulta'] ?> <br>
Valor consulta: <?= $this->data['valor_consulta'] . "R$" ?> <br>
Tempo médio: <?= substr($this->data['tempo_medio'], 0, -6) . "h" ?> <br>

<form method="post" action="">

    Descreva o motivo da consulta para o seu pet: <br>
    <textarea name="descricao"> </textarea> <br> <br>

    <input name="agendar" type="submit" >

</form>