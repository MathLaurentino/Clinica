<?php

$data = explode( '/', '10/02/2014' );
var_dump( checkdate($data[1], $data[0], $data[2]) );

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