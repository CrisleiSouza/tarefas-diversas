 <?php
include '../models/db_connection.php';

if (empty($_POST['username']) || empty($_POST['password'])) {
    header("Location: ../public/index.php");
    exit();
}

$usuario = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$query = "SELECT * FROM usuarios WHERE username = '{$usuario}' AND password = '{$password}'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Erro na consulta ao banco de dados: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);

if ($row) {
    // Login bem-sucedido
    session_start();
    $_SESSION['username'] = $row['username'];

    if ($row['username'] === $usuario) {
        // Redirecionar para a página do admin
        header("Location: ../views/pages/dashboard.php");
    } 
    exit();
} else {
    // Login falhou
    header('Location: ../public/index.php?error=1');
    exit();
}
?>
