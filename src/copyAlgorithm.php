<?php

function CopyFinal($fita)
{
    $fita = str_split("_" . $fita);
    $fita[] = "_";

    $string = implode("", $fita);
    echo "Tape:" . $string;

    $steps = 0;

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
            "_" => ["_", "S", "qEnd"]
        ],
        "q3" => [
            "0" => ["1", "L", "q3"],
            "1" => ["1", "L", "q3"],
            "_" => ["_", "S", "qEnd"]
        ],
    ];
    while ($estado !== "qEnd") {
        $simbolo = $fita[$cabecote];

        $regra = $transicoes[$estado][$simbolo];

        $fita[$cabecote] = $regra[0];

        if ($regra[1] === "R") {
            $cabecote++;
        } elseif ($regra[1] === "L") {
            $cabecote--;
        }

        $estado = $regra[2];

        $steps += 1;

        // echo "Estado: $estado |";
        // echo "Cabeçote: $cabecote |";
        // echo "Fita: " . implode("", $fita) . PHP_EOL . "<br>";
    }

    echo PHP_EOL;
    echo "<br> output: " . implode("", $fita);
    echo "<br> steps: " . $steps;
}

CopyFinal(101010);
echo "<br>";
CopyFinal(101011);
echo "<br>";
CopyFinal(111110);
echo "<br>";
CopyFinal(11_110);
