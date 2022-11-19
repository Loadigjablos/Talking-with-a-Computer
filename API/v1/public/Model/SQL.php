<?php
    // Database conection string
    $database = new mysqli("localhost", "root", "", "ai_test");

    /**
    * returns a product infromation
    * @param word a uneque key to identify what word is refert to
    * @return result of data in the DB
    */
    function search_dictionary($word) {
        global $database;

        // selects the user by user_id
        $result = $database->query("SELECT * FROM dictionary WHERE word = \"$word\"");

        if ($result == false) {
            error_function(500, "Wrong SQL Statment");
		} else if ($result !== true) {
			if ($result->num_rows > 0) {
				return $result->fetch_assoc();
			} else {
                error_function(404, "$word , word Not Found");
            }
		} else {
            error_function(404, "$word , word Not Found");
        }
    }

    /**
    * returns a product infromation
    * @param sentence a uneque key to identify what key_sentence will be chosen
    * @return result of data in the DB
    */
    function search_sentence($sentence) {
        global $database;

        // selects the user by user_id
        $result = $database->query("SELECT * FROM talk_key_value WHERE sentence_key = \"$sentence\"");

        if ($result == false) {
            error_function(500, "Wrong SQL Statment");
		} else if ($result !== true) {
			if ($result->num_rows > 0) {
				return $result->fetch_assoc();
			} else {
                error_function(404, "Not Found");
            }
		} else {
            error_function(404, "Not Found");
        }
    }

    /**
     * makes a sql statment to create a new line with the parameters.
     * @param key a uneque key to identify what product
     * @param value a value in products
     */
    function add_new_search_sentence($key, $value) {
        global $database;

        $result = $database->query("INSERT INTO talk_key_value (sentence_key, output_value, id) VALUES ('$key', '$value', NULL)");

        if ($result == false) {
            error_function(500, "Wrong SQL Statment");
		} else if ($result !== true) {
			error_function(500, "Server Error");
		}
    }
?>