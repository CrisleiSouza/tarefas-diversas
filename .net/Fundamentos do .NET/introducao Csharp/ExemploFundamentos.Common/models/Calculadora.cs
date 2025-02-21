using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace ExemploFundamentos.Common.models
{
    public class Calculadora
    {
        public void Somar(int x, int y)
        {
            Console.WriteLine($"{x} mais {y} é igual a {x + y}");
        }

        public void Subtrair(int x, int y)
        {
            Console.WriteLine($"{x} menos {y} é igual a {x - y}");
        }

        public void Multiplicar(int x, int y)
        {
            Console.WriteLine($"{x} vezes {y} é igual a {x * y}");
        }

        public void Dividir(int x, int y)
        {
            Console.WriteLine($"{x} dividido por {y} é igual a {x / y}");
        }
        
        //Classe Math pela primeira vez
        public void Potencia(int x, int y)
        {
            double pot = Math.Pow(x, y);
            Console.WriteLine($"{x} elevado à {y} é igual a {pot}");
        }
        public void Seno(double angulo)
        {
            double radiano = angulo * Math.PI / 180;
            double seno = Math.Sin(radiano);
            Console.WriteLine($"Seno de {angulo} é igual a {Math.Round(seno, 4)}");
        }
        public void Coseno(double angulo)
        {
            double radiano = angulo * Math.PI / 180;
            double coseno = Math.Cos(radiano);
            Console.WriteLine($"Coseno de {angulo} é igual a {Math.Round(coseno, 4)}");
        }
        public void Tangente(double angulo)
        {
            double radiano = angulo * Math.PI / 180;
            double tangente = Math.Tan(radiano);
            Console.WriteLine($"Tangente de {angulo} é igual a {Math.Round(tangente, 4)}");
        }

        public void RaizQuadrada(double x)
        {
            double raiz = Math.Sqrt(x);
            Console.WriteLine($"Raiz quadrada de {x} é igual a {raiz}");
        }
    }
}