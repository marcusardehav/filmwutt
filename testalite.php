<?php
$query = $_POST['booka'];
$apikey="180365ad85e4661b5bb055d05f7ef904";
$movieid="550";
$moviequery="robocop";
$path="http://image.tmdb.org/t/p/original";

$request="http://api.themoviedb.org/3/search/movie?query=$query&api_key=$apikey";

$json=file_get_contents($request);

//$movie=json_decode($json);

//echo $json;


//echo $json;
//var_dump(json_decode($json));
$array=json_decode($json, true);
//var_dump($array);
echo $array['page'];
echo BABABAJ;
//$poster=$array['results'][0]['poster_path'];
$backdrop=$array['results'][0]['backdrop_path'];
//print "<img style=\"height:400px\" src=$path$poster>";
print "<img style=\"height:400px\" src=$path$backdrop>";