<?php 

    define("HOST", "localhost");
    define("USER", "root");
    define("PASS", ""); 
    define("DATABASE", "sime");

    $conn = new mysqli(HOST, USER, PASS, DATABASE) or die ("Erro ao Conectar na Base de Dados!");
    mysqli_set_charset($conn, 'utf8');

?>