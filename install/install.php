<?php 

    include_once('../connection/connect.php');

    $sql_criar_tabela_user_admin = "CREATE TABLE user_admin(
        user_admin_id int PRIMARY KEY AUTO_INCREMENT,
        user_admin_nome varchar(255),
        user_admin_email varchar(255),
        user_admin_pass varchar(255)
    )";

    $sql_criar_tabela_professor = "CREATE TABLE professores(
        id_professor int AUTO_INCREMENT PRIMARY KEY,
        nome_professor varchar(255),
        materia_professor varchar(255),
        email_professor varchar(255),
        senha_professor varchar(255)
    )";

    $sql_criar_tabela_oficinas = "CREATE TABLE oficinas(
        id_oficina int PRIMARY KEY AUTO_INCREMENT,
        nome_oficina varchar(255),
        descricao_oficina varchar(255),
        disciplina_oficina varchar(255),
        sala_oficina varchar(255),
        limite_vagas_oficina int,
        requisitos_oficina varchar(255),
        dia_oficina date,
        hora_oficina time,
        hora_criacao_oficina time,
        user_criador_oficina varchar(255),
        status_oficina boolean,
        vagas_restantes_oficina int,
        qr_code varchar(255),
        id_professor int,
            constraint fk_prof_oficina foreign key (id_professor) references professores (id_professor)
    )";

    $sql_criar_tabela_alunos = "CREATE TABLE alunos(
        rm_aluno char(5) primary key,
        nome_aluno varchar(255),
        idade_aluno int(2),
        serie_aluno int(1),
        senha_aluno char(4),
        email_aluno varchar(255),
        sala_aluno varchar(255)
    )";

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

    $sql_criar_tabela_inscricoes = "CREATE TABLE inscricoes(
        id_inscricao int PRIMARY KEY AUTO_INCREMENT,
        rm_aluno char(5),
            CONSTRAINT fk_aluno_inscricoes FOREIGN KEY (rm_aluno) REFERENCES alunos(rm_aluno),
        id_oficina int,
            CONSTRAINT fk_oficina_inscricoes FOREIGN KEY (id_oficina) REFERENCES oficinas(id_oficina)
    )";

    $sql_insere_dados_tabela_admin = "INSERT into user_admin(user_admin_nome, user_admin_email, user_admin_pass) VALUES
    ('Admin', 'admin@admin.com', 'admin')";
    $senha_aluno = gerar_senha(4, true, true, true, true);
    $sql_insere_dados_tabela_aluno = "INSERT INTO alunos VALUES('11111', 'Felipe Cesar', 17, '3', '$senha_aluno', '3ºB', 'ff.cc.ss.rr@hotmail.com')";
    $query_criar_tabela_user_admin = mysqli_query($conn, $sql_criar_tabela_user_admin);

    if($query_criar_tabela_user_admin){
        echo("SUCESSO na user_admin!");
        $query_insere_dados_tabela_admin = mysqli_query($conn, $sql_insere_dados_tabela_admin);
        $query_criar_tabela_professor = mysqli_query($conn, $sql_criar_tabela_professor);
        $query_criar_tabela_oficinas = mysqli_query($conn, $sql_criar_tabela_oficinas);
        $query_criar_tabela_alunos = mysqli_query($conn, $sql_criar_tabela_alunos);
        $query_insere_dados_tabela_aluno = mysqli_query($conn, $sql_insere_dados_tabela_aluno);
        $query_criar_tabela_inscricoes = mysqli_query($conn, $sql_criar_tabela_inscricoes);
            if($query_criar_tabela_oficinas){
                echo("SUCESSO na oficinas!");
            } if($query_criar_tabela_alunos){
                echo("SUCESSO tabela Alunos!");
                header('location: ../index.php');
            }
    }


?>