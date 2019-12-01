<?php

/*
	basics/connection.php
	
	2019.11.30	Adapted from accountd version. (1) (1.0)
*/

$host = $_SERVER['HTTP_HOST'];
$hostPath = 'https://' . $host;

if ( $host == 'localhost' or $host == 'clark.local' or substr ( $host, 0, 7 ) == '10.0.1.'  ) { 

	$connection = pg_connect( 'hostaddr=127.0.0.1 dbname=help user=clark password=wonka237q' );
	$hostServer = 'http://clark.local/accountd';
	$tempDir = '/Library/Webserver/Documents/accountd/tmp/'; 
	
} else {

	$array = explode ( '.', $host );
	$base = $array[0];
	$connection = pg_connect( 'host=localhost port=5432 dbname=help user=root' );
	$hostServer = 'http://' . $host  . '/';

} 

if ( !$connection ) { 

	echo '<meta http-equiv="refresh" content="0; url=./nologin"></head></html>';
	die;

} 

$startProcessing = pg_query( $connection, "BEGIN" ); 

function stringCleaner ( $string )

{

	$string = str_replace ( "\\", "", $string );
	$string = str_replace ( "''''", "'", $string );
	$string = str_replace ( "'''", "'", $string );
	$string = str_replace ( "''", "'", $string );
	$array = array (  "\x80" => "'", "\x81" => " ", "\x82" => "'", "\x83" => "f", "\x84" => "\"", "\x85" => "...", "\x86" => "+", "\x87" => "#", "\x88" => "^", "\x89" => "0/00", "\x8A" => "S", "\x8B" => "<", "\x8C" => "OE", "\x8D" => " ", "\x8E" => "Z", "\x8F" => " ", "\x90" => " ", "\x91" => "`", "\x92" => "'", "\x93" => "\"", "\x94" => "\"", "\x95" => "*", "\x96" => "-", "\x97" => "--", "\x98" => "~", "\x99" => " ", "\x9A" => "s", "\x9B" => ">", "\x9C" => "oe", "\x9D" => " ", "\x9E" => "z", "\x9F" => "Y", "\x2122" => "&#8482;", "\x169" => "&copy;", "\x174" => "&reg;" );
	$array = array( "\x80" => "'", "\x81" => " ", "\x82" => "'", "\x83" => "f", "\x84" => "\"", "\x85" => "...", "\x86" => "+", "\x87" => "#", "\x88" => "^", "\x89" => "0/00", "\x8A" => "S", "\x8B" => "<", "\x8C" => "OE", "\x8D" => " ", "\x8E" => "Z", "\x8F" => " ", "\x90" => " ", "\x91" => "`", "\x92" => "'", "\x93" => "\"", "\x94" => "\"", "\x95" => "*", "\x96" => "-", "\x97" => "--", "\x98" => "~", "\x99" => " ", "\x9A" => "s", "\x9B" => ">", "\x9C" => "oe", "\x9D" => " ", "\x9E" => "z", "\x9F" => "Y", "\x2122" => "&#8482;", "\x169" => "&copy;", "\x174" => "&reg;"  );
	return $string;
				 
}

function dateFormatter( $date, $quiet ) {

	if ( strtotime( $date ) !== false ) {

		$array = explode ( '-', $date );
		$date = $array[0] . '.';
	
		if ( strlen ( $array[1] ) == 1 ) { $date .= '0'; }
	
		$date .= $array[1] . '.';
	
		if ( strlen ( $array[2] ) == 1 ) { $date .= '0'; }
	
		$date .= $array[2];
		
	} else {
	
		$date = 'not set';
		
	}
	
	if ( $quiet != true ) { echo $date; } else { return ( $date ); }
	
}

?>