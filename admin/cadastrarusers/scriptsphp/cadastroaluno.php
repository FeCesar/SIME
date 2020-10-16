<?php

    session_start();
    include_once('../../../scriptsphp/autenticador.php');
    include_once('../../../connection/connect.php');

    $nome_aluno = $_POST['nome'];
    $rm_aluno= $_POST['rm'];
    $sala_usuario = $_POST['sala'];
    $serie_aluno = $_POST['serie'];
    $idade_aluno = $_POST['idade'];
    $email_aluno = $_POST['email'];

        if(empty($nome_aluno) || empty($email_aluno) || empty($rm_aluno) || empty($sala_usuario) || empty($serie_aluno) || empty($idade_aluno)){
            $_SESSION['error_preencha_campo'] = true;
            header('location: ../cadastraraluno.php');
        } elseif(strlen($rm_aluno) < 5){
            $_SESSION['error_numero_rm_invalido'] = true;
            header('loaction: ../cadastraraluno.php');
        } else{

            function gerar_senha($tamanho, $maiusculas, $minusculas, $numeros, $simbolos){
                $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
                $mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
                $nu = "0123456789"; // $nu contem os números
                $si = "!@#$%¨&*()_+="; // $si contem os símbolos
              
                if ($maiusculas){
                      // se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $senha
                      $senha .= str_shuffle($ma);
                }
              
                  if ($minusculas){
                      // se $minusculas for "true", a variável $mi é embaralhada e adicionada para a variável $senha
                      $senha .= str_shuffle($mi);
                  }
              
                  if ($numeros){
                      // se $numeros for "true", a variável $nu é embaralhada e adicionada para a variável $senha
                      $senha .= str_shuffle($nu);
                  }
              
                  if ($simbolos){
                      // se $simbolos for "true", a variável $si é embaralhada e adicionada para a variável $senha
                      $senha .= str_shuffle($si);
                  }
              
                  // retorna a senha embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
                  return substr(str_shuffle($senha),0,$tamanho);
              }

            $senha_aluno = gerar_senha(4, true, true, true, true);
            $sql_insere_aluno = "INSERT INTO alunos(rm_aluno, nome_aluno, idade_aluno, serie_aluno, senha_aluno, sala_aluno, email_aluno) VALUES('$rm_aluno', '$nome_aluno', '$idade_aluno', '$serie_aluno', '$senha_aluno', '$sala_usuario', '$email_aluno')";
            $query_insere_aluno = mysqli_query($conn, $sql_insere_aluno);
                
            if($query_insere_aluno){
                $_SESSION['success_insercao'] = true;
                header('location: ../cadastraraluno.php');
            } else{
                $_SESSION['error_desconhecido'] = true;
                header('location: ../cadastraraluno.php');
            }
        }

?>