let passwordInput = document.querySelector("#password");
let emailInput = document.querySelector("#email");
let nameInput = document.querySelector("#name");

document.querySelector("#accountForm").addEventListener("submit", (event) => {
  event.preventDefault();
});

function sendRequest(){

	const options = {
  	method: "POST",
  	headers: { "Content-Type": "application/json" },
  	body: JSON.stringify({ 
  		name: nameInput.value, 
  		email: emailInput.value, 
  		password: passwordInput.value
  	})
	};

	fetch("/user/register", options)
	.then(response => response.json())
	.then(json => {
	  
	  if(!json.success){
			document.querySelector("#formError").innerHTML = json.data.message;
	  }

	 	window.location.replace("/");
	})
};

document.querySelector("#formButton").addEventListener("click", (event) => {

	if(document.querySelector("#formError").innerHTML !== ""){
		document.querySelector("#formError").innerHTML = "";
	}

	if(nameInput.value === ""){
		document.querySelector("#formError").innerHTML = "Name is required";
	
	}else if(emailInput.value === ""){
		document.querySelector("#formError").innerHTML = "Email is Invalid";
	
	}else if(passwordInput.value.length < 6){
		document.querySelector("#formError").innerHTML = "password must be greater than 6 characters";
	
	}else{
		sendRequest();
	}
	
});