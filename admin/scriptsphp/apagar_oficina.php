<?php

    session_start();
    include_once('../../connection/connect.php');
    include_once('../../scriptsphp/autenticador.php');

    $id_oficina = $_POST['id'];

    $slq_del_oficina = "DELETE FROM oficinas WHERE id_oficina = $id_oficina";
    $query_del_oficina = mysqli_query($conn, $slq_del_oficina);

    if($query_del_oficina){
        $_SESSION['sucesso_deletado'] = true;
        header('Location: ../gerenciaroficina.php');
        $sql_del_inscricoes = "DELETE FROM inscricoes WHERE id_oficina = $id_oficina";
        $query_del_inscricoes = mysqli_query($conn, $sql_del_inscricoes);
    } else{
        $_SESSION['error_deletado'] = true;
        header('Location: ../gerenciaroficina.php');
    }

?>