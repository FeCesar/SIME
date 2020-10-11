<?php

    session_start();
    include_once('../../scriptsphp/autenticador.php');
    include_once('../../connection/connect.php');
    date_default_timezone_set('America/Sao_Paulo');

    $informacoes_oficina = array($_POST['nome_oficina'], $_POST['descricao_oficina'], 
    $_POST['professor_oficina'], $_POST['disciplina_oficina'], $_POST['sala_oficina'],
    $_POST['limite_vagas_oficina'], $_POST['requisitos_oficina'], $_POST['dia_oficina'],
    $_POST['hora_oficina']);

    $data = date('Y-m-d H:i:s');
    $dados = $_SESSION['dados'];

    // QR CODE

    $url_atual = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $api_qrcode = 'https://chart.googleapis.com/chart?';
        $api_qrcode .= '&cht=qr';
        $api_qrcode .= '&chl=' . $url_atual;
        $api_qrcode .= '&chs=120x120';

    $sql_insere_oficina = "INSERT INTO oficinas(nome_oficina, descricao_oficina, professor_oficina, 
    disciplina_oficina, sala_oficina, limite_vagas_oficina, requisitos_oficina, dia_oficina, hora_oficina,
    hora_criacao_oficina, user_criador_oficina, status_oficina, vagas_restantes_oficina, qr_code) VALUES
    ('$informacoes_oficina[0]', '$informacoes_oficina[1]','$informacoes_oficina[2]','$informacoes_oficina[3]','$informacoes_oficina[4]',
    '$informacoes_oficina[5]','$informacoes_oficina[6]','$informacoes_oficina[7]','$informacoes_oficina[8]', '$data', '$dados[1]', true, 0, '$api_qrcode')";
    $query_sql_insere_oficina = mysqli_query($conn, $sql_insere_oficina);

        if($query_sql_insere_oficina){
            $_SESSION['sucesso_insercao_oficina'] = true;
            
            $sql_dados_oficina = "SELECT id_oficina FROM oficinas WHERE nome_oficina = '$informacoes_oficina[0]'";
            $query_dados_oficina = mysqli_query($conn, $sql_dados_oficina);
            $dados_oficina = mysqli_fetch_array($query_dados_oficina);

            $_SESSION['id_da_oficina'] = $dados_oficina[0];
            header('location: ../criaroficina.php');
        } else{
            $_SESSION['error_insercao_oficina'] = true;
            header('location: ../criaroficina.php');
        }

?>