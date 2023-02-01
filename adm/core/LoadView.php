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
    


    /**     function loadView_cabecalho_adm()
     * Carrega a view com o cabecalho do site
     */
    public function loadView_cabecalho_adm($header)
    {
        if (file_exists('app/' . $this->nameView . '.php')){
            
            include 'app\adms\Views\headers/' . $header . '.php'; 
            include 'app\adms\Views\helpers\alerts.php';
            include 'app\adms\Views\helpers\cabecalho.php';
            include 'app/' . $this->nameView . '.php';
            include 'app/adms/views/helpers/footer.php';
            // include 'app\sts\Views\helpers\fastTravel.php';

        } else {
            die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador 2" . EMAILADM);
        }
    }


    /**     function loadView_adm($header)
     * Carrega view sem o cabecalho do site
     */
    public function loadView_adm($header)
    {
        if (file_exists('app/' . $this->nameView . '.php')){
            
            include 'app\adms\Views\headers/' . $header . '.php'; 
            include 'app\adms\Views\helpers\alerts.php';
            include 'app/' . $this->nameView . '.php';
            include 'app/adms/views/helpers/footer.php';

        } else {
            die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador 2" . EMAILADM);
        }
    }

}

?>