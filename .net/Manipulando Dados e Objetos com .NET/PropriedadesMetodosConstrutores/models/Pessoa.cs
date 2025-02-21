using System;
using System.Collections.Generic;
using System.Dynamic;
using System.Linq;
using System.Threading.Tasks;

namespace PropriedadesMetodosConstrutores.models
{
    public class Pessoa
    {
        public Pessoa ()
        {

        }

        public Pessoa(string nome, string sobrenome)
        {
            Nome = nome; //passa o valor armazenado no parâmetro nome para a propriedade Nome
            Sobrenome = sobrenome;
        }
        //Nome e Idade são propriedades
        
        private string _nome;
        private int _idade;
        public string Nome
        {
            get => _nome.ToUpper(); //irá retornar uma variável com todos os caracteres em capslock, no caso, _nome.
        
            set {
                if (value == "")
                {
                    throw new ArgumentException("O campo 'nome' não pode estar vazio.");
                }
                _nome = value;
            }
        
        }
        
        public string Sobrenome { get; set; }

        public string NomeCompleto => $"{Nome} {Sobrenome}".ToUpper();

        public int Idade 
        {
            get => _idade;

            set 
            {
                if (value < 0)
                {
                    throw new ArgumentException("O campo 'idade' não pode ser menor que zero.");
                }
                _idade = value;
            } 
        }
        public void Apresentar()
        {
            Console.WriteLine($"Nome: {NomeCompleto} - Idade {Idade}");
        }

    }
}