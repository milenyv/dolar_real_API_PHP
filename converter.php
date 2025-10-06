<?php
// Função para validar entradas do usuário
function validarEntradas($valor, $moeda) {
    if ($valor === null || $valor === '' || !is_numeric($valor) || $valor <= 0) {
        return "Por favor, insira um valor em reais válido.";
    }

    if ($moeda === null || $moeda === '') {
        return "Por favor, selecione uma moeda para conversão.";
    }

    return true; // Tudo certo!
}

// Receber dados do formulário
$valor = $_POST['valor'] ?? null;
$moeda = $_POST['moeda'] ?? null;

// Validar os dados usando a função
$validacao = validarEntradas($valor, $moeda);

if ($validacao !== true) {
    echo "<p style='color:red; text-align:center;'>$validacao</p>";
    echo "<p style='text-align:center;'><a href='index.html'>Voltar</a></p>";
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
        echo "<p style='color:red; text-align:center;'>Moeda inválida!</p>";
        echo "<p style='text-align:center;'><a href='index.html'>Voltar</a></p>";
        exit;
}

// Exibir resultado
echo "<div style='text-align:center; font-family:Arial; margin-top:50px;'>
        <h2>Resultado da Conversão</h2>
        <p>Valor em Reais: <strong>R$ " . number_format($valor, 2, ',', '.') . "</strong></p>
        <p>Valor em {$nomeMoeda}: <strong>" . number_format($resultado, 2, ',', '.') . "</strong></p>
        <a href='index.html' style='display:inline-block; margin-top:20px;'>Voltar</a>
      </div>";
?>
