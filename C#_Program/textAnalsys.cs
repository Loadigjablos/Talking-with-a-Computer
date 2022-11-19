namespace Program
{
    /**
    * This class will analyse the whole text and will responde with a suitable answer.
    */
    static class textAnalsys
    {
        static webClient webClient = new webClient();

        /**
        * TODO Compleate the Dictionary
        */
        public static String dictionaryComparison(String sen)
        {
            String response = " "; // what the AI will say

            string[] text = sen.Split(" ");

            int index = 0; // to select the current word
            foreach (string word in text) {
                text[index] = webClient.httpGet("http://localhost/Dictionary/" + word);
                index++;
            }

            return response;
        }

        /**
         * 
         */
        public static String sentenceValue(String sen)
        {
            String response = " "; // what the AI will say

            response = webClient.httpGet("http://localhost/API/other/Value/" + sen); // the API will be Questioned if the key exists

            return response;
        }
    }
}