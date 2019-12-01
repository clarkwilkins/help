<?php

/*
	helpd.php
	
	2019.11.30	Created. (1) (1.0)
	
	SIGNALS
	
	1:	update the help article's metadata
	2: creates a new article metadata record
	3: loads references to articles in the selected platform.
*/

session_start ();
ini_set ( 'error_reporting' , 'E_ALL & ~E_NOTICE &~E_STRICT &~E_WARNING' );
error_reporting ( E_ALL & ~E_NOTICE &~E_STRICT &~E_WARNING );
require_once 'basics/connection.php'; 
date_default_timezone_set ( 'America/Los_Angeles' );
$errors 			= '';
$signal 			= $_POST['a'];
$signal2 			= trim ( pg_escape_string ( $_POST['b'] ) );
$signal3 			= trim ( pg_escape_string ( $_POST['c'] ) );
$signal4 			= trim ( pg_escape_string ( $_POST['d'] ) );
$signal5 			= trim ( pg_escape_string ( $_POST['e'] ) );

if ( $signal == 1 ) {

	$updateSignal = $signal2; 
	$id = $signal3;
	$newValue = $signal4;
	require 'basics/update.php';

} else if ( $signal == 2 ) {

	$platform = $signal2;
	$title = $signal3;
	$notes = $signal4;
	require 'basics/create.php';
	$responded = true;

} else if ( $signal == 3 ) {

	$platform = $signal2;
	require 'basics/articles.php';
	$responded = true;

}
 
$helpd = true;
require 'basics/error_check.php';

?>