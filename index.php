<?php

$entrada = "0101010";

$fita = str_split($entrada);

$cabecote = 0;

$length = count($fita);

while ($cabecote != $length) {
    echo $fita[$cabecote];
    $cabecote++;
}

echo " <br> Maquina escrevendo.. <br>";

$fitaEscrita = [];

foreach ($fita as $indice => $value) {
    if ($fita[$indice] == 0) {
        $value = 1;
        array_push($fitaEscrita, $value);
    } elseif ($fita[$indice] == 1) {
        $value = 0;
        array_push($fitaEscrita, $value);
    }
}

$cabecote = 0;

while ($cabecote != $length) {
    echo $fitaEscrita[$cabecote];
    $cabecote++;
}
