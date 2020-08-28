<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cadastro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
  
<?php 

    $id = $_GET['id'];

    require_once('misc/navbar.php'); 
    require('misc/bancodedadosdesafio.php');
    require('misc/validacoesServidor.php'); 

    $query = $bancodedadosdesafio->prepare("SELECT id, nome, email, senha FROM usuarios WHERE id = :id;");
    $query->execute([':id' => $id]);
    $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
    
    $nomeconfirmado = true;
    $emailconfirmado = true;
    $senhaconfirmada = true;
    $confirmacaosenhaconfirmada = true;

    if ($_POST) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $confirmacaosenha = $_POST['confirmacaosenha'];

        $nomeconfirmado = verificarnome($_POST['nome']);
        $emailconfirmado = verificaremail($_POST['email']);
        $senhaconfirmada = verificarsenha($_POST['senha']);

        if ($senha != $confirmacaosenha) {
            $confirmacaosenhaconfirmada = false;
        }

        if ($nomeconfirmado && $emailconfirmado && $senhaconfirmada && $confirmacaosenhaconfirmada) {
            $query = $bancodedadosdesafio->prepare("UPDATE usuarios SET nome = :nome, email = :email, senha = :senha WHERE id = :id;");
            $funcionou = $query->execute([':id' => $id, ':nome' => $nome, ':email' => $email, ':senha' => password_hash($_POST['senha'], PASSWORD_DEFAULT)]);
            
            if ($funcionou) {
                header('Location: createUsuario.php');
            } else {
                print_r($query->errorInfo());
                die();
            }
        }

    }

?>

    <style>
      .container{
          margin-top: 10px;
          border: solid 1px black;
      }
    </style>

<div class="container">
        <h1>Atualização de Cadastro de Usuário</h1>
            <form method="POST">
            <div class="row">
                <div class="col-lg-12">
                    <label for="nome">Nome</label>
                        <br>
                        <input name="nome" class="form-control <?php if(!$nomeconfirmado) { echo ('is-invalid');} ?>" type="text" placeholder="Insira seu nome completo">
                            <?php if (!$nomeconfirmado) : ?>
                                <div class="invalid-feedback">O nome precisa ter no mínimo cinco caracteres.</div>
                            <?php endif; ?>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12">
                    <label for="email">E-mail</label>
                        <br>
                        <input name="email" type="email" class="form-control <?php if(!$emailconfirmado) { echo ('is-invalid');} ?>" placeholder="Insira seu e-mail">
                            <?php if (!$emailconfirmado) : ?>
                                <div class="invalid-feedback">O e-mail não pode estar vazio.</div>
                            <?php endif; ?>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12">
                    <label for="senha">Senha</label>
                        <br>
                        <input name="senha" type="password" class="form-control <?php if(!$senhaconfirmada) { echo ('is-invalid');} ?>" placeholder="Insira a senha">
                            <?php if (!$senhaconfirmada) : ?>
                                <div class="invalid-feedback">A senha precisa ter no mínimo seis caracteres.</div>
                            <?php endif; ?>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12">
                    <label for="confirmarSenha">Confirmar Senha</label>
                        <br>
                        <input name="confirmacaosenha" type="password" class="form-control <?php if(!$confirmacaosenhaconfirmada) { echo ('is-invalid');} ?>" placeholder="Insira a senha novamente">
                            <?php if (!$confirmacaosenhaconfirmada) : ?><div class="invalid-feedback">As senhas precisam ser iguais.</div>
                            <?php endif; ?>
                </div>
            </div>
            <br>
            <input class="btn btn-primary" type="submit" value="Enviar">
        </form>
</div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>    
</body>
</html>