<?php


    namespace Adms\Models\helpers;

    date_default_timezone_set('America/Sao_Paulo');

    /**     class AdmsFile 
     * Essa classe contem function responsaveis por verificar e manipular as
     *      datas das consultas, podendo fazer modificações no Banco de Dados 
     */
    class AdmsDateConsulta
    {

        /**     function verifyDayTimeConsulta(array $data)
         * Verifica se a consulta já passou da data atual, para que dessa forma 
         *      se modifique a tabela consulta na posição 'sit_consulta' para 'Concluido'
         *
         * $data presisa conter as seguintes informações:
         *      - sit_consulta
         *      - horario_consulta
         *      - data_consulta
         *      - idconsulta
         */
        public function verifyDayTimeConsulta(array $data): bool
        {
            $count = 0; 

            for ($x=0; $x < count($data); $x++) {

                $consulta = $data[$x];
                extract($consulta);

                if ($sit_consulta == "A Confirmar" || $sit_consulta == "A Cancelar" || $sit_consulta == "Confirmado") {

                    $time_consulta = substr($horario_consulta,0,-6);

                    $dayTimeNow = date('d/m/Y H:i');
                    $dayNow = substr($dayTimeNow, 0, 10); // 01/01/2023
                    $dayNow = substr($dayNow,6) . "-" . substr($dayNow, 3, -5) . "-" . substr($dayNow, 0, -8); // 2023-01-01
                    $timeNow = substr($dayTimeNow,10, -3);

                    $dateDayNew = date_create($data_consulta); 
                    $dateDayNow = date_create($dayNow);
                    $diff=date_diff($dateDayNow, $dateDayNew); //$result = $diff->format("%a"); -> diferença de dias
                    $result = $diff->invert; // retorna 1 se o dia é passado e 0 se for presente o futuro

                    if ($sit_consulta == "A Confirmar" || $sit_consulta == "A Cancelar") { $sit['sit_consulta'] = "Indeferido";} 
                    
                    if ($sit_consulta == "Confirmado") { $sit['sit_consulta'] = "Concluido"; }

                    $adms = new \Adms\Models\AdmsConsultasAgendadas();

                    // se o dia já é passado
                    if ($result == 1) {
                        $adms->alterSit_Consulta($idconsulta, $sit);
                        $count++;
                    } 

                    // se o dia é presente mas o horario já passou
                    elseif ( $result == 0 && $data_consulta == $dayNow && $time_consulta <= $timeNow) {
                        $adms->alterSit_Consulta($idconsulta, $sit);
                        $count++;
                    }

                }
            }

            if ($count != 0)
                return true;
            else 
                return false;

        }

    }



?>