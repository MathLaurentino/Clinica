<?php

namespace Core;

abstract class Define
{

    protected function configAdm(): void
    {

        define('URL', 'http://localhost/Clinica/');
        define('URLADM', 'http://localhost/Clinica/adm/');

        define('CSSADM', 'http://localhost/Clinica/adm/app/adms/assets/css/');

        // foto de perfil /foto dos pets / carteiras dos pets -> dos usuários
        define('IMGCLIENTEADM', '../app/sts/assets/imagens/');
        define('IMGCLIENTEERRO', '..\app\sts\assets\imagens\Sem_Foto.png');
        // ------------------------------------------------------------------

        define('IMGADMSER', 'app/adms/assets/imagens_servicos/');
        define('IMGADMCLINICA', 'app/adms/assets/imagens_clinica/');

        
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