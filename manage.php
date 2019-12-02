<?php

/*
	manage.php
	
	2019.11.30	Adapted from help. (1) (1.0)
*/

$area = 'help manager';
require_once 'basics/begin.php';

if ( is_numeric ( $_GET['a'] ) ) {

	echo '<div id = "editView">';
	
	$query = " SELECT * FROM help WHERE id = " . $_GET['a'] . ";";
	$getData = pg_query ( $connection, $query ) or $errors[1]['manage.php'] = $query . "\n" . pg_last_error();

	if ( $errors ) { return; }
	
	if ( pg_numrows ( $getData ) > 0 ) {

		$editValid = true; // signalling that we have a valid edit record
		$hidden1 = 'hidden'; // hide the new article block for now
		
		$row = pg_fetch_array ( $getData, 0 );
		$draft = sprintf ( "%s", $row["draft"] );
		$id = sprintf ( "%s", $row["id"] );
		$notes = sprintf ( "%s", $row["notes"] );
		$platform = sprintf ( "%s", $row["platform"] );
		$related = sprintf ( "%s", $row["related"] );
		$title = stringCleaner ( sprintf ( "%s", $row["title"] ) );
		$updated = sprintf ( "%s", $row["updated"] );

// show the article
		
		echo '<div class = "block"></b>' . $title . '</b></div>';
		
		echo file_get_contents ( 'articles/' . $id . '.html' );

// start the editor
		
		echo '
			<br />
			
			<div class = "section">
			
				<div class = "sectionTitle floats">
				
					<div	class = "floatR light shift1"
							onclick = "help ( -2, \'editView\' ); help ( -2, \'search\' );">+search</div>
				
					<div	class = "floatR light shift1"
							onclick = "help ( -2, \'editView\' ); help ( -2, \'newArticle\' );">+new</div>
							
					edit
					
					
				</div>
				
				<div class = "disabled">help/articles/' . $id . '.html</div>
				
				<div class = "label">file</div>
			
				<input	id = "e_serial"
							type = "hidden"
							value = "' . $id . '" />
						
				<select		id = "e_platform"
								onchange = "help ( 1, 1 );">
							
					<option value = "1" ';
				
		if ( $platform == 1 ) { echo 'selected'; }
		
		echo '
					>accountd</option>
					<option value = "2" ';
				
		if ( $platform == 2 ) { echo 'selected'; }
		
		echo '
					>stockd</option>
					<option value = "3" ';
				
		if ( $platform == 3) { echo 'selected'; }
		
		echo '
					>servicd</option>
					<option value = "4" ';
				
		if ( $platform == 4) { echo 'selected'; }
		
		echo '
					>topical</option>
							
				</select>
			
				<div class = "label">platform</div>
			
				<input	id = "e_title"
							type = "text"
							onchange = "help ( 1, 2 );"
							value = "' . $title . '" />
						
				<div class = "label">title</div>
				
				<select		id = "e_draft"
								onchange = "help ( 1, 3 );">
								
					<option value = "t">draft</option>
					<option value = "f" ';
					
		if ( $draft == 'f' ) { echo 'selected'; }
		
		echo '
					>released</option>
								
				</select>
				
				<div class = "label">status</div>
				
				<textarea		id = "e_notes"
									onchange = "help ( 1, 4 );">' . $notes . '</textarea>
									
				<div class = "label">notes</div>
			
				<input	id = "e_related"
							type = "text"
							onchange = "help ( 1, 5 );"
							value = "' . $related . '" />
						
				<div class = "label">related</div>
				
				<div class = "button"
						onclick = "help ( 1, 6 );">delete the help record</div>
				
			</div>';
		
	}
	
	echo '</div>';
	$hidden1 = 'hidden';
	
}
	
echo '
	<div	id = "newArticle"
			class = "section ' . $hidden1 . '">
	
		<div class = "sectionTitle floats">';
		
if ( $editValid == true ) {

	echo '
			<div	class = "floatR light shift1"
					onclick = "help ( -2, \'editView\' ); help ( -2, \'newArticle\' );">+edit</div>';
					
}

echo '		
			<div	class = "floatR light shift1"
					onclick = "help ( -2, \'search\' ); help ( -2, \'newArticle\' );">+search</div>
					
			<div>new</div>
		
		</div>
		
		<select		id = "platform">
						
			<option value = "">no platform selected</option>
			<option value = "1">accountd</option>
			<option value = "2">stockd</option>
			<option value = "3">servicd</option>
			<option value = "4">topical</option>
			
		</select>
		
		<div class = "label">platform</div>
		
		<input	id = "title"
					type = "text"
					value = "" />
		
		<div class = "label">title</div>
					
		<textarea	id = "comments"></textarea>
		
		<div class = "label">comments</div>
		
		<div	class = "button"
				onclick = "help ( 2 );">save this draft</div>

	</div>
	
	<div	id = "search"
			class = "section hidden">
			
		<div	class = "floatR light shift1"
				onclick = "help ( -2, \'search\' ); help ( -2, \'newArticle\' );">+new</div>
			
		<div class = "sectionTitle floats">
		
			search
			
		</div>';
		
$platform = $_SESSION['helpPlatform'];

echo '		
		<select		id = "s_platform"
						onchange = "help ( 3 );">
				
			<option value = "">none selected</option>
					
			<option value = "1" ';
				
if ( $platform == 1 ) { echo 'selected'; }
		
echo '
			>accountd</option>
			<option value = "2" ';
				
if ( $platform == 2 ) { echo 'selected'; }
		
echo '
			>stockd</option>
			<option value = "3" ';
				
if ( $platform == 3) { echo 'selected'; }
		
echo '
			>servicd</option>
			<option value = "4" ';
				
if ( $platform == 4) { echo 'selected'; }
		
echo '
			>topical</option>
			
		</select>
		
		<div class = "label">platform</div>
		
		<div	id = "s_results">';

if ( $platform >= 1 ) { require 'basics/articles.php'; }
		
echo '
		</div>
			
	</div>';
	
require_once 'basics/end.php';

?>