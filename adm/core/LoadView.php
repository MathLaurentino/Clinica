<?php

namespace Core;

class LoadView
{
    /**     function __construct()
     * @param string $nameView endereco da view
     * @param array|string|null $data dados para a view
     * @param array|string|null $more informações extras
     */
    public function __construct(private string $nameView, private array|string|null $data, private array|string|null $more)
    {
    }
    

    /**     function loadView()
     * Carrega a view requerida pela controller
     */
    public function loadViewAdm(): void
    {
        if (file_exists('app/' . $this->nameView . '.php')){
    
            include 'app/' . $this->nameView . '.php';

        } else {
            die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador sssssssss" . EMAILADM);
        }
    }


    public function loadView_headerAdm($header)
    {
        if (file_exists('app/' . $this->nameView . '.php')){
            
            include 'app\adms\Views\headers/' . $header . '.php'; 
            // include 'app\sts\Views\helpers\aviso.php';
            // include 'app\sts\Views\helpers\cabecalho.php';
            include 'app/' . $this->nameView . '.php';
            include 'app/adms/views/helpers/footer.php';
            // include 'app\sts\Views\helpers\fastTravel.php';

        } else {
            die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador 2" . EMAILADM);
        }
    }


    public function loadView_Login_Adm($header)
    {
        if (file_exists('app/' . $this->nameView . '.php')){
            
            include 'app\adms\Views\headers/' . $header . '.php'; 
            // include 'app\sts\Views\helpers\aviso.php';
            include 'app/' . $this->nameView . '.php';
            include 'app/adms/views/helpers/footer.php';

        } else {
            die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador 2" . EMAILADM);
        }
    }

}

?>