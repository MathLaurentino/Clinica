<?php

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['idusuario'])) {
    $header = URL . "Erro?case=7"; // Erro 007
    header("Location: {$header}");
}