/*
	js/site.js
		
	2019.11.30	Started design with core from accountd. (1) (1.0)
	
	SIGNALS
	
	1:	update the help article's metadata
	2: creates a new article metadata record
	3: loads references to articles in the selected platform.
*/

function help ( signal, flag, flag2, flag3, flag4 ) {

	loading = '<img src = "images/ajax-loader.gif" height = "20" width = "20" border = "0" />';
	unhappy = '<img src = "images/unhappy_face.gif" height = "30" width = "30" border = "0" />';

	if ( signal == -1 ) {
	
		$('.default-value').each(function() {
			var default_value = this.value;
			$(this).css('color', '#aaa');
			$(this).focus(function() {
				if(this.value == default_value) {
					this.value = '';
					$(this).css('color', '#555');
				}
			});
			$(this).blur(function() {
				if(this.value == '') {
					$(this).css('color', '#aaa');
					this.value = default_value;
				}
			});
		});
				
	} else if ( signal == -2 ) {
	
		T = $ ( '#' + flag ); console.log ( T );
		T.toggle();
		
		if ( flag2 ) { $ ('html, body' ).animate ( { scrollTop: ( T.offset().top - 100 ) }, 500 ); }
		
	} else if ( signal == -3 ) {
	
		$ ( "#area" ).html ( flag );
		
	}
	
	if ( signal < 1 ) { return; }
	
	if ( signal == 1 ) {
	
		flag2 = $ ( "#e_serial" ).val();
		
		if ( flag == 1 ) {
		
			flag3 = $ ( "#e_platform" ).val();
			
		} else if ( flag == 2 ) {
		
			flag3 = $ ( "#e_title" ).val();
			
			if ( !flag3 ) {
			
				alert ( 'The title cannot be left blank.' );
				return;
				
			}
			
		} else if ( flag == 3 ) {
		
			flag3 = $ ( "#e_draft" ).val();
			
		} else if ( flag == 4 ) {
		
			flag3 = $ ( "#e_notes" ).val();
			
		} else if ( flag == 5 ) {
		
			flag3 = $ ( "#e_related" ).val();
			
		} else if ( flag == 6 ) {
		
			x = confirm ( 'If you delete this record, the file is not automatically deleted (for safety reasons).' );
			
			if ( !x ) { return; }
			
		}
	
	} else if ( signal == 2 ) {
	
		flag = $ ( "#platform" ).val();
		flag2 = $ ( "#title" ).val();
		flag3 = $ ( "#comments" ).val();
		
	} else if ( signal == 3 ) {
	
		flag = $ ( "#s_platform" ).val();
		S = $ ( "#s_results" );
		
		if ( !flag ) {
		
			S.html ( '' );
			return;
			
		}
		
		S.html ( loading );
	
	}
			
	$ ( "#main" ).fadeTo( 0.5, 0.2 );
	
	$.ajax ( {

		url: "helpd.php",

		data: {
			a: signal,
			b: flag,
			c: flag2,
			d: flag3,
			e: flag4
		},

		type: "POST",
		dataType : "html"
	
	} )
	
 // Code to run if the request succeeds (is done);
 // The response is passed to the function
 
	.done ( function ( result ) {
		
		if ( signal != 1000 ) { console.log ( 'signal ' + signal + ': ' + result );  }
		
		if ( signal == 1 && result == 1 ) { // no response need if there is no error 
			
		} else if ( signal == 2 && +result >= 1 ) {
		
			window.location.href = '?a=' + result;
			
		} else if ( signal == 3 && result ) {
		
			S.html ( result );
			
		} else {
		
			showError ( signal, result );
		
		}
		
	} )

	.fail ( function( xhr, status, errorThrown ) {

		console.log ( "Error: " + errorThrown );
		console.log ( "Status: " + status );
		console.dir ( xhr );
		
	})
 
	.always ( function ( xhr, status ) {
		
		$ ( "#main" ).fadeTo ( 1000, 1.0 );
	
 	} );

}

function showError ( signal, result ) {

	$ ( "#errorsD" ).html( result );
	console.log ( 'signal ' + signal + ' had an unexpected result: ' + result + ' (length: ' + result.length + ')' );
	$ ( "html, body" ).animate( { scrollTop: $ ( "#errorsD" ).scrollTop() }, 1000 );
	alert ( 'Summon the programmers! We have a fault on signal ' + signal + '.' );
	
}

function reloadPage () { document.location.reload( true );  }

$(document).ready(function() {

	$('.default-value').each(function() {
		var default_value = this.value;
		$(this).css('color', '#aaa');
		$(this).focus(function() {
			if(this.value == default_value) {
				this.value = '';
				$(this).css('color', '#555');
			}
		});
		$(this).blur(function() {
			if(this.value == '') {
				$(this).css('color', '#aaa');
				this.value = default_value;
			}
		});
	});
	
});
