<?php
session_start(); // Inicia a sessão

// Verificar se o usuário está autenticado
if (!isset($_SESSION['username'])) {
    // Usuário não autenticado, redirecionar para a página de login
    header('Location: ../../index.php');
    exit;
}

// Estabelecer conexão com o banco de dados
$conn = mysqli_connect('localhost', 'root', '', 'cadastroteste');

// Verificar a conexão
if (!$conn) {
    die("Erro de conexão: " . mysqli_connect_error());
}

// Consulta SQL para obter a contagem de clientes por mês neste ano
$sql = "SELECT MONTH(data_cadastro) AS mes, COUNT(*) AS total_clientes
        FROM clientes
        WHERE YEAR(data_cadastro) = YEAR(CURDATE())
        GROUP BY mes
        ORDER BY mes";

// Executar a consulta
$result = mysqli_query($conn, $sql);

// Array para armazenar os dados dos clientes por mês
$dadosClientesPorMes = [];
$dataCadastro = [];

// Iterar sobre os resultados da consulta e construir o array de dados por mês
while ($row = mysqli_fetch_assoc($result)) {
    $mes = $row['mes'];
    $totalClientes = $row['total_clientes'];
    $dadosClientesPorMes[] = $totalClientes;
    $dataCadastro[] = date('M', mktime(0, 0, 0, $mes, 1)); // Obtém o nome abreviado do mês (Jan a Dec)
}


// Transformar o array de meses em JSON para uso no JavaScript
$mesesJson = json_encode($dataCadastro);

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
    <link rel="stylesheet" href="../css/colaborators.css">
    <link rel="stylesheet" href="../css/dashboard.css">
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

    <!-- ================= The Guys ================ -->

    <div class="colaborators">
  <div class="cardHeader">
    <h2>Colaboradores do projeto</h2>
  </div>
  <div class="collab-item">
    <div class="imgBx"><img src="../../public/imgs/felippi.jpg" alt=""></div>
    <div>
      <h1>Felippi Ascendino</h1>
      <h3>CSS, JavaScript, PHP, MySQL.</h3>
    </div>
  </div>
  <div class="collab-item">
    <div class="imgBx"><img src="../../public/imgs/otario.jpg" alt=""></div>
    <div>
      <h1>Fabio Souza</h1>
      <h3>PHP, MySQL.</h3>
    </div>
  </div>
  <div class="collab-item">
    <div class="imgBx"><img src="../../public/imgs/cris.jpg" alt=""></div>
    <div>
      <h1>Crislei Rosa</h1>
      <h3>CSS, PHP, JavaScript.</h3>
    </div>
  </div>
  <div class="collab-item">
    <div class="imgBx"><img src="../../public/imgs/carlos.jpg" alt=""></div>
    <div>
      <h1>Carlos e Lopes</h1>
      <h3>CSS, JavaScript.</h3>
    </div>
  </div>
</div>


    </div>
</div>



<!-- =========== Scripts =========  -->
<script src="../js/main.js"></script>
<script src="../js/main_v2.js"></script>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="../js/charts.js"></script>
<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script>
    // Dados do gráfico
    var dadosGrafico = <?php echo json_encode($dadosClientesPorMes); ?>;
    var meses = <?php echo $mesesJson; ?>;

    // Configuração do gráfico ApexCharts
    var options = {
        chart: {
            type: 'bar'
        },
        series: [{
            name: 'Clientes',
            data: dadosGrafico
        }],
        xaxis: {
            categories: meses
        }
    };

    // Renderiza o gráfico ApexCharts
    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>

</body>
</html>
<?php
// Fechar a conexão com o banco de dados após utilização
mysqli_close($conn);
?>?>