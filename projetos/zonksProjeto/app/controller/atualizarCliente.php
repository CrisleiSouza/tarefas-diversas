<?php
session_start();
require_once(__DIR__ . '../../models/db_connection.php');

// Verifica se todos os campos obrigatórios foram preenchidos
if (empty($_POST['id']) || empty($_POST['nome']) || empty($_POST['numeroDeTelefone']) || empty($_POST['email']) || empty($_POST['empresa']) || empty($_POST['produto'])) {
    echo "<script>alert('Preencha todos os campos!');</script>";
    header("Location: ../views/pages/atualizar.php");
    exit();
}

// Obtém e sanitiza os dados do formulário
$id = mysqli_real_escape_string($conn, $_POST['id']);
$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$numero = mysqli_real_escape_string($conn, $_POST['numeroDeTelefone']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$empresa = mysqli_real_escape_string($conn, $_POST['empresa']);
$produto = mysqli_real_escape_string($conn, $_POST['produto']);

// Atualiza os dados do cliente no banco de dados
$updateQuery = "UPDATE clientes SET nome = ?, numero = ?, email = ?, empresa = ?, produto = ? WHERE id = ?";
$stmt = mysqli_prepare($conn, $updateQuery);
mysqli_stmt_bind_param($stmt, "sssssi", $nome, $numero, $email, $empresa, $produto, $id);

if (mysqli_stmt_execute($stmt)) {
    // Verifica se houve sucesso na atualização
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Atualização realizada com sucesso, redireciona e exibe mensagem
        $_SESSION['nome'] = $nome;
        $_SESSION['email'] = $email;
        $_SESSION['numero'] = $numero;
        $_SESSION['empresa'] = $empresa;
        $_SESSION['produto'] = $produto;
        
        echo "<script>alert('Cliente atualizado com sucesso!');</script>";
        header("Location: ../views/pages/cadastrar.php");
        exit();
    } else {
        // Se nenhuma linha foi afetada, houve um erro na atualização
        echo "Erro ao atualizar: Não foi possível atualizar os dados.";
    }
} else {
    // Erro ao executar a declaração preparada
    echo "Erro ao atualizar: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
