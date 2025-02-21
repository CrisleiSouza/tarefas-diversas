<?php
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['username'])) {
    header('Location: ../../public/index.php');
    exit;
}

// Estabelecer conexão com o banco de dados
$conn = mysqli_connect('localhost', 'root', '', 'cadastroteste');

// Verificar a conexão
if (!$conn) {
    die("Erro de conexão: " . mysqli_connect_error());
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Atualizar nome de usuário
    $sql = "UPDATE usuarios SET username = '$username' WHERE username = '{$_SESSION['username']}'";
    mysqli_query($conn, $sql);


    // Atualizar senha se fornecida
    if (!empty($password)) {
        $sql = "UPDATE usuarios SET password = '$password' WHERE username = '{$_SESSION['username']}'";
        mysqli_query($conn, $sql);
    }else{
        header('Location: ../../public/index.php');
    }
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $uploadDir = "uploads/"; // Diretório onde as imagens serão armazenadas

    // Verifica se o diretório de uploads existe, senão cria
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Cria o diretório com permissões de escrita
    }

    $uploadFile = $uploadDir . basename($_FILES["image"]["name"]); // Caminho completo do arquivo

    // Verifica se o arquivo é uma imagem
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
    $allowedTypes = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowedTypes)) {
        echo "Apenas arquivos JPG, JPEG, PNG e GIF são permitidos.";
    } else {
        // Tenta mover o arquivo para o diretório de uploads
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $uploadFile)) {
            echo "Arquivo foi carregado com sucesso.<br>";

            // Exibe a imagem carregada
            echo '<img src="' . $uploadFile . '" alt="Imagem Carregada">';
        } else {
            echo "Ocorreu um erro ao carregar o arquivo.";
        }
    }
}
    // Atualizar sessão com novo nome de usuário
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;

    // Redirecionar para a página de configurações com uma mensagem de sucesso
    header("Location: ../../views/pages/config.php?status=success");
    exit();
}

// Fechar a conexão com o banco de dados
mysqli_close($conn);
?>
