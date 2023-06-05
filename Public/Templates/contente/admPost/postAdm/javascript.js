$(document).ready(() => {

    $("#addPost").on( "click", function() {

		if($("#message").html() !== "")
			$("#message").html("");

    	if(!$("#title").val())
			$("#message").html("Title required");

		else if(!$("#postContente").val())
			$("#message").html("Post contente is Invalid");
		
		else {

			$("#message").html("Loading...");

	        $.ajax({
	            url: "/post/addPost",
	            type: "POST",
	            data: {
	            	postContente: $("#postContente").val(), 
	            	title: $("#title").val()
	            },
	            dataType: "json",
	            success: function(response) {
	            	$("#title").val("");
	            	$("#postContente").val("");
					$("#message").html("Post successfully added");
	            },
	            error: function(xhr) {
					$("#message").html(xhr.responseJSON.data.message);
	            }
	        });
		}
	});

    $("#deletePost").on( "click", function() {

		if($("#message").html() !== "")
			$("#message").html("");

    	if(!$("#deletePostInput").val())
			$("#message").html("Post id is required");

		else {
	        
			$("#message").html("Loading...");

	        $.ajax({
	            url: "/post/delete/"+$("#deletePostInput").val(),
	            type: "DELETE",
	            dataType: "json",
	            success: function(response) {
	            	$("#deletePostInput").val("");
					$("#message").html("Post deleted successfully");
	            },
	            error: function(xhr) {
					$("#message").html(xhr.responseJSON.data.message);
	            }
	        });
		}
	});

});