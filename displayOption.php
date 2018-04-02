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

  if($type === $eo){
		$eids = array();
    if(!($stmtf = $mysqli->prepare("SELECT res_id FROM restaurant INNER JOIN options ON options.option_id = restaurant.fk_option_id AND restaurant.fk_option_id = 1"))){
      echo "Prepare 1 failed: "  . $stmtf->errno . " " . $stmtf->error;
    }
    if(!($stmtf->execute())){
      echo "Execute 1 failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
    }
		if(!($stmtf->bind_result($ide))){
			echo "Bind 1 failed";
		}
		$num = 0;
	  while($stmtf->fetch()){
			$num++;
			$eids[] = $ide;
		}
    $rand = mt_rand(1,$num);
		$pick = $eids[$rand];
		$stmtf->close();
		if(!($qry = $mysqli->prepare("SELECT name, cost FROM restaurant WHERE res_id = ?"))){
			echo "Prepare 1.2 failed: " . $qry->errno . " " . $qry->error;
		}
		if(!($qry->bind_param("i", $pick))){
			echo "Bind 1 failed: " . $pick . " ";
		}
		if(!($qry->execute())){
      echo "Execute 2 failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
    }
		if(!($qry->bind_result($name, $cost))){
			echo "Bind 2 failed: ";
		}
    while($qry->fetch()){
			echo "<h2>" . $name . "</h2>";
			echo "<h3>Cost: " . $cost . "</h3>";
		}
  }
  else if($type === $to){
		$tids = array();
    if(!($stmto = $mysqli->prepare("SELECT res_id FROM restaurant INNER JOIN options ON options.option_id = restaurant.fk_option_id AND restaurant.fk_option_id = 2"))){
      echo "Prepare 3 failed: "  . $stmto->errno . " " . $stmto->error;
    }
		if(!($stmto->execute())){
      echo "Execute 3 failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
    }
		if(!($stmto->bind_result($idt))){
			echo "Execute 6 failed";
		}
    $numt = 0;
	  while($stmto->fetch()){
			$numt++;
			$tids[] = $idt;
		}
    $randt = mt_rand(1,$numt);
		$pickt = $tids[$randt];
		$stmto->close();
		if(!($qryt = $mysqli->prepare("SELECT name, cost FROM restaurant WHERE res_id = ?"))){
			echo "Prepare 1.2 failed: " . $qryt->errno . " " . $qryt->error;
		}
		if(!($qryt->bind_param("i", $pickt))){
			echo "Bind 1 failed: " . $pickt . " ";
		}
		if(!($qryt->execute())){
      echo "Execute 2 failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
    }
		if(!($qryt->bind_result($namet, $costt))){
			echo "Bind 2 failed: ";
		}
    while($qryt->fetch()){
			echo "<h2>" . $namet . "</h2>";
			echo "<h3>Cost: " . $costt . "</h3>";
		}
  }
  else if($type === $ch){
		$numc = 0;
		if(!($qryc = $mysqli->prepare("SELECT food_id FROM food"))){
			echo "Prepare 4 failed";
		}
		if(!($qryc->execute())){
			echo "Execute 4 failed";
		}
		if(!($qryc->bind_result($idc))){
			echo "Bind 4 failed";
		}
		while($qryc->fetch()){
			$numc++;
		}
		$randc = mt_rand(1,$numc);
		if(!($getc = $mysqli->prepare("SELECT food.name, recipes.cook_time, recipes.cost FROM food INNER JOIN recipes ON recipes.recipe_id = food.fk_rid WHERE food.food_id = ?"))){
			echo "Prepare 5 failed";
		}
		if(!($getc->bind_param("i", $randc))){
			echo "Bind 5 failed" . $randc;
		}
		if(!($getc->execute())){
			echo "Execute 5 failed";
		}
		if(!($getc->bind_result($namec, $cooktime, $costc))){
			echo "Bind 7 failed";
		}
		while($getc->fetch()){
			echo "<h2>" . $namec . "</h2>";
			echo "<h3>Cook time: " . $cooktime . " minutes</h3>";
			echo "<h3>Cost: " . $costc . "</h3>";
		}
  }

?>
