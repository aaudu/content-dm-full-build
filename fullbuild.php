<?php
    /*
    * This script performs a full index of all the collections for the
    * Skellings Digital Archive hosted at http://skellinsgda.fit.edu 
    * Author: Ayuba Audu, aaudu@fit.edu
    * Version: 1.5
    */
    include("dmscripts/DMSystem.php");
        
    /*Get Listing of all Collections*/
    $list = &dmGetCollectionList ();
    
    /*Create fuild build txt file per Collection and run the buildcmd script*/
   if  (isset($list)) {
	   	$collection_count = count ($list);
		   
		for ($i = 0; $i < $collection_count; $i++) {
	        echo "<pre>";
	        echo "Inserting fullbuild.txt to re-build ".$list[$i]["name"]." index..";
	        echo "</pre>";
	        
	        shell_exec("touch ".$list[$i]["path"]."/index/description/fullbuild.txt");
	        
	        echo "<pre>";
	        echo "Rebuiding ".$list[$i]["name"]." Index..";
	        
	        $output = shell_exec("cd /srv/http/Content5/bin/ && ./buildcmd ".$list[$i]["alias"]);
	        echo $output;
	        echo "</pre>";
	        
	        echo "<pre>";
	        echo $list[$i]["name"]." Index rebuilt..\n\n";
	        echo "</pre>";        
	    }
   } else {
   		echo "<pre>";
		echo "Failed to get list of Collections. Please check (1) Configuration (2) Script Location";
		echo "</pre>";
   } 
?>