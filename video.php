<?php

require_once("config.php");

if(isset($_GET["url"])){
	$url = d_url($_GET["url"]);

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$out = curl_exec($ch);
	curl_close($ch);

	echo $out;
	/*header('Content-type: video/mp4');
	header('Content-type: video/mpeg');
	header('Content-disposition: inline');
	header("Content-Transfer-Encoding:­ binary");
	header("Content-Length: ".filesize($out));
	echo $out;
	exit();*/
	//$a = file_get_contents($url);
	//echo $a;
}


/*header('Content-type: video/mp4');
header('Content-type: video/mpeg');
header('Content-disposition: inline');
header("Content-Transfer-Encoding:­ binary");
header("Content-Length: ".filesize($a));
echo $a;
exit();*/
?>
