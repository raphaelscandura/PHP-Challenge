<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
  
<?php 

require_once('misc/navbar.php');
require_once('misc/validacaoLogin.php');
require('misc/validacoesServidor.php');
require('misc/bancodedadosdesafio.php');

$id = $_GET['id'];

$query = $bancodedadosdesafio -> prepare("SELECT id, nome, descricao, preco, photo FROM produtos WHERE id = :id;");
$query->execute([':id' => $id]);
$produtos = $query->fetchAll(PDO::FETCH_ASSOC);

$nomeok = true;
$precook = true;
$photook = true;

if($_POST) {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $photo = $_FILES['photo']['name'];

    $nomeok = verificarNome($_POST['nome']);
    $precook = verificarPreco($_POST['preco']);
    $photook = verificarphoto($_FILES['photo']['name']);

    if ($nomeok && $precook && $photook) {
        $query = $bancodedadosdesafio -> prepare("UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco, photo = :photo WHERE id = :id;");
        $funcionou = $query -> execute([':id' => $id,':nome' => $nome,':descricao' => $descricao,':preco' => $preco,':photo' => $photo]);

        if ($funcionou) {
            header('Location: indexProdutos.php');
        } else {
            print_r($query->errorInfo());
            die();
        }
    }

    if ($_FILES['photo']['error'] == 0) {
        $photo = $_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'], 'img/'.$_FILES['photo']['name']);
    }
}    



 ?>

    <style>
      .container{
          margin-top: 200px;
      }
    </style>

<div class="container">
        <form method="POST" enctype="multipart/form-data">
            <h2>Cadastro de Produto</h2>
            <div class="row">
                <div class="col-lg-12">
                    <label for="nome">Novo nome do produto</label><br>
                        <input type="text" class = "form-control <?php if(!$nomeok) { echo ('is-invalid');} ?>" placeholder="Escreva aqui o nome do produto" id="nome" name="nome" required>
                        <?php if (!$nomeok) : ?>
                            <div class="invalid-feedback">
                                O nome precisa ter no mínimo cinco caracteres.
                            </div>
                <?php endif; ?>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12">
                    <label for="descricao">Nova descrição do produto</label><br>
                        <input type="text" placeholder="Escreva aqui a descrição do produto" id="descricao" name="descricao" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12">          
                    <label for="preco">Novo preço do produto</label><br>
                    <input name="preco" class="form-control <?php if(!$precook) { echo ('is-invalid');} ?>" type="text" step="0.01" min="0" placeholder="Insira o preço">
                    <?php if (!$precook) : ?>
                        <div class="invalid-feedback">
                            O preço precisar ser um valor numérico.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12">
                    <label for="photo">Nova foto do produto</label><br>
                    <input type="file" id="photo" name="photo" class="<?php if(!$photook) { echo ('is-invalid');} ?>" required>
                        <?php if (!$photook) : ?>
                            <div class="invalid-feedback">
                                A Foto é obrigatória.
                            </div>
                        <?php endif; ?>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12">
                    <input class="btn btn-primary" type="submit" value="Enviar">
                </div>

            </div>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>    
</body>
</html>