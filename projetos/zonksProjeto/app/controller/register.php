<?php
session_start();

include '../models/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($username) || empty($email) || empty($password)) {
        $_SESSION['register_message'] = 'Todos os campos são obrigatórios.';
        exit;
    }

    // Inserir a senha diretamente sem criptografia (NÃO RECOMENDADO)
    $stmt = $conn->prepare("INSERT INTO usuarios (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password); // Insere a senha sem criptografia

    if ($stmt->execute()) {
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        header("Location: ../public/index.php?sucess=1");
        exit();
    } else {
        $_SESSION['register_message'] = 'Erro ao cadastrar usuário.';
        exit();
    }
} else {
    header("Location: ../public/index.php");
    exit();
}

$stmt->close();
$conn->close();
?>
