		var _fnclose;
		
		function closeDialogWindow() {
			if( _fnclose ) {
				_fnclose();
			} 
			
			$("#dlgmask").hide(); 
			$('.window').hide();
			
		}

 		function showDialog(id, fnclose) {
			
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

			linkDialogClosed(fnclose);
		}
		
		function linkDialogClosed(closefn) {
			_fnclose = closefn;
			
			$('.window .close').click(function (e) {
				//Cancel the link behavior
				e.preventDefault();
				closeDialogWindow();
			});				
			
		}
