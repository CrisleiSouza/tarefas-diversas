<?php
session_start();
require_once(__DIR__ . '../../models/db_connection.php');

// Verifica se todos os campos obrigatórios foram preenchidos
if (empty($_POST['nome']) || empty($_POST['numeroDeTelefone']) || empty($_POST['email']) || empty($_POST['empresa']) || empty($_POST['produto'])) {
    echo "<script>alert('Preencha todos os campos!');</script>";
    header("Location: ../views/pages/cadastrar.php");
    exit();
}

// Obtém e sanitiza os dados do formulário
$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$numero = mysqli_real_escape_string($conn, $_POST['numeroDeTelefone']); // Aqui ajustamos para 'numeroDeTelefone'
$email = mysqli_real_escape_string($conn, $_POST['email']);
$empresa = mysqli_real_escape_string($conn, $_POST['empresa']);
$produto = mysqli_real_escape_string($conn, $_POST['produto']);

// Verifica se o usuário já está cadastrado
$query = "SELECT * FROM clientes WHERE nome = ? AND numero = ? AND email = ? AND empresa = ? AND produto = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "sssss", $nome, $numero, $email, $empresa, $produto);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {
    // Usuário já cadastrado, redireciona e exibe mensagem
    echo "<script>alert('Usuário já cadastrado!');</script>";
    header("Location: ../views/pages/cadastrar.php");
    exit();
} else {
    // Insere os dados do cliente no banco de dados
    $insertQuery = "INSERT INTO clientes (nome, numero, email, empresa, produto, data_cadastro) VALUES (?, ?, ?, ?, ?, CURDATE())";
    $stmt = mysqli_prepare($conn, $insertQuery);
    mysqli_stmt_bind_param($stmt, "sssss", $nome, $numero, $email, $empresa, $produto);

    // Executa a declaração preparada de inserção
    if (mysqli_stmt_execute($stmt)) {
        // Verifica se houve sucesso na inserção
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // Cadastro realizado com sucesso, redireciona e exibe mensagem
            $_SESSION['nome'] = $nome;
            $_SESSION['email'] = $email;
            $_SESSION['numero'] = $numero;
            $_SESSION['empresa'] = $empresa;
            $_SESSION['produto'] = $produto;
            
            echo "<script>alert('Cadastro realizado com sucesso!');</script>";
            header("Location: ../views/pages/cadastrar.php");
            exit();
        } else {
            // Se nenhuma linha foi afetada, houve um erro na inserção
            echo "Erro ao cadastrar: Não foi possível inserir os dados.";
        }
    } else {
        // Erro ao executar a declaração preparada
        echo "Erro ao cadastrar: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

// Fechar a conexão com o banco de dados após utilização
mysqli_close($conn);
?>
