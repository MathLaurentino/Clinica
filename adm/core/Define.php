<?php

namespace Core;

abstract class Define
{

    protected function configAdm(): void
    {

        define('URL', 'http://localhost/Clinica/');
        define('URLADM', 'http://localhost/Clinica/adm/');

        define('CSSADM', 'http://localhost/Clinica/adm/app/adms/assets/css/');
        define('IMGADM', 'http://localhost/Clinica/adm/app/adms/assets/imagens_clinica/');

        define('IMGADMERRO', '..\app\sts\assets\imagens\Sem_Foto.png');

        define('CONTROLLER', 'Login');
        define('METODO', 'index');
        define('CONTROLLERERRO', 'Login');

        define('EMAILADM', 'matheus.laurentino.ifpr@gmail.com');

        define('HOST', 'localhost');
        define('USER', 'root');
        define('PASS', '');
        define('DBNAME', 'clinica_veterinaria');
 
    }
}