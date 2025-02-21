<?php
session_start();

// Verifica se existe uma mensagem de erro de login na sessão
if (isset($_SESSION['login_message'])) {
    echo '<div style="border: 1px solid red; padding: 10px; margin-bottom: 20px;">';
    echo '<h2 style="color: red;">Erro</h2>';
    echo '<p>' . $_SESSION['login_message'] . '</p>';
    echo '</div>';

    // Remove a mensagem de erro da sessão após exibir
    unset($_SESSION['login_message']);
}
?>
