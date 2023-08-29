
<?php

$conexao = mysqli_connect('127.0.0.1', 'root', '', 'tg_05-012');

if (isset($_POST['salvar'])) {

    $diretorio = "Upload/";
    $Imagem = $diretorio . $_FILES['Imagem']['name'];
  
    if (move_uploaded_file($_FILES['Imagem']['tmp_name'], $Imagem)) {

        $id = $_POST['id'];
        $sql = "update atiradores set Imagem = '{$Imagem}' where ID_ATDRS = '{$id}'";


        mysqli_query($conexao, $sql);

        $mensagem = "IMAGEM ALTERADA COM SUCESSO!";
    }else{
        $mensagem = "IMAGEM NÃO ALTERADA!";
    }

}

$id = $_GET['id']; //pega o id da URL para mostrar o usuário
$sql = "select * from atiradores where ID_ATDRS = {$id}";
$resultado = mysqli_query($conexao, $sql);
$linha = mysqli_fetch_array($resultado);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <title>Alterar Imagem</title>
    <link rel="icon" href="EB.png">

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
    <br><br>
    <div class="container text-light">
        <form method="post" class="row g-3 bg-dark text-light shadow-none p-3 mb-5 rounded" enctype="multipart/form-data">
        <center>
            <h1>Alterar Imagem</h1>
        </center>
        <br>
            <input type="hidden" name="id" value="<?= $linha['ID_ATDRS'] ?>">
            <div class="col-md-3">
                <label for="Imagem" class="form-label"></label>
                <input name="Imagem" type="file" class="form-control" id="Imagem">
            </div>
            <div>
                <button type="submit" class="btn btn-primary" name="salvar"> Salvar </button>
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