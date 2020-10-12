<?php

    session_start();
    include_once('../connection/connect.php');
    $id_oficina = $_GET['id_oficina'];

    $sql_oficina = "SELECT * FROM oficinas WHERE id_oficina = $id_oficina";
    $query_sql_oficina = mysqli_query($conn, $sql_oficina);
    $dados_oficina = mysqli_fetch_array($query_sql_oficina);

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Oficinas</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/oficinas.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>

    <header class="navbar-dark bg-dark">
      <nav class="navbar container">
        <a class="navbar-brand">
          <img src="../imagens/logo.png" width="35" height="35" class="d-inline-block align-top" alt="" loading="lazy"><span style="font-size: 12px; opacity: 0.6; margin-left: 5%; color: white;"> | Sistema de Inscrição Médio Escolar</span>
        </a>
      </nav>
    </header>

    <main class="container">
      <?php
        if($dados_oficina[11] == 0){
          echo "<div class='alert alert-warning container-fluid' style='font-size: 12px; display: inline-block;' role='alert'>
                  <p class='container' style='padding: 0; margin-bottom:0;'>Oficina Desativada</p>
                </div>";
          exit();
        }
      ?>
        <header style="margin-top: 3%;">
            <h3><?php echo $dados_oficina[1]; ?></h3>
            <h6><?php echo $dados_oficina[2]; ?></h6>
        </header>

        <?php

            try{

              $pdo = new PDO('mysql:host=localhost;dbname=sime', 'root', '');
              $stmt = $pdo->query("SELECT nome_professor FROM professores WHERE id_professor = $dados_oficina[14]");

              while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $nome_professor_by_id = $row['nome_professor'];
              }

            } catch(PDOException $e){
              echo "Error: ".$e->getMessage();
            }

        ?>

            <aside class='container'>
                <div style="padding: 1%;"><h7><i class="fa fa-user" aria-hidden="true" style="margin-right: 1%;"></i>Professor: <?php echo $nome_professor_by_id; ?></h7></div>
                <div style="padding: 1%;"><h7><i class="fa fa-globe" aria-hidden="true" style="margin-right: 1%;"></i>Disciplina: <?php echo $dados_oficina[3]; ?></h7></div>
                <div style="padding: 1%;"><h7><i class="fa fa-thumb-tack" aria-hidden="true" style="margin-right: 1%;"></i>Sala: <?php echo $dados_oficina[4]; ?></h7></div>
                <div style="padding: 1%;"><h7><i class="fa fa-users" aria-hidden="true" style="margin-right: 1%;"></i>Vagas: <?php echo $dados_oficina[5]; ?></h7></div>
                <div style="padding: 1%;"><h7><i class="fa fa-user-times" aria-hidden="true" style="margin-right: 1%;"></i>Requisitos de Série: <?php if($dados_oficina[6] == 1){echo "1º Série";}elseif($dados_oficina[6] == 2){echo "2º Série";}elseif($dados_oficina[7] == 3){echo "3º Série";}else{echo "Aberto";}?></h7></div>
                <div style="padding: 1%;"><h7><i class="fa fa-calendar-check-o" aria-hidden="true" style="margin-right: 1%;"></i>Data: <?php echo date_format(new DateTime($dados_oficina[7]), "d/m/Y");; ?></h7></div>
                <div style="padding: 1%;"><h7><i class="fa fa-clock-o" aria-hidden="true" style="margin-right: 1%;"></i>Horário: <?php echo $dados_oficina[8]; ?></h7></div>
            </aside>
    </main>

    <aside class="container-fluid">
      <div class="container">
        <?php if(isset($_SESSION['error_empty'])): ?>
          <div class="alert alert-warning container-fluid" style="font-size: 12px; display: inline-block;" role="alert">
            <p class='container' style='padding: 0; margin-bottom:0;'>Preencha o Registro de Mátricula!</p>
          </div>
        <?php endif; unset($_SESSION['error_empty']); ?>

        <?php if(isset($_SESSION['error_number_of_rm'])): ?>
          <div class="alert alert-danger container-fluid" style="font-size: 12px; display: inline-block;" role="alert">
            <p class='container' style='padding: 0; margin-bottom:0'>Quantidade de Números Inválidos!</p>
          </div>
        <?php endif; unset($_SESSION['error_number_of_rm']); ?>

        <?php if(isset($_SESSION['error_aluno_inexistente'])): ?>
          <div class="alert alert-danger container-fluid" style="font-size: 12px; display: inline-block;" role="alert">
            <p class='container' style='padding: 0; margin-bottom:0'>Registro de Mátricula Inválido! Você é Aluno Mesmo?</p>
          </div>
        <?php endif; unset($_SESSION['error_aluno_inexistente']); ?>

        <?php if(isset($_SESSION['error_requisitos_serie'])): ?>
          <div class="alert alert-danger container-fluid" style="font-size: 12px; display: inline-block;" role="alert">
            <p class='container' style='padding: 0; margin-bottom:0'>Infelizmente Você Não tem os Requisitos de Série Para Participar Dessa Oficina!</p>
          </div>
        <?php endif; unset($_SESSION['error_requisitos_serie']); ?>

        <?php if(isset($_SESSION['error_horario_data'])): ?>
          <div class="alert alert-danger container-fluid" style="font-size: 12px; display: inline-block;" role="alert">
            <p class='container' style='padding: 0; margin-bottom:0'>Você já Tem Outra Oficina Esse Dia e Horário! Infelizmente Você não Pode se Inscrever Nessa Oficina.</p>
            <p class='container' style='padding: 0; margin-bottom:0'>Para se Desinscrever Dessa Oficina, Contate a Secretária!</p>
          </div>
        <?php endif; unset($_SESSION['error_horario_data']); ?>

        <?php if(isset($_SESSION['sucess_cadastro'])): ?>
          <div class="alert alert-success container-fluid" style="font-size: 12px; display: inline-block;" role="alert">
            <p class='container' style='padding: 0; margin-bottom:0'>Sucesso! Você se Cadastrou na Oficina do Professor <?php echo $dados_oficina[3]; ?>.</p>
          </div>
        <?php endif; unset($_SESSION['sucess_cadastro']); ?>

        <?php if(isset($_SESSION['error_senha_invalida'])): ?>
          <div class="alert alert-danger container-fluid" style="font-size: 12px; display: inline-block;" role="alert">
            <p class='container' style='padding: 0; margin-bottom:0'>Erro! A Senha Inserida é Inválida!</p>
          </div>
        <?php endif; unset($_SESSION['error_senha_invalida']); ?>

        <?php if(isset($_SESSION['sem_vagas'])): ?>
          <div class="alert alert-danger container-fluid" style="font-size: 12px; display: inline-block;" role="alert">
            <p class='container' style='padding: 0; margin-bottom:0'>Oficina está sem vagas! Talvez da Próxima.</p>
          </div>
        <?php endif; unset($_SESSION['sem_vagas']); ?>
      </div>
    </aside>

    <aside class="container-fluid cadastro">
      <form action="scriptsphp/cadastroUsuarioOficina.php" method="post" class='container'>
        <label for="">Registro de Mátricula(RM): </label>
        <input type="text" maxlength="5" name="rm" required placeholder="Ex.: 12234">
        <label for="">Senha do Aluno: </label>
        <input type="password" maxlength="4" name="senha" required>
        <input type="text" name="id_oficina_atual" value="<?php echo $id_oficina ?>" style='display: none;'>
        <input type="submit" value="Casdastrar-se">
      </form>
    </aside>

    <footer class="page-footer font-small blue footer">
        <div class="text-center py-3 container">
            <ul>
                <a href="#"><li>Reportar Problema </li></a>
                <li> | </li>
                <a href="#"><li>Contatar Suporte </li></a>
            </ul>
        </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>