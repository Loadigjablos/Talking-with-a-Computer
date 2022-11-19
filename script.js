var requestOne; // is where the AJAX instance will be stored

var textInput = document.querySelector("#textInput");
var conversation = document.querySelector("#Conversation");


/**
 * this is the button to send data to the server
 */
document.getElementById("send-text").addEventListener('click', function(event) {
    requestOne = new XMLHttpRequest();
    requestOne.open("GET", "API/v1/Value/" + textInput.value);
    requestOne.onreadystatechange = onRequstUpdate;
    requestOne.send();
    onRequstUpdate(event);
});

/**
 * here will be the validation of the result and it paste it in the website
 * @param {*} event nothing
 * @returns if the server didn't responde or connect corectly
 */
function onRequstUpdate(event) {
    if (requestOne.readyState < 4) {
        return;
    }
    conversation.innerText += "YOU:\t\t" + textInput.value + "\n";

    var result = JSON.parse(requestOne.responseText);

    if (result.output_value == undefined || result.output_value == null) {
        conversation.innerText += "AI:\t\t*Silence*\n";
    } else {
        conversation.innerText += "AI: \t\t" + result.output_value + "\n";
    }
}