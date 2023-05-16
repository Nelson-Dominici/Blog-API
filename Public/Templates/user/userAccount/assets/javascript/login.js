$(document).ready(() => {

    $("#accountForm").submit( (event) => {
	        
	    event.preventDefault();

    	if($("#formError").html() !== "")
			$("#formError").html("");

		if($("#email").val() === "")
			$("#formError").html("Email is Invalid");
				
		else if($("#password").val().length < 6)
			$("#formError").html("password must be greater than 6 characters");
				
		else {

	        $.ajax({
	            url: "/user/",
	            type: "POST",
	            data: {email: $("#email").val(), password: $("#password").val()},
	            dataType: "json",
	            success: function(response) {
	           		document.cookie = "token="+response.data.token;
	            	window.location.href = "/";
	            },
	            error: function(xhr) {
					$("#formError").html(xhr.responseJSON.data.message);
	            }
	        });
		}
    });
});