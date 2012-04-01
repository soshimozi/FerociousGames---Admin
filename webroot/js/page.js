	$(document).ready(function() {
		
				//select all the a tag with name equal to modal
				$('input[id=clearSearch]').click(function(e) {
				
					//Cancel the link behavior
					e.preventDefault();
					
					showWindow("#submitdlg");
					callServer();
					//addCloseBox();
					
					//viewGame(submitted_ids.shift());

				});
		
	});
	
	function callServer() {
	
		$("#statusblock").append("Contacting server... ");
	
		$.ajax({
			type: "POST",
			url: "/mochi_feed_entries/clearsearch/",
			crossDomain: true,
			success: function(html){
			
				$("#statusblock").append("success!<br />"); 
				doAjax();
			},
			error: function(xhr, textStatus, thrownError){
				alert("Uh oh, something bad happened: " + textStatus);
				hideModal();
			}
		});				
	}
	
	function addCloseBox() {
	
		$("#modal_header").append(" | <a href='#' class='close'>Close</a><br />");
	
		//if close button is clicked
		$('.window .close').click(function (e) {
			//Cancel the link behavior
			e.preventDefault();
			hideModal();
		});				
	}
	
	function showWindow(id) {
		
			$("#statusblock").html("");
			$("#modal_header").html("");
			

			$("#modal_header").append("<b>Clearing cache</b>");
			
			//Get the screen height and width
			var maskHeight = $(document).height();
			var maskWidth = $(window).width();
		
			//Set heigth and width to mask to fill up the whole screen
			$("#dlgmask").css({'width':maskWidth,'height':maskHeight});
			
			//transition effect		
			$("#dlgmask").fadeIn(1000);	
			$("#dlgmask").fadeTo("slow",0.8);	
		
			//Get the window height and width
			var winH = $(window).height();
			var winW = $(window).width();
				  
			//Set the popup window to center
			$(id).css('top',  winH/2-$(id).height()/2);
			$(id).css('left', winW/2-$(id).width()/2);
		
			//transition effect
			$(id).fadeIn(1000); 		
		}

		function hideModal() {
			// remove video element to stop video from playing (potentially)
			$("#dlgmask").hide(); 
			$('.window').hide();
			
		}		
