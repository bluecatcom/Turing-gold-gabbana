<?php

namespace TuringMachine;

final class
{
    private array $fita = [];
    private int $cabecote;
    private string $estado;
    private array $transicoes;
    private array $estadosFinais;
    private int $passos = 0;
    private int $limite;
    private string $status = 'executando';
    private ?string $mensagem = null;
    private array $historico = [];

    public function __construct()
    {
    }

    private function ler(int $indice): string
    {
        return $this->fita[$indice] ?? '_';
    }

    private function atualizarStatusFinal(): void
    {
    }

    public function executarPasso()
    {
    }

    public function executar(int $quantidade = 100)
    {
    }

    public function obterEstado()
    {
    }
}
