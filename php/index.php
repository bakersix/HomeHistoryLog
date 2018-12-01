<?php
	if(!empty($_POST['action']) && $_POST['action'] == "addr_search"){
		$host = '127.0.0.1';
		$db   = 'HomeHistoryLog';
		$user = 'root';
		$pass = 'Trevor8075094';
		$charset = 'utf8mb4';

		$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
		$options = [
		    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		    PDO::ATTR_EMULATE_PREPARES   => false,
		];
		try {
		     $pdo = new PDO($dsn, $user, $pass, $options);
		} catch (\PDOException $e) {
		     throw new \PDOException($e->getMessage(), (int)$e->getCode());
		}
		$stmt = $pdo->query("SELECT a_full_address FROM Addresses WHERE a_full_address LIKE '" . $_POST['addr'] . "%' LIMIT 5");
		$results = array();
		while ($row = $stmt->fetch())
		{
		    $results[] = $row['a_full_address'] . "\n";
		}
		echo json_encode($results);
		exit;
	}
	$buffer = file_get_contents("../htm/index.htm");
	echo $buffer;
?>
