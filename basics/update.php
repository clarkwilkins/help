<?php

/*
	basics/update.php
	
	2019.11.17	Created. (1) (1.0)
*/

if ( !is_numeric ( $id ) or $id < 1 ) { return; }

$array = array (
	1	=>	'platform',
	2	=>	'title',
	3	=>	'draft',
	4	=>	'notes',
	5	=> 	'related'
);

if ( $array[$updateSignal] ) {

	$query = " UPDATE help SET " . $array[$updateSignal] . " = '{$newValue}' WHERE id = '{$id}'; ";
	
} else if ( $updateSignal == 6 ) {

	$query = " DELETE FROM help WHERE id = '{$id}'; ";
	
}

$update = pg_query ( $connection, $query ) or $errors[2]['basics/update.php'] = $query . "\n" . pg_last_error();

?>