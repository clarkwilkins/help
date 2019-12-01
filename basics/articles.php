<?php

/*
	basics/articles.php
	
	2019.12.01	Created. (1) (1.0)
*/

$_SESSION['helpPlatform'] = $platform;
$query = " SELECT * FROM help WHERE platform = {$platform} ORDER BY title; ";
$getData = pg_query ( $connection, $query ) or $errors[4]['articles.php'] = $query . "\n" . pg_last_error();

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
					onclick = "window.location.href = \'manage.php?a=' . $id . '\';">
			
				<div>' . $title . '</div>
				
				<div class = "smaller">updated ' . dateFormatter ( $updated, true ) . '</div>
			
			</div>';
		$theCounter += 1;

	} 
	
	echo '</div>';
	
}

?>