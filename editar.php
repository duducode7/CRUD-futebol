<?php
include("conexao.php");

$nome = $_GET["nome"];
$numero_camisa = $_GET["numero_camisa"];
$posicao = $_GET["posicao"];
$time_id = $_GET["time_id"];

$sql = "SELECT * FROM jogadores WHERE nome = '$nome' AND numero_camisa = '$numero_camisa' AND posicao = '$posicao' AND time_id = '$time_id'";
$res = mysqli_query($conn, $sql);
$dado = mysqli_fetch_assoc($res);

$times = [];
$result = $conn->query("SELECT id, nome FROM times");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $times[] = $row;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $novo_nome = $_POST["nome"];
    $novo_numero_camisa = $_POST["numero_camisa"];
    $novo_posicao = $_POST["posicao"];
    $novo_time_id = $_POST["time_id"];

    $sql = "UPDATE jogadores 
            SET nome='$novo_nome', numero_camisa='$novo_numero_camisa', posicao='$novo_posicao', time_id='$novo_time_id' 
            WHERE nome='$nome' AND numero_camisa='$numero_camisa' AND posicao='$posicao' AND time_id='$time_id'";

    mysqli_query($conn, $sql);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"
    <title></title>
</head>
<body>
    
<h1>Editar Jogador</h1>
<form method="POST">
    Nome: <input type="text" name="nome" value="<?= $dado['nome'] ?>"><br>
    N° Camisa: <input type="number" name="numero_camisa" value="<?= $dado['numero_camisa'] ?>"><br>
    Posição: <input type="text" name="posicao" value="<?= $dado['posicao'] ?>"><br>
    
    <label for="time_id">Time:</label>
    <select name="time_id" required>
        <?php foreach ($times as $time): ?>
            <option value="<?= $time['id'] ?>" <?= $dado['time_id'] == $time['id'] ? 'selected' : '' ?>>
                <?= $time['nome'] ?>
            </option>
        <?php endforeach; ?>
    </select><br>
    <br>

    <input type="submit" value="Salvar" class="btn-geral">
</form>
</body>
</html>