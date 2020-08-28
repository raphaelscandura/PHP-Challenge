<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>

<?php 
require_once('misc/navbar.php'); 
require_once('misc/validacaoLogin.php');
require('misc/bancodedadosdesafio.php');

$id = $_GET['id'];

    $query = $bancodedadosdesafio->prepare("SELECT nome,descricao,preco,photo FROM produtos WHERE id = :id;");
    $query->execute([':id' => $id]);
    $produtos = $query->fetchAll(PDO::FETCH_ASSOC);

?>

    <style>
        .descricao-produto{
            font-size: 25px;
            font-weight: bold;
        }

        .container{
            margin-top: 200px;
        }

        .preco-produto{
            font-size: 20px;
            font-weight: bolder;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="foto col-lg-6">
                <?php foreach ($produtos as $produto) : ?>
                    <img width="500" height="500"  src="./img/<?= $produto['photo']?>" alt="Imagem do Produto">
                <?php endforeach; ?>
            </div>
            <div class="descricao col-lg-6">
                <?php foreach ($produtos as $produto) : ?>
                        <h1 class="nome-produto"><?= $produto['nome']?></h1>
                        <hr>
                        <p class="descricao-produto"><?= $produto['descricao']?></p>
                        <p class="preco-produto">Preço do Produto <br>R$<?= $produto['preco']?></p>
                <?php endforeach; ?>
                <form method="POST" action="./misc/removerproduto.php">
                        <input type="hidden" value="<?= $id ?>" name="id">
                        <input class="btn btn-danger" type="submit" value="Excluir Produto">
                    </form>
                    <br>
                    <a href="editProduto.php?id=<?= $id ?>"><button class="btn btn-info">Editar produto</button></a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>    
</body>
</html>