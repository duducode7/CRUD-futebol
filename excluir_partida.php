<?php
include("conexao.php");

$id = $_GET["id"];
$sql = "DELETE FROM partidas WHERE id = $id";
mysqli_query($conn, $sql);

header("Location: index.php?mostrar=partidas");
exit;
?>