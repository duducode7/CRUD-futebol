<?php
include("conexao.php");

$nome = $_GET["nome"];
$numero_camisa = $_GET["numero_camisa"];
$posicao = $_GET["posicao"];
$sql = "SELECT * FROM jogadores WHERE nome = '$nome' AND numero_camisa = '$numero_camisa' AND posicao = '$posicao' ";
$res = mysqli_query($conn, $sql);
$dado = mysqli_fetch_assoc($res);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $novo_nome = $_POST["nome"];
    $novo_numero_camisa = $_POST["numero_camisa"];
    $posicao = $_POST["posicao"];

    $sql = "UPDATE usuarios SET nome='$novo_nome', numero_camisa='$novo_numero_camisa', posicao='$posicao' WHERE nome='$nome' AND numero_camisa='$numero_camisa' AND posicao='$posicao' ";
    mysqli_query($conn, $sql);
    header("Location: index.php");
    exit;
}
?>

<form method="POST">
    Nome: <input type="text" name="nome" value="<?= $dado['nome'] ?>"><br>
    N° Camisa: <input type="number" name="numero_camisa" value="<?= $dado['numero_camisa'] ?>"><br>
    Posição: <input type="text" name="posicao" value="<?= $dado['posicao'] ?>"><br>
    <input type="submit" value="Salvar">
</form>