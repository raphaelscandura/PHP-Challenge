<?php 

$host = "mysql:host=localhost;dbname=bancodedadosdesafio;port3306";
$user = "root";
$pass = "";

try {
    $bancodedadosdesafio = new PDO($host, $user, $pass);
    $bancodedadosdesafio -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
} catch(PDOException $teste) {
    $teste -> getMessage();
    exit;
}

?>