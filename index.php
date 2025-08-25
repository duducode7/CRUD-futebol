<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"
    <title></title>
</head>
<body>
</body>
</html>

<?php
include("conexao.php");


$mostrar_partidas = isset($_GET['mostrar']) && $_GET['mostrar'] == 'partidas';

if ($mostrar_partidas) {
    
    echo "<h1>Partidas Agendadas</h1>";
    
    $sql_partidas = "SELECT p.id, p.data_jogo, p.gols_casa, p.gols_fora,
                            tc.nome AS time_casa, tf.nome AS time_fora
                     FROM partidas p
                     JOIN times tc ON p.time_casa_id = tc.id
                     JOIN times tf ON p.time_fora_id = tf.id
                     ORDER BY p.data_jogo";
    
    $result_partidas = mysqli_query($conn, $sql_partidas);
    
    if (mysqli_num_rows($result_partidas) > 0) {
        while ($partida = mysqli_fetch_assoc($result_partidas)) {
            echo "<div style='margin-bottom: 20px; border: 1px solid #ccc; padding: 10px;'>";
            echo "<h3>" . htmlspecialchars($partida['time_casa']) . " vs " . 
                          htmlspecialchars($partida['time_fora']) . "</h3>";
            echo "Data: " . htmlspecialchars($partida['data_jogo']) . "<br>";
            echo "Placar: " . htmlspecialchars($partida['gols_casa']) . " - " . 
                             htmlspecialchars($partida['gols_fora']) . "<br>";
            echo "<a href='editar_partida.php?id=" . $partida['id'] . "' class='btn'>Editar</a> ";
            echo "<a href='excluir_partida.php?id=" . $partida['id'] . "' class='btn-excluir'>Excluir</a>";
            echo "</div>";
        }
    } else {
        echo "<p>Nenhuma partida agendada.</p>";
    }
    
    echo "<br><a href='cadastrar_partida.php' class='btn-geral'>Adicionar Nova Partida</a><br><br>";
    echo "<a href='index.php' class='btn-geral'>Mostrar Jogadores</a>";
    
} else {

    echo "<h1>Lista de Jogadores</h1>";
    
    
    $sql = "SELECT t.id AS time_id, t.nome AS time_nome, 
                   j.id AS jogador_id, j.nome AS jogador_nome, 
                   j.numero_camisa, j.posicao
            FROM times t
            LEFT JOIN jogadores j ON t.id = j.time_id
            ORDER BY t.nome, j.nome";
    
    $resultado = mysqli_query($conn, $sql);
    
    $time_atual = null;
    
    if (mysqli_num_rows($resultado) > 0) {
        while ($linha = mysqli_fetch_array($resultado)) {
           
            if ($time_atual != $linha['time_id']) {
                if ($time_atual !== null) {
                    echo "<br>"; 
                }
                $time_atual = $linha['time_id'];

                $class_time = strtolower(str_replace(" ", "-", $linha['time_nome']));

                echo "<h3 class='time-" . htmlspecialchars($class_time) . "'>Time: " . htmlspecialchars($linha['time_nome']) . "</h3>";
            }

            
           
            if ($linha['jogador_id']) {
                echo "Nome: " . htmlspecialchars($linha['jogador_nome']) . "<br>";
                echo "N° camisa: " . htmlspecialchars($linha['numero_camisa']) . "<br>";
                echo "Posição: " . htmlspecialchars($linha['posicao']) . "<br>";
                
        
                echo "<a href='editar.php?nome=" . urlencode($linha['jogador_nome']) . 
                     "&numero_camisa=" . urlencode($linha['numero_camisa']) . 
                     "&posicao=" . urlencode($linha['posicao']) . 
                     "&time_id=" . urlencode($linha['time_id']) . "' class='btn'>Editar</a> ";
                
                echo "<a href='excluir.php?numero_camisa=" . urlencode($linha['numero_camisa']) . 
                     "&nome=" . urlencode($linha['jogador_nome']) . 
                     "&posicao=" . urlencode($linha['posicao']) . 
                     "&time_id=" . urlencode($linha['time_id']) . "' class='btn-excluir'>Excluir</a><br><br>";

                echo "<hr>";
            }
        }
    } else {
        echo "Nenhum registro encontrado<br><br>";
    }
    
    echo "<a href='cadastrar.php' class='btn-geral'>Cadastrar Novo Jogador</a>";
    echo "<br>";
    echo "<br>";
    echo "<a href='index.php?mostrar=partidas' class='btn-geral'>Mostrar Partidas</a><br><br>";
}
?>


    

