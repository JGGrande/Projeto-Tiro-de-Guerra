<?php
// Conecta ao banco de dados
$conexao = mysqli_connect('localhost', 'root', 'root', 'tg_05-012');
if (!$conexao) {
    die('Erro de conexão: ' . mysqli_connect_error());
}

// Consulta ao banco de dados
$query = "SELECT * FROM atiradores";
$resultado = mysqli_query($conexao, $query);

// Cria um arquivo CSV
$csvFileName = 'relatorio.csv';
$csvFile = fopen($csvFileName, 'w');

// Escreve os cabeçalhos no arquivo CSV
$cabecalhos = ['Número', 'Situacao', 'Numero Ra', 'Nome Completo', 'Nome de Guerra', 'Nome do Pai', 'Tellefone do Pai', 'Nome da mãe', 'Telefone da Mãe', 'Data de nascimento', 'Local de nascimento', 'CPF', 'RG', 'Religaio', 'Escolaridade', 'Nº Titulo Eleitoral', 'Tipo sanguinio', 'Habilitação', 'Telefone de contato', 'Endereço', 'Profissão', 'Horario', 'Carteira Assinada', 'Remuneração mensal', 'Renda Familiar'];

fputcsv($csvFile, $cabecalhos);

// Escreve os dados no arquivo CSV
while ($linha = mysqli_fetch_array($resultado)) {
    $data = [$linha['Numero'], $linha['Situacao'], $linha['NRa'], $linha['NomeC'], $linha['NomeG'], $linha['NomePai'], $linha['TelPai'], $linha['NomeMae'],$linha['TelMae'], $linha['DataNasc'],$linha['LocalNasc'],$linha['CPF'], $linha['RG'],  $linha['Religiao'],$linha['Escolaridade'], $linha['NTituloEleitor'],$linha['TipoSangue'], $linha['Habilitacao'], $linha['TelContato'],$linha['Endereco'], $linha['Profissao'],  $linha['HProfissao'],  $linha['CarteiraAss'], $linha['RemuneracaoM'],$linha['RendaF'] ];
    fputcsv($csvFile, $data);
}

// Fecha o arquivo CSV
fclose($csvFile);

// Define os cabeçalhos para download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $csvFileName . '"');

// Saída do arquivo CSV para o navegador
readfile($csvFileName);

// Deleta o arquivo CSV gerado
unlink($csvFileName);

// Fecha a conexão ao banco de dados
mysqli_close($conexao);
?>
