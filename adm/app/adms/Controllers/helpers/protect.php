<?php

//namespace Sts\Controllers\helpers;

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['idusuario'])) {
    $_SESSION['msg'] = "Pagina bloqueada, para acessar é necessario fazer o login";
    $header = URLADM . "Login"; // Erro 007
    header("Location: {$header}");
}