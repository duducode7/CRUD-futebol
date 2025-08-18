<?php
include("conexao.php");

$times = [];
$result = $conn->query("SELECT id, nome FROM times");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $times[] = $row;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $time_casa_id = $_POST["time_casa_id"];
    $time_fora_id = $_POST["time_fora_id"];
    $data_jogo = $_POST["data_jogo"];
    
    $sql = "INSERT INTO partidas (time_casa_id, time_fora_id, data_jogo) 
            VALUES ('$time_casa_id', '$time_fora_id', '$data_jogo')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php?mostrar=partidas");
        exit;
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>

<h1>Cadastrar Nova Partida</h1>

<form method="POST">
    <label>Time da Casa:</label>
    <select name="time_casa_id" required>
        <?php foreach ($times as $time): ?>
            <option value="<?= $time['id'] ?>"><?= htmlspecialchars($time['nome']) ?></option>
        <?php endforeach; ?>
    </select><br>
    
    <label>Time Visitante:</label>
    <select name="time_fora_id" required>
        <?php foreach ($times as $time): ?>
            <option value="<?= $time['id'] ?>"><?= htmlspecialchars($time['nome']) ?></option>
        <?php endforeach; ?>
    </select><br>
    
    <label>Data do Jogo:</label>
    <input type="date" name="data_jogo" required><br><br>
    
    <input type="submit" value="Cadastrar" class="btn">
</form>

<a href="index.php?mostrar=partidas" class="btn">Voltar</a>