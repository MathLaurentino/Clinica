<?php

namespace Sts\Controllers\helpers;

/**     class Metodos
 * Contem functions que auxiliam na verificação de dados
 *      para o cadastro no banco de dados 
 */
class Metodos{
    
    public function verifyAge($date): bool
    {
        list($ano, $mes, $dia) = explode('-', $date);

        $dataAtual = mktime(0, 0, 0, date('m'), date('d'), date('Y'));

        $dataFornecida = mktime( 0, 0, 0, $mes, $dia, $ano);

        $idade = floor((((($dataAtual - $dataFornecida) / 60) / 60) / 24) / 365.25);
        
        if ($idade >= 18)
            return true;
        else 
            return false;
    }



    public function verifyCpf($cpf): bool
    {
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
        
        if (strlen($cpf) != 11) {
            return false;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }


    /**
     * @author Name <email@email.com>
     *
     * @param [type] $email
     * @return boolean
     */
    public function verifyEmail($email): bool 
    {   
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
            return true;
        else 
            return false;
    }


    
    
}


?>