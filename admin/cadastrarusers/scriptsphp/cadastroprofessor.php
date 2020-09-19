<?php

    session_start();
    include_once('../../../scriptsphp/autenticador.php');
    include_once('../../../connection/connect.php');

    $email_professor = $_POST['email'];
    $senha_professor = $_POST['senha'];
    $nome_professor = $_POST['nome'];
    $materia_professor = $_POST['materia'];


        if(empty($nome_professor) || empty($senha_professor) || empty($email_professor) || empty($materia_professor)){
            $_SESSION['error_preencha_campo'] = true;
            header('location: ../cadastrarprofessor.php');
        } 
        else{
            $sql_insere_professor = "INSERT INTO professores(email_professor, senha_professor, nome_professor, materia_professor) VALUES('$email_professor', '$senha_professor', '$nome_professor', '$materia_professor')";
            $query_insere_professor = mysqli_query($conn, $sql_insere_professor);
                
            if($query_insere_professor){
                $_SESSION['success_insercao'] = true;
                header('location: ../cadastrarprofessor.php');
            } else{
                $_SESSION['error_desconhecido'] = true;
                header('location: ../cadastrarprofessor.php');
            }
        }

?>