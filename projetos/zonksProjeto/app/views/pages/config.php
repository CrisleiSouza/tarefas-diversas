<?php
session_start(); // Inicia a sessão

// Verificar se o usuário está autenticado
if (!isset($_SESSION['username'])) {
    // Usuário não autenticado, redirecionar para a página de login
    header('Location: ../../public/index.php');
    exit;
}

// Estabelecer conexão com o banco de dados
$conn = mysqli_connect('localhost', 'root', '', 'cadastroteste');

// Verificar a conexão
if (!$conn) {
    die("Erro de conexão: " . mysqli_connect_error());
}

// Verificar se o formulário foi enviado para atualizar o nome de usuário e a senha
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Atualizar nome de usuário
    if (!empty($_POST['siteName'])) {
        $username = mysqli_real_escape_string($conn, $_POST['siteName']);
        $sqlUsername = "UPDATE usuarios SET username = '$username' WHERE username = '{$_SESSION['username']}'";
        mysqli_query($conn, $sqlUsername);
        $_SESSION['username'] = $username; // Atualizar a sessão com o novo nome de usuário
    }

    // Atualizar senha
    if (!empty($_POST['adminEmail']) && !empty($_POST['itemsPerPage'])) {
        $password = mysqli_real_escape_string($conn, $_POST['adminEmail']);
        $confirmPassword = mysqli_real_escape_string($conn, $_POST['itemsPerPage']);

        if ($password == $confirmPassword) {
            // Atualiza a senha diretamente no banco de dados
            $sqlPassword = "UPDATE usuarios SET password = '$password' WHERE username = '{$_SESSION['username']}'";
            mysqli_query($conn, $sqlPassword);
            $_SESSION['password'] = $password; // Atualizar a sessão com a nova senha
        } else {
            echo "<script>alert('As senhas não coincidem.');</script>";
        }
    }
}
// Verificar se o formulário foi enviado para atualizar a foto de perfil
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_picture"])) {
    $uploadDir = "uploads/"; // Diretório onde as imagens serão armazenadas

    // Verifica se o diretório de uploads existe, senão cria
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Cria o diretório com permissões de escrita
    }

    $uploadFile = $uploadDir . basename($_FILES["profile_picture"]["name"]); // Caminho completo do arquivo

    // Verifica se o arquivo é uma imagem
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
    $allowedTypes = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowedTypes)) {
        echo "<script>alert('Apenas arquivos JPG, JPEG, PNG e GIF são permitidos.');</script>";
    } else {
        // Tenta mover o arquivo para o diretório de uploads
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $uploadFile)) {
            // Salva o caminho da imagem no banco de dados
            $sql = "UPDATE usuarios SET foto_perfil = '$uploadFile' WHERE username = '{$_SESSION['username']}'";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Foto atualizada com sucesso!');</script>";
            } else {
                echo "Erro ao atualizar a foto de perfil: " . mysqli_error($conn);
            }
        } else {
            echo "Ocorreu um erro ao carregar o arquivo.";
        }
    }
}

// Consulta SQL para obter os dados do usuário, incluindo o caminho da foto de perfil
$sql = "SELECT * FROM usuarios WHERE username = '{$_SESSION['username']}'";
$result = mysqli_query($conn, $sql);

// Verifica se o usuário foi encontrado no banco de dados
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    // Define a variável $imagemHTML com o código HTML da imagem de perfil
    $_SESSION['imagemHTML'] = '<img src="' . $row['foto_perfil'] . '" class="profile-picture" alt="Foto de Perfil">';
} else {
    echo "Usuário não encontrado.";
}

// Fechar a conexão com o banco de dados
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="shortcut icon" href="../../public/imgs/icon.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard | ZONKS</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="../css/dashboard.css">
    <style>
        .settings-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
            background-color: #f4f4f4;
        }

        .settings-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 50%;
            text-align: center;
        }

        .settings-content h2 {
            margin-bottom: 20px;
        }

        .settings-content label {
            display: block;
            margin-bottom: 10px;
            text-align: left;
        }

        .settings-content input[type="text"],
        .settings-content input[type="password"],
        .settings-content input[type="file"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .settings-content input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .settings-content input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .profile-picture {
            border-radius: 50%;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <img src="../../public/imgs/zonks-logo-branca.png" alt="LOGO" width="250" height="100"
                        class="logo">
                </li>
                <li>
                    <a href="dashboard.php">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="calendario.php">
                        <span class="icon"><ion-icon name="calendar-outline"></ion-icon></span>
                        <span class="title">Calendário</span>
                    </a>
                </li>
                <li>
                    <a href="cadastrar.php">
                        <span class="icon"><ion-icon name="person-add-outline"></ion-icon></span>
                        <span class="title">Cadastrar clientes</span>
                    </a>
                </li>
                <li>
                    <a href="cadastrarproduto.php">
                        <span class="icon"><ion-icon name="bag-add-outline"></ion-icon></span>
                        <span class="title">Cadastrar produtos</span>
                    </a>
                </li>
                <li>
                    <a href="cadastrarempresa.php">
                        <span class="icon"><ion-icon name="storefront-outline"></ion-icon></span>
                        <span class="title">Cadastrar empresa</span>
                    </a>
                </li>
                <li>
                    <a href="colaboradores.php">
                        <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
                        <span class="title">Colaboradores</span>
                    </a>
                </li>
                <li>
                    <a href="config.php">
                        <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                        <span class="title">Configurações</span>
                    </a>
                </li>

                <li>
                    <a href="../../controller/logout.php">
                        <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                        <span class="title">Log Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div class="user" onclick="entrarPerfil()">
                    <?php echo $_SESSION['imagemHTML']; ?>
                </div>
            </div>

            <div class="settings-container">
                <div class="settings-content">
                    <h2>Alterar Foto de Perfil</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                        enctype="multipart/form-data">
                        <?php echo $_SESSION['imagemHTML']; ?>
                        <br><br>
                        <label for="profile_picture">Selecionar Nova Foto:</label>
                        <input type="file" id="profile_picture" name="profile_picture"><br><br>
                        <input type="submit" value="Salvar Foto de Perfil">
                    </form>
                </div>
            </div>

            <div class="settings-container">
                <div class="settings-content">
                    <h2>Alterar Nome de Usuário e Senha</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <label for="siteName">Novo Nome de Usuário:</label>
                        <input type="text" id="siteName" name="siteName"><br><br>
                        <label for="adminEmail">Nova Senha:</label>
                        <input type="password" id="adminEmail" name="adminEmail"><br><br>
                        <label for="itemsPerPage">Confirmar Nova Senha:</label>
                        <input type="password" id="itemsPerPage" name="itemsPerPage"><br><br>
                        <input type="submit" value="Salvar Nome de Usuário e Senha">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="../js/main_v2.js"></script>
    <!-- ====== ionicons ======= -->
    <script type="module"
        src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule
        src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
