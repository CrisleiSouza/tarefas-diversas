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
    $sql = "UPDATE usuarios SET password = '$password' WHERE password = '{$_SESSION['password']}'";

    mysqli_query($conn, $sql);



    // Processar upload da imagem de perfil
    if (!empty($_FILES["profile_picture"]["name"])) {
        $targetDir = "../../model/imgs/";
        $fileName = basename($_FILES["profile_picture"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Permitir certos formatos de arquivo
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            // Upload do arquivo para o servidor
            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFilePath)) {
                // Atualizar o caminho da imagem de perfil no banco de dados
                $sql = "UPDATE usuarios SET profile_picture = '$fileName' WHERE username = '{$_SESSION['username']}'";
                if (mysqli_query($conn, $sql)) {
                    $_SESSION['profile_picture'] = $fileName;
                }
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