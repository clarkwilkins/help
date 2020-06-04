<?php

/*
	basics/end.php
	
	2019.11.30	Adopted from accountd. (1) (1.0)
*/

if ( $connection ) { require 'basics/error_check.php'; }

echo '
		<input	id = "helpLink"
					type = "hidden"
					value = "' . $helpLink . '" />
					
		<div	id = "errorsD"></div>
		
	</div>
	
	<div class = "tiny">helpd and contents are &copy;' . date ( "Y" ) . ' by <a class = "light" href = "https://simplexable.com">simplexable.is,llc</div>	';