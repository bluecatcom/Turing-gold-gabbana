# Como adicionar novos Algorithms?

### Passo a Passo:

1. Primeiro entre na pasta dos algorithms: /algorithms/Machines.php

2. Preencha cada espaço de acordo com as regras e condições do seu algoritimo

A estrutura segue o seguinte formato: 

```
'AlgorithmName' => [
```
```
        'Nome' => 'Enter the designated name for the algorithm here',
```

```
        'descricao' => 'Put here a brief description of what your algorithm does',
```

```
        'exemplo' => 'The default value that should appear automatically',
```

```
        'alfabetoEntrada' => Allowed characters, example: ['0', '1'],
```

```
        'inicial' => The initial state, example: 'q0',
```

```
        'finais' => The final states,example: ['qFim' => 'aceita'],
```

```
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
        ]
    ]
```
`"Here you will put the logic of your algorithm, The algorithms are divided into groups, and in these groups there are the conditions, for example the initial group q0, when it finds the symbol "1" what will it do? according to the example: ['1', 'R', 'q0'] then it will change the current symbol 1 for the same 1, it will go one place to the right "R" and go to the same state "q0", to change state we can see the example "_" => ['_', 'L', 'q1'], where when the algorithm finds the symbol it will change to the same symbol "_", now it will go to the left "L" and will change to the next state "q1""`