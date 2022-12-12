<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<?php
$pdo = new PDO('mysql:host=localhost;dbname=aulaprogweb', 'root', '');

if (isset($_GET['cod_aluno'])) {
    $cod_aluno = (int)$_GET['cod_aluno'];
    //mount form whit data
    $sql = $pdo->prepare("SELECT * FROM tab_aluno WHERE cod_aluno = $cod_aluno");
    $sql->execute();
    $alunos = $sql->fetchAll();

    //montar formulário com os dados dos alunos
    foreach ($alunos as $aluno) {
        echo "<form method='POST'>";
        echo "<legend>Insira os dados abaixo</legend>";
        echo "<fieldset>";
        echo "<div>";
        echo "Nome: <input type='text' class='form-control' name='nome' value='" . $aluno['nome'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "CPF: <input type='text' class='form-control' name='matricula' value='" . $aluno['matricula'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "E-mail: <input type='text' class='form-control' name='nota1' value='" . $aluno['nota1'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "<input type='submit' class='btn btn-primary' value='Enviar'>";
        echo "<input type='reset' class='btn btn-primary' value='Limpar Dados'>";
        echo "</div>";
        echo "<br>";
        echo "</fieldset>";
        echo "</form>";
    }

    //$pdo->exec("DELETE FROM `tab_aluno` WHERE `cod_aluno` = $cod_aluno");
    //echo "<h1>Usuário com id = $cod_aluno deletado com sucesso!</h1>";
}

if (isset($_POST['nome'])) {
    //$sql = $pdo->prepare("INSERT INTO tab_aluno VALUES (null, ?, ?, ?, ?, ?)");
    //$sql->execute(array($_POST['nome'], $_POST['matricula'], $_POST['nota1'], $_POST['nota2'], $_POST['nota3']));
    //alterando dados da tabela tab_aluno com os dados do form
    $sql = $pdo->prepare("UPDATE tab_aluno SET nome = ?, matricula = ?, nota1 = ? WHERE cod_aluno = $cod_aluno");
    $sql->execute(array($_POST['nome'], $_POST['matricula'], $_POST['nota1']));
    echo "<h1>Usuário com id = $cod_aluno alterado com sucesso!</h1>";
    //fazer botao para voltar para a pagina de listagem
    echo "<a href='index.php'>Voltar</a>";

    //echo "<h1>Alterado com sucesso!</h1>";
}