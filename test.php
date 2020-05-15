
<?php

include_once "connect.db.php";

// Create connection
//$db = mysqli_connect($server, $user, $password, $database);
$db = mysqli_connect("anysql.itcollege.ee", "WT8", "CJuPlun24D", "WT8");

if(!$db) die("Connnection to DB failed: " . mysqli_connect_error());
echo "damn";

?>