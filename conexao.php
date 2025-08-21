<?php

$host = "localhost";
$user = "root";
$password = "root";
$db = "futebol_db";

$conn = mysqli_connect($host, $user, $password, $db); 
if ($conn->connect_error) {
    die("Conexão falhou" . $conn->connect_error);
};