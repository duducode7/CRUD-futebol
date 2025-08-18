<?php
// Conexão com o banco (contém erro de variável e de conexão)
$host = "localhost";
$user = "root";
$password = "root";
$db = "crud_exemplo";

$conn = mysqli_connect($host, $user, $password, $db); 
if ($conn->connect_error) {
    die("Conexão falhou" . $conn->connect_error);
};