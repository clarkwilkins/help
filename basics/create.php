<?php

/*
	help/create.php
	
	2019.11.30	Adapted from accountd. (1) (1.0)
*/

$query = "INSERT INTO help ( platform, title, updated, notes ) VALUES ( {$platform}, '{$title}', 'now', '{$notes}' );
	SELECT max (id) FROM help;";
$getData = pg_query ( $connection, $query ) or $errors[2]['help/create.php'] = $query . "\n" . pg_last_error();

if ( $errors ) { return; }

$query = " SELECT max (id) FROM help; ";
$getData = pg_query ( $connection, $query ) or $errors[2]['help/create.php'] = $query . "\n" . pg_last_error();

if ( $errors ) { return; }

$row = pg_fetch_array ( $getData, 0 );
$max = sprintf ( "%s", $row["max"] ); 
$max += 1;
echo $max;

?>