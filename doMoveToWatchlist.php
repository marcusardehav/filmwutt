<?php
$connection = mysql_connect("localhost:3306", "root", "");
$db = mysql_select_db('marcusardehav', $connection);

$id = $_POST['name'];


$command2 = "INSERT INTO towatch(filmid) VALUES($id)";
$result2 = mysql_query($command2, $connection);