<?php
session_start();
require_once('../models/db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $empresa = mysqli_real_escape_string($conn, $_POST['nome_empresa']);

    if (empty($empresa)) {
        echo "<script>alert('Por favor, selecione uma empresa.');</script>";
        header("Location: ../views/pages/cadastrar.php");
        exit();
    }

    $query = "SELECT * FROM empresas WHERE empresa = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $empresa);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        echo "<script>alert('Empresa já cadastrada!');</script>";
        header("Location:  ../views/pages/cadastrarempresa.php");
        exit();
    } else {
        $insertQuery = "INSERT INTO empresas (empresa) VALUES (?)";
        $stmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($stmt, "s", $empresa);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['empresa'] = $empresa;            
            echo "<script>alert('Cadastro realizado com sucesso!');</script>";
            header("Location: ../views/pages/cadastrarempresa.php");
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