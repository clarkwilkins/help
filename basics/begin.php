<?php

/*
	basics/begin.php
	
	2019.11.30 (1) (1.0)
*/

session_start ();
ini_set ( 'error_reporting' , 'E_ALL & ~E_NOTICE &~E_STRICT &~E_WARNING' );
error_reporting ( E_ALL & ~E_NOTICE &~E_STRICT &~E_WARNING );
date_default_timezone_set ( 'America/Los_Angeles' );

require_once 'basics/connection.php'; 

// now set up the page

echo '
	<html xmlns = "http://www.w3.org/1999/xhtml" xml:lang = "en" lang = "en">
	
		<head>
		
			<meta name = "viewport" content = "width=device-width, user-scalable=yes, initial-scale=1.0"/>			
			<link rel = "stylesheet" type = "text/css" media = "screen" href = "https://global.simplexable.com/css/standard.css?v=20200510-01">
			<link rel = "stylesheet" type = "text/css" media = "screen" href = "https://helpd.simplexable.com/css/page.css?v=20200510-01">
			<script type = "text/javascript" src = "https://global.simplexable.com/js/jquery.js"></script>
			<script type = "text/javascript" src = "https://global.simplexable.com/js/callAfterDelay.js"></script>
			<script type = "text/javascript" src = "https://global.simplexable.com/js/pickadate.js"></script>
			<script type = "text/javascript" src = "https://global.simplexable.com/js/handler.js"></script>
			<script type = "text/javascript" src = "js/site.js?v=20200505-01"></script>';
			
if ( $title ) { echo '<title>' . $title . '</title>'; }

echo '</head>'; 

if ( $_SESSION['accountdUser'] == '1f3e12b06dc50e01b1adaccddbcf2429' ) {

	$superUser = true;
	
} else {

	$superUser = false;
	
}

echo '		
	<body>
	
		<div id = "body">
		<div	id = "overlay"></div>

		<div id = "menu">
	
			<div	id = "area">' . $area . '</div>';
			
if ( $superUser == true ) {

	echo '	
			<a 	class = "menuItem"
					href = "manage.php">manage</a>';
					
}

echo '	
			<a 	class = "menuItem"
					href = "search.php">search</a>
		
			&nbsp;
		
		</div>
	
		<div id = "main">';
		
?>
		
