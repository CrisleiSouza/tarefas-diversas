<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" href="../views/css/form.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Zonks</title>
</head>

<body>


<?php if (isset($_POST['error']) && $_POST['error'] === 1): ?>
    <script>
         alert('Senha ou usuario incorretos');
    </script>
<?php endif; ?>

<?php if(isset($_POST['sucess']) && $_POST['sucess']&& $_POST['sucess'] == 1): ?>
    <script>
        alert('Login efetuado com sucesso');
    </script>
    <?php endif;?>


<div class="hero">
    <img src="imgs/zonks-logo.jpg" alt="logo" style="position: relative; left: 40%; margin-top:10px; " width="250px" height="100px">
    <div class="form-box" style="margin-top: 10px;">
    <!-- Box_Button -->
        <div class="button-box">
            <div id="btn"></div>
            <button type="button" class="toggle-btn" onclick="login()" id="loginBtn">Log In</button>
            <button type="button" class="toggle-btn" onclick="register()" id="registerBtn">register</button>
        </div>
        <!-- ============= login-Form ============= -->
        <form class="input-group" id="login" action="../controller/login.php" method="POST">
            <input type="text" id="usernameIpt" class="input-field" name="username" placeholder="username" required>
            <input type="password" id="passIpt" class="input-field" name="password" placeholder="password" required>
            <a href="#">Esqueci minha senha</a>
            <br>
            <button type="submit" class="submit-btn">Log In</button>
        </form>
        <!-- =========== Register-form ============ -->
        <form class="input-group" id="register" action="../controller/register.php" method="POST">
            <input type="text" class="input-field" placeholder="username" name="username" required>
            <input type="email" class="input-field" placeholder="email" name="email" required>
            <input type="password" id="passRegister" class="input-field" placeholder="password" name="password" required>
            <button type="submit" class="submit-btn">Register</button>
        </form>
    </div>
</div>

<script src="../views/js/formAnimations.js"></script>
<script src="../views/js/alert.js"></script>

</body>
</html>
