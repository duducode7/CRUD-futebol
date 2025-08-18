<?php
include("conexao.php");

$nome = $_GET["nome"];
$email = $_GET["email"];
$sql = "SELECT * FROM usuarios WHERE nome = '$nome' AND email = '$email'";
$res = mysqli_query($conn, $sql);
$dado = mysqli_fetch_assoc($res);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $novo_nome = $_POST["nome"];
    $novo_email = $_POST["email"];

    $sql = "UPDATE usuarios SET nome='$novo_nome', email='$novo_email' WHERE nome='$nome' AND email='$email'";
    mysqli_query($conn, $sql);
    header("Location: index.php");
    exit;
}
?>

<form method="POST">
    Nome: <input type="text" name="nome" value="<?= $dado['nome'] ?>"><br>
    Email: <input type="email" name="email" value="<?= $dado['email'] ?>"><br>
    <input type="submit" value="Salvar">
</form>