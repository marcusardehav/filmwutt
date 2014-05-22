<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="wutt.css">
<link href='http://fonts.googleapis.com/css?family=Bitter:700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

</head>
<body>

<?php
$query = $_POST['booka'];
$apikey="180365ad85e4661b5bb055d05f7ef904";
$path="http://image.tmdb.org/t/p/original";
$cleanquery=rawurlencode($query);
$request="http://api.themoviedb.org/3/search/movie?query=$cleanquery&api_key=$apikey";

$imagesrequest="http://api.themoviedb.org/3/movie/$id/images?api_key=$apikey";

if (isset($_POST['booka'])){
$json=file_get_contents($request);

//$movie=json_decode($json);

//echo $json;


//echo $json;
//var_dump(json_decode($json));
$array=json_decode($json, true);
//var_dump($array);
//echo $array['page'];
//echo BABABAJ;
$poster=$array['results'][0]['poster_path'];

$backdrop=$array['results'][0]['backdrop_path'];
$title=$array['results'][0]['original_title'];
$year=substr($array['results'][0]['release_date'], 0, 4);
$id=$array['results'][0]['id'];
$length=strlen($title);
if($length>50) {
	$title=substr($title, 0, 45);
	$title.="...";
	}
//print "<img style=\"height:400px\" src=$path$poster>";
//print "<img class=\"img-rounded\" style=\"height:400px\" src=$path$backdrop>";
//print  $title;
$deeprequest="http://api.themoviedb.org/3/movie/$id?api_key=$apikey";
$imagesrequest="http://api.themoviedb.org/3/movie/$id/images?api_key=$apikey";
$deepjson=file_get_contents($deeprequest);
$imagesjson=file_get_contents($imagesrequest);
$deeparray=json_decode($deepjson, true);
$imagesarray=json_decode($imagesjson, true);
$synopsis=$deeparray['overview'];
$imdb=$deeparray['imdb_id'];
end($imagesarray['backdrops']);
$endkey=key($imagesarray['backdrops']);
//$altbackdrop=$imagesarray['backdrops'][2]['file_path'];
}

?>
<div class="container">
<br>
<div class="image img-rounded" id="backdrop" style="background-image: url('<?php echo $path, $backdrop?>')"></div>
<br>

<?php
if($length>25)
print "<div id=\"tworow\" class=\"bannerrama\"><span id=\"title\">$title ($year)</span></div>";

else 
print "<div id=\"onerow\" class=\"bannerrama\"><span id=\"title\">$title ($year)</span></div>";
?>
<form id="searchz" name='search' method='post' action='http://localhost/TMDB4PHP/wutt.php'>
 <div id="searchy" >
    <div class="input-group">
      <input name='booka' type="text" class="form-control">
      <span class="input-group-btn">
        <button type='submit' class="btn btn-default" type="button">Go!</button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->

</form>

</div>
<br>
<div class="bawdy">


<div id="poster" class="pull-right"><?php print "<img style=\"height:280px\" src=$path$poster>"; ?></div>
<div id="synopsis">
<?php print $synopsis?>
<a href="http://www.imdb.com/title/<?php print $imdb?>"><img src="imdb.png"></img></a>
</div>
</div>


<div class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    Action <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
	<?php
		for($counter=0;$counter<=$endkey;$counter++){
		$altbackdrop=$imagesarray['backdrops'][$counter]['file_path']; 
		print "<li><a class=\"thumbnail changebackdrop\" href=\"javascript:;\"><img id=\"imgbackdrop\" data-src=\"holder.js/100%x180\" src=$path$altbackdrop></a></li>";
	} ?>
  </ul>
</div>

<br>
</body>
<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

</html>
<script>
$('.changebackdrop').on('click', function() {
	var backdrop = $("img", this).attr("src");
	$("#backdrop").css({"background-image":"url(" + backdrop + ")"})
})
</script>