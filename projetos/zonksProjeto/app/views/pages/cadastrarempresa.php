<?php
session_start(); // Inicia a sessão

// Verificar se o usuário está autenticado
if (!isset($_SESSION["username"])) {
    // Usuário não autenticado, redirecionar para a página de login
    header("Location: ../../public/index.php");
    exit();
}

include "../../models/db_connection.php";

// Verifica se houve um envio de formulário para cadastrar uma nova empresa
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["empresa"])) {
    $empresa = $_POST["empresa"];

    // Prepara a query para inserir a empresa no banco de dados
    $sql = "INSERT INTO empresas (empresa) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $empresa);

    if ($stmt->execute()) {
        $_SESSION['alert_message'] = 'Empresa cadastrada com sucesso.';
    } else {
        $_SESSION['alert_message'] = 'Erro ao cadastrar empresa: ' . $stmt->error;
    }

    // Redireciona de volta para a página de cadastro de empresa
    header("Location: cadastrarempresa.php");
    exit();
}

// Query para obter empresas do banco de dados
$query = "SELECT empresa, id FROM empresas";
$result = mysqli_query($conn, $query);

if (!$result) {
    $_SESSION['alert_message'] = 'Erro ao buscar empresas: ' . mysqli_error($conn);
    header("Location: ../../public/index.php");
    exit();
}
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
    <link rel="stylesheet" href="../css/cadasterEmpresa.css">
    <style>
        button {
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
            transition-duration: 0.4s;
        }

        .edit-button {
            background-color: #007bff;
        }

        .edit-button:hover {
            background-color: white;
            color: #007bff;
            border: 1px solid #007bff;
        }

        .delete-button {
            background-color: #dc3545;
        }

        .delete-button:hover {
            background-color: white;
            color: #dc3545;
            border: 1px solid #dc3545;
        }

        .info-button {
            background-color: #7FFF00;
        }

        .info-button:hover {
            background-color: white;
            color: #7FFF00;
            border: 1px solid #7FFF00;
        }

        ion-icon {
            vertical-align: middle;
            margin-right: 5px;
        }

        .add-box {
            position: absolute;
            right: 0%;
            top: 90%;
            transform: translate(-50%, -50%);
            z-index: 1;
            width: 50rem;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            transition: opacity 0.5s ease, transform 0.5s ease; /* Adicionando uma transição suave para opacidade e transform */
            border-radius: 10px;
            box-shadow: 3px 9px 24px 0px rgba(0, 0, 0, 0.35);
            display: none; /* Inicialmente oculto */
            flex-direction: column;
            align-items: center;
        }

        /* Adicionando a animação para exibir o elemento */
        .add-box.show {
            display: flex;
            opacity: 1;
            transform: translate(-50%, -50%) scale(1); /* Adicionando escala para um efeito de zoom */
        }

        .add-box h1 {
            font-size: 24px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .add-box form {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .add-box label {
            font-size: 16px;
            color: #555;
            margin-bottom: 5px;
        }

        .add-box input,
        .add-box select {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 14px;
            line-break: column;
        }

        .add-box input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        .add-box input[type="submit"]:hover {
            background-color: #0056b3;
        }

        #closeicon {
            width: 70px;
            height: 40px;
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 0;
        }

        .cadastroempresa {
            position: relative;
            display: grid;
            height: 12rem;
            width: 12rem;
            padding: 20px;
            background: var(--white);
            box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
            border-radius: 20px;
            left: 75rem;
            bottom: 16rem;
        }

        .btn {
            position: relative;
            font-size: 17px;
            text-transform: uppercase;
            text-decoration: none;
            display: inline-block;
            border-radius: 1em;
            transition: all .2s;
            border: none;
            font-family: inherit;
            font-weight: 500;
            color: #fff;
            background-color: #2f3061;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .btn:active {
            transform: translateY(-1px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }

        .btn::after {
            content: "";
            display: inline-block;
            height: 100%;
            width: 100%;
            border-radius: 100px;
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
            transition: all .4s;
        }

        .btn::after {
            background-color: #2f3061;
        }

        .btn:hover::after {
            transform: scaleX(1.3) scaleY(1.6);
            opacity: 0;
        }

        /* CSS para fade */
        .fade-in {
            opacity: 1;
            transition: opacity 0.5s ease-in;
        }

        .fade-out {
            opacity: 0;
            transition: opacity 0.5s ease-out;
            display: none;
        }

        .hidden {
            opacity: 0;
            display: none;
        }

        /* Adicionando estilo para alinhar o texto à esquerda */
        #table_client td {
            text-align: left;
            padding: 8px;
        }
    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                       <li>
                <img src="../../public/imgs/zonks-logo-branca.png" alt="LOGO" width="250" height="100" class="logo">
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
    </div>

    <!-- ========================= Main ==================== -->
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
            <div class="user" onclick="entrarPerfil()">
                <?php echo $_SESSION["imagemHTML"]; ?>
            </div>
        </div>

        <!-- ================ Order Details List ================= -->
        <div class="details">
            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>Empresa</h2>
                </div>
                <div style="width: 50px; position: relative; left: 45rem; height: 50px; bottom: 3rem;">
                    <ion-icon name="add-circle-outline" onclick="showEmpresa()" id="showFormIcon" style="width:70px;height:40px; cursor:pointer;"></ion-icon>
                </div>
                <table id="table_client">
                <thead>
                        <tr>
                            <th>Empresa</th>
                            <th>Açao</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['empresa']) . "</td>";
                        echo "<td>
                                <form style='display:inline;' method='POST' action='../../controller/deletarEmpresa.php' onsubmit='return confirmDelete()'>
                                    <input type='hidden' name='id' value='" . $row["id"] . "'>
                                    <button class='delete-button' type='submit'><ion-icon name='trash-outline'></ion-icon></button>
                                </form>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <!-- Formulário para adicionar empresa -->
            <div class="add-box hidden" id="empresa-box">
                <ion-icon name="close-circle-outline" onclick="hideEmpresa()" id="closeicon" style="width:70px;height:40px; cursor:pointer;"></ion-icon>
                <h1>Cadastrar Empresa</h1>
                <form action="../../controller/cadastrarEmpresa.php" method="POST">
                    <label for="nome_empresa">Nome da empresa:</label>
                    <input type="text" id="nome_empresa" name="nome_empresa" required>
                    <input type="submit" value="Adicionar">
                </form>
            </div>
        </div>
    </div>


    <script>
        
    </script>

    <!-- =========== Scripts =========  -->
    <script src="../js/main.js"></script>
    <script src="../js/main_v2.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
<style>
    /* CSS para fade */
.fade-in {
    opacity: 1;
    transition: opacity 0.5s ease-in;
}

.fade-out {
    opacity: 0;
    transition: opacity 0.5s ease-out;
    display: none;
}

.hidden {
    opacity: 0;
    display: none;
}

</style>
</html>
