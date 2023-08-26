<?php

// Faz a Conexão com o BD

$conexao = mysqli_connect('127.0.0.1', 'root', '', 'tg_05-012');
$id_turma = $_GET['ID_turma']; //pega o id da URL para mostrar o usuário
$sql = "select * from atiradores where ID_turma = {$id_turma}";
$resultado = mysqli_query($conexao, $sql);
$PegarAno = "select * from turma where ID = {$id_turma}"; //pega o ano da turma de acordo com o id
$ano = mysqli_query($conexao, $PegarAno);
$row2 = mysqli_fetch_array($ano); //seleciona cada registro por ordem

if (isset($_POST['Salvar'])) {

  $numero = $_POST['Atdr'];
  $mes = $_POST['mes'];
  $qtds = $_POST['Qtds'];
  $teste2 = "update atiradores set $mes = $mes + $qtds, TotalF = Marco + Abril + Maio + Junho + Julho + Agosto + Setembro + Outubro + Novembro where ID_turma = '$id_turma' and (NomeG like '$numero%' or Numero = '$numero')";
  mysqli_query($conexao, $teste2);
}

if (mysqli_num_rows($resultado) >= 1) {
  $linha = mysqli_fetch_array($resultado);

  $sql = "select * from atiradores where ID_turma = '$id_turma' order by NomeC asc";
  $resultado = mysqli_query($conexao, $sql);
  //executar a SQL
  mysqli_query($conexao, $sql);
} else {
  $mensagem = "NENHUM ATIRADOR ENCONTRADO!";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Listar Atiradores</title>
  <link rel="icon" href="EB.png">
  <script src="https://kit.fontawesome.com/309120fd85.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

  <style>
    /* Estilos personalizados para a célula com scroll */
    .scrollable-cell {
      max-height: 150px;
      /* Ajuste esta altura conforme necessário */
      overflow-y: auto;
    }
  </style>

</head>

<body>

  <?php
  require_once('Nav.php');
  ?>

  <br>

  <div class="container">
    <div class="card bg-dark text-light">
      <div class="card-body">
        <center>
          <h2 class="card-title">Atiradores da turma <?= $row2['Ano'] ?></h2>
          <div class="card-body bg-light w-50 text-dark">
            <form method="post" class="row g-3 shadow-none p-3 mb-5" enctype="multipart/form-data">
              <div class="col-md-3" style="width: 200px;">
                <label for="Adicionar" class="form-label">Mês</label>
                <select class="form-select" aria-label="Default select example" name="mes" id="mes">
                  <option value="marco">Março</option>
                  <option value="abril">Abril</option>
                  <option value="maio">Maio</option>
                  <option value="junho">Junho</option>
                  <option value="julho">Julho</option>
                  <option value="agosto">Agosto</option>
                  <option value="setembro">Setembro</option>
                  <option value="outubro">Outubro</option>
                  <option value="novembro">Novembro</option>
                </select>
              </div>
              <div class="col-md-3" style="width: 80px;">
                <label for="Qtds" class="form-label">Qtd</label>
                <input type="Number" class="form-control" id="Qtds" name="Qtds" value="0">
              </div>
              <div class="col-md-3" style="width: 150px;">
                <label for="Atdr" class="form-label">Atdr</label>
                <input type="text" class="form-control" id="Atdr" name="Atdr" placeholder="N° ou Nome">
              </div>
              <div class="container" align="left">
                <button type="submit" class="btn btn-warning button-sm" name="Salvar"><i class="fa-solid fa-plus"></i></button>
              </div>
            </form>
          </div>
        </center>
      </div>
    </div>

    <?php if (isset($mensagem)) : ?>
      <div class="alert alert-success" role="alert">
        <?= $mensagem ?>
      </div>
    <?php endif; ?>

    <form method="post" class="row g-3 bg-light text-dark shadow-none p-3 mb-5 bg-light rounded" enctype="multipart/form-data">
      <div class="table-responsive">
        <table class="table table-striped bg-light shadow-none bg-light rounded">
          <thead>
            <tr>
              <th scope="col">N° Atdr</th>
              <th scope="col">Nome de Guerra</th>
              <th scope="col">Março</th>
              <th scope="col">Abril</th>
              <th scope="col">Maio</th>
              <th scope="col">Junho</th>
              <th scope="col">Julho</th>
              <th scope="col">Agosto</th>
              <th scope="col">Setembro</th>
              <th scope="col">Outubro</th>
              <th scope="col">Novembro</th>
              <th scope="col">Total</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($linha = mysqli_fetch_array($resultado)) : ?>
              <tr>
                <td><?= $linha['Numero'] ?></td>
                <td><?= $linha['NomeG'] ?></td>
                <td><?= $linha['Marco'] ?></td>
                <td><?= $linha['Abril'] ?></td>
                <td><?= $linha['Maio'] ?></td>
                <td><?= $linha['Junho'] ?></td>
                <td><?= $linha['Julho'] ?></td>
                <td><?= $linha['Agosto'] ?></td>
                <td><?= $linha['Setembro'] ?></td>
                <td><?= $linha['Outubro'] ?></td>
                <td><?= $linha['Novembro'] ?></td>
                <td><?= $linha['TotalF'] ?></td>
              </tr>
      </div>
    <?php endwhile; ?>
    </tbody>
    </table>
  </div>
  <form>

    <!--Impede que a tecla enter envia o formulário-->

    <script>
      // Captura o formulário
      const form = document.getElementById("meuForm");

      // Captura o input
      const input = document.getElementById("meuInput");

      // Adiciona um evento de tecla pressionada ao input
      input.addEventListener("keydown", function(event) {
        // Verifica se a tecla pressionada é o "Enter" (código 13)
        if (event.keyCode === 13) {
          // Impede o envio do formulário
          event.preventDefault();
        }
      });
    </script>

    <script>
      function voltarPagina() {
        window.history.back();
        //Faz a página voltar de acordo com o histórico.
      }
    </script>
    <script>
      // Crie um objeto Date para representar a data atual
      var dataAtual = new Date();

      // Obtenha o mês atual (0 - janeiro, 1 - fevereiro, ..., 11 - dezembro)
      var mesAtual = dataAtual.getMonth();

      // Verifique se o mês atual está fora do intervalo de março (2) a novembro (10)
      if (mesAtual < 2 || mesAtual > 10) {
        // Se estiver fora desse intervalo, defina a opção selecionada para março (índice 0)
        mesAtual = 2; // Março
      }

      // Defina a opção selecionada com base no mês atual
      document.getElementById('mes').selectedIndex = mesAtual - 2; // Ajuste para o índice correto
    </script>


</body>

</html>

</body>

</html>