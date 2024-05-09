<?php
session_name('virtual_pet'); 
session_start();
session_destroy();
require("cfd.php");
header("Location: " . $config_basedir );
?>