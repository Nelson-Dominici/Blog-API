$(document).ready(() => {

	let skipQuery = 0;
	let canScroll = true;
	let postsDiv = document.querySelector("#postsDiv");

	function getPosts(){

		$.ajax({
		    url: "/getPosts?skipQuery="+skipQuery,
		    type: "get",
		    dataType: "json",
		    success: function(response) {
				
				skipQuery++;

		    	if(response.data.length !== 5){
		    		canScroll = false
		    	}

		    	for (let post of response.data) {
  					
  					let postHtml = `<div><a href='/post/${post.id}'>${post.title}
  					</a><p>${post.post_date}</p></div>`
				
					postsDiv.innerHTML += postHtml;
				}
		    },
		 	error: function(xhr) {
	            window.location.href = "/user/login";
		    }
		});
	}

	getPosts();

	$(window).scroll(function() {

	    if ($(window).scrollTop() == $(document).height() - $(window).height()) {

	    	if(canScroll){
	    		getPosts();
	    	}
	    }
  	});

});