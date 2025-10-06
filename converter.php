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

// Função para converter Real → Dólar
function converterParaDolar($valor) {
    $cotacaoDolar = 5.60;
    return $valor / $cotacaoDolar;
}

// Função para converter Real → Euro
function converterParaEuro($valor) {
    $cotacaoEuro = 6.10;
    return $valor / $cotacaoEuro;
}

// Função para converter Real → Dólar Canadense
function converterParaDolarCanadense($valor) {
    $cotacaoCad = 4.10;
    return $valor / $cotacaoCad;
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

// Escolher a função correta para cada moeda
switch ($moeda) {
    case 'usd':
        $resultado = converterParaDolar($valor);
        $nomeMoeda = "Dólar (USD)";
        break;

    case 'eur':
        $resultado = converterParaEuro($valor);
        $nomeMoeda = "Euro (EUR)";
        break;

    case 'cad':
        $resultado = converterParaDolarCanadense($valor);
        $nomeMoeda = "Dólar Canadense (CAD)";
        break;

    default:
        exibirMensagem("Moeda inválida!", "erro");
        exit;
}

// Exibir resultado
exibirMensagem(
    "Valor em Reais: <strong>R$ " . number_format($valor, 2, ',', '.') .
    "</strong><br>Valor em {$nomeMoeda}: <strong>" . number_format($resultado, 2, ',', '.') . "</strong>",
    "sucesso"
);
?>
