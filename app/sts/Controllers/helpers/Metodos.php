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
     * 
     */
    public function verifyEmail($email): bool 
    {   
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
            return true;
        else 
            return false;
    }



    /**
     * Undocumented function
     *
     */
    public function verifyFile($formFile): bool
    {
        $file = $formFile;

        if ($file['error']) // falha ao carregar arquivo
        {
            $_SESSION['errFile'] = "Erro ao receber imagem";
            return false;
        }

        elseif ($file['size'] > 2097152) // arquivo maior que 2 mg
        { 
            $_SESSION['errFile'] = "Arquivo muito grande";
            return false;
        } 

        else // arquivo recebido
        {
            // pega o tipo do arquivo (.pdf, .png ...)
            $extensao = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

            if ($extensao != "jpg" && $extensao != "png") { // se não for um arquivo jpg ou png
                $_SESSION['errFile'] = "tipo de arquivo não aceito";
                return false;
            } else {
                return true; //$this->saveFile($extensao)
            }
        }
    }



    /**
     * Undocumented function
     *
     */
    public function saveFile($formFile): string|null
    {
        $extensao = strtolower(pathinfo($formFile['name'], PATHINFO_EXTENSION));
        $pasta = IMG; 
        $nomeUnicoArquivo = uniqid(); // nome aleatorio de arquivo, mas sempre unico
        $path = $pasta . $nomeUnicoArquivo . "." . $extensao;
        $nameInDB = $nomeUnicoArquivo . "." . $extensao;

        $save = move_uploaded_file($formFile['tmp_name'], $path); // salvar o arquivo na pasta
        if($save){ // se salvar corretamente 
            return $nameInDB;
        }
        else { // se tiver algum erro no save
            $_SESSION['errFile'] = "falha ao salvar arquivo333";
            return null;
        }
        
    }
    
    
}


?>