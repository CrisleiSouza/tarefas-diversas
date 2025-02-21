<?php
session_start();
// Inicia a sessão
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- arquivos style -->
  <link rel="shortcut icon" href="../../public/imgs/icon.png" type="image/x-icon">
  <link href="../css/calendario.css" rel="stylesheet">
  <link href="../css/darkMode.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/dashboard.css">
  <title>Calendario</title>
</head>

<body>
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
    <!-- ========================= Main ==================== -->
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
            <div class="dark" style="display: none;">
                <input id="switch" type="checkbox" name="theme">
                <label for="switch">Toggle</label>
            </div>

            <div class="user" onclick="entrarPerfil()">
                <?php echo $_SESSION["imagemHTML"]; ?>
            </div>
        </div>

        <div id="container">
            <div id="header">
                <div id="monthDisplay"></div>

                <div class= "btn1">
                    <button id="backButton">Voltar</button>
                    <button id="nextButton">Próximo</button>
                </div>

            </div>

            <div id="weekdays">
                <div>Domingo</div>
                <div>Segunda-feira</div>
                <div>Terça-feira</div>
                <div>Quarta-feira</div>
                <div>Quinta-feira</div>
                <div>Sexta-feira</div>
                <div>Sábado</div>
            </div>

            <!-- div dinamic -->
            <div id="calendar" ></div>
        </div>

        <div id="newEventModal">
            <h2>Novo Evento</h2>

            <input id="eventTitleInput" placeholder="Insira o evento .."/>

            <button id="saveButton"> Salvar</button>
            <button id="cancelButton">Cancelar</button>
        </div>

        <div id="deleteEventModal">
            <h2>Evento</h2>

            <div id="eventText"></div><br>

            <button id="deleteButton">Deletar</button>
            <button id="closeButton">Fechar</button>
        </div>

        <div id="modalBackDrop"></div>

        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script src="../js/darkMode.js"></script>
        <script src="../js/main.js"></script>
        <script src="../js/main_v2.js"></script>
    </div>
</div>
</body>
</html>
