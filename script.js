var requestOne; // is where the AJAX instance will be stored

var textInput = document.querySelector("#textInput");
var conversation = document.querySelector("#Conversation");

function getRandomNummber(amount) {
    return Math.floor(Math.random() * amount);
}

/**
 * this is the button to send data to the server
 */
document.getElementById("send-text").addEventListener('click', function(event) {
    if (textInput.value == "") {
        return;
    }
    requestOne = new XMLHttpRequest();
    requestOne.open("GET", "../API/other/Value/" + textInput.value);
    requestOne.onreadystatechange = onRequstUpdate;
    requestOne.send();
    onRequstUpdate(event);
});

/**
 * this is the button to delet all the conversation
 */
 document.getElementById("clear-text").addEventListener('click', function(event) {
    conversation.innerHTML = "";
});

/**
 * here will be the validation of the result
 * @param {*} event nothing
 * @returns if the server didn't responde or connect corectly
 */
function onRequstUpdate(event) {
    if (requestOne.readyState < 4) {
        return;
    }
    conversation.innerHTML += "<p><span class=\"you\">YOU :</span> " + textInput.value + "</p>\n";

    var result = JSON.parse(requestOne.responseText);

    if (result.output_value == undefined || result.output_value == null) {
        conversation.innerHTML += "<p><span class=\"computer\">COMPUTER :</span> *Silence*</p>\n";
    } else {
        var data = result.output_value.split("$");
        conversation.innerHTML += "<p><span class=\"computer\">COMPUTER :</span> " + data[getRandomNummber(data.length - 1)] + "</p>\n";
    }
    textInput.value = "";
}