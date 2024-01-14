<?php
	include 'sql.php';
	
	$UserID = (array_key_exists('m', $_GET) && strlen($_GET['m'])>2) ? $_GET['m'] : "X";
	
	echo "{";
	try {
		$sqlDB = connectToSQL();
		$participantQuery = $sqlDB->prepare("SELECT ID, participants.nextriddle FROM participants WHERE hashid = ?");
		$participantQuery->execute(array($UserID));
		$participantRow = $participantQuery->fetch();
		if (!$participantRow) {
			echo '"next": "survey.php?m='.$UserID.'",';
			echo '"error": "unknown ID"}';
			exit();
		}
		
		$riddleQuery = $sqlDB->prepare("SELECT icar.picture, icar.headline, icar.ID as riddleID FROM icar, participants WHERE participants.hashid = ? AND participants.nextriddle <= icar.ID ORDER BY icar.ID ASC LIMIT 1");
		$riddleQuery->execute(array($UserID));
		$row = $riddleQuery->fetch();
		if (!$row) {
			echo '"next": "finalBox.php?m='.$UserID.'", ';
			echo '"error": ""}';
			exit();
		}
		if ($row) {
			//Write starting time into DB
			$insertQuery = "INSERT INTO submittedsolutions (participantID, riddleID, icarID, timestampStart) VALUES (?,?,?,?)";
			$insertNewUser = $sqlDB->prepare($insertQuery);
			$insertNewUser->execute([$participantRow["ID"], -1, $row["riddleID"], date("Y-m-d H:i:s", time())]);
			
			//Get data from DB and submit it to player
			echo ' "imageBox": "' . $row["picture"] . '",';

			$lineQuery = $sqlDB->prepare("SELECT picture,orderIndex FROM icarlines WHERE icarID = ? ORDER BY orderIndex");
			$lineQuery->execute(array($row["riddleID"]));
			$result = $lineQuery->fetchAll();
			
			echo ' "lines": [';
			$i = 0;
			foreach( $result as $line ) {
				echo ($i === 0) ? ' { ' : ', { ';
				echo ' "index": '.$line["orderIndex"].',';
				echo ' "URI": "'.$line["picture"].'"';
				echo ' } ';
				$i++;
			}
			echo '],';
			
			if (strlen($row["headline"]) > 0) {
				$message = addslashes(htmlentities($row["headline"]));
				$message = str_replace(["\n", "\r"], ["<br>","<br>"], $message);
				$entity = preg_replace_callback('/[\x{80}-\x{10FFFF}]/u', function ($m) {
					$char = current($m);
					$utf = iconv('UTF-8', 'UCS-4', $char);
					return sprintf("&#x%s;", ltrim(strtoupper(bin2hex($utf)), "0"));
					}, $message);
				echo ' "headLine": "'.$entity.'", ';
			} else {
				echo ' "headLine": "", ';
			}

			echo '"next": "",';
			echo '"error": ""}';
			$sqlDB = null;
		} else {
			echo '"next": "",';
			echo '"error": "unknown ID"}';
			$sqlDB = null;
		}		
	} catch(PDOException $e) {
		echo '"error": "Connection failed ' . str_replace('"', "'", $e->getMessage()) . '"}';
		$sqlDB = null;
	}
?>