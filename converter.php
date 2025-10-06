<?php
// Função para validar entradas
function validarEntradas($valor, $moeda) {
    if ($valor === null || $valor === '' || !is_numeric($valor) || $valor <= 0) {
        return "Por favor, insira um valor em reais válido.";
    }

    if ($moeda === null || $moeda === '') {
        return "Por favor, selecione uma moeda para conversão.";
    }

    return true;
}

// Função para exibir mensagens
function exibirMensagem($mensagem, $tipo = "erro") {
    $cor = $tipo === "erro" ? "red" : "green";
    echo "<div style='text-align:center; font-family:Arial; margin-top:50px;'>";
    echo "<p style='color:{$cor}; font-weight:bold;'>{$mensagem}</p>";
    echo "<p><a href='index.html'>Voltar</a></p>";
    echo "</div>";
}

// Função que consome a API para pegar as cotações
function buscarCotacoes() {
    $url = "https://economia.awesomeapi.com.br/json/last/USD-BRL,EUR-BRL,CAD-BRL";
    $response = @file_get_contents($url);

    if ($response === false) {
        return false; // erro de conexão
    }

    $dados = json_decode($response, true);

    return [
        'usd' => $dados['USDBRL']['bid'] ?? 5.60,
        'eur' => $dados['EURBRL']['bid'] ?? 6.10,
        'cad' => $dados['CADBRL']['bid'] ?? 4.10,
    ];
}

// Funções de conversão (usando a cotação da API)
function converterParaDolar($valor, $cotacao) {
    return $valor / $cotacao;
}

function converterParaEuro($valor, $cotacao) {
    return $valor / $cotacao;
}

function converterParaDolarCanadense($valor, $cotacao) {
    return $valor / $cotacao;
}

// Receber dados do formulário
$valor = $_POST['valor'] ?? null;
$moeda = $_POST['moeda'] ?? null;

// Validar entradas
$validacao = validarEntradas($valor, $moeda);
if ($validacao !== true) {
    exibirMensagem($validacao, "erro");
    exit;
}

// Buscar cotações atualizadas
$cotacoes = buscarCotacoes();
if ($cotacoes === false) {
    exibirMensagem("Não foi possível atualizar as cotações. Tente novamente mais tarde.", "erro");
    exit;
}

// Escolher a moeda e converter com base na cotação da API
switch ($moeda) {
    case 'usd':
        $resultado = converterParaDolar($valor, $cotacoes['usd']);
        $nomeMoeda = "Dólar (USD)";
        $cotacaoAtual = $cotacoes['usd'];
        break;

    case 'eur':
        $resultado = converterParaEuro($valor, $cotacoes['eur']);
        $nomeMoeda = "Euro (EUR)";
        $cotacaoAtual = $cotacoes['eur'];
        break;

    case 'cad':
        $resultado = converterParaDolarCanadense($valor, $cotacoes['cad']);
        $nomeMoeda = "Dólar Canadense (CAD)";
        $cotacaoAtual = $cotacoes['cad'];
        break;

    default:
        exibirMensagem("Moeda inválida!", "erro");
        exit;
}

// Exibir resultado
exibirMensagem(
    "Cotação atual de {$nomeMoeda}: <strong>R$ " . number_format($cotacaoAtual, 2, ',', '.') . "</strong><br>" .
    "Valor em Reais: <strong>R$ " . number_format($valor, 2, ',', '.') . "</strong><br>" .
    "Valor convertido: <strong>" . number_format($resultado, 2, ',', '.') . " {$nomeMoeda}</strong>",
    "sucesso"
);
?>
