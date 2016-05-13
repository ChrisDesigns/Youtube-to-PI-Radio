<?php

$APIKey = "";

$googleAPI = "https://www.googleapis.com/youtube/v3/videos";
$googleAPI .= "?part=snippet";
$googleAPI .= "&key=" . $APIKey;

$url = $_POST['YTLink'];

	
	if (parse_url($url)['host'] == "www.youtube.com" || parse_url($url)['host'] == "youtube.com")
	{
		parse_str(parse_url($url)['query'], $VidID);
		$VidIDSQL = $VidID['v'];
			
		$googleAPI .= "&id=" . $VidIDSQL;
		
	$data = $VidIDSQL . '' . PHP_EOL;
	$fp = fopen('vidid.txt', 'a');
	fwrite($fp, $data);
	fclose($f);

		$JSON = file_get_contents($googleAPI);
		$videoResponse = json_decode($JSON, true);
		
		$url = 'https://www.youtube.com/watch?v=' . $VidIDSQL;
		$cmd = 'youtube-dl --extract-audio --audio-format wav -o "%(id)s.%(ext)s" ' . escapeshellarg($url);
		exec($cmd, $output, $ret);
		
		echo $videoResponse['items'][0]['snippet']['title'] . " has been added to the playlist";
	} else {
		echo("Invalid Youtube Link, try format: https://www.youtube.com/watch?v=dQw4w9WgXcQ");
		header( "refresh:5;url=newsong.html" );
	}


?>