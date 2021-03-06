<?php 

    session_start();
    include_once('../scriptsphp/autenticador.php');
    include_once('../connection/connect.php');

    $id_oficina = $_GET['id_oficina'];
    $sql_oficina = "SELECT * FROM oficinas WHERE id_oficina = $id_oficina";
    $query_oficina = mysqli_query($conn, $sql_oficina);
    $dados_oficina = mysqli_fetch_array($query_oficina);

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
    <link rel="stylesheet" href="styles/painel-professor.css">
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
                <li class="breadcrumb-item"><a href="minhas-oficinas.php">Minhas Oficinas</a></li>
                <li class="breadcrumb-item active">Alunos Inscritos</li>
            </ol>
        </nav>
    </article>

    <main class="container">
        <?php if(isset($_SESSION['error_inesperado'])): ?>
          <div class="alert alert-danger container-fluid" style="font-size: 12px; display: inline-block;" role="alert">
            <p class='container' style='padding: 0; margin-bottom:0;'>Erro Inesperado! Contate o <a href="#">Suporte</a> Para Mais Informações.</p>
          </div>
        <?php endif; unset($_SESSION['error_inesperado']); ?>
        <?php if(isset($_SESSION['success_operacao'])): ?>
          <div class="alert alert-success container-fluid" style="font-size: 12px; display: inline-block;" role="alert">
            <p class='container' style='padding: 0; margin-bottom:0;'>Sucesso! Aluno Desinscrito na Oficina.</p>
          </div>
        <?php endif; unset($_SESSION['success_operacao']); ?>

        <h5 style="display: inline-block;"><?php echo $dados_oficina[1]; ?> - </h5>
            <h6 style="display: inline-block;">Lista de Alunos Inscritos</h6>

      <div class="formulario">
        <table>
            <tr>
                <td>Nome do Aluno</td>
                <td>Sala</td>
                <td>Série</td>
                <td>Rm</td>
            </tr>

            <?php 

                $sql_alunos_inscritos = "SELECT * FROM inscricoes WHERE id_oficina = $id_oficina";
                $query_alunos_inscritos = mysqli_query($conn, $sql_alunos_inscritos);
                $contador = 0;
                
                    while($dados_inscricoes = mysqli_fetch_array($query_alunos_inscritos)){
                        
                        $contador += 1;

                        $sql_info_alunos = "SELECT * FROM alunos WHERE rm_aluno = $dados_inscricoes[1]";
                        $query_info_alunos = mysqli_query($conn, $sql_info_alunos);
                        $dados_alunos = mysqli_fetch_array($query_info_alunos);

                        echo "<tr>";
                            echo "<td>$dados_alunos[1]</td>";
                            echo "<td>$dados_alunos[5]</td>";
                            echo "<td>";
                                if($dados_alunos[3] == 1){
                                    echo "1º Série";
                                } elseif($dados_alunos[3] == 2  ){
                                    echo "2º Série";
                                } else{
                                    echo "3º Série";
                                }
                            echo "</td>";
                            echo "<td>$dados_alunos[0]</td>";

                        echo "</tr>";
                    }

                    echo "<h6 style='float: right;  '>";
                        echo $contador;
                        echo "/";
                        echo $dados_oficina[5];
                    echo "</h6>";

                    $vagas_restantes = $contador;
                    $sql_numero_inscricoes = "UPDATE oficinas SET vagas_restantes_oficina = $vagas_restantes WHERE id_oficina = $id_oficina";
                    $query_numero_inscricoes = mysqli_query($conn, $sql_numero_inscricoes);
            ?>

        </table>
      </div>

             <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="float: right;">
          Fazer Chamada
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lista de Chamada</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                

                    <table>
                      <tr>
                        <td>Nome</td>
                        <td>Presente</td>
                      </tr>
                    
                      <?php

                          try{
                            $pdo = new PDO("mysql:host=localhost;dbname=sime", 'root', '');
                            $stmt = $pdo->query("SELECT rm_aluno FROM inscricoes WHERE id_oficina = $id_oficina");

                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                              $rm_aluno = $row['rm_aluno'];
                                
                              $query_nome_aluno = mysqli_query($conn, "SELECT nome_aluno FROM alunos WHERE rm_aluno = $rm_aluno");
                              $linha = mysqli_fetch_array($query_nome_aluno);

                              echo "<tr>";
                                echo "<td>";
                                  echo $linha[0];
                                echo "</td>";
                                echo "<td>";
                                  echo "<form method='post' action='scriptsphp/presenca.php'>";
                                    echo "<input type='checkbox' name='presencas[]' value='$rm_aluno' checked>";
                                echo "</td>";
                              echo "</tr>";

                            }
                            
                            echo "<div class='modal-footer' style='border: none; margin-bottom: 1%;'>";
                            echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>";
                            echo "<input type='text' name='id_oficina' value='$id_oficina' style='display: none;'>";
                            echo "<input type='submit' class='btn btn-primary' value='Confirmar'>";
                            echo "</div>";
                            echo "</form>";
                            echo "</table>";
                          echo "</div>";
                          } catch(PDOException $e){
                            echo "Error: " . $e->getMessage();
                          }

                      ?>
            </div>
          </div>
        </div>   

    </main>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="scriptsjs/popup.js"></script>
  </body>
</html>