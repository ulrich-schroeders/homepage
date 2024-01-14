<?php
	include 'sql.php';
	
	$UserID = (array_key_exists('m', $_GET) && strlen($_GET['m'])>2) ? $_GET['m'] : "X";
	$guessString = (array_key_exists('solution', $_GET)) ? $_GET['solution'] : "";
	$guess = explode(',' , $guessString);
	$totalTime = (array_key_exists('totalTime', $_GET) && is_numeric($_GET['totalTime'])) ? intval($_GET['totalTime']) : 0;
	$timestamp = time();
	
	try {
		echo '{';
		$sqlDB = connectToSQL();
		$participantQuery = $sqlDB->prepare("SELECT ID, participants.nextriddle, itemset FROM participants WHERE hashid = ?");
		$participantQuery->execute(array($UserID));
		$participantRow = $participantQuery->fetch();
		if (!$participantRow) {
			echo '"error": "unknown ID"}';
			exit();
		}

		//Check if solution is correct
		if ($participantRow["itemset"] === 3) {//itemset === 3 means icar; 1 and 2 means the two possible sets of mastermind and 0 means the training masterminds
			$riddleQuery = $sqlDB->prepare("SELECT icar.ID as riddleID, icar.solution FROM icar, participants WHERE participants.hashid = ? AND participants.nextriddle <= icar.ID ORDER BY icar.ID ASC LIMIT 1");
		} else {
			$riddleQuery = $sqlDB->prepare("SELECT riddles.ID as riddleID, riddles.solution FROM riddles, participants WHERE participants.hashid = ? AND participants.itemset = riddles.itemset AND participants.nextriddle <= riddles.ID ORDER BY riddles.ID ASC LIMIT 1");
		}
		$riddleQuery->execute(array($UserID));  
		$row = $riddleQuery->fetch();
		
		if (!$row) {
			echo ' "error": "unknown ID"}';
			exit();
		}

		if ($participantRow["itemset"] === 3) {
			$correct = ($row["solution"] === (is_numeric($guessString) ? intval($guessString) : -1));
		} else {
			$solution = explode(',' , str_replace(['[',']'], ['',''], $row["solution"]));
			$diff = array_diff_assoc($solution, $guess);
			$correct = (count($solution)===count($guess)) && (count($diff) === 0); // Same number of entries and no different values
		}

		echo ' "correct": "'.($correct ? "true" : "false").'",';
		
		//Comment for wrong tutorial solution
		if ($participantRow["itemset"] === 0 && !$correct) {
			echo ' "comment": "<br><br><strong>Leider ist Ihre L&ouml;sung falsch.</strong>",';
		} else {
			echo ' "comment": "",';
		}
		
		//Advance to next riddle (except for wrong tutorial solution)
		if ($participantRow["itemset"] > 0 || $correct) {
			$updateItemsetQuery = "UPDATE participants set nextriddle=? WHERE hashid=?";
			$updateItemset = $sqlDB->prepare($updateItemsetQuery);
			$updateItemset->execute([$row["riddleID"]+1, $UserID]);//next Riddle
		}
		
		if ($participantRow["itemset"]>0) {//Write submitted solution to DB, except for tutorials
			if ($participantRow["itemset"] === 3) {
				$updateSolutionQuery = "UPDATE submittedsolutions set timestampEnd = ?, time = ?, solution = ?, correct = ? WHERE participantID = ? AND icarID = ?";
			} else {
				$updateSolutionQuery = "UPDATE submittedsolutions set timestampEnd = ?, time = ?, solution = ?, correct = ? WHERE participantID = ? AND riddleID = ?";
			}
			$updateSolution = $sqlDB->prepare($updateSolutionQuery);
			$updateSolution->execute([date("Y-m-d H:i:s", $timestamp), $totalTime, $guessString, $correct, $participantRow["ID"], $row["riddleID"]]);
		}
		echo ' "error": ""}';
		
	} catch(PDOException $e) {
		echo '"error": "Connection failed ' . str_replace('"', "'", $e->getMessage()) . '"';
		$sqlDB = null;
	}
?>