<?php

/*
	search.php
	
	2019.12.01	Created. (1) (1.0)
*/

$area = 'help articles';
require_once 'basics/begin.php';

if  ( !$_SESSION['helpPlatform'] ) {

	echo '<blockquote>Apologies, but your session is not currently providing us information on the service you are using. Please go back to it and open help again. This function should be working when you return here.</blockquote>';

} else {

	$query = " SELECT * FROM help WHERE platform = '" . pg_escape_string ( $_SESSION['helpPlatform'] ) . "' ORDER BY title; ";
	$getData = pg_query ( $connection, $query ) or $errors[3]['search.php'] = $query . "\n" . pg_last_error();

	if ( $errors ) { return; }
	
	if ( pg_numrows ( $getData ) > 0 ) {

		echo '<div class = "results">';
		
		$theCounter = 0;

		while ( $theCounter < pg_numrows ( $getData ) ) {

			$row = pg_fetch_array ( $getData, $theCounter );
			$id = sprintf ( "%s", $row["id"] );
			$title = stringCleaner ( sprintf ( "%s", $row["title"] ) );
			$updated = sprintf ( "%.10s", $row["updated"] );
			echo '
				<div class = "reportLine2 p1"
						onclick = "window.location.href = \'show.php?h=' . $id . '\';">
				
					<div>' . $title . '</div>
					
					<div class = "smaller">updated ' . dateFormatter ( $updated, true ) . '</div>
				
				</div>';
			$theCounter += 1;

		} 
		
		echo '</div>';
		
	}

}

require_once 'basics/end.php';

?>