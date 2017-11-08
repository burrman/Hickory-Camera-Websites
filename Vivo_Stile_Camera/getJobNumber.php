<?php

function getJobNumber ($filePath) {
	
	$contents = $filePath;

	if (preg_match('_Job(.*)_', $contents, $matches)) {
		
		return $matches[1];
		
	} else {
		
		return "UnknownJob.jpg";
		
	}

}

?>