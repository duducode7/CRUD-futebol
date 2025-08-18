<?php
include("conexao.php");

$id = $_GET["id"];
$sql = "SELECT * FROM partidas WHERE id = $id";
$result = mysqli_query($conn, $sql);
$partida = mysqli_fetch_assoc($result);

$times = [];
$result_times = $conn->query("SELECT id, nome FROM times");
if ($result_times) {
    while ($row = $result_times->fetch_assoc()) {
        $times[] = $row;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $time_casa_id = $_POST["time_casa_id"];
    $time_fora_id = $_POST["time_fora_id"];
    $data_jogo = $_POST["data_jogo"];
    $gols_casa = $_POST["gols_casa"];
    $gols_fora = $_POST["gols_fora"];
    
    $sql = "UPDATE partidas SET 
            time_casa_id = '$time_casa_id',
            time_fora_id = '$time_fora_id',
            data_jogo = '$data_jogo',
            gols_casa = '$gols_casa',
            gols_fora = '$gols_fora'
            WHERE id = $id";
    
    mysqli_query($conn, $sql);
    header("Location: index.php?mostrar=partidas");
    exit;
}
?>

<h1>Editar Partida</h1>

<form method="POST">
    <label>Time da Casa:</label>
    <select name="time_casa_id" required>
        <?php foreach ($times as $time): ?>
            <option value="<?= $time['id'] ?>" <?= $time['id'] == $partida['time_casa_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($time['nome']) ?>
            </option>
        <?php endforeach; ?>
    </select><br>
    
    <label>Time Visitante:</label>
    <select name="time_fora_id" required>
        <?php foreach ($times as $time): ?>
            <option value="<?= $time['id'] ?>" <?= $time['id'] == $partida['time_fora_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($time['nome']) ?>
            </option>
        <?php endforeach; ?>
    </select><br>
    
    <label>Data do Jogo:</label>
    <input type="date" name="data_jogo" value="<?= $partida['data_jogo'] ?>" required><br>
    
    <label>Gols Time Casa:</label>
    <input type="number" name="gols_casa" value="<?= $partida['gols_casa'] ?>"><br>
    
    <label>Gols Time Visitante:</label>
    <input type="number" name="gols_fora" value="<?= $partida['gols_fora'] ?>"><br><br>
    
    <input type="submit" value="Salvar" class="btn">
</form>

<a href="index.php?mostrar=partidas" class="btn">Voltar</a>