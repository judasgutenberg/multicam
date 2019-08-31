<?php

function camUpdate() {
	$dateCode = mt_rand(0,999999);
 
	$urlList = 'http://192.168.2.192/html http://192.168.2.195/cam http://192.168.2.197/cam http://192.168.2.191/cam http://192.168.2.190/html';
	$urls = explode(' ',$urlList);
 
	for($i=0; $i<count($urls); $i++) {
		 
		$imageUrl = $urls[$i] . '/cam_pic.php?time=' . $dateCode;
		
		$filename = $imageUrl ;
		$handle = fopen($imageUrl, "rb");
		//echo("*" . $handle  . "=");
		$contents = fread($handle, filesize($imageUrl));
		//echo($filename . "-" . filesize($imageUrl));
		//echo("+" . $contents);
		fclose($handle);
 		echo(base64_encode($contents));
	}
}


camUpdate();
die();
?>
<html>
<head>
<title>Multi-cam</title>

</head>
<body>
<div id='stream'></stream>
</body>

<script>
//how it would work if we could do it on the frontend:
camUpdate();

function camUpdate() {
	let dateCode = Math.random();
	let urlList = 'http://192.168.2.191/cam http://192.168.2.190/html http://192.168.2.192/html http://192.168.2.195/cam http://192.168.2.197/cam';
	let urls = urlList.split(' ');
	let imageDiv = document.getElementById('stream');
	imageDiv.innerHTML = '';
	for(let camUrl of urls) {
		let imageUrl = camUrl + '/cam_pic.php?time=' + dateCode;
		imageDiv.innerHTML += "<img src='" + imageUrl + "' width='500'/>";
	}
	setTimeout(()=>{camUpdate()}, 1000);
}
</script>
</html>