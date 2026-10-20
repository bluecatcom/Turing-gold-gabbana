<?php
$maquinas = require __DIR__ . '/../algorithms/Machines.php';
?>

<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Simulador de Máquina de Turing</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<main>

  <header>
    <h1>Turing Machine</h1>
    <p>Choose an algorithm, provide input, and track each machine transition.</p>
  </header>

  <section>
    <label>
      Algorithm
      <select id="algoritmo">
        <?php foreach ($maquinas as $id => $config): ?>
          <option 
            value="<?= htmlspecialchars($id, ENT_QUOTES) ?>" 
            data-exemplo="<?= htmlspecialchars($config['exemplo'], ENT_QUOTES) ?>" 
            data-descricao="<?= htmlspecialchars($config['descricao'], ENT_QUOTES) ?>">
            <?= htmlspecialchars($config['nome']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </label>

    <label>
      Input
      <input id="entrada" type="text" maxlength="200" value="111" spellcheck="false" autocomplete="off">
    </label>

    <p id="descricao"></p>

    <div>
      <button id="iniciar">Start / Restart</button>
      <button id="passo">Execute step</button>
      <button id="executar">Execute up to 100 step</button>
    </div>
  </section>

  <section>
    <div>
      <h2>Tape</h2>
      <span id="status" class="status">Waiting</span>
    </div>
    <div id="fita" class="fita" aria-label="Fita da máquina"></div>
  </section>

  <section>
    <div>
      <small>Current State</small>
      <strong id="estado">—</strong>
    </div>
    <div>
      <small>Head position</small>
      <strong id="cabecote">—</strong>
    </div>
    <div>
      <small>Steps taken</small>
      <strong id="passos">0</strong>
    </div>
  </section>

  <section>
    <h2>Output</h2>
    <pre id="resultado">Start a Machine.</pre>
    <p id="mensagem" role="status"></p>
  </section>

  <section>
    <h2>Transition history</h2>
    <div>
      <table>
        <thead>
          <tr>
            <th>step</th>
            <th>state</th>
            <th>position</th>
            <th>read</th>
            <th>write</th>
            <th>move</th>
            <th>next</th>
          </tr>
        </thead>
        <tbody id="historico">
          <tr>
            <td colspan="7">None transition taken</td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
</main>
<script src="assets/app.js"></script>
</body>
</html>