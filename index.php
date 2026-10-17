<?php

$fita = str_split("_" . "10101");
$fita[] = "_";

$cabecote = 1;
$estado = "q0";

$transicoes = [
    "q0" => [
        "0" => ["0", "R", "q0"],
        "1" => ["1", "R", "q0"],
        "_" => ["_", "L", "q1"]
    ],

    "q1" => [
        "0" => ["0", "L", "q2"],
        "1" => ["1", "L", "q3"],
        "_" => ["_", "L", "q1"]
    ],
    "q2" => [
        "0" => ["0", "L", "q2"],
        "1" => ["0", "L", "q2"],
        "_" => ["0", "S", "qFim"]
    ],
    "q3" => [
        "0" => ["1", "L", "q3"],
        "1" => ["1", "L", "q3"],
        "_" => ["1", "S", "qFim"]
    ],
];
while ($estado !== "qFim") {
    $simbolo = $fita[$cabecote];

    $regra = $transicoes[$estado][$simbolo];

    $fita[$cabecote] = $regra[0];

    if ($regra[1] === "R") {
        $cabecote++;
    } elseif ($regra[1] === "L") {
        $cabecote--;
    }

    $estado = $regra[2];

    echo "Estado: $estado | <br>";
    echo "Cabeçote: $cabecote | <br>";
    echo "Fita: " . implode("", $fita) . PHP_EOL . "<br>";
}

echo PHP_EOL;
echo "<br> Resultado final: " . implode("", $fita);
