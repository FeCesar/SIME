<?php

    session_start();
    include_once('../../connection/connect.php');
    include_once('../../scriptsphp/autenticador.php');

    $rm_alunos = $_POST['presencas'];
    
    foreach ($rm_alunos as $value){
        
        try{
            $pdo = new PDO("mysql:host=localhost;dbname=sime", 'root', '');
            $stmt = $pdo->query("SELECT email_aluno FROM alunos WHERE rm_aluno = $value");

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                
                echo "Envia Certificado para O email: " . $row['email_aluno'];

            }


        } catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }

    }

?>