<?php

include("deleteOldFiles.php");
include("createRefImages.php");
include("createThumbnails.php");
include("getJobNumber.php");

include("directories.php");



//operate();


function operate(){
	
	global $sourceDir, $recentPassingImagesDir, $recentFailingImagesDir, $setupImagesDir, $thumbnailsDirAdder;

	
	
	createRefImages($sourceDir, $recentPassingImagesDir, $recentFailingImagesDir);

	deleteOldFiles($sourceDir, 20);
	deleteOldFiles($recentFailingImagesDir, 50);

	deleteOldFiles($thumbnailsDirAdder.'/'.$sourceDir, 0);
	deleteOldFiles($thumbnailsDirAdder.'/'.$recentPassingImagesDir, 0);
	deleteOldFiles($thumbnailsDirAdder.'/'.$recentFailingImagesDir, 0);
	deleteOldFiles($thumbnailsDirAdder.'/'.$setupImagesDir, 0);
	
	createThumbs($sourceDir, $thumbnailsDirAdder."/".$sourceDir, 320);
	createThumbs($recentPassingImagesDir, $thumbnailsDirAdder."/".$recentPassingImagesDir, 320);
	createThumbs($recentFailingImagesDir, $thumbnailsDirAdder."/".$recentFailingImagesDir, 320);
	createThumbs($setupImagesDir, $thumbnailsDirAdder."/".$setupImagesDir, 320);
	
}

?>