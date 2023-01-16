<?php

namespace Sts\Models\helpers;

if (!isset($_SESSION)) {
    session_start();
} 

/**     class StsVerifyDateConsulta 
 * Nessa classe se encontra function responsaveis por verificar 
 *      dados de cadastro, como o de verificar idade (maior de 18)
 *      ou o de verificar CPF
 */
class StsVerifyDateConsulta
{

   /**     function varificarData()
     * Verifica se a data e hora passada está disponivel no banco de dados
     */
    public function varificarData($dayNewEvent, $timeNewEvent): bool
    {

        $dayTimeNow = date('d/m/Y H:i');
        $dayNow = substr($dayTimeNow, 0, 10); // 01/01/2023
        $dayNow = substr($dayNow,6) . "-" . substr($dayNow, 3, -5) . "-" . substr($dayNow, 0, -8); // 2023-01-01
        $timeNow = substr($dayTimeNow,10, -3);

        $dateDayNew = date_create($dayNewEvent); 
        $dateDayNow = date_create($dayNow);
        $diff=date_diff($dateDayNow, $dateDayNew); //$result = $diff->format("%a"); -> diferença de dias
        $result = $diff->invert; // retorna 1 se o dia da URL é passado e 0 se for presente o futuro

        // se o dia da URL já é passado
        if ($result == 1) {
            return FALSE;
        }

        // se o horario passado estiver fora dos horarios estabelecidos pela clinica
        if ($timeNewEvent < 12 || $timeNewEvent > 18) {
            return FALSE;
        }   

        // se tiver no mesmo dia mas o horario já é passado
        if ($dayNewEvent == $dayNow && $timeNewEvent <= $timeNow) {
            return FALSE;
        }

        $sts = new \Sts\Models\StsAgendamento();
        $eventsArray = $sts->horariosDeConsulta();

        for ($x = 0; $x <count($eventsArray); $x++) {

            $event = $eventsArray[$x];

            $dayEventDB = $event['data_consulta'];
            $timeEventDB = $event['horario_consulta'];
            $timeEventDB = substr($timeEventDB, 0, 2);

            // se tiver um evento no mesmo dia e mesmo horario
            if ($dayEventDB == $dayNewEvent && $timeEventDB == $timeNewEvent) {
                return FALSE;
            }
        
        }

        return TRUE;
    }



    /**     function verifyDayTimeConsulta(array $data)
     * Verifica se a consulta já passou da data atual, para que dessa forma 
     *      se modifique a tabela consulta na posição 'sit_consulta' para 'Concluido' ou 'Indeferido'
     * Retorna true se teve alguma alteração no BD e false se não
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

                $stsAgendamento = new \Sts\Models\StsAgendamento();

                // se o dia já é passado
                if ($result == 1) {
                    $stsAgendamento->alterSitConsulta($idconsulta, $sit);
                    $count++;
                } 

                // se o dia é presente mas o horario já passou
                elseif ( $result == 0 && $data_consulta == $dayNow && $time_consulta <= $timeNow) {
                    $stsAgendamento->alterSitConsulta($idconsulta, $sit);
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