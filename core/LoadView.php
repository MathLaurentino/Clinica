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
    public function loadView(): void
    {
        if (file_exists('app/' . $this->nameView . '.php')){
    
            include 'app/' . $this->nameView . '.php';

        } else {
            die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM);
        }
    }


    public function loadView_header($header)
    {
        if (file_exists('app/' . $this->nameView . '.php')){
            
            include 'app\sts\Views\headers/' . $header . '.php'; 
            include 'app\sts\Views\helpers\cabecalho.php';
            include 'app/' . $this->nameView . '.php';
            include 'app/sts/views/footer.php';
            include 'app\sts\Views\helpers\fastTravel.php';

        } else {
            die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM);
        }
    }

    public function loadView_header2()
    {
        if (file_exists('app/' . $this->nameView . '.php')){
            
            include 'app\sts\Views\headers/padrao.php'; 
            include 'app/' . $this->nameView . '.php';
            include 'app/sts/views/footer.php';
            include 'app\sts\Views\helpers\fastTravel.php';

        } else {
            die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM);
        }
    }


    public function loadView_header3($header)
    {
        include 'app\sts\Views\headers/' . $header . '.php'; 
        include 'app/' . $this->nameView . '.php';
        include 'app/sts/views/footer.php';
    } 


    public function loadView_agendamento()
    {
        if (file_exists('app/' . $this->nameView . '.html')){
    
            include 'app\sts\Views\headers\agendamento.php'; 

            include 'app/'. $this->nameView .'.html';

            include 'app/sts/views/footer.php';

        } else {
            die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM);
        }
    }

}

?>