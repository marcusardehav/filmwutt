<?php
$dir = "C:\Users\marcus\Downloads\MOVIES2";
$filelist = scandir($dir);

//print_r($filelist);
foreach($filelist as $value) {
$cutstring = strtok($value, "/^[0-9]+$/");
$cutstring = substr_replace($cutstring, "", -2);
$nodots = str_replace('.', '%20', $cutstring);
$nodots = str_replace(' ', '%20', $nodots);
$readyarray[] = array($nodots);

}
print_r($readyarray);
?>