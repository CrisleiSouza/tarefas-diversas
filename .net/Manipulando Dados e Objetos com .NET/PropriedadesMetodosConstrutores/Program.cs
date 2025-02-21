using PropriedadesMetodosConstrutores.models;
using System.Collections;
using System.Globalization;
using System.Net.Mail;

//Dictionary

Dictionary<string, string> estados = new Dictionary<string, string>();
//dictionary<tipo da chave, tipo do valor da chave> nome

estados.Add("SP", "São Paulo");
estados.Add("BA", "Bahia");
estados.Add("MG", "Minas Gerais");

foreach (var item in estados)
{
    Console.WriteLine($"Chave: {item.Key} - Valor: {item.Value}");
}

Console.WriteLine("-------");

estados.Remove("SP"); //removendo um elemento
estados["MG"] = "Minas Gerais, país do pão de queijo - valor alterado"; //alterando um valor (não é possível alterar chave)

foreach (var item in estados)
{
    Console.WriteLine($"Chave: {item.Key} - Valor: {item.Value}");
}

Console.WriteLine("-------");

//Checando se um elemento é existente
string chave = "SP";
Console.WriteLine($"Verificando o elemento {chave}");

if (estados.ContainsKey(chave))
{
    Console.WriteLine("Elemento existente.");
}
else 
{
    Console.WriteLine("Elemento inexistente.");
}

Console.WriteLine("-------");

Console.WriteLine(estados["MG"]); //Acionando uma chave




//Pilha
// Stack<int> pilha = new Stack<int>();
//  pilha.Push(1);
//  pilha.Push(3);
//  pilha.Push(6);
//  pilha.Push(9);

//  foreach (var item in pilha)
//  {
//      Console.WriteLine(item);
//  }

//  Console.WriteLine($"Removendo o elemento: {pilha.Pop()}");
//  foreach (var item in pilha)
//  {
//      Console.WriteLine(item);
//  }

//  Console.WriteLine($"Adicionando o elemento: 12");

//  pilha.Push(12);

//  foreach (var item in pilha)
//  {
//      Console.WriteLine(item);
//  }



//Fila
// Queue<int> fila = new Queue<int>();
// fila.Enqueue(2);
// fila.Enqueue(4);
// fila.Enqueue(6);
// fila.Enqueue(8);

// foreach (var item in fila)
// {
//     Console.WriteLine(item);
// }

// Console.WriteLine($"Removendo o elemento: {fila.Dequeue()}");
// foreach (var item in fila)
// {
//     Console.WriteLine(item);
// }

// Console.WriteLine($"Adicionando o elemento 10.");

// fila.Enqueue(10);

// foreach (var item in fila)
// {
//     Console.WriteLine(item);
// }

//new ExemploExcecao().Metodo1(); //Exemplo de Exceção

// try 
// {
//     string[] linhas = File.ReadAllLines("arquivos/arquivoLeitura.txt"); //cria um array onde armazena cada linha do arquivo de texto em um item
//     foreach (string linha in linhas)
//     {
//         Console.WriteLine(linha);
//     }
// }
// catch(FileNotFoundException ex) 
// {
//     Console.WriteLine($"Ocorreu um erro. Arquivo não encontrado. {ex.Message}");
// }
// catch(DirectoryNotFoundException ex) 
// {
//     Console.WriteLine($"Ocorreu um erro. Pasta não encontrada. {ex.Message}");
// }
// catch(Exception ex) 
// {
//     Console.WriteLine($"Ocorreu uma exceção genérica. {ex.Message}");
// }
// finally //serve para sempre executar um bloco de código no fim da execução, tendo ocorrido uma exceção ou não
// {
//     Console.WriteLine("Você chegou até aqui!");
// }


// string dataString = "2023-05-04 21:30";

// bool sucesso = DateTime.TryParseExact(dataString, "yyyy-MM-dd HH:mm", CultureInfo.InvariantCulture, DateTimeStyles.None, out DateTime data);

// //DateTime data = DateTime.Parse(dataString);

// if (sucesso)
// {
//     Console.WriteLine($"Conversão realizada com sucesso! Data: {data}");
// }
// else 
// {
//     Console.WriteLine("A data inserida não é válida.");
// }


// CultureInfo.DefaultThreadCurrentCulture = new CultureInfo("en-US"); //torna a cultura do sistema TODA pra estadunidense ew

// decimal valorMonetario = 1582.42m;

//Console.WriteLine($"{valorMonetario.ToString("c", CultureInfo.CreateSpecificCulture("en-US"))}"); //torna apenas a cultura dessa variável em estadunidense ew

// Console.WriteLine($"{valorMonetario.ToString("n")}");

// double porcentagem = .3421;

// Console.WriteLine($"{porcentagem.ToString("P")}");

// int numero = 123456;

// Console.WriteLine($"{numero.ToString("#a## ##-#")}");


// string numero1 = "10";
// string numero2 = "20";
// string resultado = numero1 + numero2;

// Console.WriteLine(resultado);


// Pessoa p1 = new Pessoa(nome: "Fulano", sobrenome: "De Tal");//(nome do parâmetro: valor do parâmetro, nome do parâmetro: valor do parâmetro)
// Pessoa p2 = new Pessoa(nome: "Cicrano", sobrenome: "Silvano"); 

// Curso cursoDeIngles = new Curso();
// cursoDeIngles.Nome = "Inglês";
// cursoDeIngles.Alunos = new List<Pessoa>();

// cursoDeIngles.AdicionarAluno(p1);
// cursoDeIngles.AdicionarAluno(p2);
// cursoDeIngles.ListarAlunos();