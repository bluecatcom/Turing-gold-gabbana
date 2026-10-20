<?php

declare(strict_types=1);

final class MaquinaTuring
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

    public function __construct(string $entrada, array $config, int $limite = 1000)
    {
        if ($limite < 1 || $limite > 100000) {
            throw new InvalidArgumentException('Invalid step limit.');
        }
        $alfabeto = $config['alfabetoEntrada'] ?? ['0', '1'];
        foreach (str_split($entrada) as $simbolo) {
            if (!in_array($simbolo, $alfabeto, true)) {
                throw new InvalidArgumentException("Invalid symbol on input: {$simbolo}");
            }
        }
        $this->transicoes = $config['transicoes'];
        $this->estadosFinais = $config['finais'];
        $this->estado = $config['inicial'] ?? 'q0';
        $this->cabecote = 0;
        $this->limite = $limite;
        foreach (str_split($entrada) as $i => $simbolo) {
            $this->fita[$i] = $simbolo;
        }
        $this->atualizarStatusFinal();
    }

    private function ler(int $indice): string
    {
        return $this->fita[$indice] ?? '_';
    }

    private function atualizarStatusFinal(): void
    {
        if (array_key_exists($this->estado, $this->estadosFinais)) {
            $this->status = $this->estadosFinais[$this->estado];
            $this->mensagem = "Estado final alcançado: {$this->estado}.";
        }
    }

    public function executarPasso(): array
    {
        if ($this->status !== 'executando') {
            return $this->obterEstado();
        }
        if ($this->passos >= $this->limite) {
            $this->status = 'limite';
            $this->mensagem = 'Reached max steps limit. The machine maybe not able to end.';
            return $this->obterEstado();
        }
        $simbolo = $this->ler($this->cabecote);
        $regra = $this->transicoes[$this->estado][$simbolo] ?? null;
        if (!is_array($regra) || count($regra) !== 3) {
            $this->status = 'erro';
            $this->mensagem = "Transition non-existent on {$this->estado} reading '{$simbolo}'.";
            return $this->obterEstado();
        }
        [$escrever, $mover, $proximo] = array_values($regra);
        if (!is_string($escrever) || strlen($escrever) !== 1 || !in_array($mover, ['L', 'R', 'S'], true) || !is_string($proximo)) {
            $this->status = 'erro';
            $this->mensagem = 'Transition malformed.';
            return $this->obterEstado();
        }
        $anterior = $this->estado;
        $posicaoAnterior = $this->cabecote;
        $this->fita[$this->cabecote] = $escrever;
        if ($mover === 'R') $this->cabecote++;
        if ($mover === 'L') $this->cabecote--;
        $this->estado = $proximo;
        $this->passos++;
        $this->historico[] = [
            'passo' => $this->passos,
            'estado' => $anterior,
            'posicao' => $posicaoAnterior,
            'leu' => $simbolo,
            'escreveu' => $escrever,
            'movimento' => $mover,
            'proximo' => $proximo
        ];
        $this->atualizarStatusFinal();
        return $this->obterEstado();
    }

    public function executar(int $quantidade = 100): array
    {
        $quantidade = max(1, min(1000, $quantidade));
        for ($i = 0; $i < $quantidade && $this->status === 'executando'; $i++) {
            $this->executarPasso();
        }
        return $this->obterEstado();
    }

    public function obterEstado(): array
    {
        $indices = array_keys($this->fita);
        $min = min([0, $this->cabecote, ...$indices]);
        $max = max([0, $this->cabecote, ...$indices]);
        $celulas = [];
        $inicio = max($min - 1, $this->cabecote - 40);
        $fim = min($max + 1, $inicio + 80);
        if ($this->cabecote > $fim) {
            $fim = $this->cabecote + 1;
            $inicio = $fim - 80;
        }
        for ($i = $inicio; $i <= $fim; $i++) {
            $celulas[] = ['indice' => $i, 'simbolo' => $this->ler($i)];
        }
        $naoBrancos = array_filter($this->fita, fn($s) => $s !== '_');
        $texto = '';
        if ($naoBrancos) {
            $a = min(array_keys($naoBrancos));
            $b = max(array_keys($naoBrancos));
            for ($i = $a; $i <= $b && strlen($texto) < 1000; $i++) $texto .= $this->ler($i);
            if ($b - $a + 1 > 1000) $texto .= '…';
        }
        return [
            'fita' => $celulas,
            'resultado' => $texto,
            'cabecote' => $this->cabecote,
            'estado' => $this->estado,
            'status' => $this->status,
            'mensagem' => $this->mensagem,
            'passos' => $this->passos,
            'limite' => $this->limite,
            'historico' => array_slice($this->historico, -30)
        ];
    }
}
