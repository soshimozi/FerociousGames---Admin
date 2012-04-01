		var submitted_ids = new Array();
		
		$(document).ready(function() {	
		 
			//select all the a tag with name equal to modal
			$('input[id=addGame]').click(function(e) {
			
				//Cancel the link behavior
				e.preventDefault();
				
				var values = new Array();
				$.each($("input[name='gametag[]']:checked"), function() {
				  submitted_ids.push($(this).val());
				});				

				launchWindow("#submitdlg");
				doAjax();
				
				//viewGame(submitted_ids.shift());

			});
			
			//if close button is clicked
			$('.window .close').click(function (e) {
				//Cancel the link behavior
				e.preventDefault();
				
				hideModal();
			});		
		});
		
		function doAjax() {
			var currentTag = submitted_ids.shift();
			
			if( currentTag ) {
				$("#statusblock").append("Contacting server... ");
				
				$.ajax({
					type: "POST",
					url: "/mochi_feed_entries/addgame/" + currentTag,
					crossDomain: true,
					success: function(html){
					
						$('input[value="'+currentTag+'"]').attr("checked", false);
						$('input[value="'+currentTag+'"]').attr("disabled", true);
						
						$("#statusblock").append("success!<br />"); 
						doAjax();
					},
					error: function(xhr, textStatus, thrownError){
						alert("Uh oh, something bad happened: " + textStatus);
						hideModal();
					}
				});				
			} else {
				$("#modal_header").append(" | <a href='#' class='close'>Close</a><br />");
			
				//if close button is clicked
				$('.window .close').click(function (e) {
					//Cancel the link behavior
					e.preventDefault();
					hideModal();
				});				
			}
		}
		
		function hideModal() {
			// remove video element to stop video from playing (potentially)
			$('#game_video').remove();
			
			$("#dlgmask").hide(); 
			$('.window').hide();
			
		}
		
		
		function viewGame(gametag) {
		
			$.ajax({
				url: "/mochi_feed_entries/view/"+gametag,
				success: function(html){
				
					$("#gamecontent").html(html); 
				},
				error: function(xhr, textStatus, thrownError){
					alert("Uh oh, something bad happened: " + textStatus);
					hideModal();
				}
			});				
		}
		
		function addGame(gametag) { 
		
			$("#gamestatusblock").append("<span style=\"color:#686868;\">Contacting server ... </span>");
			
			$.ajax({
				type: "POST",
				url: "/mochi_feed_entries/addgame/" + gametag,
				crossDomain: true,
				success: function(html){
				
					$("#gamestatusblock").append("<span style=\"color:#228b22;font-weight:bold;\">success!</span><br />"); 
				},
				error: function(xhr, textStatus, thrownError){
					alert("Uh oh, something bad happened: " + textStatus);
					hideModal();
				}		
			});
		};
		
		function launchWindow(id) {
				//Get the A tag
				//var id = $(this).attr('href');
			
				$("#statusblock").html("");
				$("#modal_header").html("");
				
 
				$("#modal_header").append("<b>Submitting Requests - Please Wait</b>");
				
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
			
		function showGame(parent, gametag) {
			
			launchWindow('#gamedlg');
			viewGame(gametag);
		}