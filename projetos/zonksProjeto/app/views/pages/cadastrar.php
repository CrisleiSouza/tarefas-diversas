<?php
session_start(); // Inicia a sessão

// Verificar se o usuário está autenticado
if (!isset($_SESSION["username"])) {
    // Usuário não autenticado, redirecionar para a página de login
    header("Location: ../../public/index.php");
    exit();
}

include "../../models/db_connection.php";
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
    <link rel="stylesheet" href="../css/cadaster.css">
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
                    <h2>Clientes</h2>
                    <ion-icon name="add-circle-outline" onclick="showRegister()" id="showFormIcon" style="width:70px;height:40px; cursor:pointer;"></ion-icon>
                </div>

                <table id="table_client">
                    <thead>
                        <tr>
                            <td>Nome</td>
                            <td>Número</td>
                            <td>Email</td>
                            <td>Empresa</td>
                            <td>Produto</td>
                            <td>Ações</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql =
                            "SELECT id, nome, numero, email, empresa, produto FROM clientes";
                        $result = $conn->query($sql);

                        if ($result !== false && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" .
                                    htmlspecialchars($row["nome"]) .
                                    "</td>";
                                echo "<td>" .
                                    htmlspecialchars($row["numero"]) .
                                    "</td>";
                                echo "<td>" .
                                    htmlspecialchars($row["email"]) .
                                    "</td>";
                                echo "<td>" .
                                    htmlspecialchars($row["empresa"]) .
                                    "</td>";
                                echo "<td>" .
                                    htmlspecialchars($row["produto"]) .
                                    "</td>";
                                echo "<td>
                                        <button class='edit-button' onclick='showUpdate(" .
                                    $row["id"] .
                                    ", \"" .
                                    htmlspecialchars($row["nome"]) .
                                    "\", \"" .
                                    htmlspecialchars($row["numero"]) .
                                    "\", \"" .
                                    htmlspecialchars($row["email"]) .
                                    "\", \"" .
                                    htmlspecialchars($row["empresa"]) .
                                    "\", \"" .
                                    htmlspecialchars($row["produto"]) .
                                    "\")'><ion-icon name='pencil-outline' class='pencil-icon'></ion-icon></button>
                                        <form style='display:inline;' method='POST' action='../../controller/deletarCliente.php' onsubmit='return confirmDelete()'>
                                            <input type='hidden' name='id' value='" .
                                    $row["id"] .
                                    "'>
                                            <button class='delete-button' type='submit'><ion-icon name='trash-outline'></ion-icon></button>
                                        </form>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>0 resultados</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="add-box" id="add-box">
                <ion-icon name="close-circle-outline" onclick="hideRegister()" id="closeicon" style="width:70px;height:40px; cursor:pointer;"></ion-icon>
                <h1>Cadastrar Cliente</h1>
                <form action="../../controller/processarCadastro.php" method="POST">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" placeholder="Insira o nome ...">
                    <label for="numero">Telefone:</label>
                    <input type="text" id="numeroDeTelefone" maxlength="13" onkeyup="formatarNumero()" placeholder="Número" name="numeroDeTelefone">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="emailDoFdp" placeholder="Insira email ...">
                    <label for="empresa">Empresa:</label>
                    <select name="empresa" id="empresa">
                        <option value="">Selecione uma empresa</option>
                        <?php
                        $sql = "SELECT empresa FROM empresas";
                        $result = $conn->query($sql);

                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $empresa = htmlspecialchars($row["empresa"]);
                                echo "<option value=\"$empresa\">$empresa</option>";
                            }
                        } else {
                            echo "<option value=\"\">Nenhuma empresa encontrada</option>";
                        }
                        ?>
                    </select>
                    <label for="produto">Produto:</label>
                    <option value="">Selecione um produto</option>
                    <select name="produto" id="update-produto">
                    <?php
                    $sql = "SELECT produto FROM produto";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $produto = htmlspecialchars($row["produto"]);
                            echo "<option value=\"$produto\">$produto</option>";
                        }
                    } else {
                        echo "<option value=\"\">Nenhum produto encontrado</option>";
                    }
                    ?>
                    </select>
                    <input type="submit" value="Cadastrar">
                </form>
            </div>

            <div class="add-box" id="update-box">
    <ion-icon name="close-circle-outline" onclick="hideUpdate()" id="closeicon" style="width:70px;height:40px; cursor:pointer;"></ion-icon>
    <h1>Atualizar Cliente</h1>
    <form action="../../controller/atualizarCliente.php" method="POST">
        <input type="hidden" name="id" id="update-id">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="update-nome">
        <label for="numero">Telefone:</label>
        <input type="text" id="update-numero" maxlength="16" onkeyup="formatarNumeroUpdate()" placeholder="Número" name="numeroDeTelefone">
        <label for="email">Email:</label>
        <input type="email" name="email" id="update-email">
        <label for="empresa">Empresa:</label>
        <select name="empresa" id="update-empresa">
            <option value="">Selecione uma empresa</option>
            <?php
            $sql = "SELECT empresa FROM empresas";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $empresa = htmlspecialchars($row["empresa"]);
                    echo "<option value=\"$empresa\">$empresa</option>";
                }
            } else {
                echo "<option value=\"\">Nenhuma empresa encontrada</option>";
            }
            ?>
        </select>
        <label for="produto">Produto:</label>
        <select name="produto" id="update-produto">
            <option value="">Selecione um produto</option>
            <?php
            $sql = "SELECT produto FROM produto";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $produto = htmlspecialchars($row["produto"]);
                    echo "<option value=\"$produto\">$produto</option>";
                }
            } else {
                echo "<option value=\"\">Nenhum produto encontrado</option>";
            }
            ?>
        </select>
        <input type="submit" value="Atualizar">
    </form>
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
