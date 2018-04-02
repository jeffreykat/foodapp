<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","jeffreyk-db","W7O21GVOX33SPQJF","jeffreyk-db");
if(!$mysqli || $msqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

$eo = "eatout";
$to = "takeout";
$ch = "cookhome";
$type = $_GET['q'];
echo $type;

if($type === $eo){
  
}
else if($type === $to){
  
}
else if($type === $ch){
  
}
echo "<meta http-equiv=refresh content=\"0; URL=index.php\">";
?>
