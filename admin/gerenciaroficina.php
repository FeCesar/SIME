<?php 

    session_start();
    include_once('../scriptsphp/autenticador.php');
    include_once('../connection/connect.php');

?>
<!doctype html>
<html lang="en">
  <head>
    <title>SIME - Gerenciar Oficinas</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/gerencia-oficinas.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>

    <header class="navbar-dark bg-dark">
      <nav class="navbar container">
        <a class="navbar-brand" href="index.php">
          <img src="../imagens/logo.png" width="35" height="35" class="d-inline-block align-top" alt="" loading="lazy"><span style="font-size: 12px; opacity: 0.6; margin-left: 5%;"> | Sistema de Inscrição Médio Escolar</span>
        </a>
        <a class="navbar-brand" href="scriptsphp/logout.php"><span style="font-size: 13px;">Logout<i class="fa fa-sign-out" aria-hidden="true" style="margin-left: 10%;"></i></span></a>
      </nav>
    </header>

    <article style="background-color: #e9ecef; width: 100%;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb container">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Gerenciar Oficina</li>
            </ol>
        </nav>
    </article>

    <article>
        <?php if(isset($_SESSION['sucesso_deletado'])): ?>
          <div class="alert alert-success container-fluid" style="font-size: 12px; display: inline-block;" role="alert">
            <p class='container' style='padding: 0; margin-bottom:0;'>Oficina Apagada com Sucesso! Todas as Inscrições Foram Canceladas.</p>
          </div>
        <?php endif; unset($_SESSION['sucesso_deletado']); ?>
        <?php if(isset($_SESSION['sucesso_operacao'])): ?>
          <div class="alert alert-success container-fluid" style="font-size: 12px; display: inline-block;" role="alert">
            <p class='container' style='padding: 0; margin-bottom:0;'>Oficina Desativada com Sucesso! Todas as Inscrições Foram Canceladas.</p>
          </div>
        <?php endif; unset($_SESSION['sucesso_operacao']); ?>
        <?php if(isset($_SESSION['error_deletado'])): ?>
          <div class="alert alert-danger container-fluid" style="font-size: 12px; display: inline-block;" role="alert">
            <p class='container' style='padding: 0; margin-bottom:0;'>Erro Inesperado! Contate o <a href="#">Suporte</a> Para Mais Informações.</p>
          </div>
        <?php endif; unset($_SESSION['error_deletado']); ?>
    </article>

    <main class="container">
            <?php 

                $sql_dados_oficinas = "SELECT * FROM oficinas";
                $query_sql_dados_oficinas = mysqli_query($conn, $sql_dados_oficinas);
                $num_rows_query_sql_dados_oficinas = mysqli_num_rows($query_sql_dados_oficinas);
      
                if($num_rows_query_sql_dados_oficinas < 1){
                    echo "<h5 style='padding: 1%; margin: 0;'>Sem Oficinas no Momento! <a href='criaroficina.php'><span>Que tal Criar Uma?</span></a></h5>";
                } else{

                    echo "<table>";
                      echo "<tr>";
                        echo "<td>Nome da Oficina</td>";
                        echo "<td>Professor</td>";
                        echo "<td>Máteria</td>";
                        echo "<td>Vagas</td>";
                        echo "<td>Sala</td>";
                        echo "<td>Data</td>";
                        echo "<td>Horário</td>";
                        echo "<td>Status</td>";
                        echo "<td>Funções</td>";
                      echo "</tr>";

                  while($dados_oficinas = mysqli_fetch_array($query_sql_dados_oficinas)){

                      echo "<tr>";
                          echo "<td><a href='../oficinas/oficinas.php?id_oficina=$dados_oficinas[0]'><span>$dados_oficinas[1]</span></a></td>";
                          echo "<td><span>$dados_oficinas[3]</span></td>";
                          echo "<td><span>$dados_oficinas[4]</span></td>";
                          echo "<td><a href='inscricoesoficina.php?id_oficina=$dados_oficinas[0]'>";
                            echo "<span>$dados_oficinas[13]</span>";
                              echo "/";
                            echo "<span>$dados_oficinas[6]</span>";
                          echo "</a></td>";
                          echo "<td><span>$dados_oficinas[5]</span></td>";
                          echo "<td><span>"; 
                            echo date_format(new DateTime($dados_oficinas[8]), "d/m/Y");;
                          echo "</span></td>";
                          echo "<td><span>$dados_oficinas[9]</span></td>";
                          
                              if($dados_oficinas[12] == 1){
                                  echo "<td><span style='color: green;'>ATIVO</span></td>";
                              } else{
                                  echo "<td><span style='color: red;'>DESATIVADO</span></td>";
                              }

                          echo "<td>";
                              echo "<form action='scriptsphp/apagar_oficina.php' method='post' style='display: inline-block;'>";
                                  echo "<input type='number' style='display: none;' name='id' value='$dados_oficinas[0]'>";
                                  echo "<input type='submit' value='' class='btn-funcao btn-funcao-lixeira'>";
                              echo "</form>";
                              echo "<form action='scriptsphp/desativa_oficina.php' method='post' style='display: inline-block;'>";
                                  echo "<input type='number' style='display: none;' name='id' value='$dados_oficinas[0]'>";
                                  echo "<input type='submit' value='' class='btn-funcao btn-funcao-desativar'>";
                              echo "</form>";
                          echo "</td>";

                      echo "</>";
                  };
              };
          
            ?>

        </table>
    </main>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>