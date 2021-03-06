<?php 

    session_start();
    include_once('../scriptsphp/autenticador.php');
    include_once('../connection/connect.php');

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
                <li class="breadcrumb-item active">Minhas Oficinas</li>
            </ol>
        </nav>
    </article>

    <main class="container">

        <?php 
        
            $id_professor = $_SESSION['dados'][0];
            $sql_oficinas_professor = "SELECT * FROM oficinas WHERE id_professor = '$id_professor'";
            $query_oficinas_professor = mysqli_query($conn, $sql_oficinas_professor);
            $numero_linhas = mysqli_num_rows($query_oficinas_professor);
            
                if($numero_linhas == null){
                    echo "<h5>Nenhuma Oficina Ativa!</h5>";
                }

                if($numero_linhas > 0){

                  echo "<table>";
                      echo "<tr>";
                        echo "<td>Nome da Oficina</td>";
                        echo "<td>Vagas</td>";
                        echo "<td>Sala</td>";
                        echo "<td>Data</td>";
                        echo "<td>Horário</td>";
                        echo "<td>Status</td>";
                        echo "<td>QrCode</td>";
                      echo "</tr>";

                  while($dados_oficinas = mysqli_fetch_array($query_oficinas_professor)){

                      echo "<tr>";
                          echo "<td><a href='../oficinas/oficinas.php?id_oficina=$dados_oficinas[0]'><span>$dados_oficinas[1]</span></a></td>";

                          echo "<td><a href='inscricoesoficina.php?id_oficina=$dados_oficinas[0]'>";
                            echo "<span>$dados_oficinas[12]</span>";
                              echo "/";
                            echo "<span>$dados_oficinas[5]</span>";
                          echo "</a></td>";

                          echo "<td><span>$dados_oficinas[4]</span></td>";

                          echo "<td><span>"; 
                            echo date_format(new DateTime($dados_oficinas[8]), "d/m/Y");;
                          echo "</span></td>";

                          echo "<td><span>$dados_oficinas[8]</span></td>";

                          if($dados_oficinas[11] == 1){
                            echo "<td><span style='color: green;'>ATIVO</span></td>";
                          } else{
                            echo "<td><span style='color: red;'>DESATIVADO</span></td>";
                          }
                  
                          echo "<td>";
                              echo "<a href='$dados_oficinas[13]' target='_blank'><img src='imagens/qrcode.png' width='25px' height='25px'></a>";
                          echo "</td>";

                      echo "</tr>";
                  };
              };
        
        ?>
        </table>
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