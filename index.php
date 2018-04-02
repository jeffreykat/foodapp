<!doctype html>
<html lang="en">

<head>
	<?php /*variables*/
        $sitename="Select a Meal";
        $slogan="For when you don't know what to eat";
        $sitepath="http://people.oregonstate.edu/~jeffreyk/CS340foodapp/";
        $author="Katherine Jeffrey";
  ?>
	<title>
		<?php echo $author.", ".$sitename; ?>
	</title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="<?php echo $slogan;?>" />
	<meta name="author" content="<?php echo $author; ?>" />

	<link href="cs340.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" media="screen">
	<!--favicon-->

	<?php
  //Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","jeffreyk-db","W7O21GVOX33SPQJF","jeffreyk-db");
if(!$mysqli || $msqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
  ?>

</head>

<body>
	<header>
		<h1 class="title">Select a Meal</h1>
	</header>
	<nav>
		<ul>
			<li class="navItem navE">
				<h3>Eat Out</h3>
			</li>
			<li class="navItem navT">
				<h3>Take Out</h3>
			</li>
			<li class="navItem navC">
				<h3>Cook at Home</h3>
			</li>
		</ul>
	</nav>
	<main>
		<div class="dropList hidden" id="el">
			<ul class="foodList">
				<?php
					if(!($stmt = $mysqli->prepare("SELECT restaurant.name FROM restaurant INNER JOIN options ON options.option_id = restaurant.fk_option_id AND restaurant.fk_option_id = 1 ORDER BY restaurant.name ASC"))){
						echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
					}
					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($name)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
						echo "<li>" . $name . "</li>";
					}
					$stmt->close();
					?>
			</ul>
		</div>
		<div class="dropList hidden" id="tl">
			<ul class="foodList">
				<?php
					if(!($stmt = $mysqli->prepare("SELECT restaurant.name FROM restaurant INNER JOIN options ON options.option_id = restaurant.fk_option_id AND restaurant.fk_option_id = 2 ORDER BY restaurant.name ASC"))){
						echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
					}
					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($name)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
						echo "<li>" . $name . "</li>";
					}
					$stmt->close();
					?>
			</ul>
		</div>
		<div class="dropList hidden" id="cl">
			<ul class="foodList">
				<?php
					if(!($stmt = $mysqli->prepare("SELECT food.name FROM food ORDER BY food.name ASC"))){
						echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
					}
					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($name)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
						echo "<li>" . $name . "</li>";
					}
					$stmt->close();
					?>
			</ul>
		</div>
			<div class="select-loc">
				<p class="location" id="e"><input type="button" value="Eat Out" class="selectB" name="eatout" onclick="displayOption(this.name)"></p>
				<p class="location border" id="t"><input type="button" value="Take Out" class="selectB" name="takeout" onclick="displayOption(this.name)"></p>
				<p class="location" id="c"><input type="button" value="Cook at Home" class="selectB" name="cookhome" onclick="displayOption(this.name)"></p>
			</div>
			<br>
		<form method="post" action="removefood.php">
			<div id="option" class="hidden" name="display">
				<p id="showOpt">
					<?php include 'displayOption.php'; ?>
				</p>
				<input type="submit" value="Remove" id="remove">
			</div>
	</form>
		<!-- The Modal -->
		<div id="myModal" class="modal">
			<!-- Modal content -->
			<div class="modal-content">
				<span class="close">&times;</span>
				<h2>Add a food or restaurant:</h2>
				<form method="post" action="addfood.php">
					<div class="pickType">
						<select id="type" name="Type">
          <option value="eatOut">Eat Out</option>
          <option value="takeOut">Take Out</option>
          <option value="cookHome">Cook at Home</option>
          </select>
					</div>
					<div class="getName">
						<input type="text" id="fname" name="foodname" placeholder="Name">
					</div>
					<div class="getCost">
						<input type="text" id="fcost" name="foodcost" placeholder="Cost">
					</div>
					<div class="getTime">
						<input type="text" id="ftime" name="cooktime" placeholder="Cook time">
					</div>
					<div class="row">
						<input type="submit" value="Submit" id="submitAdd">
					</div>
				</form>
			</div>
		</div>
		<div id="add">
			+
		</div>
	</main>
	<script src="index.js"></script>
</body>

</html>
