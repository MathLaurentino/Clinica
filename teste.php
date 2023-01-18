<?php

date_default_timezone_set('America/Sao_Paulo');

// Array com os dias da semana
$diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');

//  Aqui podemos usar a data atual ou qualquer outra data no formato Ano-mês-dia (2014-02-28)
$data = date('Y-m-d');

//  Varivel que recebe o dia da semana (0 = Domingo, 1 = Segunda ...)
$diasemana_numero = date('w', strtotime($data));

// Exibe o dia da semana com o Array
echo $diasemana_numero; //$diasemana[$diasemana_numero];


// $dayTimeNow = date('d/m/Y H:i');
// $dayNow = substr($dayTimeNow, 0, 10); // 01/01/2023
// $dayNow = substr($dayNow,6) . "-" . substr($dayNow, 3, -5) . "-" . substr($dayNow, 0, -8); // 2023-01-01
// $timeNow = substr($dayTimeNow,10, -3);

// $dateDayNew = date_create("2023-01-13"); 
// $dateDayNow = date_create($dayNow);
// $diff=date_diff($dateDayNow, $dateDayNew); //$result = $diff->format("%a"); -> diferença de dias

// $diferença = $diff->format("%a");
// $negativo = $diff->invert; // retorna 1 se o dia é passado e 0 se for presente o futuro


// //echo $diferença . " -> " . $negativo;

// if ($diferença != 0 && $negativo ==0 ){
//     echo "pode";
// } else {
//     echo "não pode";
// }


// $array = ['index', 'dados', 'alterarDados', 'alterarDadosPet', 'alterarDadosEndereco', 'apagarDadosPet', 'maisInfoConsulta'];
// $pa = array_search("alterarDadosEndereco", $array);
// echo "aqui: " . $pa;


// $kay = null;

// $array = ['index', 'dados', 'alterarDados'];

// $key = array_search("view", $array); 

// if ($key != null || $key === 0){
//     echo $key;
// } else {
//     echo "invalido " . $key;
// }

// if (0 === null) {
//     echo "Verdade";
// }


// $data['sit_consulta'] = "Confirmado";
// var_dump($data);
// $data = explode( '/', '10/02/2014' );
// var_dump( checkdate($data[1], $data[0], $data[2]) );

// $date1=date_create("2023-01-03");
// $date2=date_create("2023-01-01");
// $diff=date_diff($date1,$date2);
// echo $diff->format("%a");

// echo "<pre>";var_dump($diff) ;
// echo "<pre>";var_dump($date1) ;
// echo "<pre>";var_dump($date2) ;

// $data_inicio = new DateTime("2023-01-04");
// $data_fim = new DateTime("2023-01-03");

// // Resgata diferença entre as datas
// $dateInterval = $data_inicio->diff($data_fim);
// echo $dateInterval->days;

    //365