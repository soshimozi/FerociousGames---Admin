
		$(document).ready(function() {	
			initUI();
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
				    
			$('#addgame-button').click(function(e) {
				//Cancel the link behavior
				e.preventDefault();
				addAllGames();
			});				
			
			$('#category-select').selectmenu({ style: 'dropdown', width: 220 });  
		}
		
		 function changePage(category, page,limit) {
		 
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
					
					if( xhr.status == 403 ) {
						window.location.href = "/users/login";
					}
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

			$("#statusblock").html("");
			$("#modal-header").html("");
			$("#modal-header").append("Submitting Requests - Please Wait");			
			
			$("#submitdlg").dialog({
				title: 'Submitting Selected Games',
				open: function(event, ui) {
					
					doAjaxAddGame(values);
				},
				modal: true,
				height: 300,
				width: 400				
			});
			
			$("#submitdlg").dialog('open');

		}
		
		function doAjaxAddGame(submitted_ids) {
		
			var currentTag = submitted_ids.shift();
			
			if( currentTag ) {
				
				var $div = $("<div></div>");
				$div.html("Contacting server ...");
				$("#statusblock").append($div);
				
				$.ajax({
					type: "POST",
					url: "/mochi_feed_entries/addgame/" + currentTag,
					crossDomain: true,
					success: function(html){
					
						var id = "#" + currentTag;
						
						$('input[value="'+currentTag+'"]').attr("checked", false);
						$('input[value="'+currentTag+'"]').hide();
						
						$div.html($div.html() + "success!<br />"); 
						
						// call recursively
						doAjaxAddGame(submitted_ids);
					},
					error: function(xhr, textStatus, thrownError){
						alert("Uh oh, something bad happened: " + textStatus);
						$("#submitdlg").dialog('close');
					}
				});				
			} else {  
				$("#modal-header").html($("#modal-header").html() + "<span> | <a href='#' class='close'>Close</a></span>");
				$('#modal-header a').button().click(function(e) {
						$("#submitdlg").dialog('close');
					});
			}
		}
		
		
		function showGame(parent, name, gametag) {
			
			var $dialog = $("#gamedlg").dialog({
				title: name,
				beforeClose: function(event, ui) { },
				close: function(event, ui) { 
					$('#game_video').remove(); 
				},
				open: function(event, ui) {
				
					// hide old contents
					$('#gamedlg-contents').hide();

					// show loading
					$("#loading-div").show();
					
					$.ajax({
						url: "/mochi_feed_entries/view/"+gametag,
						success: function(html){
							
							$("#loading-div").hide();
							$("#gamecontent").html($(html).find("#game_info")); 
							$('#gamedlg-contents').fadeIn('fast');

							// hookup buttons on content screen
							$dialog.find("input:button").button();
						},
						error: function(xhr, textStatus, thrownError){
							if( xhr.status == 403  ) {
								$dialog.dialog('close');
								window.location.href = "/users/login";
							} else {

								printObject(xhr);
								alert("Uh oh, something bad happened: " + textStatus);
								$dialog.dialog('close');
							}
						}
					});				
				},
				modal: true,
				height: 700,
				width: 1100
				});
				
			$dialog.dialog('open');			
			
			$dialog.find('.close').click(function (e) {
				//Cancel the link behavior
				e.preventDefault();
				$dialog.dialog('close');
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
				}		
			});
		};
		
		function printObject(o) {
			  var out = '';
			  for (var p in o) {
			    out += p + ': ' + o[p] + '\n';
			  }
			  alert(out);
			}		

		
