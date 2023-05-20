$(document).ready(() => {

    $("#accountForm").submit( (event) => {
	  		        
	    event.preventDefault();

    	if($("#message").html() !== "")
			$("#message").html("");

		if($("#email").val() === "")
			$("#message").html("Email is Invalid");

		else if($("#password").val().length < 6)
			$("#message").html("password must be greater than 6 characters");
				
		else {
			
	  		$("#formButton").val("Loading...");

	        $.ajax({
	            url: "/user/",
	            type: "POST",
	            data: {email: $("#email").val(), password: $("#password").val()},
	            dataType: "json",
	            success: function(response) {
	            	window.location.href = "/home";
	            },
	            error: function(xhr) {
	  				$("#formButton").val("log in");
					$("#message").html(xhr.responseJSON.data.message);
	            }
	        });
		}
    });
});