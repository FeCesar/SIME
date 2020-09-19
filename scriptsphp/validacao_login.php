<?php 

    // CONEXÕES COM O BANCO
    session_start();
    include_once('../connection/connect.php');

    // RECEBE OS DADOS VIA POST
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $opcao = $_POST['opcao'];

    // SE VIER VAZIO VOLTA PARA A PÁGINA INICIAL E MOSTRA ERRO
    if(empty($email) || empty($pass) || empty($opcao)){
        $_SESSION['error_preencha_todos_campos'] = true;
        header("location: ../index.php");
    }    
    if($opcao == 0){
        $sql_email = "SELECT user_admin_email FROM user_admin WHERE user_admin_email = '$email'";
        $query_email = mysqli_query($conn, $sql_email);
        $linhas_retornadas_query_email = mysqli_num_rows($query_email);
    
        $sql_pass = "SELECT user_admin_pass FROM user_admin WHERE user_admin_pass = '$pass'";
        $query_pass = mysqli_query($conn, $sql_pass);
        $linhas_retornadas_query_pass = mysqli_num_rows($query_pass);
    
            if($linhas_retornadas_query_email < 1){
                $_SESSION['error_email_invalido'] = true;
                header("location: ../index.php");
            }
            elseif($linhas_retornadas_query_pass < 1){
                $_SESSION['error_pass_invalido'] = true;
                header("location: ../index.php");
            }
            elseif(($linhas_retornadas_query_email > 0) and ($linhas_retornadas_query_pass > 0)){
                $sql_todos_dados_usuario = "SELECT * FROM user_admin WHERE user_admin_email = '$email' and user_admin_pass = '$pass'";
                $query_todos_dados_usuario = mysqli_query($conn, $sql_todos_dados_usuario);
                $_SESSION['dados'] =  mysqli_fetch_array($query_todos_dados_usuario);
                var_dump($_SESSION['dados']);
                header("location: ../admin/index.php");
            }
            else{
                $_SESSION['error_inesperado'] = true;
                header("location: ../index.php");
            }
    } elseif($opcao == 1){
        $sql_email = "SELECT email_professor FROM professores WHERE email_professor = '$email'";
        $query_email = mysqli_query($conn, $sql_email);
        $linhas_retornadas_query_email = mysqli_num_rows($query_email);
    
        $sql_pass = "SELECT senha_professor FROM professores WHERE senha_professor = '$pass'";
        $query_pass = mysqli_query($conn, $sql_pass);
        $linhas_retornadas_query_pass = mysqli_num_rows($query_pass);
    
            if($linhas_retornadas_query_email < 1){
                $_SESSION['error_email_invalido'] = true;
                header("location: ../index.php");
            }
            elseif($linhas_retornadas_query_pass < 1){
                $_SESSION['error_pass_invalido'] = true;
                header("location: ../index.php");
            }
            elseif(($linhas_retornadas_query_email > 0) and ($linhas_retornadas_query_pass > 0)){
                $sql_todos_dados_usuario = "SELECT * FROM professores WHERE email_professor = '$email' and senha_professor = '$pass'";
                $query_todos_dados_usuario = mysqli_query($conn, $sql_todos_dados_usuario);
                $_SESSION['dados'] =  mysqli_fetch_array($query_todos_dados_usuario);
                var_dump($_SESSION['dados']);
                header("location: ../chamada/index.php");
            }
            else{
                $_SESSION['error_inesperado'] = true;
                header("location: ../index.php");
            }
    } else{
        $_SESSION['error_inesperado'] = true;
         header("location: ../index.php");
    }
    


?>