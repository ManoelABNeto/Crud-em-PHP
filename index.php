<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crud PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <?php

    if(isset($_GET['delete'])){
        $cod_aluno = (int) $_GET['delete'];
        $pdo->exec("DELETE FROM tab_aluno WHERE cod_aluno = $cod_aluno");
        echo "<h2>Pessoa excluida com sucesso!</h2>";
    }

    if(isset($_POST['nome'])){
        $sql = $pdo->prepare("INSERT INTO `tab_aluno`Values (null,?,?,?)" );
        $sql->execute(array($_POST['nome'], $_POST['matricula'], $_POST['nota1']));

        echo "<h2>Pessoa Cadastrada com sucesso!</h2>";
        
    }

?>


<div class="container">
    <form method="POST">
        <legend>
            <H1 align="center">CRUD em PHP</H1>
        </legend>
        <fieldset>
            <div>
                Nome: <input type="text" class="form-control" name="nome">
            </div>
            <div>
                CPF: <input type="text" class="form-control" name="matricula">
            </div>
            <div>
                E-mail: <input type="text" class="form-control" name="nota1">
            </div><br>
            
            <div>
                <input type="submit" class="btn btn-primary" value="Enviar">

                <input type="reset" class="btn btn-primary" value="Limpar Dados">
            </div>

        </fieldset>

    </form>
</div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<?php 
$sql = $pdo->prepare("SELECT * FROM `tab_aluno`");
$sql->execute();
$alunos = $sql->fetchAll();

echo "<table class='table table-striped table-hover'>";
echo "<thead>";
echo "<tr>";
echo "<th scope='col' colspan'2' aling='center'>Ações</th>";

echo "<th scope='col'>Nome</th>";
echo "<th scope='col'>Matrícula</th>";
echo "<th scope='col'>Nota 1</th>";
echo "</tr>";
echo "</thead>";

foreach ($alunos as $aluno) {
    echo "</tr>";
    echo'<td align="center">
    <a href="?delete=' . $aluno['cod_aluno'] . '">( X )</a> </td>';
    echo '<td align="center"> 
    <a href="alterar.php?cod_aluno=' . $aluno['cod_aluno'] . '">( Alterar )</a> </td>';

    echo "<td>" . $aluno['nome'] . "</td>";
    echo "<td>" . $aluno['matricula'] . "</td>";
    echo "<td>" . $aluno['nota1'] . "</td>";
    echo "</tr>";
}

echo "</table>";


?>

  </body>
</html>