<?php
include("conexao.php");


$sql = "SELECT t.id AS time_id, t.nome AS time_nome, 
               j.id AS jogador_id, j.nome AS jogador_nome, 
               j.numero_camisa, j.posicao
        FROM times t
        LEFT JOIN jogadores j ON t.id = j.time_id
        ORDER BY t.nome, j.nome";

$resultado = mysqli_query($conn, $sql);

echo "<h1>Lista de Usuários</h1>";

$time_atual = null;

if (mysqli_num_rows($resultado) > 0) {
    while ($linha = mysqli_fetch_array($resultado)) {
      
        if ($time_atual != $linha['time_id']) {
            if ($time_atual !== null) {
                echo "<br>"; 
            }
            $time_atual = $linha['time_id'];
            echo "<h3>Time: " . htmlspecialchars($linha['time_nome']) . "</h3>";
        }
        
        if ($linha['jogador_id']) {
            echo "Nome: " . htmlspecialchars($linha['jogador_nome']) . "<br>";
            echo "N° camisa: " . htmlspecialchars($linha['numero_camisa']) . "<br>";
            echo "Posição: " . htmlspecialchars($linha['posicao']) . "<br>";
            
            echo "<a href='editar.php?nome=" . urlencode($linha['jogador_nome']) . 
                 "&numero_camisa=" . urlencode($linha['numero_camisa']) . 
                 "&posicao=" . urlencode($linha['posicao']) . 
                 "&time_id=" . urlencode($linha['time_id']) . "'>Editar</a><br>";
            
            echo "<a href='excluir.php?numero_camisa=" . urlencode($linha['numero_camisa']) . 
                 "&nome=" . urlencode($linha['jogador_nome']) . 
                 "&posicao=" . urlencode($linha['posicao']) . 
                 "&time_id=" . urlencode($linha['time_id']) . "'>Excluir</a><br><br>";
        }
    }
} else {
    echo "Nenhum registro encontrado<br><br>";
}
?>

<a href='cadastrar.php'>Cadastrar novo</a>