<?php	
	$host = 'oniddb.cws.oregonstate.edu';
	$name = 'elliotan-db';
	$user = 'elliotan-db';
	$dbPass = 'j2UFkUoAjkXBvZzs';
	$mysqli = new mysqli($host, $user, $dbPass, $name);
	if(!$mysqli || $mysqli->connect_errno) { 
		echo "Connection error to database: (" . $mysqli->connect_errno . ")"
		 . $mysqli->connect_error;
	}

	function getUserName($name, $mysqli) {
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE name=? LIMIT 1");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_array(MYSQLI_ASSOC);
    $stmt->close();
    return $result;
	}

	function addUser($name, $pass, $mysqli) {
    $stmt = $mysqli->prepare("INSERT INTO users (name, pass) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $pass);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
	}
?>