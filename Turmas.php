<?php

$conexao = mysqli_connect('172.30.0.2', 'root', 'root_password', 'tg_05-012');


$sql = "select * from turma order by Ano desc";
$resultado = mysqli_query($conexao, $sql);
// Impede o cache do navegador
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Data no passado

// Resto do seu código PHP para buscar e exibir os dados do banco de dados
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turmas</title>
    <link rel="icon" href="EB.png">
    <script src="https://kit.fontawesome.com/309120fd85.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <style>
        body {

            background-repeat: repeat;
            overflow-x: hidden;
        }

    </style>
</head>

<body background="Camuflado.png">

    <?php
    require_once('Nav.php');
    ?>
    <br>
    <div class="container">
    <div class="card bg-dark">
    <center>
        <h1 style="color: white">Turmas:</h1>
    </center>
    <div class="row row-cols-1 row-cols-md-3 g-5 ">
        <?php while ($linha = mysqli_fetch_array($resultado)) : ?>
            <center>
                <div class="col">
                    <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
                        <div class="card-header">Turma de <?= $linha['Ano'] ?> <br>
                        </div>
                        <div class="card-body">
                            <h5>Instrutor Chefe: <h5>
                                    <h5 class="card-title"><?=$linha['InstrutorC']?></h5><br>
                                    <p class="card-text"><a class="btn btn-primary" href="ListarAtiradores.php?ID_turma=<?= $linha['ID'] ?>" role="button">Acessar</a></p>
                        </div>
                        <?php $cont = "select * from atiradores where ID_turma = {$linha['ID']}";
                        $contagem = mysqli_query($conexao, $cont);

                        $qtdsAtdr = mysqli_num_rows($contagem);

                        $alterar = "update turma set QTDsATDR = '$qtdsAtdr' where ID = {$linha['ID']}";
                        $aterado = mysqli_query($conexao, $alterar); ?>
                        <div class="card-footer"> N° de Atdrs: <?= $linha['QTDsATDR'] ?></div>
                    </div>
                </div>
            </center>
        <?php endwhile ?>

    </div>

    </div>
    </div>
    </div>

</body>

</html>