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
         * @param sen for the URI
         * @return Data from the server
         */
        public static String sentenceValue(String sen)
        {
            String response = " "; // what the AI will say

            string jsonString = webClient.httpGet("http://campus.csbe.ch/streit-dominic/API/other/Value/" + sen); // the API will be Questioned if the key exists

            if (jsonString.Contains("output_value")) {
                string[] responseArray = jsonString.Split("\"");
                string[] responseArrayTwo = responseArray[3].Split("$");
                response = responseArrayTwo[Program.randomNumber(responseArrayTwo.Length)];
            } else {
                response = "*Silence*";
            }

            return response;
        }
    }
}