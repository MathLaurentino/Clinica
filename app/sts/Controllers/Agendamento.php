<?php

namespace Sts\Controllers;

class Agendamento{
    
    public function index(){
        echo "<h2>Página de Agendamento</h2>";
    }

    /**     function pages()
     * Function que todas as controller tem
     * Retorna as functions que são publicas nessa controller
     */
    public function pages(): array
    {  
        return $array = ['index'];
    }
    
}