<?php
// Conexão com o banco
include("conexao.php");


$times = [];
$result = $conn->query("SELECT id, nome FROM times");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $times[] = $row;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $numero_camisa = $_POST["numero_camisa"];
    $posicao = $_POST["posicao"];
    $time_id = $_POST["time_id"];

    
    $sql = "INSERT INTO jogadores (nome, numero_camisa, posicao, time_id) 
            VALUES ('$nome', '$numero_camisa', '$posicao', '$time_id')";

    if (mysqli_query($conn, $sql)) {
        echo "Usuário cadastrado com sucesso!";
        header("Location: index.php");
        exit; 
    } else {
        echo "Erro: " . $conn->error;
    }
}

$conn->close();
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
    
<h1>Cadastrar Novo Jogador</h1>

<form method="POST">
    Nome e Sobrenome: <input type="text" name="nome" required><br>
    N° Camisa: <input type="number" name="numero_camisa" required><br>
    Posição: <input type="text" name="posicao" required><br>

    <label for="time_id">Time:</label>
    <select name="time_id" required>
        <option value="">Selecione um time</option>
        <?php foreach ($times as $time): ?>
            <option value="<?php echo $time['id']; ?>">
                <?php echo htmlspecialchars($time['nome']); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br><br>
    <input type="submit" value="Cadastrar" class="btn-geral">
</form>
</body>
</html>