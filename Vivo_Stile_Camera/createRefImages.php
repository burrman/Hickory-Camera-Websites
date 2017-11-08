<?php

function createRefImages($sourceDir, $recentPassImagesDir, $recentFailedImagesDir) {
	
	$foundFiles = scandir($sourceDir);
		
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
		
		
		//echo $fileName." ".$fileAgeInSeconds."<br />";
		
		
			
		// if the file has a very short name, ignore it, there are some system files that show up in the file search
		if ($fileNameLength > 3 AND $fileAgeInSeconds > 2) {
			
			//echo "operating on: ".$fileName."<br />";
			
			if ($pos !== false OR $pos1 !== false OR $pos2 !== false OR $pos3 !== false) {
				
				// if the image is a passing image, copy it to the reference image directory
				if (strpos(strtolower($fileName), "pass") !== false) {
			
					$sourcePath = $sourceDir.'/'.$fileName;
			
					$tempFileName = 'Job'.getJobNumber($sourceDir.'/'.$fileName);
			
					$tempFileName = str_replace("Pass", "Ref", $tempFileName);
		
					$destinationPath = $recentPassImagesDir.'/'.$tempFileName;

					if (!copy($sourcePath, $destinationPath)) {
						
						//echo "failed to copy file!";
						
					} else {
							
						//echo "file: ".$sourcePath." copied to ".$destinationPath."<br />";
					}
			
				}
				
				// if the image is not a passing image, copy the image to the recent failed images directory
				if (strpos(strtolower($fileName), "fail") !== false) {
			
					$sourcePath = $sourceDir.'/'.$fileName;
			
					$destinationPath = $recentFailedImagesDir.'/'.$fileName;
			
					if ($fileAgeInSeconds > 2) {

						if (!file_exists($recentFailedImagesDir.'/'.$fileName)) {
				
							if (!copy($sourcePath, $destinationPath)) {
							
								//echo "failed to copy file!";
								
							} else {
							
								//echo "file: ".$sourcePath." copied to ".$destinationPath."<br />";
								
							}	
								
						}
						
					}
				
				}
			
			}
		
		}
		
	}

}	
	
?>