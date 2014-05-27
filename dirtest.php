<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<!--<link rel="stylesheet" href="wutt.css"> -->
<link rel="stylesheet" href="wutt.css">
</head>

<?php
ini_set('max_execution_time', 300);
$connection = mysql_connect("localhost:3306", "root", "");
$db = mysql_select_db('marcusardehav', $connection);

$apikey="180365ad85e4661b5bb055d05f7ef904";
$path="http://image.tmdb.org/t/p/w154";

$dir = 'C:\Users\marcus\Downloads\MOVIES2';
$filelist = scandir($dir);

foreach($filelist as $value) {
	$cutstring = strtok($value, "/^[0-9]+$/");
	$cutstring = substr_replace($cutstring, "", -2);
	$nodots = str_replace('.', '%20', $cutstring);
	$nodots = str_replace(' ', '%20', $nodots);
	$output[] = array('query' => $nodots);

}
$readyarray = array_slice($output, 2);
?>
<body class="lists">
<?php

foreach($readyarray as $value) {
	$request="http://api.themoviedb.org/3/search/movie?query=".$value['query']."&api_key=$apikey";
	$json=file_get_contents($request);
	$array=json_decode($json, true);
	$poster=$array['results'][0]['poster_path'];
	$title=$array['results'][0]['original_title'];
	$releasedate=$array['results'][0]['release_date'];
	$filmid=$array['results'][0]['id'];

	$deeprequest="http://api.themoviedb.org/3/movie/$filmid?api_key=$apikey";
	$deepjson=file_get_contents($deeprequest);
	$deeparray=json_decode($deepjson, true);
	$runtime=$deeparray['runtime'];
	$imdb=$deeparray['imdb_id'];
	
	
	$command = "INSERT INTO dirlist(filmid, title, poster, runtime, imdb, releasedate) VALUES('$filmid', '$title', '$poster', '$runtime', '$imdb', '$releasedate')";
	$result = mysql_query($command, $connection);
	echo $result;
	}
	?>


</body>
<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

</html>
<script>

$(document).ready(function(){
	$('.remove').click(function(){
		$(this).closest('.media').remove();

	});
	
	$('.add').click(function(){
		$(this).closest('.media').remove();
		var filmId = $(this).attr("id");
		var ajaxurl = 'doMoveToWatchlist.php',
        data =  {'name': filmId};
		$.post(ajaxurl, data, function (response) {
        
		});
		});
	});
</script>