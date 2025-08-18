<?php
// Listagem corrigida
include("conexao.php");

$sql = "SELECT * FROM usuarios";
$resultado = mysqli_query($conn, $sql);

echo "<h1>Lista de Usuários</h1>";

if (mysqli_num_rows($resultado) > 0) {
    while ($linha = mysqli_fetch_array($resultado)) {
        echo "Nome: " . $linha['nome'] . "<br>";
        echo "Email: " . $linha['email'] . "<br>";
        echo "<a href='editar.php?nome={$linha['nome']}&email={$linha['email']}'>Editar</a> ";
        echo "<a href='excluir.php?email={$linha['email']}&nome={$linha['nome']}'>Excluir</a><br><br>";
    }
} else {
    echo "Nenhum registro encontrado";
    echo "<br><br>";
}
?>
<a href='cadastrar.php'>Cadastrar novo</a>