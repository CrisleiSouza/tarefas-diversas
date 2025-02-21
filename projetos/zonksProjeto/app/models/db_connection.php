<?php
$servername = "localhost";
$username_db = "root";
$password_db = "";
$database = "cadastroteste";

$conn = new mysqli($servername, $username_db, $password_db, $database);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}
?>
