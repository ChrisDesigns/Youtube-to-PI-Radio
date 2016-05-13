<?php

$APIKey = "";

echo "
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
	width: 25%;
	text-align: center;
}
th, td {
    padding: 5px;
}
tr:nth-child(odd) {
	background: #CCC;
}
tr:nth-child(even) {
	background: #FFF;
}
tr.active {
	background: #FF0;
}

.playlist {
	margin: auto;
}
</style>";

echo '<table class="playlist">';
echo '<tr>';
echo "<th>Preview</th>";
echo "<th>Title</th>";
echo '</tr>';


$f = fopen('vidid.txt','r');

while ($line = fgets($f)) {
	
	// strip out all whitespace
	$line = preg_replace('/\s*/', '', $line);
		
	$googleAPI = "https://www.googleapis.com/youtube/v3/videos";
	$googleAPI .= "?part=snippet";
	$googleAPI .= "&id=" . $line;
	$googleAPI .= "&key=" . $APIKey;
	
	$JSON = file_get_contents($googleAPI);
	$videoResponse = json_decode($JSON, true);
	
	

	
	echo "<tr class='inactive'>";
	echo "<td><img src='https://i.ytimg.com/vi/" . $line . "/default.jpg'></td>";
	echo "<td>" . $videoResponse['items'][0]['snippet']['title'] . "</td>";

}
echo "</table>";

fclose($f);

echo '
<br/>
<center>
<form action="/music/save.php" method="post">
  Youtube Link: <input value="" name="YTLink" required></br>
  <input type="submit" value="Submit">
</form>
</center>
';

header( "refresh:20;url=index.php" );

?>