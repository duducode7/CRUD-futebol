<?php
// Listagem corrigida
include("conexao.php");

$sql = "SELECT * FROM jogadores";
$resultado = mysqli_query($conn, $sql);

echo "<h1>Lista de Usuários</h1>";

if (mysqli_num_rows($resultado) > 0) {
    while ($linha = mysqli_fetch_array($resultado)) {
        echo "Nome: " . $linha['nome'] . "<br>";
        echo "N° camisa: " . $linha['numero_camisa'] . "<br>";
        echo "Posição: " . $linha['posicao'] . "<br>";
        echo "<a href='editar.php?nome={$linha['nome']}&numero_camisa={$linha['numero_camisa']}&email={$linha['posicao']}'>Editar</a> ";
        echo "<a href='excluir.php?numero_camisa={$linha['numero_camisa']}&nome={$linha['nome']}&posicao={$linha['posicao']}'>Excluir</a><br><br>";
    }
} else {
    echo "Nenhum registro encontrado";
    echo "<br><br>";
}
?>
<a href='cadastrar.php'>Cadastrar novo</a>