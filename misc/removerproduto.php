<?php
    
    require('bancodedadosdesafio.php');

    $id = $_POST['id'];

    $query = $bancodedadosdesafio -> prepare("DELETE FROM produtos WHERE id = :id;");
    $query->execute([':id' => $id]);

    header('Location: ../indexProdutos.php');

?>