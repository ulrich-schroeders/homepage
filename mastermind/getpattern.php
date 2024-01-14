<?php
	include 'sql.php';
	
	$UserID = (array_key_exists('m', $_GET) && strlen($_GET['m'])>2) ? $_GET['m'] : "X";
	
	echo "{";
	echo ' "showMenu": 0,'; //Only relevant for Unity version of Mastermind
	try {
		$sqlDB = connectToSQL();
		$participantQuery = $sqlDB->prepare("SELECT ID, participants.nextriddle, itemset FROM participants WHERE hashid = ?");
		$participantQuery->execute(array($UserID));
		$participantRow = $participantQuery->fetch();
		if (!$participantRow) {
			echo '"next": "survey.php?m='.$UserID.'",';
			echo '"error": "unknown ID"}';
			exit();
		}
		
		$riddleQuery = $sqlDB->prepare("SELECT riddles.Colors, riddles.Columns, riddles.ID as riddleID, riddles.tutorialText, riddles.itemset FROM riddles, participants WHERE participants.hashid = ? AND participants.itemset = riddles.itemset AND participants.nextriddle <= riddles.ID ORDER BY riddles.ID ASC LIMIT 1");
		$riddleQuery->execute(array($UserID));
		$row = $riddleQuery->fetch();
		if (!$row) {//No more riddles for this user ID and his set.
			if ($participantRow["itemset"] === 0) { //Zero is the practicing set. select randomly one of the two real sets
				$updateItemsetQuery = "UPDATE participants set itemset=?, nextriddle=0 WHERE hashid=?";
				$updateItemset = $sqlDB->prepare($updateItemsetQuery);
				$updateItemset->execute([random_int(1,2), $UserID]);//random_int(1,2) chooses the used item set
				$riddleQuery->execute(array($UserID));
				$row = $riddleQuery->fetch();
			} else { //Continue with Icar
				$updateItemsetQuery = "UPDATE participants set itemset=3, nextriddle=0 WHERE hashid=?";
				$updateItemset = $sqlDB->prepare($updateItemsetQuery);
				$updateItemset->execute([$UserID]);
				echo '"next": "explainerIcar.html?m='.$UserID.'", ';
				echo '"error": ""}';
				exit();
			}
		}
		if ($row) {
			//Write starting time into DB
			if ($row["itemset"]>0) {
				$insertQuery = "INSERT INTO submittedsolutions (participantID, riddleID, icarID, timestampStart) VALUES (?,?,?,?)";
				$insertNewUser = $sqlDB->prepare($insertQuery);
				$insertNewUser->execute([$participantRow["ID"], $row["riddleID"], -1, date("Y-m-d H:i:s", time())]);
			}
			
			//Get data from DB and submit it to player
			echo ' "colors": ' . $row["Colors"] . ',';
			echo ' "columns": ' . $row["Columns"] . ',';

			$lineQuery = $sqlDB->prepare("SELECT lineEntries, correctColors, correctPositions FROM riddlelines WHERE riddleID = ? ORDER BY lineIndex");
			$lineQuery->execute(array($row["riddleID"]));
			$result = $lineQuery->fetchAll();
			
			echo ' "lines": [';
			$i = 0;
			foreach( $result as $line ) {
				echo ($i === 0) ? ' { ' : ', { ';
				echo ' "correctPositions": '.$line["correctPositions"].',';
				echo ' "correctColors": '.$line["correctColors"].',';
				echo ' "lineEntries": '.$line["lineEntries"];
				echo ' } ';
				$i++;
			}
			echo '],';
			
			//For tutorial only
			if ($row["itemset"] === 0 || $row["itemset"] === 1) {
				if (strlen($row["tutorialText"]) > 0) {
					$message = addslashes(htmlentities($row["tutorialText"]));
					$message = str_replace(["\n", "\r"], ["<br>","<br>"], $message);
					$entity = preg_replace_callback('/[\x{80}-\x{10FFFF}]/u', function ($m) {
						$char = current($m);
						$utf = iconv('UTF-8', 'UCS-4', $char);
						return sprintf("&#x%s;", ltrim(strtoupper(bin2hex($utf)), "0"));
						}, $message);
					echo ' "tutorialText": "'.$entity.'", ';
				} else {
					echo ' "tutorialText": "", ';
				}
			} else {
				echo ' "tutorialText": "", ';
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
