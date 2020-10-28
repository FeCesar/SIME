<?php

    session_start();
    include_once('../../connection/connect.php');
    include_once('../../scriptsphp/autenticador.php');

    $rm_alunos = $_POST['presencas'];
    $id_oficina = $_POST['id_oficina'];

    $query = "SELECT * FROM oficinas WHERE id_oficina = $id_oficina";
    $query_ativa = mysqli_query($conn, $query);
    $dados_oficina = mysqli_fetch_array($query_ativa);

    $query_prof = "SELECT * FROM professores WHERE id_professor = $dados_oficina[14]";
    $query_ativa_prof = mysqli_query($conn, $query_prof);
    $dados_professor = mysqli_fetch_array($query_ativa_prof);

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
    <link rel="stylesheet" href="certificado.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript">
      function imprimir(){

        element = document.getElementById("btn");
        element2 = document.getElementById("btnVoltar");
        element.style.display="none";
        element2.style.display="none";

         window.print();

        element.style.display = "inline-block";
        element2.style.display = "inline-block";
       }
     </script>
  </head>
  <body>

        <?php

            try{

                $pdo = new PDO('mysql:host=localhost;dbname=sime', 'root', '');
                $stmt = $pdo->query("SELECT * FROM alunos WHERE rm_aluno = $rm_alunos[0]");

                while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)):
        ?>

                <main>

                <header>
                    <figure><img src="../imagens/logo.png"></figure> 
                </header>

                <aside>
                    <h1>CERTIFICADO</h1>
                </aside>

                <aside>
                    <p>Etec Pedro D'Arcádia Neto certifica que</p>
                    <h3><?php echo $row['nome_aluno']; ?></h3>
                    <p style="width: 40%; margin-left: 30%;">Participou da oficina organizada por <?php echo $dados_professor[1]; ?>, Realizada na escola Pedro D'Arcádia Neto no dia <?php echo date_format(new DateTime($dados_oficina[7]), "d/m/Y");; ?>, com carga horária de 1 hora e 40 minutos (Uma hora e quarenta minutos).</p>
                </aside>
                    
                <footer>
                    <div class="box" style="margin-right: 5%;">
                        <h5>Professor <?php echo $dados_professor[1]?></h5>
                    </div>
                    <div class="box" style="margin-left: 5%;">
                        <h5>Diretor Pedagógico Daniel Paulo Ferreira</h5>
                    </div>
                </footer>

                </main>

        <?php
            
                endwhile;
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }

        ?>

        <button type="button" class="btn btn-secondary" style="margin: 5%; margin-bottom: 0;" onClick="imprimir()" id="btn">Imprimir</button>
        <a href="../index.php"><button type="button" class="btn btn-secondary" style="display: none; margin: 5%; margin-bottom: 0;" id="btnVoltar">Voltar</button></a>

</body>
</html>