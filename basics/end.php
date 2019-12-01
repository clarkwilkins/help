<?php

/*
	basics/end.php
	
	2019.11.30	Adopted from accountd. (1) (1.0)
*/

echo '</div>';

if ( $connection ) { require 'basics/error_check.php'; }

echo '
					<input	id = "helpLink"
								type = "hidden"
								value = "' . $helpLink . '" />
								
					<div	id = "errorsD"></div>
			
				</div>';