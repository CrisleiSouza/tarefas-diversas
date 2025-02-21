<?php
include '../models/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'], $_POST['produto'])) {
        $id = $_POST['id'];
        $produto = $_POST['produto'];

        // Query para atualizar o produto no banco de dados
        $query = "UPDATE produto SET produto = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "si", $produto, $id);

        if (mysqli_stmt_execute($stmt)) {
            echo "Produto atualizado com sucesso.";
            header('Location: ../views/pages/cadastrarproduto.php');
        } else {
            echo "Erro ao atualizar o produto: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        exit();
    } else {
        echo "Dados incompletos para atualização.";
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query para obter os dados do produto pelo ID
    $query = "SELECT * FROM produto WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        // Aqui você pode exibir um formulário pré-preenchido com os dados atuais do produto
        $produto = $row['produto'];
        // Exemplo de formulário
        echo "<form action='editarProduto.php' method='POST'>";
        echo "<input type='hidden' name='id' value='" . $id . "'>";
        echo "<label for='produto'>Nome do Produto:</label>";
        echo "<input type='text' id='produto' name='produto' value='" . htmlspecialchars($produto) . "' required>";
        echo "<input type='submit' value='Salvar'>";
        echo "</form>";
    } else {
        echo "Produto não encontrado.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo "ID do produto não fornecido.";
}
?>
