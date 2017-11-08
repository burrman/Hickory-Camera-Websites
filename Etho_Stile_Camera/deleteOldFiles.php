<?php

function deleteOldFiles($sourceDir, $numberFilesToKeep) {
		
	$foundFiles = scandir($sourceDir);
	$filteredFiles = array();
		

	foreach($foundFiles as $fileName) {
		
		//echo "working with {$fileName}<br />";
		
		// get the length of the file name
		$fileNameLength=strlen($fileName);
		
		// determine if the file is a valid vision system image and is old enough to be fully loaded on the server
		$pos = strpos($fileName, ".bmp");
		$pos1 = strpos($fileName, ".BMP");
		$pos2 = strpos($fileName, ".jpg");
		$pos3 = strpos($fileName, ".JPG");
		
		// get the age of the file in seconds since it's last modifeid time
		$fileAgeInSeconds = (date("U") - date("U", filemtime($sourceDir.'/'.$fileName)));
		
		
			
		// if the file has a very short name, ignore it, there are some system files that show up in the file search
		if ($fileNameLength > 3 AND $fileAgeInSeconds > 20) {
			
			array_push ($filteredFiles, $fileName);
		
		}
		
	}
	
	
	$arrayLength = count($filteredFiles);
	$numberToDelete = $arrayLength-$numberFilesToKeep;


	if($numberToDelete > 0){
	
		for ($i = 0; $i < $numberToDelete; $i++) {
				
			$fileNameToDelete=$filteredFiles[$i];
			//echo "The current index is: $i <br>";
			//echo "The file name is: $fileName <br>";
		
			unlink($sourceDir.'/'.$fileNameToDelete);
		
		} 

	}
	
}
	
?>