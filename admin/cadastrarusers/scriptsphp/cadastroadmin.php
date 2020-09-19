<?php

    session_start();
    include_once('../../../scriptsphp/autenticador.php');
    include_once('../../../connection/connect.php');

    $nome_usuario = $_POST['nome'];
    $senha_usuario = $_POST['senha'];
    $email_usuario = $_POST['email'];

        if(empty($nome_usuario) || empty($senha_usuario) || empty($email_usuario)){
            $_SESSION['error_preencha_campo'] = true;
            header('location: ../cadastraradmin.php');
        } else{
            $sql_insere_admin = "INSERT INTO user_admin(user_admin_nome, user_admin_email, user_admin_pass) VALUES('$nome_usuario', '$email_usuario', '$senha_usuario')";
            $query_insere_admin = mysqli_query($conn, $sql_insere_admin);
                
            if($query_insere_admin){
                $_SESSION['success_insercao'] = true;
                header('location: ../cadastraradmin.php');
            } else{
                $_SESSION['error_desconhecido'] = true;
                header('location: ../cadastraradmin.php');
            }
        }

?>