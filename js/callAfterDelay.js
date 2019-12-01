// callAfterDelay.js

// A simple mechanism to handle delayed validation based on keyboard entry.
// Copyright (c) 2008, Aral Balkan, All Rights Reserved.
// Released under the MIT license.

validationFunctionRefs = [];
timers = [];
function callAfterDelay (fnRef, duration)

{

	// Check if a timer for this validation function is already in effect and reset it if it is.
	for (i = 0; i < validationFunctionRefs.length; i++) {

		fnToCheck = validationFunctionRefs[i];
		
		if (fnToCheck == fnRef){

			timer = timers[i];
			clearInterval(timer);
			timers.splice(i,1);
			validationFunctionRefs.splice(i,1);
			break;

		}

	}
	timer = setTimeout(fnRef, duration);
	timers.push(timer);
	validationFunctionRefs.push(fnRef);
	return timer;
	
}