using Sintaxe_e_Tipos_de_Dados_em_C_.models;







/*
//------------------------------------LAÇOS DE REPETIÇÃO--------------------------------------

//---------------- MENU COM WHILE E SWITCH -------------
string? opcao;
bool exibirMenu = true;

while (exibirMenu)
{
    Console.Clear();
    Console.WriteLine("Digite a sua opção:");
    Console.WriteLine("1. Cadastrar cliente");
    Console.WriteLine("2. Buscar cliente");
    Console.WriteLine("3. Apagar cliente");
    Console.WriteLine("4. Encerrar");

    opcao = Console.ReadLine();

    switch (opcao)
    {
        case "1":
            Console.WriteLine("Cadastrar cliente.");
            break;
        case "2":
            Console.WriteLine("Buscar cliente.");
            break;
        case "3":
            Console.WriteLine("Apagar cliente.");
            break;
        case "4":
            Console.WriteLine("Encerrar");
            exibirMenu = false; //Quebra a condição para o while, saindo do laço de repetição.
            // Sair de vez do programa, acabar tudo = Environment.Exit(0);
            break;

        default:
            Console.WriteLine("Opção inválida");
            break;
    }
}

Console.WriteLine("Programa encerrado.");


//-------- DO WHILE ---------
int soma = 0, numero = 0;

do
{
    Console.WriteLine("Digite um número: (0 para parar)");
    numero = Convert.ToInt32(Console.ReadLine());

    soma += numero;

} while (numero != 0);

Console.WriteLine($"Resultado da soma dos números digitados: {soma}");


//-------- Interrompendo o laço -----------
int numero = 5;
int contador = 1;

while (contador <= 10)
{
    Console.WriteLine($"{numero} x {contador} = {numero * contador}");
    contador++;

   if (contador == 6)
    {
        break;
    }
}


//---------- WHILE ---------

int numero = 5;
int contador = 1;

while (contador <= 10)
{
    Console.WriteLine($"{numero} x {contador} = {numero * contador}");
    contador++;
}


//----------- FOR -------------
int numero = 9;

for (int contador = 1; contador <= 10; contador++)
{
    Console.WriteLine($"{numero} x {contador} = {numero * contador}");
}



//--------------------------------OPERADORES ARITMÈTICOS------------------------------------

Calculadora calc = new Calculadora();

calc.Somar(10, 30);
calc.Subtrair(10, 50);
calc.Multiplicar(15, 45);
calc.Dividir(6, 2);
Console.WriteLine("\n");

//Exemplos classe Math.
calc.Potencia(3, 3);
calc.Seno(30);
calc.Coseno(30);
calc.Tangente(30);
Console.WriteLine("\n");

//Incremento e Decremento
int numeroIncremento = 10;
int numeroDecremento = 20;

Console.WriteLine("Incrementando o 10");
//numero = numero + 1
numeroIncremento++;
Console.WriteLine(numeroIncremento);

Console.WriteLine("Decrementando o 20");
//numero = numero - 1
numeroDecremento--;
Console.WriteLine(numeroDecremento);
Console.WriteLine("\n");

//Raiz Quadrada
calc.RaizQuadrada(9);


//------------------------------OPERADORES CONDICIONAIS-------------------------------------

//----------- NOT -----------
bool choveu = false;
bool estaTarde = false;

if (!choveu && !estaTarde)
{
    Console.WriteLine("Vou pedalar! :)");
}
else
{
    Console.WriteLine("Não vou pedalar.");
}


//---------- AND -----------

bool possuiPresencaMinima = true;
double media = 8;

if (possuiPresencaMinima && media >= 5)
{
    Console.WriteLine("Aprovado!");
}
else
{
    Console.WriteLine("Reprovado.");
}


//--------- OR -----------
bool eMaiorDeIdade = true;
bool possuiAutorizacaoDoResponsavel = false;

if (eMaiorDeIdade || possuiAutorizacaoDoResponsavel)
{
    Console.WriteLine("Entrada liberada!");
}
else
{
    Console.WriteLine("Entrada negada.");
}

Console.WriteLine($"É maior de idade: {eMaiorDeIdade}");
Console.WriteLine($"Possui atoorização do responsável: {possuiAutorizacaoDoResponsavel}");


//------- SWITCH CASE -----------
Console.WriteLine("Digite uma letra: ");
string? letra = Console.ReadLine();

switch (letra)
{
    case "a":
    case "e": 
    case "i": 
    case "o": 
    case "u":
        Console.WriteLine("É uma vogal!");
        break;

    default:
        Console.WriteLine("Não é uma vogal.");
        break;
}

//------------ If e Else ---------------
int quantidadeEstoque = 10;
int quantidadeCompra = 0;
bool possivelVenda = quantidadeCompra > 0 && quantidadeEstoque >= quantidadeCompra;

Console.WriteLine($"Quantidade em estoque: {quantidadeEstoque}");
Console.WriteLine($"Quantidade compra: {quantidadeCompra}");
Console.WriteLine($"É possível realizar a venda? {possivelVenda}");

if (quantidadeCompra == 0)
{
    Console.WriteLine("Venda inválida, por favor insira um valor.");
}
else if (possivelVenda)
{
    Console.WriteLine("venda realizada!");
}
else
{
    Console.WriteLine("Não temos a quantidade desejada em estoque.");
}
//------------------------------------------



//-------------------------------- CONVERSÂO DE TIPOS DE VARIÀVEIS ---------------------------------

//cast ou casting + processo de converter uma variável de um tipo para outro.
//Conversão para int:  Por conta dos valores nulos, o método 'a' é melhor.
int a = Convert.ToInt32(null); //Utiliza a classe Convert e o método ToInt32. Convert + . + ToTipo a ser convertido. O valor pode ser nulo aqui.
int b = int.Parse("10"); //Utiliza o método Parse. Tipo a ser convertido + . + Parse. O valor não pode ser nulo aqui.

//Conversão para string.
int exemplo = 1;
string c = exemplo.ToString("Pipipi");

//Cast Implícito
//Só é possível pq o double e long suportam os valores inteiros, porém não é possível realizar o contrário pq o int não suporta todos os valores do long e do double.
int exemplo2 = 5;
double d = exemplo2;

Console.WriteLine(a + ", conversão à int através do Convert.ToInt32;\n" + b + ", conversão à int através do int.Parse;\n" + c + ", conversão de int para string através do ToString;\n" + d + ", cast implícito de int para double.");

//--------Convertendo de Maneira Segura--------------

string f = "15";
int g = 0;

int.TryParse(f, out g);

Console.WriteLine("\nConvertendo de maneira segura: " + g);
//-----------------------------------------------------------------------



// ------------------------------------------------------ OPERADORES ARITMÈTICOS -----------------------------------------------

int a = 10;
int b = 20;

//Pega o valor na variável a, soma ao valor na variável b e armazena o resultado na variável C.
int c = a + b;

c = c + 5; //Não pode nem é necessário repetir o tipo da variável pq ela (variável c) já foi declarada.
c += 5; //Mesma coisa que acima. C + a variável c = 5;
// O mesmo vale para subtração (-), divisão (/) e multiplicação (*).

Console.WriteLine(c);

//--------Ordem dos Operadores---------
double e = 4 / 2 + 2; //Segue a ordem normal, começando pela divisão.
double eAjustado = 4 / (2 + 2); //Começa pelos parênteses.

Console.WriteLine("Divisão e soma seguindo a ordem regular de operadores: " + e + ";\nOrdem dos operadores alterada com parênteses" + eAjustado);



//------------------------------ TIPOS DE VARIÀVEIS ----------------------------------

//Modelo atribuição de valor à variável: tipo nome_da_var = valor da var;

//--Exemplo de mudança de valor--
string apresentacao = "Olá!";
Console.WriteLine(apresentacao);

apresentacao = "Tudo bem?";
Console.WriteLine(apresentacao);
//----------------------------------

//---Exemplo DateTime---
DateTime dataAtual = DateTime.Now;
------------------------

int quantidade = 1;

double altura = 1.80;

decimal preco = 1.99m;

bool condicao = true;

//---- Apresentando os valores das variáveis ----
Console.WriteLine(dataAtual);
Console.WriteLine("Valor da variável quantidade: " + quantidade);
Console.WriteLine("Valor da variável altura: " + altura);
Console.WriteLine("Valor da variável altura (com o ToString): " + altura.ToString("0.00"));
Console.WriteLine("Valor da variável preço: " + preco);
Console.WriteLine("Valor da variável condição: " + condicao + "\n");
//------------------------------------------------

//Adicionado valores à classe criada no arquivo Pessoa.cs e acionando a functionmétodo Apresentar()

Pessoa pessoa1 = new Pessoa();

pessoa1.Nome = "Fulano";
pessoa1.Idade = 26;

pessoa1.Apresentar();
*/