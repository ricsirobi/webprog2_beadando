<?php require("connect/database.php"); ?>


<!-- Belépés-Kilépés-Regisztráció-->
<?php
if (isset($_POST["logout"])) {
	setcookie("userID", "null", time() - (86400 * 30), "/");
	setcookie("userName", "null", time() - (86400 * 30), "/");
	header("location:index.php");
}

if (isset($_POST["belep"])) {
	$eredmeny = mysqli_query($kapcsolat, "select * from users");
	while ($sor = $eredmeny->fetch_assoc()) {
		$nev = $sor["name"];
		$jelszo = $sor["password"];
		$cookie_name = $sor["id"];
		if ($_POST["nev"] == $nev && $_POST["jelsz"] == $jelszo) {
			$_SESSION["user"] = $_POST["nev"];
			$_SESSION["userid"] = $sor["id"];

			$cookie_value = $_POST["nev"];
			setcookie("userID", $sor["id"], time() + (86400 * 30), "/");
			setcookie("userName", $cookie_value, time() + (86400 * 30), "/");
			break;
		} else {
			setcookie("userID", "null", time() - (86400 * 30), "/");
			setcookie("userName", "null", time() - (86400 * 30), "/");
		}
	}
	header("location:index.php");
}
if (isset($_POST["regi"])) {
	if (isset($_POST["nev"]) && isset($_POST["jelsz"])) {
		if ($_POST["nev"] != "" && $_POST["jelsz"] != "") {
			$n = $_POST["nev"];
			$j = $_POST["jelsz"];
			//$eredmeny = mysqli_query($kapcsolat, "insert into vasarlo (nev, jelsz) values ('$n','$j')");
			$sql = "insert INTO users(name, password) VALUES (\"$n\",\"$j\")";
			mysqli_query($kapcsolat, $sql);
			$_POST["nev"] = "";
			$_POST["jelsz"] = "";
			echo "sikeres regisztáció";
		}
	}
	//header("location:index.php");
}
if (!isset($_COOKIE["userID"]) || !isset($_COOKIE["userName"]) || $_COOKIE["userName"] == "null" || $_COOKIE["userID"] == "null" || $_COOKIE["userID"] == null || $_COOKIE["userName"] == null)
	echo '<div id = "contentSelector">
<button onclick="loadDoc(\'users/login.php\')"> Bejelentkezés </button>';
else
	echo '<div id = "contentSelector">
<button onclick="loadDoc(\'users/profile.php\')"> Fiókom </button>' . '<button onclick="loadDoc(\'games/games.php\')"> Játékok hozzáadása</button>' .
		'<button onclick="loadDoc(\'games/gamesEdit.php\')"> Játékok szerkesztése</button>' .
		'<button onclick="loadDoc(\'games/gameStuffUpload.php\')"> Fájlfeltöltés</button>' .
		'<button onclick="loadDoc(\'users/logout.php\')"> Kijelentkezés </button>';
?>
<!-- Játékok-->
<!-- Játék feltöltése-->
<?php
if (isset($_POST["gameUpload"])) {
	$gamename = $_POST["gameName"];
	$gameUSD = $_POST["gameUSD"];
	$platform = $_POST["gamePlatform"];

	$sql = "insert INTO games(name, priceUSD, platform) VALUES (\"$gamename\",$gameUSD,\"$platform\")";
	mysqli_query($kapcsolat, $sql);
}
?>
<!-- Játékok szerkesztése-->
<?php

if (isset($_POST["gameEdit"])) {
	$gamename = $_POST["gameName"];
	$gameUSD = $_POST["gameUSD"];
	$platform = $_POST["gamePlatform"];
	$sql = "uPDATE games SET priceUSD=$gameUSD,platform=\"$platform\" WHERE name = \"$gamename\"";
	mysqli_query($kapcsolat, $sql);
}
?>


<!-- -->

<!-- Fájlfeltöltés -->
<?php
if (isset($_COOKIE["fileUp"])) {
	//echo $_GET["fileName"];
	//echo "megtaláltam a fájlt: ". $_COOKIE["fileUp"];
	//karakter
	if ($_COOKIE["fileUp"] == "characters.txt" || $_COOKIE["fileUp"] == "characters.csv") {
		if ($_COOKIE["fileUp"] == "characters.txt") {
			$myfile = fopen("games/uploads/characters.txt", "r") or die("Hiba a fájl megnyitása közben");
		} else {
			$myfile = fopen("games/uploads/characters.csv", "r") or die("Hiba a fájl megnyitása közben");
		}
		while (!feof($myfile)) {
			$sorom = fgets($myfile);
			$temp = explode(";", $sorom);
			$characterName = $temp[0];
			$characterSex = $temp[1];
			$characterAge = $temp[2];
			$characterPower = $temp[3];
			$characterRace = $temp[4];
			$characterGameId = $temp[5];
			$sql = "iNSERT INTO characters(name, sex, age, power, race, gameID) VALUES (\"$characterName\",\"$characterSex\",$characterAge,$characterPower,\"$characterRace\", $characterGameId)";
			mysqli_query($kapcsolat, $sql);
		}
	}

	if ($_COOKIE["fileUp"] == "places.txt" || $_COOKIE["fileUp"] == "places.csv") {

		if ($_COOKIE["fileUp"] == "collectibles.txt") {
			$myfile = fopen("games/uploads/places.txt", "r") or die("Hiba a fájl megnyitása közben");
		} else {
			$myfile = fopen("games/uploads/places.csv", "r") or die("Hiba a fájl megnyitása közben");
		}
		while (!feof($myfile)) {
			$sorom = fgets($myfile);
			$temp = explode(";", $sorom);
			$places0 = $temp[0]; //név
			$places1 = $temp[1]; //maxenemy
			$placesGameID = $temp[2];

			$sql = "iNSERT INTO places(name, numberOfEnemy, gameID) VALUES (\"$places0\",$places1,$placesGameID)";
			mysqli_query($kapcsolat, $sql);
		}
	}
	if ($_COOKIE["fileUp"] == "collectibles.txt" || $_COOKIE["fileUp"] == "collectibles.csv") {

		if ($_COOKIE["fileUp"] == "collectibles.txt") {
			$myfile = fopen("games/uploads/collectibles.txt", "r") or die("Hiba a fájl megnyitása közben");
		} else {
			$myfile = fopen("games/uploads/collectibles.csv", "r") or die("Hiba a fájl megnyitása közben");
		}
		while (!feof($myfile)) {
			$sorom = fgets($myfile);
			$temp = explode(";", $sorom);
			$collectibles0 = $temp[0];
			$collectibles1 = $temp[1];
			$collectibles2 = $temp[2];
			$collectibles3 = $temp[3];

			$sql = "iNSERT INTO collectibles(name, rarity, maxValuee, gameID) VALUES (\"$collectibles0\",\"$collectibles1\",$collectibles2,$collectibles3)";
			mysqli_query($kapcsolat, $sql);
		}
	}
	setcookie("fileUp", "null", time() - (86400 * 30), "/");



	/*$myfile = fopen("webdictionary.txt", "r") or die("Unable to open file!");
	echo fread($myfile,filesize("webdictionary.txt"));
	fclose($myfile);
*/
}
?>
<!-- -->



<html lang="hu">

<head>
	<meta charset="UTF-8">
	<title> GamesProject - TC92HL</title>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/mystyle.css">
	<script>
		function loadDoc(docName) {
			const xhttp = new XMLHttpRequest();
			xhttp.onload = function() {
				document.getElementById("content").innerHTML = "Betöltés...";
				document.getElementById("content").innerHTML = this.responseText;
			}
			xhttp.open("GET", docName);
			xhttp.send();
		}
	</script>

	<script>



	</script>

</head>

<body>
	<button onclick="loadDoc('games/allGames.php')"> Összes játék</button>
	<button onclick="loadDoc('games/ingameContent.php')"> Mi van a játékban?</button>
	<?php
	echo '   
	<button onclick="loadDoc(\'games/download.php\')"> Fájl letöltés</button>
	
	
	</div>';
	echo '<div id="content"> </div>';
	?>


	<!-- Játékinfó-->

	<?php

	if (isset($_POST["whatIsInGameButton"]) && $_POST["whatIsInGame"] != null && $_POST["whatIsInGame"] != "") {

		$gamename = $_POST["whatIsInGame"];

		setcookie("selectedGame", $gamename, time() + (86400 * 30), "/");
		$_POST["whatIsInGame"] = "";
	}

	?>

</body>

</html>