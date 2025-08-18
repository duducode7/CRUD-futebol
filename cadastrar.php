<?php
// Cadastro com erros de sintaxe e falta de validação
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $numero_camisa = $_POST["numero_camisa"];
    $posicao = $_POST["posicao"];
    $sql = "INSERT INTO usuarios (nome, camisa, posicao) VALUES ('$nome', '$numero_camisa', '$posicao')";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->$error;
    };
    header("Location: index.php");
}
$conn->close();

?>

<form method="POST">
    Nome e Sobrenome: <input type="text" name="nome" required><br>
    N° Camisa: <input type="number" name="numero_camisa" required><br>
    Posição: <input type="text" name="posicao" required><br>
    <input type="submit" value="Cadastrar">
</form>
