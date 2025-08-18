<?php
include("conexao.php");

$numero_camisa = $_GET["numero_camisa"];
$nome = $_GET["nome"];
$posicao = $_GET["posicao"];
$sql = "DELETE FROM jogadores WHERE numero_camisa = '$numero_camisa' AND posicao = '$posicao' AND nome = '$nome'";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "Usuário excluído com sucesso!";
    echo "<br><br>";
    echo "<a href='index.php'>Voltar ao Início</a>";
} else {
    echo "Erro ao excluir usuário.";
}

?>
