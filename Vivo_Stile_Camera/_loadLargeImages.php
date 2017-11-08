<?php



include("createImageView.php");
include("getJobNumber.php");
include("directories.php");



$filesFound = scandir($sourceDir);
$arrayLength = count($filesFound);



$fileFound = false;	
$filePointer = $arrayLength-1;



while ($fileFound == 0 AND $filePointer >= 0) {
	
	$fileName = $filesFound[$filePointer];

	$pos = strpos($fileName, ".bmp");
	$pos1 = strpos($fileName, ".BMP");
	$pos2 = strpos($fileName, ".jpg");
	$pos3 = strpos($fileName, ".JPG");
	$fileAgeInSeconds = (date("U") - date("U", filemtime($sourceDir.'/'.$fileName)));
	
	if ($pos !== false OR $pos1 !== false OR $pos2 !== false OR $pos3 !== false) {
		
		if ($fileAgeInSeconds > 10) {
	
			$fileFound = true;
			
		} else {
			
			$filePointer = $filePointer - 1;
			
		}
		
	}
	
}



if ($fileFound) {
	
	if (strpos(strtolower($fileName), "pass") !== false) {
		
		$imageType = "pass";
		
	} else {
	
		if (strpos(strtolower($fileName), "fail") !== false) {
			
			$imageType = "fail";
			
		} else {
		
			$imageType = "unknown";
			
		}
	
	}
	

	
	// load the last image to the html
	createImgView($sourceDir, $fileName, $imageType);
		
	// if the image is a failing image, find and display the last passing image of the same job number as a reference image
	if (strpos(strtolower($fileName), "fail") !== false) {
		
		$tempFileName = getJobNumber($sourceDir.'/'.$fileName);
		
		$tempFileName = 'Job'.str_replace("Fail", "Ref", $tempFileName);
		
		if (file_exists($recentPassingImagesDir.'/'.$tempFileName)) {
			
			createImgView($recentPassingImagesDir, $tempFileName, "ref");
			
		} else {
			
			createImgView($recentPassingImagesDir, "Null_Ref.jpg", "ref");
			
		}
		
		$tempFileName = getJobNumber($sourceDir.'/'.$fileName);
		
		$tempFileName = 'Job'.str_replace("Fail", "Setup", $tempFileName);
		
		if (file_exists($setupImagesDir.'/'.$tempFileName)) {
			
			createImgView($setupImagesDir, $tempFileName, "setup");
			
		} else {
			
			createImgView($setupImagesDir, "Null_Setup.jpg", "setup");
			
		}
		
	}
	
	
	// if the image is a passing image, find and display the last passing image of the same job number as a reference image
	if (strpos(strtolower($fileName), "pass") !== false) {
		
		$tempFileName = getJobNumber($sourceDir.'/'.$fileName);
		
		$tempFileName = 'Job'.str_replace("Pass", "Ref", $tempFileName);
		
		//if (file_exists($recentPassingImagesDir.'/'.$tempFileName)) {
			
		//	createImgView($recentPassingImagesDir, $tempFileName, "ref");
			
		//} else {
			
		//	createImgView($recentPassingImagesDir, "Null_Ref.jpg", "ref");
			
		//}
		
		$tempFileName = getJobNumber($sourceDir.'/'.$fileName);
		
		$tempFileName = 'Job'.str_replace("Pass", "Setup", $tempFileName);
		
		if (file_exists($setupImagesDir.'/'.$tempFileName)) {
			
			createImgView($setupImagesDir, $tempFileName, "setup");
			
		} else {
			
			createImgView($setupImagesDir, "Null_Setup.jpg", "setup");
			
		}
		
	}
		
}




?>