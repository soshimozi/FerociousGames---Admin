
		//var submitted_ids = new Array();
		
		$(document).ready(function() {	
		 
			$( "input:submit").button();
			//$( "input:submit", "#clearfilterform").button();
			$( "input:button").button();
			
			$('.items-per-page select').selectmenu({
				style:'popup', 
				menuWidth: 180,
				width:150
				}); 
				  
			$("#testmeh").click(function(e) {
				//Cancel the link behavior
				e.preventDefault();
				alert('testmeh!');
				
				window.location.href = "/mochi_feed_entries/testyo";
				
 			});
				  
			//select all the a tag with name equal to modal
			$('div.addgame input:button').click(function(e) {
				//Cancel the link behavior
				e.preventDefault();
				addAllGames();
			});				
				
		});

		function addAllGames() {
			var values = new Array();
			$.each($("input[name='gametag[]']:checked"), function() {
			  values.push($(this).val());
			});				

			showDialog("#submitdlg", windowClosing);

			$("#statusblock").html("");
			$("#modal_header").html("");
			$("#modal_header").append("<b>Submitting Requests - Please Wait</b>");				
			
			doAjaxAddGame(values);
		}
		
		function showGame(parent, gametag) {
			
			showDialog('#gamedlg', windowClosing);
			
			$("#statusblock").html("");
			$("#modal_header").html("");
			$("#modal_header").append("<b>Submitting Requests - Please Wait</b>");			
			
			$.ajax({
				url: "/mochi_feed_entries/view/"+gametag,
				success: function(html){
				
					$("#gamecontent").html(html); 
					$("input:button").button();
					
					//linkDialogClosed(windowClosing);
				},
				error: function(xhr, textStatus, thrownError){
					alert("Uh oh, something bad happened: " + textStatus);
					closeDialogWindow();
				}
			});				
		}		
		  
		function windowClosing() {
			$('#game_video').remove();
		}

		function addSingleGame(gametag) { 
		
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
					closeDialogWindow();
				}		
			});
		};
		

		function doAjaxAddGame(submitted_ids) {
		
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
						
						// call recursively
						doAjaxAddGame(submitted_ids);
					},
					error: function(xhr, textStatus, thrownError){
						alert("Uh oh, something bad happened: " + textStatus);
						closeDialogWindow();
					}
				});				
			} else {
				$("#modal_header").append(" | <a href='#' class='close'>Close</a><br />");
				$('#modal_header a').button();
				linkDialogClosed(windowClosing);
			}
		}
		
		function bleh() {
			$.ajax({
				url: "/mochi_feed_entries/index/category:premium/page:5",
				success: function(html){
					$("#content-holder").html($(html).find('#content-holder').html()); 
				},
				error: function(xhr, textStatus, thrownError){
					alert("Uh oh, something bad happened: " + textStatus);
					closeDialogWindow();
				}
			});		
		}		
