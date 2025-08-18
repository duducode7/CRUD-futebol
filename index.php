<?php
include("conexao.php");

$sql = "SELECT jogadores.*, times.nome AS nome_time 
        FROM jogadores
        INNER JOIN times ON jogadores.time_id = times.id";

$resultado = mysqli_query($conn, $sql);

echo "<h1>Lista de Usuários</h1>";

if (mysqli_num_rows($resultado) > 0) {
    while ($linha = mysqli_fetch_array($resultado)) {
        echo "Nome: " . $linha['nome'] . "<br>";
        echo "N° camisa: " . $linha['numero_camisa'] . "<br>";
        echo "Posição: " . $linha['posicao'] . "<br>";
        echo "Time: " . $linha['nome_time'] . "<br>";

        echo "<a href='editar.php?nome={$linha['nome']}&numero_camisa={$linha['numero_camisa']}&posicao={$linha['posicao']}&time_id={$linha['time_id']}'>Editar</a><br>";

        echo "<a href='excluir.php?numero_camisa={$linha['numero_camisa']}&nome={$linha['nome']}&posicao={$linha['posicao']}&time_id={$linha['time_id']}'>Excluir</a><br><br>";
    }
} else {
    echo "Nenhum registro encontrado<br><br>";
}
?>

<a href='cadastrar.php'>Cadastrar novo</a>
