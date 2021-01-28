
/** 
* Añade al input el caracter que indica el usuario
**/
function addScreen(character){
		document.getElementById("pantalla").value += character;
}

/**
* Vacia el contenido del input
**/
function deleteScreen(){
	document.getElementById("pantalla").value = "";
}

/**
 * Calcular la respuesta
 */
function readScreen(){
	//Valor del input
	let expression = document.getElementById("pantalla").value;
	console.log(expression);

	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function (response) {
        if (xhr.readyState === 4) {
			console.log(JSON.parse(xhr.response).result);
			document.getElementById("pantalla").value = JSON.parse(xhr.response).result;
        }
    };


    xhr.open('POST', '/resolve', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
	xhr.send('expression='+ encodeURIComponent(expression));
	
}


