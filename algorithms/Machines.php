<?php

declare(strict_types=1);

return [
    'AddOne' => [
        'nome' => 'Add 1 (unary)',
        'descricao' => 'Add a 1 symbol to the end. E.g.: 111 → 1111.',
        'exemplo' => '111',
        'alfabetoEntrada' => ['1'],
        'inicial' => 'q0',
        'finais' => ['qFim' => 'aceita'],
        'transicoes' => [
            'q0' => [
                '1' => ['1', 'R', 'q0'],
                '_' => ['1', 'S', 'qFim'],
            ],
        ],
    ],
    'ReplaceZero' => [
        'nome' => 'Replace with zero',
        'descricao' => 'It goes to the end and comes back replacing all the bits with 0.',
        'exemplo' => '10101',
        'alfabetoEntrada' => ['0', '1'],
        'inicial' => 'q0',
        'finais' => ['qFim' => 'aceita'],
        'transicoes' => [
            'q0' => [
                '0' => ['0', 'R', 'q0'],
                '1' => ['1', 'R', 'q0'],
                '_' => ['_', 'L', 'q1'],
            ],
            'q1' => [
                '0' => ['0', 'L', 'q1'],
                '1' => ['0', 'L', 'q1'],
                '_' => ['_', 'S', 'qFim'],
            ],
        ],
    ],
    'replicateLast' => [
        'nome' => 'Replicate last number',
        'descricao' => 'Reads the last bit and replaces all previous ones with it.',
        'exemplo' => '10101',
        'alfabetoEntrada' => ['0', '1'],
        'inicial' => 'q0',
        'finais' => ['qFim' => 'aceita', 'qRejeita' => 'rejeita'],
        'transicoes' => [
            'q0' => [
                '0' => ['0', 'R', 'q0'],
                '1' => ['1', 'R', 'q0'],
                '_' => ['_', 'L', 'q1'],
            ],
            'q1' => [
                '0' => ['0', 'L', 'q2'],
                '1' => ['1', 'L', 'q3'],
                '_' => ['_', 'S', 'qRejeita'],
            ],
            'q2' => [
                '0' => ['0', 'L', 'q2'],
                '1' => ['0', 'L', 'q2'],
                '_' => ['_', 'S', 'qFim'],
            ],
            'q3' => [
                '0' => ['1', 'L', 'q3'],
                '1' => ['1', 'L', 'q3'],
                '_' => ['_', 'S', 'qFim'],
            ],
        ],
    ],
    'InverseSymbols' => [
        'nome' => 'Inverse one to zero and zero to one',
        'descricao' => 'It goes to the end and comes back replacing all the bits with 0.',
        'exemplo' => '10101',
        'alfabetoEntrada' => ['0', '1'],
        'inicial' => 'q0',
        'finais' => ['qFim' => 'aceita'],
        'transicoes' => [
            'q0' => [
                '0' => ['0', 'R', 'q0'],
                '1' => ['1', 'R', 'q0'],
                '_' => ['_', 'L', 'q1'],
            ],
            'q1' => [
                '0' => ['1', 'L', 'q1'],
                '1' => ['0', 'L', 'q1'],
                '_' => ['_', 'S', 'qFim'],
            ],
        ],
    ],
];
