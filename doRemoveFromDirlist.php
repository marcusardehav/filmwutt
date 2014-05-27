<?php
$connection = mysql_connect("localhost:3306", "root", "");
$db = mysql_select_db('marcusardehav', $connection);

$id = $_POST['name'];

$command = "DELETE FROM dirlist WHERE filmid='" . $id . "' LIMIT 1";
$result = mysql_query($command, $connection);