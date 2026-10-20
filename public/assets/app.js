const $ = (id) => document.getElementById(id);
const seletor = $('algoritmo');
let ocupado = false;
function atualizarExemplo() {
  const opcao = seletor.selectedOptions[0];
  $('entrada').value = opcao.dataset.exemplo;
  $('descricao').textContent = opcao.dataset.descricao;
}
seletor.addEventListener('change', atualizarExemplo);
atualizarExemplo();
async function requisitar(acao) {
  if (ocupado) return;
  ocupado = true;
  for (const id of ['iniciar', 'passo', 'executar']) $(id).disabled = true;
  try {
    const params = new URLSearchParams({ acao, algoritmo: seletor.value, entrada: $('entrada').value });
    const resposta = await fetch('api.php', { method: 'POST', credentials: 'same-origin', cache: 'no-store', body: params });
    const json = await resposta.json();
    if (!json.ok) throw new Error(json.erro);
    renderizar(json.dados);
  } catch (erro) {
    $('mensagem').textContent = 'Erro: ' + erro.message;
  } finally {
    ocupado = false;
    $('iniciar').disabled = false;
    $('passo').disabled = false;
    $('executar').disabled = false;
  }
}
function renderizar(dados) {
  const fita = $('fita');
  fita.replaceChildren();
  for (const celula of dados.fita) {
    const item = document.createElement('div');
    item.className = 'celula' + (celula.indice === dados.cabecote ? ' ativa' : '');
    const simbolo = document.createElement('div');
    simbolo.className = 'simbolo';
    simbolo.textContent = celula.simbolo;
    const indice = document.createElement('div');
    indice.className = 'indice';
    indice.textContent = celula.indice;
    const ponteiro = document.createElement('div');
    ponteiro.className = 'ponteiro';
    ponteiro.textContent = celula.indice === dados.cabecote ? '▲' : '';
    item.append(simbolo, indice, ponteiro);
    fita.append(item);
  }
  fita.querySelector('.ativa')?.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
  $('estado').textContent = dados.estado;
  $('cabecote').textContent = dados.cabecote;
  $('passos').textContent = dados.passos + ' / ' + dados.limite;
  $('status').textContent = dados.status;
  $('resultado').textContent = dados.resultado || '(tape without non-white symbols)';
  $('mensagem').textContent = dados.mensagem || 'Machine ready to execute the next transition.';
  const tbody = $('historico');
  tbody.replaceChildren();
  for (const item of [...dados.historico].reverse()) {
    const tr = document.createElement('tr');
    for (const campo of ['passo', 'estado', 'posicao', 'leu', 'escreveu', 'movimento', 'proximo']) {
      const td = document.createElement('td');
      td.textContent = item[campo];
      tr.append(td);
    }
    tbody.append(tr);
  }
  if (!dados.historico.length) {
    const tr = document.createElement('tr');
    const td = document.createElement('td');
    td.colSpan = 7;
    td.textContent = 'No transition executed.';
    tr.append(td);
    tbody.append(tr);
  }
  const terminou = dados.status !== 'executed';
  $('passo').disabled = terminou;
  $('executar').disabled = terminou;
}
$('iniciar').addEventListener('click', () => requisitar('iniciar'));
$('passo').addEventListener('click', () => requisitar('passo'));
$('executar').addEventListener('click', () => requisitar('executar'));
requisitar('iniciar');
