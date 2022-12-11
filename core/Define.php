<?php

namespace Core;

    abstract class Define
    {

        protected function config(): void 
        {
            define('URL', 'http://localhost/Clinica/');
            define('URLADM', 'http://localhost/Clinica/Adm/');

            define('IMG', 'app\sts\assets\imagens/'); 
            define('IMGERRO', 'app\sts\assets\imagens/Sem_Foto.png');

            define('CSS', 'http://localhost/Clinica/app/sts/assets/css/');

            define('CONTROLLER', 'Home');
            define('CONTROLLERERRO', 'Erro');
            define('METODO', 'index');
            //define('CONTROLLER', 'Home');

            define('EMAILADM', 'matheus.laurentino.ifpr@gmail.com');

            define('HOST', 'localhost');
            define('USER', 'root');
            define('PASS', '');
            define('DBNAME', 'clinica_veterinaria');
        }

    }