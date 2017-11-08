<?php

	include("directories.php");
	

	
	function createImgView ($_sourceDir, $_fileName, $_imageType) {
		
		global $thumbnailsDirAdder;
		
		$filePath = $_sourceDir.'/'.$_fileName;
		
		
		
		$thumbFilePath = $thumbnailsDirAdder.'/'.$_sourceDir.'/'.$_fileName;
		//echo $filePath.'<br />';
		//echo $thumbFilePath.'<br />';
		
		$imageClassModifier = "unknownImage";
		$imageTitle = "Unknown image pass/fail status";
		$imageDescription = "No description availabe for this image";

		//echo "<script type='text/javascript'>alert('$path');</script>";

	
		if(strpos(strtolower($_imageType), "pass") !== false) {
	
			//echo "<script type='text/javascript'>alert('Passing Image');</script>";
			$imageClassModifier = "passingImage";
			$imageTitle = "Passing Image";
			$imageDescription = "Not much else to say about that...";
	
		} else {
	
			if(strpos(strtolower($_imageType), "fail") !== false) {
		
				//echo "<script type='text/javascript'>alert('Failing Image');</script>";
				$imageClassModifier = "failingImage";
				$imageTitle = "Failing Image";
				$imageDescription = "A note on failing images: extra holes in the failing<br />
									image will NOT necessarily cause an image to fail.<br /> 
									Some parts have extra hole configurations in order to share<br />
									punches/gags and camera inspections.";
		
			} else {
				
				if(strpos(strtolower($_imageType), "ref") !== false) {
		
				//echo "<script type='text/javascript'>alert('Reference Image');</script>";
				$imageClassModifier = "referenceImage";
				$imageTitle = "Recent Passing Image";
				$imageDescription = "This is the most recent passing image for this inspection";
				
				} else {
									
					if(strpos(strtolower($_imageType), "setup") !== false) {
		
					//echo "<script type='text/javascript'>alert('Reference Image');</script>";
					$imageClassModifier = "setupImage";
					$imageTitle = "Origional Setup Image";
					$imageDescription = "This is what the origional passing image looked like<br />
										when the camera was first configured.";
				
					} else {
			
					//echo "<script type='text/javascript'>alert('Not a passing or failing image');</script>";
				
					}
					
				}
				
			}
			
		}
		
		$generatedHTML = '
		
			<div class="'.$imageClassModifier.' '.$_GET['passedInfo'].'">
			
				<a href="'.$filePath.'">
				
					<img src="'.$thumbFilePath.'" class="'.$imageClassModifier.'" alt="'.$thumbFilePath.'">
					
				</a>
				
				<p class="imageLabel imageFileTitle '.$_GET['passedInfo'].'">Type of Image:</p>
				<p class="imageLabelData imageFileTitle '.$_GET['passedInfo'].'">'.$imageTitle.'</p>
				
				<p class="imageLabel imageFileDescription '.$_GET['passedInfo'].'">Description:</p>
				<p class="imageLabelData imageFileDescription '.$_GET['passedInfo'].'">'.$imageDescription.'</p>
				
				<p class="imageLabel imageFileDirectory '.$_GET['passedInfo'].'">Folder:</p>
				<p class="imageLabelData imageFileDirectory '.$_GET['passedInfo'].'">'.$_sourceDir.'</p>
				
				<p class="imageLabel imageFileName '.$_GET['passedInfo'].'">Filename:</p>
				<p class="imageLabelData imageFileName '.$_GET['passedInfo'].'">'.$_fileName.'</p>
								
			</div>';

		echo $generatedHTML;
				
	}
	
?>