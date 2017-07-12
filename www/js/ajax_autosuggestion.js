/*
 * This script contains AJAX methods
 */
var xhr;
var totalSuggestions = 0;
var activeSuggestion = -1;

//run the init function when the page finishes loading.
window.onload = init;

//initial actions to take when the page load
function init() {
    //create an XMLHttpRequest object by calling the createXmlHttpRequestObject function
    xhr = createXmlHttpRequestObject();

    document.addEventListener("click", function () {
        document.getElementById('suggestionDiv').style.display = 'none';
    });

    if (document.getElementById("searchtextbox")) {
        document.getElementById("searchtextbox").addEventListener("keyup", function (event) {
            handleKeyUp(event);
        });
    }
}

//create an XMLHttpRequest object
function createXmlHttpRequestObject()
{
    var xmlHttp;

    if (window.ActiveObject) {  //IE6 and older
        xmlHttp = new ActiveObject("Microsoft.XMLHTTP");
    }
    else if (window.XMLHttpRequest) {  // IE7+, Chrome, Mozilla, Safari, Opera
        xmlHttp = new window.XMLHttpRequest();
    }
    else
        xmlHttp = false;

    return xmlHttp;
}

//this function is called after every keystroke
function handleKeyUp(e) {
    // get the key event for different browsers
    e = (!e) ? window.event : e;

    //if the up arrow key is pressed
    if (e.keyCode == 38) {
        //add code here to handle up arrow key. e.g. select the previous item
        document.getElementById("s_" + activeSuggestion).style.backgroundColor = "#FFF";
        activeSuggestion--;
        activeSuggestion = (activeSuggestion < 0) ? (totalSuggestions - 1) : activeSuggestion;
        document.getElementById("s_" + activeSuggestion).style.backgroundColor = "#F5DEB3";
        document.getElementById('searchtextbox').value = document.getElementById("s_" + activeSuggestion).innerHTML;
    }
    //if the down arrow key is pressed
    else if (e.keyCode == 40) {
        //add code here to handle down arrow key, e.g. select the next item 
        if (activeSuggestion >= 0) {
            document.getElementById("s_" + activeSuggestion).style.backgroundColor = "#FFF";
        }
        activeSuggestion++;
        activeSuggestion = (activeSuggestion >= totalSuggestions) ? 0 : activeSuggestion;
        document.getElementById("s_" + activeSuggestion).style.backgroundColor = "#F5DEB3";
        document.getElementById('searchtextbox').value = document.getElementById("s_" + activeSuggestion).innerHTML;

    }

    //if any other key is pressed, call a function to send an AJAX request
    else
        processXMLHttpRequest();
}
//set and send XMLHttp request
function processXMLHttpRequest() {
    // proceed only if the xmlHttp object isn't busy
    if (xhr.readyState == 4 || xhr.readyState == 0) {

        // retrieve the name typed by the user on the form
        query_terms = encodeURI(document.getElementById("searchtextbox").value);

        if (query_terms != "") {  //preceed only if the textbox isn't empty
            // execute an asynchronous request to the server.
            //suggest_url varies depending on the media object. 
            //this variable receives the value from the view file specific to the media type.
            xhr.open("GET", base_url + "/" + media + "/suggest/" + query_terms, true);

            // specify the function to handle server responses
            xhr.onreadystatechange = handleServerResponse;

            // make the request
            xhr.send(null);
        }
        else //clear the suggestion div if the search textbox is empty
            document.getElementById("suggestionDiv").innerHTML = "";
    }
    else
        // if the connection is busy, try again after one second
        setTimeout("processXMLHttpRequest()", 1000);
}

// executed automatically when a response is received from the server
function handleServerResponse()
{
    // move forward only if the transaction has completed
    if (xhr.readyState == 4)
    {
        // status of 200 indicates the transaction completed successfully
        if (xhr.status == 200)
        {
            // extract the XML received from the server
            xmlResponse = xhr.responseXML;

            // obtain the document element (the root element) of the XML structure
            xmlDocumentElement = xmlResponse.documentElement;

            // display suggested products in a div block
            displaySuggestions(xmlDocumentElement.getElementsByTagName("product"));
        }
        // a HTTP status different than 200 signals an error
        else
        {
            //alert("There was a problem accessing the server: " + xhr.statusText);
        }
    }
}

/* populate the suggestion box with spans containing all the products retrieved from an XML doc */
function displaySuggestions(xmlDoc) {
    totalSuggestions = xmlDoc.length;
    activeSuggestion = -1;
    if (totalSuggestions === 0) {
        //hide all suggestions
        document.getElementById('suggestionDiv').style.display = 'none';
        return false;
    }

    var divContent = "";
    //retrive the products from the xml doc and create a new span for each product
    for (i = 0; i < xmlDoc.length; i++) {
        var product = xmlDoc.item(i).firstChild.data;
        divContent += "<span id=s_" + i + " onclick='clickProduct(this)'>" + product + "</span>";
    }
    //display the spans in the div block
    document.getElementById("suggestionDiv").innerHTML = divContent;
    document.getElementById('suggestionDiv').style.display = 'block';
}


//when a product is clicked, fill the search box with the product and then hide the suggestion list
function clickProduct(product) {
    //display the product in the search box
    document.getElementById('searchtextbox').value = product.innerHTML;

    //hide all suggestions
    document.getElementById('suggestionDiv').style.display = 'none';
}