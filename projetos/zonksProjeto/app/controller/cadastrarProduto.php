<?php
session_start();
require_once('../models/db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produto = mysqli_real_escape_string($conn, $_POST['produto']);

    if (empty($produto)) {
        echo "<script>alert('Por favor, selecione um produto.');</script>";
        header("Location: ../views/pages/cadastrarproduto.php");
        exit();
    }

    $query = "SELECT * FROM produto WHERE produto = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $produto);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        echo "<script>alert('Produto ja cadastrado!');</script>";
        header("Location:  ../views/pages/cadastrarproduto.php");
        exit();
    } else {
        $insertQuery = "INSERT INTO produto (produto) VALUES (?)";
        $stmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($stmt, "s", $produto);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['produto'] = $produto;            
            echo "<script>alert('Cadastro realizado com sucesso!');</script>";
            header("Location: ../views/pages/cadastrarproduto.php");
            exit();
        } else {
            echo "Erro ao cadastrar: " . mysqli_error($conn);
            exit();
        }
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>