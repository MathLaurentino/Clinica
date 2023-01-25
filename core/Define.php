<?php

namespace Core;

    abstract class Define
    {

        protected function config(): void 
        {
            
            /* URLs do site */
            define('URL', 'http://localhost/Clinica/');
            define('URLADM', 'http://localhost/Clinica/Adm/');
            /* ************ */


            /* ATALHOS PARA IMAGENS */
            define('IMG', 'app/sts/assets/imagens/');
            define('IMGCLINICA', 'app/sts/assets/imagens_clinica/'); 
            define('IMGERRO', 'app\sts\assets\imagens/Sem_Foto.png');
            define('IMGADMSERVICOS', 'app/adms/assets/imagens_servicos/');
            /* ******************** */ 


            /* ATALHO PARA CSS E JS */
            define('CSS', 'http://localhost/Clinica/app/sts/assets/css/');
            define('JS', 'app/sts/assets/js/');
            /* ******************** */


            /* URL CONTROLLER */
            define('CONTROLLER', 'Home');
            define('CONTROLLERERRO', 'Erro');
            define('METODO', 'index');
            /* ************** */


            /* EMAIL PARA O CLIENTE POSSA OBTER CONTATO */
            define('EMAILADM', 'matheus.laurentino.ifpr@gmail.com');
            /* **************************************** */


            /* DADOS DO MAILTRAP */
            define('EMAILTRAP', 'matheuscalifornia29@gmail.com');
            define('NOME', 'Clinica Veterinária');

            define('HOSTTRAP', 'smtp.mailtrap.io');
            define('USERNAME', '5b0b0de0c72429');
            define('PASSWORD', '1dcc7c242ab250');
            define('PORTTRAP', '2525');
            /* **************** */


            /* AJUDAM NO PDO */
            define('HOST', 'localhost');
            define('USER', 'root');
            define('PASS', '');
            define('DBNAME', 'clinica_veterinaria');
            /* ************* */
        }

    }