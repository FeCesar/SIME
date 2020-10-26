<?php

    session_start();
    include_once('../../connection/connect.php');
    include_once('../../scriptsphp/autenticador.php');

    $rm_alunos = $_POST['presencas'];

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

  <style>
    .log{
        height: 400px;
    }
    table{
        width: 100%;
        margin-top: 2%;
    }
    tr{
        border: 1px solid rgba(0, 0, 0, 0.5);
        margin-bottom: 2px;
    }
    td{
        padding: 1.5%;
    }
    span{
        padding: 0.5%;
        border-radius: 3px;
    }
    button{
        float: right;
    }
  </style>

    <header class="navbar-dark bg-dark">
      <nav class="navbar container">
        <a class="navbar-brand" href="../index.php">
          <img src="../../imagens/logo.png" width="35" height="35" class="d-inline-block align-top" alt="" loading="lazy"><span style="font-size: 12px; opacity: 0.6; margin-left: 5%;"> | Sistema de Inscrição Médio Escolar</span>
        </a>
        <a class="navbar-brand" href="logout.php"><span style="font-size: 13px;">Logout<i class="fa fa-sign-out" aria-hidden="true" style="margin-left: 10%;"></i></span></a>
      </nav>
    </header> 

    <main class="container log">
        <table>
            <?php

                foreach ($rm_alunos as $value){
                        
                    try{
                        $pdo = new PDO("mysql:host=localhost;dbname=sime", 'root', '');
                        $stmt = $pdo->query("SELECT email_aluno FROM alunos WHERE rm_aluno = $value");

                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                            $email_aluno = $row['email_aluno'];
                            
                                echo "<tr>";
                                    echo "<td>Certificado <span class='alert-success'>Enviado</span> Para <span class='alert-success'>$email_aluno</span></td>";
                                echo "</tr>";

                        }


                    } catch(PDOException $e){
                        echo "Error: " . $e->getMessage();
                    }

                }

            ?>
        </table>
    </main>

    <aside class="container">
        <a href='../index.php'><button type="button" class="btn btn-primary">Voltar</button></a>
    </aside>

</body>
</html>