<?php
include("conexao.php");

$email = $_GET["email"];
$nome = $_GET["nome"];
$sql = "DELETE FROM usuarios WHERE email = '$email' AND nome = '$nome'";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "Usuário excluído com sucesso!";
    echo "<br><br>";
    echo "<a href='index.php'>Voltar ao Início</a>";
} else {
    echo "Erro ao excluir usuário.";
}

?>
