<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Local</title>
    <link rel="stylesheet" href="../styles/cad.css" />
</head>
<body class="main">
<?php
include "conecta.php";

$orgs = mysqli_query($conn, "SELECT id, nome FROM organizacao");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $endereco = $_POST["endereco"];
    $capacidade = $_POST["capacidade"];
    $organizacao_id = $_POST["organizacao_id"];

    $sql = "INSERT INTO local_evento (nome, endereco, capacidade, organizacao_id)
            VALUES ('$nome', '$endereco', '$capacidade', '$organizacao_id')";

    if (mysqli_query($conn, $sql)) {
        echo "<p><strong>Local cadastrado com sucesso!</strong></p>";
    } else {
        echo "<p>Erro ao cadastrar local.</p>";
    }
}
?>


<h2 class="title">Cadastro de Local</h2>

<form method="post" class="form">
    <label>Nome do Local:</label>
    <input type="text" name="nome" required class="input" placeholder="Digite o local do evento"><br><br>

    <label>Endereço:</label><br>
    <input type="text" name="endereco" required class="input" placeholder="Digite o endereço"><br><br>

    <label>Capacidade:</label><br>
    <input type="number" name="capacidade" required class="input" placeholder="Digite a capacidade"><br><br>

    <label>Organização:</label><br>
    <select name="organizacao_id" required>
        <option value="">Selecione</option>
        <?php
        while ($org = mysqli_fetch_assoc($orgs)) {
            echo "<option value='".$org["id"]."'>".$org["nome"]."</option>";
        }
        ?>
    </select><br><br>

    <button type="submit" class="button">Cadastrar</button>
</form>

<br>
<a href="lista_usuario.php" class="link">Ver locais cadastrados</a>
