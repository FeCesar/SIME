<?php 

    session_start();
    include_once('../../scriptsphp/autenticador.php');
    include_once('../../connection/connect.php');

?>
<!doctype html>
<html lang="en">
  <head>
    <title>SIME - Sistema de Inscrição Médio Escolar</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/inscricoesoficina.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>

    <header class="navbar-dark bg-dark">
      <nav class="navbar container">
        <a class="navbar-brand" href="..index.php">
          <img src="../../imagens/logo.png" width="35" height="35" class="d-inline-block align-top" alt="" loading="lazy"><span style="font-size: 12px; opacity: 0.6; margin-left: 5%;"> | Sistema de Inscrição Médio Escolar</span>
        </a>
        <a class="navbar-brand" href="../scriptsphp/logout.php"><span style="font-size: 13px;">Logout<i class="fa fa-sign-out" aria-hidden="true" style="margin-left: 10%;"></i></span></a>
      </nav>
    </header>

    <article style="background-color: #e9ecef; width: 100%;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb container">
                <li class="breadcrumb-item "><a href='../index.php'>Home</a></li>
                <li class="breadcrumb-item"><a href='../cadastrarusuarios.php'>Menu de Cadastros de Usuários</a></li>
                <li class="breadcrumb-item active">Cadastrar Admins</li>
            </ol>
        </nav>
    </article>

    <aside>
      <?php if(isset($_SESSION['error_desconhecido'])): ?>
            <div class="alert alert-danger container-fluid" style="font-size: 12px; display: inline-block;" role="alert">
              <p class='container' style='padding: 0; margin-bottom:0;'>Erro Inesperado! Contate o <a href="#">Suporte</a> Para Mais Informações.</p>
            </div>
      <?php endif; unset($_SESSION['error_desconhecido']); ?>
      <?php if(isset($_SESSION['success_insercao'])): ?>
          <div class="alert alert-success container-fluid" style="font-size: 12px; display: inline-block;" role="alert">
            <p class='container' style='padding: 0; margin-bottom:0;'>Cadastro de Administrador Concluído!</p>
          </div>
        <?php endif; unset($_SESSION['success_insercao']); ?>
    </aside>

    <main class="container">
      <form method="post" action="scriptsphp/cadastroadmin.php">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Email</label>
            <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name='email' required>
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4">Password</label>
            <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name='senha' required>
          </div>
        </div>
        <div class="form-group">
          <label for="inputAddress">Nome</label>
          <input type="text" class="form-control" id="inputAddress" placeholder="Ex.: João Guilherme" name='nome' required>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
      </form>
    </main>

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