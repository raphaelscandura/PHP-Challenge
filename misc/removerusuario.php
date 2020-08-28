<?php
    
    require('bancodedadosdesafio.php');

    $id = $_POST['id'];
    $query = $bancodedadosdesafio -> prepare("DELETE FROM usuarios WHERE id = :id;");
    $query->execute([':id' => $id]);

    header('Location: ../createUsuario.php');

?>