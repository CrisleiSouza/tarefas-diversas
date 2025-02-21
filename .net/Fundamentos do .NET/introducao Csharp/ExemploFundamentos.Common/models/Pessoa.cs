using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace ExemploFundamentos.Common.models //Organização de classes. Todas as minhas models estarão no namespace indicado.
{
    public class Pessoa //Nome da classe é Pessoa
    {
        public string? Nome { get; set; }
        public int Idade { get; set; }
        public string? NomeRepresentanteLegal { get; set; }

        public void Apresentar() //Apresentar = função/método
        {
            Console.WriteLine($"Olá, meu nome é {Nome}, e tenho {Idade} anos.");
            //console = classe. WriteLine = Função/método. Trecho em parênteses = Argumento/parâmetro
        }
    }
}