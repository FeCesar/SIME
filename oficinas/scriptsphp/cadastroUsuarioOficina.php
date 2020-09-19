<?php

    session_start();
    include_once('../../connection/connect.php');

    $rm_aluno = $_POST['rm'];
    $id_oficina = $_POST['id_oficina_atual'];
    $senha_aluno = $_POST['senha'];

    if(empty($rm_aluno)){
        $_SESSION['error_empty'] = true;
        header("location: ../oficinas.php?id_oficina=$id_oficina");
    }
    if(empty($senha_aluno)){
        $_SESSION['error_empty'] = true;
        header("location: ../oficinas.php?id_oficina=$id_oficina");
    }

    if(strlen($rm_aluno) < 5){
        $_SESSION['error_number_of_rm'] = true;
        header("location: ../oficinas.php?id_oficina=$id_oficina");
    }
    if(strlen($senha_aluno) < 4){
        $_SESSION['error_number_of_rm'] = true;
        header("location: ../oficinas.php?id_oficina=$id_oficina");
    }

    $sql_rm_alunos = "SELECT * FROM alunos WHERE rm_aluno = $rm_aluno";
    $query_rm_alunos = mysqli_query($conn, $sql_rm_alunos);
    $dados_aluno_senha = mysqli_fetch_array($query_rm_alunos);
    $num_linhas_query_rm_alunos = mysqli_num_rows($query_rm_alunos);

    if($num_linhas_query_rm_alunos < 1){
        $_SESSION['error_aluno_inexistente'] = true;
        header("location: ../oficinas.php?id_oficina=$id_oficina");
    }

    if($senha_aluno == $dados_aluno_senha[4]){
        $sql_inscricoes = "SELECT * FROM inscricoes WHERE rm_aluno = '$rm_aluno'";
        $query_inscricoes = mysqli_query($conn, $sql_inscricoes);
        $num_linhas_query_inscricoes = mysqli_num_rows($query_inscricoes);
        $dados_inscricoes = mysqli_fetch_array($query_inscricoes);
    
        if($num_linhas_query_inscricoes = 1){
            $sql_oficina_inscrita = "SELECT hora_oficina, dia_oficina, requisitos_oficina FROM oficinas WHERE id_oficina = $dados_inscricoes[2]";
            $query_oficina_inscrita = mysqli_query($conn, $sql_oficina_inscrita);
            $dados_oficina_inscrita = mysqli_fetch_array($query_oficina_inscrita);
    
                $sql_oficinas = "SELECT hora_oficina, dia_oficina, requisitos_oficina FROM oficinas WHERE id_oficina = $id_oficina";
                $query_oficinas = mysqli_query($conn, $sql_oficinas);
                $dados_oficina_inscricao = mysqli_fetch_array($query_oficinas);
    
                $sql_dados_aluno = "SELECT serie_aluno, senha_aluno FROM alunos WHERE rm_aluno = $rm_aluno";
                $query_dados_aluno = mysqli_query($conn, $sql_dados_aluno);
                $dados_aluno = mysqli_fetch_array($query_dados_aluno);
        }
    
                if($dados_oficina_inscrita[0] == $dados_oficina_inscricao[0] && $dados_oficina_inscrita[1] == $dados_oficina_inscricao[1]){
                    $_SESSION['error_horario_data'] = true;
                    header("location: ../oficinas.php?id_oficina=$id_oficina");
                } elseif($dados_aluno[0] < $dados_oficina_inscricao[2]){
                    $_SESSION['error_requisitos_serie'] = true;
                    header("location: ../oficinas.php?id_oficina=$id_oficina");
                } else{
                    $sql_fazer_inscricao = "INSERT INTO inscricoes(rm_aluno, id_oficina) VALUES('$rm_aluno', $id_oficina)";
                    $query_fazer_inscricao = mysqli_query($conn, $sql_fazer_inscricao);
                    $_SESSION['sucess_cadastro'] = true;
                    header("location: ../oficinas.php?id_oficina=$id_oficina");
                }
    
        if($num_linhas_query_inscricoes > 1){
            $dados_inscricoes = mysqli_fetch_array($query_inscricoes);
            var_dump($dados_inscricoes);
            // $sql_oficina_inscrita = "SELECT horario_oficina FROM oficinas WHERE id_oficina = $dados_inscricoes[2]";
            // $query_oficina_inscrita = mysqli_query($conn, $sql_oficina_inscrita);
        }
    }else{
        $_SESSION['error_senha_invalida'] = true;
        header("location: ../oficinas.php?id_oficina=$id_oficina");
    }

   


?>