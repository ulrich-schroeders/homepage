<?php
	function validateBilendiID($input)
	{
		//Returns true, if the string is 15 characters long and only consists of digits.
		preg_match('/^\\d+$/', $input , $matches, PREG_OFFSET_CAPTURE);
		return (count($matches) === 1) && (strlen($matches[0][0]) == 15) && ($input === $matches[0][0]);
	}

	$gender = (array_key_exists('gender', $_GET) && is_numeric($_GET['gender'])) ? intval($_GET['gender']) : 0;
	$gender = ($gender > 0 && $gender <= 3) ? $gender : 0;
	$age = (array_key_exists('age', $_GET) && is_numeric($_GET['age'])) ? intval($_GET['age']) : 0;
	$age = ($age > 0 && $age <= 121) ? $age : 0;
	$education = (array_key_exists('education', $_GET) && is_numeric($_GET['education'])) ? intval($_GET['education']) : 0;
	$education = ($education > 0 && $education <= 7) ? $education : 0;
	$mastermind = (array_key_exists('mastermind', $_GET) && is_numeric($_GET['mastermind'])) ? intval($_GET['mastermind']) : 0;
	$mastermind = ($mastermind>0 && $mastermind <= 4) ? $mastermind : 0;
	$hashID = (array_key_exists('m', $_GET) && is_numeric($_GET['m'])) ? ($_GET['m']) : 0;
	$randomValue = random_int(50000,250000);
	usleep($randomValue);
	if ($gender>0 && $age>0 && $education>0 && $mastermind>0) {
		include 'sql.php';
		try {
			$sqlDB = connectToSQL();
			$timestamp = time();
			$i = 0;
			if (!validateBilendiID($hashID)) {
				$randomValue = random_int(0,250000);
				//Generate truncated hash value as user ID. While loop for the rare case of a collision. If the user has not a valid BilendiID, a custom ID is generated starting with an Y
				$hashID = "Y" . substr(hash("sha256", "seed".$randomValue.";".$timestamp.";".$gender.";".$age.";".$education.";".$mastermind.";".microtime().";".$i), 0, 24);
			}
			$hashExistsQuery = $sqlDB->prepare("SELECT ID FROM participants WHERE hashid = ?");
			$hashExistsQuery->execute(array($hashID));
			$row = $hashExistsQuery->fetch();
			while ($row) {
				$randomValue = random_int(0,250000);
				//Generate truncated hash value as user ID. While loop for the rare case of a collision. If the ID was already in use, a custom ID is generated starting with an X
				$hashID = "X" . substr(hash("sha256", "seed".$randomValue.";".$timestamp.";".$gender.";".$age.";".$education.";".$mastermind.";".microtime().";".$i), 0, 24);
				$hashExistsQuery->execute(array($hashID));  
				$row = $hashExistsQuery->fetch();
				$i = $i + 1;
			}
			$insertQuery = "INSERT INTO participants (hashid, gender, age, education, mastermind, created) VALUES (?,?,?,?,?,?)";
			$insertNewUser = $sqlDB->prepare($insertQuery);
			$insertNewUser->execute([$hashID, $gender, $age, $education, $mastermind, date("Y-m-d H:i:s", $timestamp)]);
			header("Location: instructions.html?m=".$hashID);
			exit();
		} catch(PDOException $e) {
			echo '"error": "Connection failed ' . str_replace('"', "'", $e->getMessage()) . '"';
			$sqlDB = null;
		}
	} else {
?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<style>
.survey {
	margin-left: 30%;
    text-align: left;
	width: 40%;
	font-family: Verdana,Geneva,sans-serif;
	line-height: 140%;
	font-size: 14px;
}
.button {
	margin-left: 30%;
	text-align: right;
	width: 40%;
}
html {
    background-image: url(images/lock2.jpg);
    background-position: 50% 50%;
    background-repeat: no-repeat;
    background-attachment: fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    background-color: #000;
}
h1 {
	display: inline-block;
    vertical-align: top;
	line-height: 130%;
}
</style>
<script>
function accpeted() {
	var gender = document.querySelector('input[name = "gender"]:checked');
	if(gender == null){
		alert("Bitte Geschlecht auswählen\,");
		return;
	}
	var age = parseInt(document.getElementById("age").value);
	if (isNaN(age) || (age > 121) || (age <= 0)) {
		alert("Bitte Alter angeben\.");
		return;
	}
	var education = document.querySelector('input[name = "education"]:checked');
	if(education == null){
		alert("Bitte höchsten Schulabschluss auswählen\.");
		return;
	}
	var mastermind = document.querySelector('input[name = "mastermind"]:checked');
	if(mastermind == null){
		alert("Bitte auswählen ob sie schon einmal eine Spielvariante gespielt haben\.");
		return;
	}
	window.location.href = "survey.php?m=<?php echo $hashID; ?>&gender=" + gender.value + "&age=" + age + "&education=" + education.value + "&mastermind=" + mastermind.value;
}

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
	return (charCode < 31) || ((document.getElementById("age").value.length < 3) && (charCode >= 48) && (charCode <= 57));
}
</script>
</head>
<body>
<div class="survey">
	<h1>Demographische Daten</h1>
	<fieldset style="border:0px">
	<strong>Geschlecht</strong><br />
	<input type="radio" id="female" name="gender" value="1"><label for="female"> Weiblich</label><br />
	<input type="radio" id="male" name="gender" value="2"><label for="male"> M&auml;nnlich</label><br />
	<input type="radio" id="divers" name="gender" value="3"><label for="divers"> Divers</label><br />
	</fieldset>
	<fieldset style="border:0px">
	<strong>Alter</strong><br />
	<input type="number" id="age" name="age" onkeypress="return isNumberKey(event)" /><label for="age"> Jahre</label><br />
	</fieldset>
	<fieldset style="border:0px">
	<strong>Ihr h&ouml;chster Schulabschluss</strong><br />
	<input type="radio" id="none" name="education" value="1"><label for="noeducation"> Kein Schulabschluss</label><br />
	<input type="radio" id="grundschule" name="education" value="2"><label for="grundschule"> Grund-/Hauptschulabschluss</label><br />
	<input type="radio" id="realschule" name="education" value="3"><label for="realschule"> Realschulabschluss (Mittlere Reife)</label><br />
	<input type="radio" id="gymnasium" name="education" value="4"><label for="gymnasium"> Allgemeine Hochschulreife oder Fachhochschulreife</label><br />
	<input type="radio" id="berufsausbildung" name="education" value="5"><label for="berufsausbildung"> Abgeschlossene Berufsausbildung</label><br />
	<input type="radio" id="studium" name="education" value="6"><label for="studium"> Hochschul- oder Fachhochschulabschluss</label><br />
	<input type="radio" id="promotion" name="education" value="7"><label for="promotion"> Promotion</label><br />
	</fieldset>
	<fieldset style="border:0px">
	<strong>Wie häufig spielen Sie &bdquo;Mastermind&ldquo;, &bdquo;Superhirn&ldquo; oder &bdquo;Ochs und Kuh&ldquo;?</strong><br />
	<input type="radio" id="nie" name="mastermind" value="1"><label for="nie"> Nie</label><br />
	<input type="radio" id="selten" name="mastermind" value="2"><label for="selten"> Selten</label><br />
	<input type="radio" id="manchmal" name="mastermind" value="3"><label for="manchmal"> Manchmal</label><br />
	<input type="radio" id="haeufig" name="mastermind" value="4"><label for="haeufig"> H&auml;ufig</label><br />
	</fieldset>
</div>

<div class="button" style="text-align:center">
<hr>
	<button type="button" onclick="accpeted()">Weiter</button>
<hr>
</div>

</body>
</html>
<?php } //Else if ($valid) ?>