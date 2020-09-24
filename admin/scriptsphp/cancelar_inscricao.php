<?php

    session_start();
    include_once('../../connection/connect.php');
    include_once('../../scriptsphp/autenticador.php');

    $rm_aluno = $_POST['id'];
    $id_oficina = $_POST['oficina'];
    
    $sql_delete_inscricao = "DELETE FROM inscricoes WHERE rm_aluno = $rm_aluno AND id_oficina = $id_oficina";
    $query_delete_inscricao = mysqli_query($conn, $sql_delete_inscricao);

    if($query_delete_inscricao){
        $sql_abre_vaga = "SELECT vagas_restantes_oficina FROM oficinas WHERE id_oficina = $id_oficina";
        $query_abre_vaga = mysqli_query($conn, $sql_abre_vaga);
        $dados_oficina = mysqli_fetch_array($query_abre_vaga);

        $vaga_nova = $dados_oficina[0] - 1;

        $sql_atualiza_vagas = "UPDATE oficinas SET vagas_restantes_oficina = $vaga_nova";
        $query_atualiza_vagas = mysqli_query($conn, $sql_atualiza_vagas);

        if($query_atualiza_vagas){
            $_SESSION['success_operacao'] = true;
            header("Location: ../inscricoesoficina.php?id_oficina=$id_oficina");
        } else{
            $_SESSION['error_inesperado'] = true;
            header("Location: ../inscricoesoficina.php?id_oficina=$id_oficina");
        }

    } else{
        $_SESSION['error_inesperado'] = true;
        header("Location: ../inscricoesoficina.php?id_oficina=$id_oficina");
    }

?>