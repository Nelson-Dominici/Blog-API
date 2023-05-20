$(document).ready(() => {

    $("#accountForm").submit( (event) => {
	        
	    event.preventDefault();

		if($("#message").html() !== "")
			$("#message").html("");

		if($("#name").val() === "")
			$("#message").html("Name is required");

		else if($("#email").val() === "")
			$("#message").html("Email is Invalid");
		
		else if($("#password").val().length < 6)
			$("#message").html("password must be greater than 6 characters");
		
		else {
			
	  		$("#formButton").val("Loading...");

	        $.ajax({
	            url: "/user/register",
	            type: "POST",
	            data: {
	            	name: $("#name").val(), 
	            	email: $("#email").val(), 
	            	password: $("#password").val()
	            },
	            dataType: "json",
	            success: function(response) {
	            	window.location.href = "/user/login";
	            },
	            error: function(xhr) {
	  				$("#formButton").val("log in");
					$("#message").html(xhr.responseJSON.data.message);
	            }
	        });
		}
    });
});