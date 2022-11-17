<?php

//session_start();
//ob_start(); //buffer de saída

//Constante que define que o usuário está acessando páginas internas através da página "index.php".
define('C7E3L8K9E5', true);

//Carregar o Composer
require './vendor/autoload.php';

//Instanciar a classe ConfigController, responsável em tratar a URL
$url = new Core\UrlController;

$url->verifyPage();

//Instanciar o método para carregar a página/controller
//$url->loadPage();
