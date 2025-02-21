  // Seleciona os elementos necessários
  let loginForm = document.getElementById("login");
  let registerForm = document.getElementById("register");
  let loginBtn = document.getElementById("loginBtn");
  let registerBtn = document.getElementById("registerBtn");
  let slider = document.getElementById("btn");

  // Função para exibir o formulário de registro e ocultar o de login
  function register() {
    loginForm.style.left = "-100%"; // Move o formulário de login para a esquerda
    registerForm.style.left = "5%"; // Move o formulário de registro para a esquerda (exibe)
    slider.style.left = "110px"; // Move o slider para o botão de registro
    registerBtn.style.left = "0";
    loginBtn.style.left = "110px";
    slider.style.width = "130px";
    loginBtn.style.width = "130px";
  }

  // Função para exibir o formulário de login e ocultar o de registro
  function login() {
    loginForm.style.left = "5%"; // Move o formulário de login para a direita (exibe)
    registerForm.style.left = "100%"; // Move o formulário de registro para a direita
    slider.style.left = "0"; // Move o slider para o botão de login
    registerBtn.style.left = "110px";
    loginBtn.style.left = "0";
  }

  //Requisições de inputs

  let usernameIpt = document.getElementById("usernameIpt").value;
  let passIpt = document.getElementById("passIpt").value;

          