/** 
* Add character to input screen
**/
function addScreen(character){
		document.getElementById("pantalla").value += character;
}

/**
* Delete content from input screen
**/
function deleteScreen(){
	document.getElementById("pantalla").value = "";
}

/**
 * Revolve expression
 */
function readScreen(){
	//input value
	let expression = document.getElementById("pantalla").value;

	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = () => {
        if (xhr.readyState === 4) {
			document.getElementById("pantalla").value = JSON.parse(xhr.response).result;
        }
    };

    xhr.open('POST', '/resolve', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
	xhr.send('expression='+ encodeURIComponent(expression));	
}


