<?php
  //Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","jeffreyk-db","W7O21GVOX33SPQJF","jeffreyk-db");
if(!$mysqli || $msqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

$te = "eatOut";
$tt = "takeOut";
$tc = "cookHome";
$type = $_POST['Type'];

if($type == $tc){
	//insert recipe
	if(!($stmt = $mysqli->prepare("INSERT INTO recipes(recipe_id, cook_time, cost) VALUES (?,?,?)"))){
	echo "Prepare 1 failed: "  . $stmt->errno . " " . $stmt->error . " " . $result;
}
if(!($stmt->bind_param("iii",$n = NULL,$_POST['cooktime'],$_POST['foodcost']))){
	echo "Bind 1 failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->execute())){
	echo "Execute 1 failed: "  . $stmt->errno . " " . $stmt->error;
} 
	$stmt->close();
	//get recipe id
if(!($getid = $mysqli->prepare("SELECT MAX(recipe_id) FROM recipes"))){
	echo "Prepare 2 failed: "  . $getid->errno . " " . $getid->error;
}
	if(!($getid->execute())){
		echo "Execute 2 failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!($getid->bind_result($id))){
		echo "Bind 2 failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($getid->fetch()){}
	
	//insert food
	if(!($stmtf = $mysqli->prepare("INSERT INTO food(food_id, name, fk_rid) VALUES (?,?,?)"))){
	echo "Prepare 1.2 failed: "  . $stmtf->errno . " " . $stmtf->error . "  " . $id;
}
if(!($stmtf->bind_param("isi",$n = NULL,$_POST['foodname'],$id))){
	echo "Bind 1.2 failed: "  . $stmtf->errno . " " . $stmtf->error;
}
if(!($stmtf->execute())){
	echo "Execute 1.2 failed: "  . $stmtf->errno . " " . $stmtf->error;
} 
}
else if($type == $te){
  //select option id
  $rese = 1;
//insert row
if(!($stmt = $mysqli->prepare("INSERT INTO restaurant(res_id, name, fk_option_id, cost) VALUES (?,?,?,?)"))){
	echo "Prepare 5 failed: "  . $stmt->errno . " " . $stmt->error . " " . $result;
}
if(!($stmt->bind_param("isii",$n = NULL,$_POST['foodname'],$rese,$_POST['foodcost']))){
	echo "Bind 5 failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute 5 failed: "  . $stmt->errno . " " . $stmt->error;
} 
}
else{
  //select option id
  $rest = 2;
  //insert row
if(!($stmt = $mysqli->prepare("INSERT INTO restaurant(res_id, name, fk_option_id, cost) VALUES (?,?,?,?)"))){
	echo "Prepare 6 failed: "  . $stmt->errno . " " . $stmt->error . " " . $result;
}
if(!($stmt->bind_param("isii",$n = NULL,$_POST['foodname'],$rest,$_POST['foodcost']))){
	echo "Bind 6 failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute 6 failed: "  . $stmt->errno . " " . $stmt->error . " " . $rest;
} 
}
 echo "<meta http-equiv=refresh content=\"0; URL=index.php\">";

?>
