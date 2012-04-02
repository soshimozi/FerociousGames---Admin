
		$(document).ready(function() {	
			initUI();
			
				//style: 'dropdown',
				//menuWidth: 220,
				//width:220
						
			$('#category-select').selectmenu({ style: 'dropdown', width: 220 });  
		});

		function initUI() {
			hideSpinner();
			
			$( "input:submit").button();
			$( "input:button").button();
			
			$('.items-per-page-select').selectmenu({
				style:'popup', 
				menuWidth: 180,
				width:150
				}); 
				    
			$('div.addgame input:button').click(function(e) {
				//Cancel the link behavior
				e.preventDefault();
				addAllGames();
			});				
		}
		
		 function changePage(category, page,limit) {
		 
			//limit = typeof limit !== 'undefined' ? limit : 20;		 
			
			var url = "/mochi_feed_entries/index/";
			if( category ) {
				url = url + "category:"+category+"/";
			}
			
			if( limit ) {
				url = url + "limit:"+limit+"/";
			}
			
			if( page ) {
				url = url + "page:"+page+"/";
			}

			showSpinner();
			$.ajax({
				url: url,
				success: function(html){
					
					$("#inner-content").html($(html).find("#inner-content").html()); 
					
					hideSpinner();
					initUI();
					
				},
				error: function(xhr, textStatus, thrownError){
					hideSpinner();				
				}
			});	
			
			return false;
		}

		function showSpinner() {
			$(".spinner").show();
		}
		
		function hideSpinner() {
			$(".spinner").hide();
		}
		
		function addAllGames() {
			var values = new Array();
			$.each($("input[name='gametag[]']:checked"), function() {
			  values.push($(this).val());
			});				

			showDialog(
				"#submitdlg", 
				function(e) { 
					$(e).fadeIn(1000); 
					$("#statusblock").html("");
					$("#modal_header").html("");
					$("#modal_header").append("<b>Submitting Requests - Please Wait</b>");				
					}, 
				function() { }, 
				false);

			doAjaxAddGame(values);
		}
		
		function showDialogCallback(el) {
			$(el).fadeIn(1000);
		}
		
		function showGame(parent, gametag) {
			
			showDialog('#gamedlg', 
				function(el) {
					$("#statusblock").html("");
					$("#modal_header").html("");
					$("#modal_header").append("<b>Submitting Requests - Please Wait</b>");			
					
				}, 
				function() { 
					$('#game_video').remove(); 
					}, 
				true);  
			
			
			$.ajax({
				url: "/mochi_feed_entries/view/"+gametag,
				success: function(html){
					$("#gamecontent").html($(html).find("#game_info")); 

					hideLoading();
					
					$('#gamedlg').show();					
					
					// hookup buttons on content screen
					$("input:button").button();
				},
				error: function(xhr, textStatus, thrownError){
					alert("Uh oh, something bad happened: " + textStatus);
					closeDialogWindow();
				}
			});				
		}		
		  
		function addSingleGame(gametag) { 
		
			$("#gamestatusblock").append("<span style=\"color:#686868;\">Contacting server ... </span>");
			
			$.ajax({ 
				type: "POST",
				url: "/mochi_feed_entries/addgame/" + gametag, 
				crossDomain: true,
				success: function(html){
					$("#gamestatusblock").append("<span style=\"color:#228b22;font-weight:bold;\">success!</span><br />"); 
					
					var id = "#" + gametag;
					$(id).find("input:checkbox").attr("disabled", true);
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
					
						var id = "#" + currentTag;
						$(id).find("input:checkbox").attr("disabled", true);
						
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
				linkDialogClosed(function() { });
			}
		}
		
