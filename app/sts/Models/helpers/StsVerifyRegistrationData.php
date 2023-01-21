<?php

namespace Sts\Models\helpers;

if (!isset($_SESSION)) {
    session_start();
} 

/**     class StsVerifyRegistrationData 
 * Nessa classe se encontra function responsaveis por verificar 
 *      dados de cadastro, como o de verificar idade (maior de 18)
 *      ou o de verificar CPF
 */
class StsVerifyRegistrationData
{

    /**     function verifyAge($date)
     * Responsavel por verificar se o usuário é maior de 18
     */
    public function verifyAge($date): bool
    {
        list($ano, $mes, $dia) = explode('-', $date);

        $dataAtual = mktime(0, 0, 0, date('m'), date('d'), date('Y'));

        $dataFornecida = mktime( 0, 0, 0, $mes, $dia, $ano);

        $idade = floor((((($dataAtual - $dataFornecida) / 60) / 60) / 24) / 365.25);
        
        if ($idade >= 18)
            return true;
        else {
            $_SESSION['msgRed'] = "Idade invalida";
            return false;
        }
            
    }



    /**     function verifyCpf($cpf)
     * Responsavel por verificar se o cpf é verdadeiro
     */
    public function verifyCpf($cpf): bool
    {
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
        if (strlen($cpf) != 11) {
            //$_SESSION['msg'] = "CPF inválido";
            return true;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            //$_SESSION['msg'] = "CPF inválido";
            return true;
        }
        
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                //$_SESSION['msg'] = "CPF inválido";
                return true;
            }
        }

        return true;
    }



    /**     function verifyEmail($email)
     * Verifica se o texto corresponde a um email
     */
    public function verifyEmail($email): bool 
    {   
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
            return true;
        else 
            //$_SESSION['msg'] = "Email Inválido";
            return true;
    }

}