<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
    <?php 
    
    session_start();

    require('./misc/bancodedadosdesafio.php');

    $emaildeLoginCorreto = true;
    $senhadeLoginCorreta = true;

    if ($_POST) {
        $query = $bancodedadosdesafio -> prepare("SELECT email, senha FROM usuarios;");
        $query->execute();
        $acessos = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($acessos as $acesso) {
            if ($_POST['email'] == $acesso['email'] && password_verify($_POST['senha'], $acesso['senha'])) {
                $_SESSION['loggedin'] = true;
                return header('location: createUsuario.php');
            }
        }

        $erroLogin = 'E-mail e/ou senha não registrados';
    }

    ?>
    <style>
        .container{
            text-align: center;
            border: 2px solid black;
            padding: 20px;
            margin-top: 200px;
        }
    </style>

    <div class="container">
        <?php if (isset($erroLogin)) : ?>
            <div class="alert alert-danger"><?= $erroLogin ?></div>
        <?php endif; ?>
        <form method="POST">
            <h2>Login</h2>
            <br>
            <div class="row">
                <div class="col-lg-12">
                    <input type="email" name="email" id="email" placeholder="E-mail" required <?php if (isset($_COOKIE['emailUsuario'])) { echo "value='$_COOKIE[emailUsuario]'"; } ?>>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12">
                    <input type="password" name="senha" id="senha" placeholder="Senha" <?php if (isset($_COOKIE['senhaUsuario'])) { echo "value='$_COOKIE[senhaUsuario]'"; } ?>>
                </div>
            </div>
            <br>
            <input class="btn btn-primary" type="submit" value="Enviar">
            <br>
            <hr>
            <p>Não está cadastrado ainda? <a href="createUsuario.php">Clique Aqui</a></p>
        </form>

    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>