<?php
	include 'sql.php';
	$UserID = (array_key_exists('m', $_GET) && strlen($_GET['m'])>2) ? $_GET['m'] : "X";
	$state = 0;
	
	try {
		$sqlDB = connectToSQL();
		$participantQuery = $sqlDB->prepare("SELECT ID, participants.nextriddle, itemset, age, education FROM participants WHERE hashid = ?");
		$participantQuery->execute([$UserID]);
		$participantRow = $participantQuery->fetch();
		if (!$participantRow) {
			echo $participantQuery;
			//header("Location: survey.php");
			exit();
		}
		
		if ($state == 0) {
			# results of the Mastermind Test (MMT)
			$resultQuery_MMT = $sqlDB->prepare("SELECT COUNT(ID) as total, SUM(correct) as correct, SUM(time) as time FROM submittedsolutions WHERE participantID=? AND riddleID > 0");
			$resultQuery_MMT ->execute([$participantRow["ID"]]);
			$resultRow_MMT = $resultQuery_MMT -> fetch();
			
			# results of the ICAR
			$resultQuery_ICAR = $sqlDB->prepare("SELECT COUNT(ID) as total, SUM(correct) as correct, SUM(time) as time FROM submittedsolutions WHERE participantID=? AND icarID > 0");
			$resultQuery_ICAR ->execute([$participantRow["ID"]]);
			$resultRow_ICAR = $resultQuery_ICAR -> fetch();
		}
	} catch(PDOException $e) {
		echo '"error": "Connection failed ' . str_replace('"', "'", $e->getMessage()) . '"}';
		$sqlDB = null;
	}
	header('Content-type: text/html');
?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<style>
.survey {
	font-family: Verdana,Geneva,sans-serif;
	font-size: 0.9em;
	margin-left: 25%;
    text-align: left;
	width: 50%;
}
.button {
	margin-left: 33%;
	text-align: right;
	width: 33%;
}
</style>
</head>

<body>
<?php
if (($state == 0) && $resultRow_ICAR) {
?>
<div class="survey">
</br>
Vielen Dank f&uuml;r die Teilnahme!<br><br>
Im Folgenden haben wir für Sie Ihre Ergebnisse zusammengestellt. Vorab jedoch noch ein paar Informationen zur besseren Einordnung dieser Ergebnisse.

<h3>Anmerkungen zur Interpretation der Testergebnisse</h3>
Bei der Interpretation der Ergebnisse sollten Sie einige Dinge beachten, die die Aussagekraft einschränken:
<ul>
<li>Ihre <i>erbrachte Leistung</i> schwankt und ist von einer Vielzahl von Faktoren Tageszeit, Testleitung, etc.) abhängig. Diese Faktoren können zu einer verzerrten Darstellung des <i>tatsächlichen Leistungsniveaus</i> führen.</li>
<li>Jede Leistungsmessung ist mit einem Messfehler behaftet. Das heißt, dass die Fähigkeiten in einzelnen Aufgabengruppen möglicherweise über- oder unterschätzt wurden. Selbst wenn deine Leistung unterdurchschnittlich ist, bedeutet dies nicht zwangsläufig, dass der Unterschied zu anderen Teilnehmer:innen, die überdurchschnittliche Werte erzielen konnten, sehr groß oder von praktischer Bedeutung ist.</li>
<li>Der Codeknacker-Test befindet sich derzeit in einer frühen Entwicklungsstufe. Ihre Antworten werden dabei helfen, die Schwierigkeiten der einzelnen Aufgaben und die zu Verfügung stehende Bearbeitungszeit zu justieren. Auch der zweite Kurztest stellt lediglich eine kurze <i>Momentaufnahme</i> dar und ersetzt keine eingehende psychologische Untersuchung zur zuverlässigen und aussagekräftigen Einschätzung ihre Fähigkeiten zum schlussfolgenden Denken. Von den hier erzielten Testergebnisse sollte deshalb nicht generalisiert werden. Deshalb wird vor einer zu breiten Auslegung der Testergebnisse 'gewarnt'.</li>
</ul>

<!-- results of the MMT -->
<p><h3>Codeknacker-Test</h3></p>
<p>
Sie haben <strong><?php echo $resultRow_MMT["correct"]; ?> von 
<?php echo $resultRow_MMT["total"]; ?> Aufgaben</strong> korrekt gel&ouml;st. Sie haben daf&uuml;r 
<?php echo round($resultRow_MMT["time"]/100); ?> Sekunden gebraucht.
</p>

<!-- results of the ICAR -->
<p><h3>Matrizentest</h3></p>
<p>
Sie haben <strong><?php echo $resultRow_ICAR["correct"]; ?> von
<?php echo $resultRow_ICAR["total"]; ?> Aufgaben</strong> korrekt gel&ouml;st. Zum Vergleich: In einer großen Online-Untersuchung mit weltweit knapp 100.000 Teilnehmer:innen wurden durchschnittlich 5.1 Aufgaben richtig beantwortet. Zur Bearbeitung der 11 Aufgaben haben Sie <?php echo round($resultRow_ICAR["time"]/100); ?> Sekunden benötigt. 
</div>
</p>

<div class="survey">
Wenn Sie wollen, können Sie Ihre Ergebnisse nun ausdrucken.<br>
Nach dem Schließen dieses Fensters gibt es keine Möglichkeit mehr auf Ergebnisse zuzugreifen, da die Aufgaben anonym bearbeitet wurden.

<br>
<h2>Klicken Sie <a href="<?php
function validateBilendiID($input)
{
	//Returns true, if the string is 15 characters long and only consists of digits.
	preg_match('/^\\d+$/', $input , $matches, PREG_OFFSET_CAPTURE);
	return (count($matches) === 1) && (strlen($matches[0][0]) == 15) && ($input === $matches[0][0]);
}

echo "https://survey.maximiles.com/";
if (validateBilendiID($UserID)) {
	$UserIDURL='&m='.$UserID;
} else {
	echo "static-";
	$UserIDURL='';
}
// Too fast. All time in 100th of a second. E.g. 30000 is five minutes. Or just write 5 * 60 * 100 for five minutes.
if ($resultRow_MMT["time"] < 30000) {
	echo "speeder?p=98327";
// Not enough correct results
//} else if (($resultRow_MMT["correct"] < 2) || ($resultRow_ICAR["correct"] < 4)) {
//	echo "quality?p=98327";
// Screenout
//} else if (($participantRow["age"] < 16) || ($participantRow["age"] > 75)) {
//	echo "screenout?p=98327";
} else {
	echo "complete?p=98327_8107c9fe";
}
echo $UserIDURL;
?>">hier</a>, um zu Bilendi zurück zu gelangen.</h2>
</div>
<?php
}
?>
</body>
</html>
