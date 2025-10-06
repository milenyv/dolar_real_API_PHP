<?php
// Receber dados do formulário
$valor = $_POST['valor'] ?? null;
$moeda = $_POST['moeda'] ?? null;

// Definir cotações fixas
$cotacaoDolar = 5.60;
$cotacaoEuro = 6.10;
$cotacaoCad = 4.10;

// Verificar se o valor foi informado corretamente
if ($valor === null || $valor <= 0 || $moeda === null || $moeda === '') {
    echo "<p style='color:red; text-align:center;'>Por favor, insira um valor válido e selecione uma moeda.</p>";
    echo "<p style='text-align:center;'><a href='index.html'>Voltar</a></p>";
    exit;
}

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

// Exibir resultado formatado
echo "<div style='text-align:center; font-family:Arial; margin-top:50px;'>
        <h2>Resultado da Conversão</h2>
        <p>Valor em Reais: <strong>R$ " . number_format($valor, 2, ',', '.') . "</strong></p>
        <p>Valor em {$nomeMoeda}: <strong>" . number_format($resultado, 2, ',', '.') . "</strong></p>
        <a href='index.html' style='display:inline-block; margin-top:20px;'>Voltar</a>
      </div>";
?>
