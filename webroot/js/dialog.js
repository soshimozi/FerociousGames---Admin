		var _fnclose;
		
		function closeDialogWindow() {

			$("#dlgmask").hide(); 
			$('.window').hide();
			
			if( _fnclose ) {
				_fnclose();
			}   

		}

 		function showDialog(id, fninit, fnclose, showloading) {
			
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
		
			fninit($(id));
			
			if( showloading ) {
				$("#loading-div").show();
				
				$("#loading-div").css('top',  winH/2-$(id).height()/2);
				$("#loading-div").css('left', winW/2-$(id).width()/2);
			}
			
			linkDialogClosed(fnclose);
		}
		
		function hideLoading() {
			$("#loading-div").hide();
		}
		
		function linkDialogClosed(closefn) {
			_fnclose = closefn;
			
			$('.window .close').click(function (e) {
				//Cancel the link behavior
				e.preventDefault();
				closeDialogWindow();
			});				
			
		}
