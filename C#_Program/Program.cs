using System;

namespace Program
{
    /**
    * start class
    */
    class Program
    {
        static private Random random = new Random(); 

        /**
        * Start of the program
        */
        static void Main(string[] args)
        {
            bool done = false;
            while (done == false) {
                Console.Write("('-q' to quit)> ");
                var text = Console.ReadLine();
                if (text.Equals("-q")) {
                    done = true;
                    Console.WriteLine("bye");
                } else if (!(text.Equals(""))) {
                    Console.WriteLine(textAnalsys.sentenceValue(text));
                } else {
                    Console.ForegroundColor = ConsoleColor.White;
                    Console.BackgroundColor = ConsoleColor.Red;
                    Console.WriteLine("empty request");
                }
                Console.ResetColor();
                Console.WriteLine(" ");
            }
        }
        static public int randomNumber(int max) {
            return random.Next(0, max);
        }
    }
}