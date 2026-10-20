<?php

declare(strict_types=1);

$diretorioSessoes = dirname(__DIR__) . '/var/sessoes';

if (!is_dir($diretorioSessoes) && !mkdir($diretorioSessoes, 0775, true) && !is_dir($diretorioSessoes)) {
    throw new RuntimeException('Unable to create session folder.');
}

ini_set('session.save_path', $diretorioSessoes);

require_once __DIR__ . '/../src/TuringMachine.php';

session_start();
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

$maquinas = require __DIR__ . '/../algorithms/Machines.php';

try {
    $acao = $_POST['acao'] ?? 'estado';

    if ($acao === 'iniciar') {
        $id = (string) ($_POST['algoritmo'] ?? '');
        if (!isset($maquinas[$id])) throw new InvalidArgumentException('Algorithm not found.');

        $entrada = (string) ($_POST['entrada'] ?? '');

        if (strlen($entrada) > 200) throw new InvalidArgumentException('Input too long (max 200 symbols).');

        $_SESSION['maquina'] = new MaquinaTuring($entrada, $maquinas[$id]);

        $_SESSION['algoritmo'] = $id;
    }

    if (!isset($_SESSION['maquina']) || !($_SESSION['maquina'] instanceof MaquinaTuring)) {
        throw new RuntimeException('Start the machine first.');
    }

    $maquina = $_SESSION['maquina'];

    if ($acao === 'passo') $maquina->executarPasso();
    elseif ($acao === 'executar') $maquina->executar(100);
    elseif (!in_array($acao, ['estado', 'iniciar'], true)) throw new InvalidArgumentException('Invalid Action');

    session_write_close();

    echo json_encode(['ok' => true, 'dados' => $maquina->obterEstado()], JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
} catch (Throwable $e) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'erro' => $e->getMessage()], JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
}
