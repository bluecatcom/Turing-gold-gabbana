<?php

function copyAlgorithm($tape)
{
    $tape = str_split("_" . $tape);
    $tape[] = "_";

    $string = implode("", $tape);
    echo "Tape:" . $string;

    $steps = 0;

    $head = 1;
    $state = "q0";

    $transition = [
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
    while ($state !== "qEnd") {
        $symbol = $tape[$head];

        $rule = $transition[$state][$symbol];

        $tape[$head] = $rule[0];

        if ($rule[1] === "R") {
            $head++;
        } elseif ($rule[1] === "L") {
            $head--;
        }

        $state = $rule[2];

        $steps += 1;
    }

    echo PHP_EOL;
    echo "<br> output: " . implode("", $tape);
    echo "<br> steps: " . $steps;
    echo "<br> ========================== <br>";
}

copyAlgorithm(101010);
copyAlgorithm(101011);
copyAlgorithm(111110);
copyAlgorithm(11_110);
