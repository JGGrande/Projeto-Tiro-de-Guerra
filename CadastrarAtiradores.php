<?php
// Conecta ao banco de dados do TG)
require('config.php');


// Parte dedicada a organização de data --
// Obtém o ano atual do computador
$ano_computador = date('Y');

// Obtém a data real usando a API do WorldTimeAPI
$url_api = 'http://worldtimeapi.org/api/ip';
$data_api = file_get_contents($url_api);
$data_json = json_decode($data_api, true);

// Verifica se a chamada à API foi bem-sucedida e obtém o ano real
if ($data_json && isset($data_json['utc_datetime'])) {
  $data_real = $data_json['utc_datetime'];
  $ano_real = date('Y', strtotime($data_real));

  // Comparação dos anos
  if (!($ano_computador === $ano_real)) {
    $mensagem = "ATENÇÃO! A DATA DO COMPUTADOR ESTÁ ERRADA, O QUE OCASIONARÁ NO CADASTRO DE UM ATIRADOR EM UMA TURMA DE UM OUTRO ANO.";
  }
} else {
  $mensagem = "Não foi possível obter a data!";
}
// Termina a organização de data --

// Codigo do envio dos dados ao banco.
if (isset($_POST['cadastrar'])) {

  $consulta2 = $conn->prepare("SELECT * from turma");
  $consulta2->execute();
  // $dados = $consulta2->fetchAll(PDO::FETCH_ASSOC); 

  //2-receber os valores para inserir
  $NRa = $_POST['NRa'];
  $NomeC = $_POST['NomeC'];
  $NomeG = $_POST['NomeG'];
  $NomePai = $_POST['NomePai'];
  $TelPai = $_POST['TelPai'];
  $NomeMae = $_POST['NomeMae'];
  $TelMae = $_POST['TelMae'];
  $DataNasc = $_POST['DataNasc'];
  $LocalNasc = $_POST['LocalNasc'];
  $CPF = $_POST['CPF'];
  $RG = $_POST['RG'];
  $Religiao = $_POST['Religiao'];
  $Escolaridade = $_POST['Escolaridade'];
  $NTitulo = $_POST['NTitulo'];
  $TipoS = $_POST['TipoS'];
  $Habilitacao = $_POST['Habilitacao'];
  $TelContato = $_POST['TelContato'];
  $Endereco = $_POST['Endereco'];
  $Profissao = $_POST['Profissao'];
  $HProfissao = $_POST['HProfissao'];
  $CarteiraAss = $_POST['CarteiraAss'];
  $RemuM = $_POST['RemuM'];
  $RendaF = $_POST['RendaF'];

  // seleciona todos os atributos da tabela atiradores.
  // Parte responsável por verificar o ano da turma a qual o atirador vai estar cadastrado.
  $id_turma = null;
  if ($consulta2->rowCount() > 0) {
      $turmas = $consulta2->fetchAll(PDO::FETCH_ASSOC);
      foreach ($turmas as $turma) {
          if ($turma['Ano'] == date('Y')) {
              $id_turma = $turma['ID'];
              break; // Termina o loop assim que encontrar a turma correta
          }
      }
  }

  // // Termina a parte de verificar o ano do atirador.

  // // 4- Preparar a consulta SQL com os dados a serem inseridos
  $sql = "INSERT INTO atiradores (Numero, NomeC, NomeG, NomePai, TelPai, NomeMae, TelMae, DataNasc, LocalNasc, CPF, RG, Religiao, Escolaridade, NTituloEleitor, TipoSangue, Habilitacao, TelContato, Endereco, Profissao, HProfissao, CarteiraAss, RemuneracaoM, RendaF, ID_turma, Situacao) 
          VALUES (:ra, :nomeC, :nomeG, :nomePai, :telPai, :nomeMae, :telMae, :dataNasc, :localNasc, :cpf, :rg, :religiao, :escolaridade, :nTitulo, :tipoS, :habilitacao, :telContato, :endereco, :profissao, :hProfissao, :carteiraAss, :remuneracaoM, :rendaF, :id_turma, 'Ligado')";

  // 5- Preparar a consulta SQL
  $consulta = $conn->prepare($sql);
  $consulta->bindParam(":ra", $NRa);
  $consulta->bindParam(":nomeC", $NomeC);
  $consulta->bindParam(":nomeG", $NomeG);
  $consulta->bindParam(":nomePai", $NomePai);
  $consulta->bindParam(":telPai", $TelPai);
  $consulta->bindParam(":nomeMae", $NomeMae);
  $consulta->bindParam(":telMae", $TelMae);
  $consulta->bindParam(":dataNasc", $DataNasc);
  $consulta->bindParam(":localNasc", $LocalNasc);
  $consulta->bindParam(":cpf", $CPF);
  $consulta->bindParam(":rg", $RG);
  $consulta->bindParam(":religiao", $Religiao);
  $consulta->bindParam(":escolaridade", $Escolaridade);
  $consulta->bindParam(":nTitulo", $NTitulo);
  $consulta->bindParam(":tipoS", $TipoS);
  $consulta->bindParam(":habilitacao", $Habilitacao);
  $consulta->bindParam(":telContato", $TelContato);
  $consulta->bindParam(":endereco", $Endereco);
  $consulta->bindParam(":profissao", $Profissao);
  $consulta->bindParam(":hProfissao", $HProfissao);
  $consulta->bindParam(":carteiraAss", $CarteiraAss);
  $consulta->bindParam(":remuneracaoM", $RemuM);
  $consulta->bindParam(":rendaF", $RendaF);
  $consulta->bindParam(":id_turma", $id_turma);

  // 6- Executar a consulta SQL
  $consulta->execute();

  
  // Mensagem de Sucesso
  $mensagem = "Usuario cadastrado com sucesso!";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="EB.png">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

  <title>Cadastrar Atirador</title>

  <style>

        body {

            background-repeat: repeat;
            overflow-x: hidden;
        }

     

  </style>

</head>

<body background="camuflado.png">

  <?php
  require_once('Nav.php')
  ?>

  <div class="container">
    <?php if (isset($mensagem)) { ?>
      <div class="alert alert-success" role="alert">
        <?php echo $mensagem ?>
      </div>
    <?php } ?>
  </div>

  <br>
  <br>
  <div class="container text-dark">
    <form method="post" class="row g-3 bg-dark text-light shadow-none p-3 mb-5 rounded" enctype="multipart/form-data">
    <center>
      <h1>Cadastro de Atirador</h1>
    </center>
    <br>  
    <div class="col-md-3">
        <label for="NRa" class="form-label">N° do RA</label>
        <input name="NRa" type="text" class="form-control" id="NRa" placeholder="Ex: 00.000.000000.0" required>
      </div>
      <div class="col-md-3">
        <label for="NomeC" class="form-label">Nome Completo</label>
        <input name="NomeC" type="text" class="form-control" id="NomeC" placeholder="Nome do atirador..." required>
      </div>
      <div class="col-md-3">
        <label for="NomeG" class="form-label">Nome de Guerra</label>
        <input name="NomeG" type="text" class="form-control" id="NomeG" placeholder="Nome de guerra do atirador..." required>
      </div>
      <div class="col-md-3">
        <label for="NomePai" class="form-label">Nome do Pai</label>
        <input name="NomePai" type="text" class="form-control" id="NomePai" placeholder="Nome do pai..." required>
      </div>
      <div class="col-md-3">
        <label for="TelPai" class="form-label">Telefone Do Pai</label>
        <input name="TelPai" type="text" class="form-control" id="TelPai" placeholder="Ex: 44 99999-9999" required>
      </div>
      <div class="col-md-3">
        <label for="NomeMae" class="form-label">Nome da Mãe</label>
        <input name="NomeMae" type="text" class="form-control" id="NomMae" placeholder="Nome da mãe..." required>
      </div>
      <div class="col-md-3">
        <label for="TelMae" class="form-label">Telefone Da Mãe</label>
        <input name="TelMae" type="text" class="form-control" id="TelMae" placeholder="Ex: 44 99999-9999" required>
      </div>
      <div class="col-md-3">
        <label for="DataNasc" class="form-label">Data de Nascimento</label>
        <input name="DataNasc" type="date" class="form-control" id="DataNasc" required>
      </div>
      <div class="col-md-3">
        <label for="LocalNasc" class="form-label">Local de Nascimento</label>
        <input name="LocalNasc" type="text" class="form-control" id="LocalNasc" placeholder="Cidade natal - Estado" required>
      </div>
      <div class="col-md-3">
        <label for="CPF" class="form-label">CPF</label>
        <input name="CPF" type="text" class="form-control" id="CPF" placeholder="Ex: 000.000.000-00" required>
      </div>
      <div class="col-md-3">
        <label for="RG" class="form-label">N° do RG</label>
        <input name="RG" type="text" class="form-control" id="RG" placeholder="Ex: 000000000 - SSP/PR"required>
      </div>
      <div class="col-md-3">
        <label for="Religiao" class="form-label">Religião</label>
        <input name="Religiao" type="text" class="form-control" id="Religiao" placeholder="Religião..." required>
      </div>
      <div class="col-md-3">
        <label for="Escolaridade" class="form-label">Escolaridade</label>
        <input name="Escolaridade" type="text" class="form-control" id="Escolaridade" placeholder="Ex: Ensino médio completo" required>
      </div>
      <div class="col-md-3">
        <label for="NTitulo" class="form-label">N° do Titulo de Eleitor</label>
        <input name="NTitulo" type="text" class="form-control" id="NTitulo" placeholder="Ex: 0000 0000 0000" required>
      </div>
      <div class="col-md-3">
        <label for="TipoS" class="form-label">Tipo Sanguíneo</label>
        <input name="TipoS" type="text" class="form-control" id="TipoS"  placeholder="Ex: A+" required>
      </div>
      <div class="col-md-3">
        <label for="Habilitacao" class="form-label">Habilitação</label>
        <input name="Habilitacao" type="text" class="form-control" id="Habilitacao" placeholder="Ex: A/B" required>
      </div>
      <div class="col-md-3">
        <label for="TelContato" class="form-label">Telefone de Contato</label>
        <input name="TelContato" type="text" class="form-control" id="TelContato" placeholder="Ex: 44 99999-9999" required>
      </div>
      <div class="col-md-3">
        <label for="Endereco" class="form-label">Endereço</label>
        <input name="Endereco" type="text" class="form-control" id="Endereco" placeholder="Ex: Rua Goiás, N° 43 - Jardim Florido" required>
      </div>
      <div class="col-md-3">
        <label for="Profissao" class="form-label">Profissão</label>
        <input name="Profissao" type="text" class="form-control" id="Profissao" placeholder="Profissão do atirador..." required>
      </div>
      <div class="col-md-3">
        <label for="HProfissao" class="form-label">Horário</label>
        <input name="HProfissao" type="text" class="form-control" id="HProfissao" placeholder="Horário de trabalho..." required>
      </div>
      <div class="col-md-3">
        Carteira Asssinada?
        <div class="form-check">
          <input class="form-check-input" type="radio" name="CarteiraAss" id="CarteiraAssSim" value="Sim"required>
          <label class="form-check-label" for="CarteiraAssSim">
            Sim
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="CarteiraAss" id="CarteiraAssNao" value="Não"required>
          <label class="form-check-label" for="CarteiraAssNao">
            Não
          </label>
        </div>
      </div>
      <div class="col-md-3">
        <label for="RemuM" class="form-label">Remuneração Mensal</label>
        <input name="RemuM" type="text" class="form-control" id="RemuM" placeholder="Ex: 6.200,00 R$" required>
      </div>
      <div class="col-md-3">
        <label for="RendaF" class="form-label">Renda Familiar</label>
        <input name="RendaF" type="text" class="form-control" id="RendaF" placeholder="Ex: 5.500,00 R$" required>
      </div>
      <br>
      <div class="container">
        <button type="submit" class="btn btn-primary" name="cadastrar" onclick="return confirm('Confirma cadastro?')">Cadastrar</button>
        <button type="button" class="btn btn-warning" onclick="voltarPagina()">Voltar</button>
      </div>
    </form>
    <script>
      function voltarPagina() {
        window.history.back();
        //Faz a página voltar de acordo com o histórico.
      }
    </script>
  </div>

</body>

</html>