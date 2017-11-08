<?php




include("createImageView.php");
include("getJobNumber.php");
include("directories.php");



$filesFound = scandir($recentFailingImagesDir);
$arrayLength = count($filesFound);



for ($i = $arrayLength; $i > 0; $i--){
	
//for ($i = 0; $i < $arrayLength; $i++){
	
	$fileName = $filesFound[$i];
	
	$pos = strpos($fileName, ".bmp");
	$pos1 = strpos($fileName, ".BMP");
	$pos2 = strpos($fileName, ".jpg");
	$pos3 = strpos($fileName, ".JPG");
	$fileAgeInSeconds = (date("U") - date("U", filemtime($recentFailingImagesDir.'/'.$fileName)));
	
	if ($pos !== false OR $pos1 !== false OR $pos2 !== false OR $pos3 !== false) {
			
		// echo $fileAgeInSeconds . "<br />";
			
		if ($fileAgeInSeconds > 10) {
			
			echo '<div class="clearFloats"></div>
		
					<div class="divider">
	
						<h4>Next failed image with matching reference image(if available):</h4>
	
					</div>';
			
			// load the last image to the html
			createImgView($recentFailingImagesDir, $fileName, "fail");
		
			// if the image is a failing image, find and display the last passing image of the same job number as a reference image
			if (strpos(strtolower($fileName), "fail") !== false) {
		
				$tempFileName = getJobNumber($recentFailingImagesDir.'/'.$fileName);
		
				$tempFileName = 'Job'.str_replace("Fail", "Ref", $tempFileName);
		
				if (file_exists($recentPassingImagesDir.'/'.$tempFileName)) {
			
					createImgView($recentPassingImagesDir, $tempFileName, "ref");
			
				} else {
			
					createImgView($recentPassingImagesDir, "Null_Ref.jpg", "ref");
			
				}
		
				$tempFileName = getJobNumber($recentFailingImagesDir.'/'.$fileName);
		
				$tempFileName = 'Job'.str_replace("Fail", "Setup", $tempFileName);
		
				if (file_exists($setupImagesDir.'/'.$tempFileName)) {
			
					createImgView($setupImagesDir, $tempFileName, "setup");
			
				} else {
			
					createImgView($setupImagesDir, "Null_Setup.jpg", "setup");
			
				}
		
			}
				
		}
		
	}
	
}


	
	


?>