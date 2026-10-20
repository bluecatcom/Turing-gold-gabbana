# Turing-gold-gabbana

## Requisitos

- PHP 8.1 ou superior
- Navegador moderno

## Como executar

Na pasta raiz do projeto:

```bash
php -S localhost:8000 -t public
```

Abra `http://localhost:8000` no navegador. Não abra `index.php` diretamente como arquivo local, pois o PHP precisa ser executado pelo servidor.

## Como funciona

Cada regra tem o formato `"símbolo lido" => ["escrever", "mover", "próximo estado"]` e é agrupada pelo estado atual. Movimentos: `L` (esquerda), `R` (direita) e `S` (parado). `_` representa branco.

O método `executarPasso()` aplica uma única transição, `executar()` aplica até uma quantidade definida de passos, a fita é representada por um array indexado por inteiros até negativos, as posições não inicializadas são lidas como `_`.

O motor distingue estados finais (`aceita` ou `rejeita`), transições ausentes (`erro`) e limite de passos (`limite`).

## Estrutura:
```
.
├── algorithms
│   └── Machines.php
├── public
│   └── index.php
├── src
│   └── TuringMachine.php
├── README.md
```