$(document).ready(() => {

    $("#addPost").on( "click", function() {

		if($("#message").html() !== "")
			$("#message").html("");

    	if(!$("#title").val())
			$("#message").html("Title required");

		else if(!$("#postContente").val())
			$("#message").html("Post contente is Invalid");
		
		else {

	        $.ajax({
	            url: "/addPost",
	            type: "POST",
	            data: {
	            	postContente: $("#postContente").val(), 
	            	title: $("#title").val()
	            },
	            dataType: "json",
	            success: function(response) {
	            	console.log(response);
	            },
	            error: function(xhr) {
					$("#message").html(xhr.responseJSON.data.message);
	            }
	        });
		}
	});
});