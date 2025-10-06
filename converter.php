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

// Receber dados do formulário
$valor = $_POST['valor'] ?? null;
$moeda = $_POST['moeda'] ?? null;

// Validar entradas
$validacao = validarEntradas($valor, $moeda);
if ($validacao !== true) {
    exibirMensagem($validacao, "erro");
    exit;
}

// Verificar a moeda e converter
switch ($moeda) {
    case 'usd':
        $resultado = converterParaDolar($valor);
        $nomeMoeda = "Dólar (USD)";
        break;

    case 'eur':
        $cotacaoEuro = 6.10;
        $resultado = $valor / $cotacaoEuro;
        $nomeMoeda = "Euro (EUR)";
        break;

    case 'cad':
        $cotacaoCad = 4.10;
        $resultado = $valor / $cotacaoCad;
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
