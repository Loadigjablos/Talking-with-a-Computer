using System;

namespace Program
{
    /**
    * start class
    */
    class Program
    {
        /**
        * Start of the program
        */
        static void Main(string[] args)
        {
            bool done = false;
            while (done == false) {
                Console.Write("('!' Comand, '?' Question, ' ' Statement, 'done' quit)> ");
                var text = Console.ReadLine();
                if (text.Equals("done")) {
                    done = true;
                    Console.WriteLine("bye");
                } else if (!(text.Equals(""))) {
                    Console.WriteLine(textAnalsys.sentenceValue(text));
                } else {
                    Console.ForegroundColor = ConsoleColor.White;
                    Console.BackgroundColor = ConsoleColor.Red;
                    Console.WriteLine("empty request");
                }
                Console.ForegroundColor = ConsoleColor.Black;
                Console.BackgroundColor = ConsoleColor.White;
                Console.WriteLine(" ");
            }
        }
    }
}