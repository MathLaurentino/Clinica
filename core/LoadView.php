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
    


    /**
     * Carrega a tela juntamente com o seu respequitivo header
     * Adiciona também: 
     *  'helpers\cabecalho.php'
     *  'helpers\alerts.php'
     *  'helpers\footer.php''
     */
    public function loadView_cabecalho($header)
    {
        if (file_exists('app/' . $this->nameView . '.php')){
            
            include 'app\sts\Views\headers/' . $header . '.php'; 
            include 'app\sts\Views\helpers\alerts.php';
            include 'app\sts\Views\helpers\cabecalho.php';
            include 'app/' . $this->nameView . '.php';
            //include 'app\sts\views\helpers\rodape.php';
            include 'app\sts\views\helpers\footer.php';
            //include 'app\sts\Views\helpers\fastTravel.php';

        } else {
            die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM);
        }
    }


    public function loadView_cabecalhoOff($header)
    {
        if (file_exists('app/' . $this->nameView . '.php')){
            
            include 'app\sts\Views\headers/' . $header . '.php'; 
            include 'app\sts\Views\helpers\alerts.php';
            include 'app\sts\Views\helpers\cabecalhoOff.php';
            include 'app/' . $this->nameView . '.php';
            //include 'app\sts\views\helpers\rodape.php';
            include 'app\sts\views\helpers\footer.php';
            //include 'app\sts\Views\helpers\fastTravel.php';

        } else {
            die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM);
        }
    }



    /**
     * Carrega a tela juntamente com o seu respequitivo header
     * Adiciona também: 
     *  'helpers\alerts.php'
     *  'helpers\footer.php''
     */
    public function loadView_header($header)
    {
        if (file_exists('app/' . $this->nameView . '.php')){
            
            include 'app\sts\Views\headers/' . $header . '.php'; 
            include 'app\sts\Views\helpers\alerts.php';
            include 'app/' . $this->nameView . '.php';
            include 'app\sts\views\helpers\footer.php';

        } else {
            die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM);
        }
    }



    /**
     * Sem header definido
     */ 
    public function loadView_header2() // cadastroEndereco, sobreCliente/infoConsulta //confirmarEmail, erro
    {
        if (file_exists('app/' . $this->nameView . '.php')){
            
            include 'app\sts\Views\headers/padrao.php'; 
            include 'app\sts\Views\helpers\alerts.php';
            include 'app/' . $this->nameView . '.php';
            include 'app\sts\views\helpers\footer.php';
            include 'app\sts\Views\helpers\fastTravel.php';

        } else {
            die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador 3" . EMAILADM);
        }
    }

}

?>