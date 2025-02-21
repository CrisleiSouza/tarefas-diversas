using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace PropriedadesMetodosConstrutores.models
{
    public class Curso
    {
        public string Nome { get; set; }
        public List<Pessoa> Alunos { get; set; }


        public void AdicionarAluno(Pessoa aluno) //argumento aluno pq vai armazenar a informação da classe Pessoa em aluno
        {
            Alunos.Add(aluno); //adiciona aluno à lista, não retorna nada
        }


        //Métodos diferentes de void precisam retornar algo
        public int ObterQuantidadeDeAlunosMatriculados() //argumentos vazio pq não vai adicionar nada
        {
            int quantidade = Alunos.Count; //armazena a contagem de alunos na lista na variável 'quantidade'
            return quantidade; //retorna (mostra na tela) a variável quantidade
        }


        public void RemoverAluno(Pessoa aluno) //void pq não quero que retorne nada
        {
            Alunos.Remove(aluno);
        }


        public void ListarAlunos()
        {
            Console.WriteLine($"Alunos do curso de {Nome}");

            for (int count = 0; count < Alunos.Count; count++)
            {
                //string texto = "N°: " + count + " - Nome: " + Alunos[count].NomeCompleto;
                string texto = $"N°: {count+1}  Nome: {Alunos[count].NomeCompleto}";
                Console.WriteLine(texto);
            }
        }
    }
    
}