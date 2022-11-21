<?php

    /**
     * @OA\Info(title="REST-API", version="0.1")
     */

    // this handels the request and response.
    use Psr\Http\Message\ResponseInterface as Response; 
    use Psr\Http\Message\ServerRequestInterface as Request;

    // allows Using Slim and build our application.
    use Slim\Factory\AppFactory;

    // To create a JWT Token for authentication
    use ReallySimpleJWT\Token;

    // all the libraries we need.
    require __DIR__ . "/../vendor/autoload.php";
    // self made functions
    require_once "Controler/validation.php";
    require_once "Model/SQL.php";

    // all response data will be in the Json Fromat
    header("Content-Type: application/json");

    $app = AppFactory::create();

    // the URL must be 'http://[Domain]/API/other/' To Work
    $app->setBasePath("/streit-dominic/API/other");

        /**
    * @OA\Post(
    *   path="/Login",
    *   summary="You can authenticate yourself",
    *   tags={"Login"},
    *   requestBody=@OA\RequestBody(
    *       request="Localhost/Login",
    *       required=true,
    *       description="Password and username",
    *       @OA\MediaType(
    *           mediaType="application/json",
    *           @OA\Schema(
    *               @OA\Property(property="Password", type="string", example="wu3Ao82832#sd1U+asc9"),
    *               @OA\Property(property="username", type="string", example="Steven")
    *           )
    *       )
    *   ),
    *   @OA\Response(response="201", description="Succesfully authenticated"),
    *   @OA\Response(response="400", description="Invalid input"),
    *   @OA\Response(response="404", description="Invalid Input"),
    *   @OA\Response(response="500", description="Server Error")
    * )
    */
    $app->post("/Login", function (Request $request, Response $response, $args) {
        // reads the requested JSON body
        $body_content = file_get_contents("php://input");
        $JSON_data = json_decode($body_content, true);

        // if JSON data doesn't have these then there is an error
        if (isset($JSON_data["username"]) && isset($JSON_data["password"])) { } else {
            error_function(400, "Empty request");
        }

        // Prepares the data to prevent bad data, SQL injection andCross site scripting
        $username = validate_string($JSON_data["username"]);
        $password = validate_string($JSON_data["password"]);

        if (!$password) {
            error_function(400, "password is invalid, must contain at least 5 characters");
        }
        if (!$username) {
            error_function(400, "username is invalid, must contain at least 5 characters");
        }

        // validates if the right passwd and username are set.
        if ($username === "RESTRICTED INFORMATION" && $password === "RESTRICTED INFORMATION") {
            //creates the JWT token and puts it in the cookies.
            setcookie("token", Token::create("_root", "sec!ReT423*&", time() + 3600, "localhost"));
            message_function(200, "Succesfuly authenticated");
        } else {
            error_function(401, "Wrong");
        }

        return $response; 
    });

    /**
    * @OA\Get(
    *   path="/Products",
    *   summary="to list all products",
    *   tags={"Talking With Computer"},
    *   @OA\Response(response="200", description="data")
    * )
    */
    $app->get("/", function (Request $request, Response $response, $args) {
        echo "⠀⢸⠀⠀⢸⠀⠀⠀⣀⡤⠤⣄⠀⠀⢨⠀⠀⠀⡇⠀⠀⠀⠀⢀⠤⢤⣤⡀⠀⠀\n⠀⢸⠤⠤⢼⠄⡔⠁⠀⠀⣀⠇⠀⠀⡆⠀⠀⢸⠀⠀⠀⠀⡜⠀⠀⠀⠀⠙⡄ \n⠀⢸⠀⠀⢸⠀⠘⣄⡈⠉⠀⠀⠀⠀⠀⡇⡠⢺⠀⠀⡀⠀⣇⠀⠀⠀⠀⠀⡇⠀\n⠀⠀⠀⠀⠀⠁⠀⠀⠈⠉⠉⠁⠀⠀⠀⠋⠁⠀⣧⠋⠁⠀⠀⠈⠉⠉⠉⠁⠀⠀";
        // it is not in a Json Fromat, which is Ilegale.
        return $response;
    });

    /**
    * @OA\Get(
    *   path="/Products",
    *   summary="to list all products",
    *   tags={"Talking With Computer"},
    *   @OA\Response(response="200", description="data"),
    *   @OA\Response(response="401", description="unotharised"),
    *   @OA\Response(response="500", description="Server Error")
    * )
    */
    $app->get("/Dictionary/{word}", function (Request $request, Response $response, $args) {
        // takes the String from the URL.
        $word = validate_string($args["word"]);
        // The word will be searched in the dictonary and outputed in a JSON fromat.
        echo json_encode(search_dictionary($word));
        return $response;
    });

    /**
    * @OA\Get(
    *   path="/Value/{sentence}",
    *   summary="to list all products",
    *   tags={"Talking With Computer"},
    *   @OA\Response(response="200", description="data"),
    *   @OA\Response(response="401", description="unotharised"),
    *   @OA\Response(response="500", description="Server Error")
    * )
    */
    $app->get("/Value/{sentence}", function (Request $request, Response $response, $args) {
        // takes the String from the URL.
        $sentence = validate_string($args["sentence"]);
        
        echo json_encode(search_sentence($sentence));

        return $response;
    });

    /**
    * @OA\Post(
    *   path="/Value",
    *   summary="you add data to the Conversation",
    *   tags={"Add Talking With Computer"},
    *   requestBody=@OA\RequestBody(
    *       request="/Value",
    *       required=true,
    *       description="give key and Value",
    *       @OA\MediaType(
    *           mediaType="application/json",
    *           @OA\Schema(
    *               @OA\Property(property="key", type="string", example="Hello"),
    *               @OA\Property(property="value", type="array", example="['hi', 'hi, how are you?']")
    *           )
    *       )
    *   ),
    *   @OA\Response(response="201", description="Succesfully authenticated"),
    *   @OA\Response(response="400", description="Invalid input"),
    *   @OA\Response(response="404", description="unable to find"),
    *   @OA\Response(response="500", description="Server Error")
    * )
    */
    $app->post("/Value", function (Request $request, Response $response, $args) {
        validate_token();
        // reads the requested JSON body
        $body_content = file_get_contents("php://input");
        $JSON_data = json_decode($body_content, true);

        // if the requested JSON data doesn't have these then there is an error
        if (isset($JSON_data["key"]) || isset($JSON_data["value"])) { } else {
           error_function(400, "Empty request");
        }

        // Prepares the data to prevent bad data, SQL injection andCross site scripting
        $key = validate_string($JSON_data["key"]);

        $value = validate_string(implode("$", $JSON_data["value"]));

        if (!$key || !$value) {
           error_function(400, "empty strings");
        }

        add_new_search_sentence($key, $value);

        echo true;

        return $response; 
    });

    $app->run();
?>