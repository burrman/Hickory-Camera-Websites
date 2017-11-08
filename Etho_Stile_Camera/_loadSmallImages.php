<?php



include("createImageView.php");
include("getJobNumber.php");
include("directories.php");

$filesFound = scandir($sourceDir);
$arrayLength = count($filesFound);


if ($arrayLength >= 20) {
	
	$indexStart = $arrayLength - 20;
	$indexEnd = $arrayLength;
	
} else {
	
	$indexStart = 0;
	$indexEnd = $arrayLength;
		
}



//for (i = $arrayLength, i > 0, i--){
	
for ($i = $indexStart; $i < $indexEnd; $i++){
	
	//echo $i;

	$fileName = $filesFound[$i];
	
	$pos = strpos($fileName, ".bmp");
	$pos1 = strpos($fileName, ".BMP");
	$pos2 = strpos($fileName, ".jpg");
	$pos3 = strpos($fileName, ".JPG");
	$fileAgeInSeconds = (date("U") - date("U", filemtime($sourceDir.'/'.$fileName)));
	
	if ($pos !== false OR $pos1 !== false OR $pos2 !== false OR $pos3 !== false) {
			
		// echo $fileAgeInSeconds . "<br />";
		
		if (strpos(strtolower($fileName), "pass") !== false) {
		
		$imageType = "pass";
		
		} else {
	
			if (strpos(strtolower($fileName), "fail") !== false) {
			
				$imageType = "fail";
			
			} else {
		
				$imageType = "unknown";
			
			}
	
		}
			
		if ($fileAgeInSeconds > 10) {
			
			createImgView($sourceDir, $fileName, $imageType);
	
		}
		
	}

}




?>