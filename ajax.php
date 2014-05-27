<?php
$connection = mysql_connect("localhost:3306", "root", "");
$db = mysql_select_db('marcusardehav', $connection);

$runtime = $_POST['runtime'];
$imdb = $_POST['imdb'];
$releasedate = $_POST['release'];
$title = $_POST['title'];
$poster = $_POST['poster'];
$action = $_POST['action'];
$id = $_POST['name'];



if($action=='inputwatchlist'){
	$command = "INSERT INTO towatch(filmid, title, poster, runtime, imdb, releasedate) VALUES('$id','$title', '$poster', '$runtime', '$imdb', '$releasedate')";
	$result = mysql_query($command, $connection);
	echo $result;
}
else if($action=='inputwatched'){
	$command = "INSERT INTO watched(filmid, title, poster, runtime, imdb, releasedate) VALUES('$id', '$title', '$poster', '$runtime', '$imdb', '$releasedate')";
	$result = mysql_query($command, $connection);
	echo $result;
}
else {
	echo 'faiiiiiiiled';
}
