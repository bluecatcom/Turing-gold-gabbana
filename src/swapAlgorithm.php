<?php

function FunctionName($tape)
{
    $tape = str_split($tape);
    $tape[] = "_";

    $steps = 0;

    $head = 0;
    $state = "q0";

    $transition = [
        "q0" => [
            "0" => ["0", "R", "q0"],
            "1" => ["1", "R", "q0"],
            "_" => ["_", "L", "q1"]
        ],

        "q1" => [
            "0" => ["0", "S", "qEnd"],
            "1" => ["0", "S", "qEnd"]
        ]
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
}
