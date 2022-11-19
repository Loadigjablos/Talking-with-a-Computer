var requestOne; // is where the AJAX instance will be stored

var textInput = document.querySelector("#textInput");
var conversation = document.querySelector("#Conversation");


/**
 * this is the button to send data to the server
 */
document.getElementById("send-text").addEventListener('click', function(event) {
    requestOne = new XMLHttpRequest();
    //requestOne.open("GET", "http://localhost/API/other/Value/" + textInput.value);
    requestOne.open("GET", "http://localhost/API/other");
    requestOne.onreadystatechange = onRequstUpdate;

    if (requestOne.Request == "OPTIONS") {
     return;
    }

    requestOne.send();
    onRequstUpdate(event);
});

/**
 * here will be the validation of the result
 * @param {*} event nothing
 * @returns if the server didn't responde corectly
 */
function onRequstUpdate(event) {
    if (requestOne.readyState < 4) {
        return;
    }
    conversation.innerText += textInput.value + "\n";

    console.log(requestOne.responseText);

    var result = JSON.parse(requestOne.responseText);

    conversation.innerText += result.output_value + "\n";
}