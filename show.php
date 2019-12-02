<?php

/*
	show.php
	
	2019.11.30	Adapted from accountd version. (1) (1.0)
*/

require 'basics/begin.php';  

if ( is_numeric ( $_GET['h'] ) and $_GET['h'] >= 1 ) { 

	$help = $_GET['h']; 

} else {
	
	echo '<blockquote>the help article id <b>' . $_GET['h'] . '</b> was not located.</blockquote>';
	return;
	
}

require_once 'basics/connection.php'; 

$query = " SELECT * FROM help WHERE draft = 'f' AND id = {$help}; ";
$getData = pg_query ( $connection, $query ) or $errors[3]['help.php'] = $query . "\n" . pg_last_error();

$row = pg_fetch_array ( $getData, 0 );
$related = explode ( ' ', sprintf ( "%s", $row["related"] ) );
$platform = sprintf ( "%s", $row["platform"] );
$title = stringCleaner ( sprintf ( "%s", $row["title"] ) ); 

if ( !$title ) { $title = 'not available'; }

$_SESSION['helpPlatform'] = $platform;

$platforms = array (
	1		=> 	'accountd',
	2		=>	'stockd',
	3		=>	'servicd',
	4		=>	'topical'
);

$area = $platforms[$platform] . ' help';
echo '<script type = "text/javascript">help ( -3, \'' . $area . '\' );</script>';

// show the article
		
echo '<div class = "block"><b>' . $title . '</b></div>';

echo file_get_contents ( 'articles/' . $help . '.html' );

if ( is_array ( $related ) ) {

	$or = '';
	
	$query = " SELECT id, title FROM help WHERE ( ";
	
	foreach ( $related as $relatedId ) {
		
		$query .= $or . " id = {$relatedId} ";
		$or = ' OR ';
		
	}
	
	$query .= " ) AND draft = 'f' ORDER BY title; ";
	$getData = pg_query ( $connection, $query ) or $errors[3]['help.php'] = $query . "\n" . pg_last_error();
	
	if ( pg_numrows ( $getData ) > 0 ) {
	
		echo '
			<br />
			
			<div class = "block tiny">
			
				<div>RELATED TOPICS</div>';

		$theCounter = 0;

		while ( $theCounter < pg_numrows ( $getData ) ) {

			$row = pg_fetch_array ( $getData, $theCounter );
			$id = sprintf ( "%s", $row["id"] );
			$title = stringCleaner ( sprintf ( "%s", $row["title"] ) );
			echo '
				<div class = "reportLine">
				
					<a	class = "light"
							href = "?h=' . $id . '">
							
						<div class = "p1">' . $title . '</div>
							
					</a>
				
				</div>';
			$theCounter += 1;

		} 
		
		echo '</div>';
	
	}
	
}

require 'basics/end.php';

?>