let passwordInput = document.querySelector("#password");
let emailInput = document.querySelector("#email");

document.querySelector("#accountForm").addEventListener("submit", (event) => {
  event.preventDefault();
});

function sendRequest(){

	const options = {
  	method: "POST",
  	headers: { "Content-Type": "application/json" },
  	body: JSON.stringify({ 
  		email: emailInput.value, 
  		password: passwordInput.value
  	})
	};

	fetch("/user/", options)
	.then(response => response.json())
	.then(json => {
	  
	  if(!json.success){
			document.querySelector("#formError").innerHTML = json.data.message;
	  }

	  document.cookie = `token=${json.data.token}`;
	})
};

document.querySelector("#formButton").addEventListener("click", (event) => {

	if(document.querySelector("#formError").innerHTML !== ""){
		document.querySelector("#formError").innerHTML = "";
	}

	if(emailInput.value === ""){
		document.querySelector("#formError").innerHTML = "Email is Invalid";
	
	}else if(passwordInput.value.length < 6){
		document.querySelector("#formError").innerHTML = "password must be greater than 6 characters";
	
	}else{
		sendRequest();
	}

});