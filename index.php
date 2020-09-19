<?php

    session_start();
    include_once('connection/connect.php');

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Sime - Sistema de Inscrição Médo Escolar</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/index-login.css">
  </head>
  <body>
      
    <header class="navbar-dark bg-dark">
      <nav class="navbar container">
        <a class="navbar-brand" href="index.php">
          <img src="imagens/logo.png" width="35" height="35" class="d-inline-block align-top" alt="" loading="lazy"><span style="font-size: 12px; opacity: 0.6; margin-left: 5%;"> | Sistema de Inscrição Médio Escolar</span>
        </a>
      </nav>
    </header>

    <main class="container formulario">
      <form method="post" action="scriptsphp/validacao_login.php">
        <div class="form-group">
          <label for="exampleInputEmail1">Email</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" requeired name="email">
          <small id="emailHelp" class="form-text text-muted">Contate o <a href="#">suporte</a> para ter acesso!</small>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Senha</label>
          <input type="password" class="form-control" id="exampleInputPassword1" requeired name="pass">
        </div>
        <div class="form-group">
          <label for="inputState">Login Modo</label>
          <select id="inputState" class="form-control" name="opcao" requeired>
            <option selected value="0">Administrator</option>
            <option value="1">Professor</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>

        <!-- ERROS DE AUTENTICAÇÃO -->
        <?php if(isset($_SESSION['error_preencha_todos_campos'])): ?>
          <div class="alert alert-danger" style="font-size: 12px; margin-top: 3%;" role="alert">
            Preencha Todos os Campos!
          </div>
        <?php endif; unset($_SESSION['error_preencha_todos_campos']); ?>

        <?php if(isset($_SESSION['error_email_invalido'])): ?>
          <div class="alert alert-danger" style="font-size: 12px; margin-top: 3%;" role="alert">
            Email Inválido! Casos Esteja Tendo Problemas Contate o <a href="#">Suporte.</a>
          </div>
        <?php endif; unset($_SESSION['error_email_invalido']); ?>

        <?php if(isset($_SESSION['error_pass_invalido'])): ?>
          <div class="alert alert-danger" style="font-size: 12px; margin-top: 3%;" role="alert">
            Senha Inválida! Casos Esteja Tendo Problemas Contate o <a href="#">Suporte.</a>
          </div>
        <?php endif; unset($_SESSION['error_pass_invalido']); ?>

        <?php if(isset($_SESSION['error_inesperado'])): ?>
          <div class="alert alert-danger" style="font-size: 12px; margin-top: 3%;" role="alert">
            Erro Inesperado! Contate o <a href="#">Suporte</a> Para Mais Informações.
          </div>
        <?php endif; unset($_SESSION['error_inesperado']); ?>
      </form>
    </main>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>