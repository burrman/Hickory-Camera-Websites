<?php



function checkTaskStatus ($fileAgeLimit) {

	$taskStatusFileName = 'taskRunning.txt';
	$taskIsRunning = false;

	if (file_exists($taskStatusFileName)) {
		
		//echo "file already exists, checking file age<br />";
		
		$fileAgeInSeconds = (date("U") - date("U", filemtime($taskStatusFileName)));
		
		if ($fileAgeInSeconds <= $fileAgeLimit) {
			
			//echo "task is not expired<br />";
			
			echo "task is already Running and is {$fileAgeInSeconds} seconds old<br />";
			
			$taskIsRunning = true;
			
		} else {
			
			//echo "task is expired<br />";
			
			echo "taks is expired and is {$fileAgeInSeconds} seconds old, deleting previous task<br />";
			
			deleteTaskStartStatus();
			
		}
		
	} else {
		
		//echo "file does not exist<br />";
		
		//echo "task is not running<br />";
		
	}
		
	return $taskIsRunning;
	
}






function logTaskStartStatus () {

	$taskStatusFileName = 'taskRunning.txt';
	$success = false;

		if (fopen($taskStatusFileName, "w+")) {
			
			//echo "file was created successfully<br />";
			
			//echo "task is started<br />";
			
			$success = true;
			
		} else {
			
			//echo "file could not be created for some reason<br />";
			
			//echo "task is not started<br />";
			
		}
			
	return $success;
	
}



function deleteTaskStartStatus () {

	$taskStatusFileName = 'taskRunning.txt';
	$success = false;
	
	if (file_exists($taskStatusFileName)) {

		if (unlink($taskStatusFileName)) {
				
			//echo "the file was successfully deleted<br />";
				
			//echo "task is stopped<br />";
				
			$success = true;
				
		} else {
				
			echo "the file could not be deleted<br />";
				
			//echo "task is not stopped<br />";
				
		}
				
	} else {
	
		echo "couldn't find file, nothing to delete<br />";
	
		$success = true;
	
	}
			
	return $success;
	
}



?>