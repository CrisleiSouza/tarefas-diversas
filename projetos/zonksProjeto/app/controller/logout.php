<?php

session_start();

// Destroi todas as variáveis de sessão
session_destroy();

// Redireciona para a página de login ou outra página após o logout
header("Location: ../public/index.php");
exit(); // Encerra o script após o redirecionamento

?>