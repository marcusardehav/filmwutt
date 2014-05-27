<?php
$connection = mysql_connect("localhost:3306", "root", "");
$db = mysql_select_db('marcusardehav', $connection);

$all = $_POST['all'];
list($filmid, $poster, $imdb, $releasedate, $title, $runtime) = split('£', $all);

$command = "DELETE FROM dirlist WHERE filmid='" . $filmid . "' LIMIT 1";
$result = mysql_query($command, $connection);

$command2 = "INSERT INTO towatch(filmid, title, poster, runtime, imdb, releasedate) VALUES('$filmid', '$title', '$poster', '$runtime', '$imdb', '$releasedate')";
$result2 = mysql_query($command2, $connection);