<?php

include('checkLogFileStatus.php');
include('operate.php');

$okToStartTask = false;


// check if the task is already running by looking for the signature file
if (checkTaskStatus(10)) {
	
	//echo "task is already running<br />";
	
	echo 'checked at: '.date("U").' absolute seconds<br />';
		
	echo 'server time: '.date('l jS \of F Y h:i:s A').'<br />';
	
} else {
	
	//echo "task is not already running<br />";
	
	//create the signature file to signify the task running status
	logTaskStartStatus();
	
	$okToStartTask = true;
	
}

// if the task is not already running, start the process
if ($okToStartTask){
		
		echo "running task...<br />";
		operate();
		
		echo 'started at: '.date("U").' absolute seconds<br />';
		
		echo 'server time: '.date('l jS \of F Y h:i:s A').'<br />';


	//delete the signature file to confirm the end of the task
	deleteTaskStartStatus();
	
}



?>