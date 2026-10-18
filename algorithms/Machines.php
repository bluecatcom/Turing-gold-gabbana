<?php

return [
    'somarUm' => [
        'nome' => 'Somar 1 (unário)',
        'descricao' => 'Acrescenta um símbolo 1 ao final. Ex.: 111 → 1111.',
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
];
