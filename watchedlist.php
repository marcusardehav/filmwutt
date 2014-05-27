<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="wutt.css">
</head>
<?php
$apikey="180365ad85e4661b5bb055d05f7ef904";
$path="http://image.tmdb.org/t/p/w154";
$connection = mysql_connect("localhost:3306", "root", "");
$db = mysql_select_db('marcusardehav', $connection);

$returnarr = array();
$fetch = mysql_query("SELECT * FROM watched ORDER BY added DESC");
while ($row = mysql_fetch_array($fetch, $db)) {
	$rowarray['filmid'] = $row['filmid'];
	$rowarray['added'] = $row['added'];
	$rowarray['poster'] = $row['poster'];
	$rowarray['imdb'] = $row['imdb'];
	$rowarray['releasedate'] = $row['releasedate'];
	$rowarray['title'] = $row['title'];
	$rowarray['runtime'] = $row['runtime'];

	array_push($returnarr, $rowarray);
}


?>
<body class="lists">

<?php foreach($returnarr as $value) {
?>
<div class="media">
  <a class="pull-left" href="#">
    <img class="media-object" src="<?php echo $path,$value['poster'] ?>" alt="...">
  </a>
    <div class="btn-group-vertical pull-right boobs">
  <button type="button" class="btn btn-default add" id="<?php echo $value['filmid'] ?>" disabled><span class="glyphicon glyphicon-ok"></span></button>
  <a href="http://www.imdb.com/title/<?php echo $value['imdb'] ?>" target="_blank"<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-film"></span></button></a>
  <button type="button" class="btn btn-default remove" id="<?php echo $value['filmid'] ?>"><span class="glyphicon glyphicon-remove"></span></button>
</div>
  <div class="media-body">
    <h4 class="media-heading"><?php echo $value['title'] ?></h4>
    <?php echo 'Released: ', $value['releasedate'];?>
	<br>
	<?php echo 'Runtime: ', $value['runtime'], ' minutes';?>
	<br>
	<?php echo 'Added to list: ', $value['added'];?>
  </div>
</div>
<?php } ?>

</body>
<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

</html>
<script>
$(document).ready(function(){
	$('.remove').click(function(){
		$(this).closest('.media').remove();
		var filmId = $(this).attr("id");
		var ajaxurl = 'doRemoveFromWatchlist.php',
        data =  {'name': filmId};
		$.post(ajaxurl, data, function (response) {
        
		});
	});
	$('.add').click(function(){
		$(this).closest('.media').remove();
		var filmId = $(this).attr("id");
		var ajaxurl = 'doMoveToWatched.php',
        data =  {'name': filmId};
		$.post(ajaxurl, data, function (response) {
        
		});
	});
});
</script>