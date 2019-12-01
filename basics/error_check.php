<?php

/*
	basics/error_check.php
	
	2019.11.30	Adopted from accountd. (1) (1.0)
*/

if ( !$errors ) { 

	$x = pg_query ( "COMMIT" );
	
	if ( $helpd and !$responded ) { echo 1; }

} else if ( $thisUser == '1f3e12b06dc50e01b1adaccddbcf2429' ) {

	echo '
		<div><img src = "images/unhappy_face.gif" style = "height: 30px;" /> Oops. ' . count ( $errors ) . ' error';

	if ( count ( $errors ) > 1 ) { echo 's'; }

	echo ' occured.</div>';

	foreach ( $errors as $code => $array ) {
	
		if ( is_array ( $array ) ) {
			
			foreach ( $array as $script => $error ) { 
			
				echo '
					<div>code ' . $code . ' in ' . $script . '</div>
				
					<div><tt>' . nl2br ( $error ) . '</tt></div>';
				
			}
			
		} else {
		
			echo '<div>error: ' . $array . '</div>';
			
		}
	
	}

} 

?>
