<?php
// Função de porcentagem: Quanto é X% de N?

use Carbon\Carbon;

function porcentagemXn ( $porcentagem, $total ) {
	return ( $porcentagem / 100 ) * $total;
}

// Função de porcentagem: N é X% de N
function porcentagemNx ( $valor, $total ) {
	return ( $valor * 100 ) / $total;
}

// Função de porcentagem: N é X% de N Arredondado
function porcentagemNxRound ( $valor, $total ) {
	return round(( $valor * 100 ) / $total);
}

// Função de porcentagem: N é N% de X
function porcentagemNnx ( $parcial, $porcentagem ) {
	return ( $parcial / $porcentagem ) * 100;
}

// Função de Calcular Idade
function getAge($date, $full=false) {
    if($full)
        return Carbon::parse($date)->diff(\Carbon\Carbon::now())->format('%y anos, %m meses e %d dias');
    else
        return Carbon::parse($date)->age;
}
