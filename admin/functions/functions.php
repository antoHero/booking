<?php
require('../../db_engine/db_connect.php');

function getTeams() {
	global $con;
	$sql = "SELECT * FROM teams";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$team = $row['name'];
			$logo = $row['crest'];

			echo "<option value='$team'>".$team."</option>";
		}
	}
}

function fetchEvent() {
	global $con;
	$sql = "SELECT * FROM events ORDER BY date DESC";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$id = $row['id'];
			$home = $row['home'];
			$away = $row['away'];
			$event = $home ." vs ". $away;
			$date = $row['date'];
			$time = $row['time'];

			echo "<option>".$event."</option>";
		}
	}
}

function getSeats() {
	global $con;
	$sql = "SELECT * FROM seats_section ORDER BY class_name DESC";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$id = $row['id'];
			$name = $row['class_name'];
			$capacity = $row['class_capacity'];
			$cost = $row['class_price'];
			$desc = $row['description'];

			echo "<option>".$name."</option>";
		}
	} 

}


?>