using System.Net.Http;

namespace Program
{
    class webClient
    {
        public String httpGet(String uRI)
        {
            using(var client = new HttpClient())
            {
                var endpoint = new Uri(uRI); // The API Location
                // Http get request
                var result = client.GetAsync(endpoint).Result;
                var json = result.Content.ReadAsStringAsync().Result;
                return json;
            }
        }

        public void httpPost(String uRI) {
            /*
            string json = new JavaScriptSerializer().Serialize(new
            {
                Title = "aaa",
                ISBN = "12345678",
                Price = 19
            });
            using (var client = new HttpClient())
            {
                var response = await client.PostAsync(uRI, new StringContent(json, Encoding.UTF8, "application/json"));
                string responseFromServer = await response.Content.ReadAsStringAsync();
            }
            */
        }
    }
}