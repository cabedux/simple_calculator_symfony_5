
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

function readScreen(){
	//Valor del input
	let expression = document.getElementById("pantalla").value;
	
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function (response) {
        if (xhr.readyState === 4) {
			document.getElementById("pantalla").value = JSON.parse(xhr.response).result;
        }
    };
	var data = new FormData();
    data.append('expression', expression);

    xhr.open('POST', '/resolve', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
	xhr.send('expression='+ expression);
	
}


