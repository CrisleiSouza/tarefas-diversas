// add hovered class to selected list item
let list = document.querySelectorAll(".navigation li");

function activeLink() {
    list.forEach((item) => {
        item.classList.remove("hovered");
    });
    this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));

// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
    navigation.classList.toggle("active");
    main.classList.toggle("active");
};


// ========= Adicionar elemento na tablea ==========

/*function addBtn(){
    let form_add = document.getElementById("add-box");
    form_add.style.display = "block";
}*/




// ===================== Dark theme function (jquery) ====================//
$(function(){
    // Verifica se o modo noturno está ativado
    var nightIcon = localStorage.getItem('night') === 'yes';

    // Adiciona ou remove a classe 'bodyNoite' com base no estado atual do modo noturno
    $('body').toggleClass('bodyNoite', nightIcon);

    // Manipula o clique no ícone de alternância de modo noturno
    $('.nightIcon').click(function(){
        // Alterna a classe 'bodyNoite' no corpo do documento
        $('body').toggleClass('bodyNoite', !nightIcon);

        // Atualiza o valor de 'nightIcon' com base na presença da classe 'bodyNoite'
        nightIcon = !nightIcon;

        // Salva o estado do modo noturno no armazenamento local
        localStorage.setItem('night', nightIcon ? 'yes' : 'no');
    });
});



// function clicado() {
//     // Verifica se o modo noturno está ativado
//     var nightIcon = localStorage.getItem('night') === 'yes';

//     // Adiciona ou remove a classe 'bodyNoite' com base no estado atual do modo noturno
//     $('*').toggleClass('bodyNoite', nightIcon);

//     // Manipula o clique no ícone de alternância de modo noturno
//     $('.nightIcon').click(function(){
//         // Alterna a classe 'bodyNoite' no corpo do documento
//         $('*').toggleClass('bodyNoite', !nightIcon);

//         // Atualiza o valor de 'nightIcon' com base na presença da classe 'bodyNoite'
//         nightIcon = !nightIcon;

//         // Atualiza o estilo dos elementos com a classe 'numbers' com base no estado do modo noturno
//         $('.cardBox .card .numbers').css({
//             'color': nightIcon ? 'your-dark-theme-color' : 'var(--blue)'
//             // Substitua 'your-dark-theme-color' pela cor que você deseja aplicar no modo noturno
//         });

//         // Salva o estado do modo noturno no armazenamento local
//         localStorage.setItem('night', nightIcon ? 'yes' : 'no');
//     });
// }


function showRegister() {
    const element = document.getElementById('add-box');
    element.classList.remove('hidden', 'fade-out');
    element.classList.add('fade-in');
    element.style.display = 'block';

}

function hideRegister() {
    const element = document.getElementById('add-box');
    element.classList.remove('fade-in');
    element.classList.add('fade-out');
    setTimeout(() => {
        element.classList.add('hidden');
        element.style.display = 'none';
    }, 500); // Tempo deve coincidir com a duração da transição CSS
}

 function showEmpresa() {
         const element = document.getElementById('empresa-box');
         element.classList.remove('hidden', 'fade-out');
         element.classList.add('fade-in');
         element.style.display = 'block';
    }

 function hideEmpresa() {
         const element = document.getElementById('empresa-box');
         element.classList.remove('fade-in');
         element.classList.add('fade-out');
         setTimeout(() => {
             element.classList.add('hidden');
             element.style.display = 'none';
         }, 500);
     }

     function showProduto() {
        const element = document.getElementById('produto-box');
        element.classList.remove('hidden', 'fade-out');
        element.classList.add('fade-in');
        element.style.display = 'block';
   }

function hideProduto() {
        const element = document.getElementById('produto-box');
        element.classList.remove('fade-in');
        element.classList.add('fade-out');
        setTimeout(() => {
            element.classList.add('hidden');
            element.style.display = 'none';
        }, 500);
    }

function showUpdate(id, nome, numero, email, empresa, produto) {
    const element = document.getElementById('update-box');
    document.getElementById('update-id').value = id;
    document.getElementById('update-nome').value = nome;
    document.getElementById('update-numero').value = numero;
    document.getElementById('update-email').value = email;
    document.getElementById('empresa').value = empresa;
    document.getElementById('update-produto').value = produto;
    element.classList.remove('hidden', 'fade-out');
    element.classList.add('fade-in');
    element.style.display = 'block';
}

function hideUpdate() {
    const element = document.getElementById('update-box');
    element.classList.remove('fade-in');
    element.classList.add('fade-out');
    setTimeout(() => {
        element.classList.add('hidden');
        element.style.display = 'none';
    }, 500);
}

function confirmDelete() {
    return confirm('Tem certeza que deseja deletar?');
}


function formatarNumero() {
    var numero = document.getElementById('numeroDeTelefone');
    var valor = numero.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos

    // Aplica a formatação desejada
    if (valor.length > 0) {
        valor = valor.replace(/^(\d{2})(\d)/g, '$1-$2');
        valor = valor.replace(/(\d{5})(\d)/, '$1-$2');
    }

    numero.value = valor;
}

function formatarNumeroUpdate() {
    var numero = document.getElementById('update-numero');
    var valor = numero.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos

    // Aplica a formatação desejada
    if (valor.length > 0) {
        valor = valor.replace(/^(\d{2})(\d)/g, '$1-$2');
        valor = valor.replace(/(\d{5})(\d)/, '$1-$2');
    }

    numero.value = valor;
}
