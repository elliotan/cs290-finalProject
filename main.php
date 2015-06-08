<?php
	session_start();
	require_once('database.php');
	if($_GET['login'] !== "true"){
		header('Location: index.php?logout=true');
	}

	$userid = $_SESSION['id']; 
		$now = new DateTime();
	include('inc/header.php');
	echo $userid;

	if(isset($_POST['record'])) {
		$numReps = $_POST['numReps'];
		$weight = $_POST['weight'];
		$lift_Type = $_POST['lift_Type'];
		$lift_date = $_POST['lift_date'];
		$validate_date = new DateTime($_POST['lift_date']);
		

		if(empty($numReps)) {
			$error_msg = "You must enter your number of reps. <br>";
			$valid = 0;
		}
		else if(empty($weight)) {
			$error_msg = "A weight is required.<br>";
			$valid = 0;
		}
		else if($weight < 0) {
			$error_msg = "Weight cannot be negative.<br>";
			$valid = 0;
		}
		else if(empty($lift_date)) {
			$error_msg = "A date is required.<br>";
			$valid = 0;
		} 
		else {
			$valid = 1;
		}

		if($valid != 0 ) {

			if (!($stmt = $mysqli->prepare("INSERT INTO exercises (numReps, weight) VALUES (?,?);"))) {
		    echo "Error during prepare: " . $mysqli->errno . " " . $mysqli->error;
		    exit;
		    $stmt->bind_param('iiddss', $recordID, $userid, $numReps, $weight, $lift_Type, $lift_date);
			$stmt->execute();
			$stmt->close();
		}
		}
	}

	if(isset($_POST['deleteRecord'])){
		$record_id = $_POST['recordID'];
		if(!($stmt = $mysqli->prepare("DELETE FROM exercises WHERE recordID = '$record_id'"))){
			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		if(!$stmt->execute()){
			echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
	}

	$query = "SELECT * FROM exercises WHERE userid = '$userid'
					  ORDER BY lift_date DESC";
	$records = $mysqli->query($query);
?>

<script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
</script>

			<div id="logout">
		 	  <a href='index.php?logout=true'>Logout</a>
			</div>

	<div id="right">
	  <div id="logLift">
		  <h2>Log your Progress</h2>
			<form action="main.php?login=true" method="post">
				<table>
					<tr>
						<th>
							<label for"lift_date">What day did you lift? </label>
						</th>
						<td>
							<input type="text" name="lift_date" id="datepicker">
						</td>
					</tr>
					<tr>
						<th>
							<label for"numReps">How many reps did you complete? </label>
						</th>
						<td>
							<input type="number" name="numReps">
						</td>
					</tr>
					<tr>
						<th>
							<label for"weight">How much did you lift? </label>
						</th>
						<td>
							<input type="number" name="weight">
						</td>
					</tr>
					<tr>
						<th>
							<label for"lift_Type">What movement did you complete?</label>
						</th>
						<td>
							<input type = "text" name="liftType" id="lift_Type">
						</td>
					</tr>
					
					<tr>
						<td>
							<input type="hidden" name="userid" value="$userid">
						</td>
					</tr>
				</table>
				<div id="logLift_btn">
					<input type="submit" name="record" value="Log It">
				</div>
				<div>
					<?php
						if(!empty($error_msg))
						{
							echo $error_msg;
						}
					?>
				</div>
			</form>
		</div>
		<div id="right">
			<h2>Workout Log</h2>
			<?php
				$counter = 0;
				echo "<table>";
					echo "<tr>";
						echo "<th>Date       </th>";
						echo "<th>Number of Reps       </th>";
						echo "<th>Weight       </th>";
						echo "<th>Movement       </th>";
					echo "</tr>";


				  foreach ($records as $record) :
						echo "<tr>";
							echo	"<td>" . $record['lift_date'] . "</td>";
							echo	"<td>" . $record['numReps'] . "</td>";
							echo	"<td>" . $record['weight'] . "</td>";
							echo	"<td>" . $record['liftType'] . "</td>";
							echo	"<td>"; 
								echo	'<form action="main.php?login=true" method="post">';?>
									<input type ="hidden" name="recordID" value="<?php echo $record['recordID']; ?>">
									<?php echo	'<input type="submit" name="deleteRecord" value ="Delete">';
								echo "</form>"; 
							echo "</td>";
						echo "</tr>";
						$counter++;
						if($counter == 10) {
							break;
						}
			    endforeach;
		  
				echo "</table>";?>
		</div>
	</div>
