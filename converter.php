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
    echo "<p style='color:{$cor}; text-align:center; font-weight:bold;'>{$mensagem}</p>";
    echo "<p style='text-align:center;'><a href='index.html'>Voltar</a></p>";
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

// Cotações fixas
$cotacaoDolar = 5.60;
$cotacaoEuro = 6.10;
$cotacaoCad = 4.10;

// Realizar a conversão
switch ($moeda) {
    case 'usd':
        $resultado = $valor / $cotacaoDolar;
        $nomeMoeda = "Dólar (USD)";
        break;
    case 'eur':
        $resultado = $valor / $cotacaoEuro;
        $nomeMoeda = "Euro (EUR)";
        break;
    case 'cad':
        $resultado = $valor / $cotacaoCad;
        $nomeMoeda = "Dólar Canadense (CAD)";
        break;
    default:
        exibirMensagem("Moeda inválida!", "erro");
        exit;
}

// Exibir resultado com função de mensagem (tipo sucesso)
exibirMensagem(
    "Valor em Reais: <strong>R$ " . number_format($valor, 2, ',', '.') . 
    "</strong><br>Valor em {$nomeMoeda}: <strong>" . number_format($resultado, 2, ',', '.') . "</strong>",
    "sucesso"
);
?>
