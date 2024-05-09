<?php 
$dbhost = "localhost";
$dbuser = "rsokol_virtual_pet_user";
$dbpassword = "1KGUye1kBeT7";
$dbdatabase = "rsokol_virtual_pet";
$config_basedir = "https://rssokol.com/GD/project";//this line
$db = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbdatabase) or die("Error " . mysqli_error($db));
date_default_timezone_set('America/Chicago');
?>
