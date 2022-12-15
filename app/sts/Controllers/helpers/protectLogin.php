<?php

/**
 * Incluido em páginas que não é permitido o acesso quando 
 *      o usuario já esta logado
 */

if(!isset($_SESSION)) {
    session_start();
}

if(isset($_SESSION['idusuario'])) {
    $header = URL . "Erro?case=21"; // Erro 021
    header("Location: {$header}");
}