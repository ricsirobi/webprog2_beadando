<?php
echo "<h1>Fájl letöltése</h1>";
echo "<h2>A gombra kattintva egy csv állományt tud letölteni amiben rendezve benne van az összes általunk eltárolt játék és annak dolgai.<br> Ha szeretné látni az összes adatunkat egy fájlban akkor töltse le!</h2>";
require("../connect/database.php");
$myfile = fopen("data.csv", "w") or die("Unable to open file!");
$txt = "Nev;Ar;Platform;Id.\n";
fwrite($myfile, $txt);
$txt = "";
$eredmeny2 = mysqli_query($kapcsolat, "select * from games");
while ($sor = $eredmeny2->fetch_assoc()) {
	$gameid = $sor["id"];
	$jateknev = $sor["name"];
	$ara = $sor["priceUSD"];
	$platform = $sor["platform"];
	$txt .= $jateknev . ";" . $ara . "$;" . $platform . ";" . $gameid . "\n";
	$txt .= "Karakterek:\n";
	$eredmeny4 = mysqli_query($kapcsolat, "select * from characters where gameID = \"$gameid\"");
	$txt .= " ;Nev;Faj;Kor;Neme;Ereje\n";
	while ($sor = $eredmeny4->fetch_assoc()) {
		$characterID = $sor["id"];
		$characterName = $sor["name"];
		$characterSex = $sor["sex"];
		$characterAge = $sor["age"];
		$characterPower = $sor["power"];
		$characterRace = $sor["race"];
		$charactersGameID = $sor["gameID"];
		$txt .= " ;" . $characterName . ";" . $characterRace . ";" . $characterAge . ";" . $characterSex . ";" . $characterPower . "\n";
	}
	$txt .= "\n";
	$txt .= "Helyszinek:\n";
	$eredmeny4 = mysqli_query($kapcsolat, "select * from places where gameID = \"$gameid\"");
	$txt .= " ;Nev;Ellenfelek szama;Id\n";
	while ($sor = $eredmeny4->fetch_assoc()) {
		$placeID = $sor["id"];
		$placeName = $sor["name"];
		$placeEnemyNumber = $sor["numberOfEnemy"];
		$txt .= " ;" . $placeName . ";" . $placeEnemyNumber . ";" . $placeID . "\n";
	}
	$txt .= "\n";
	$txt .= "Gyujtheto dolgok:\n";
	$txt .= " ;Nev;Mennyire ritka?;Max erteke;Id\n";
	$eredmeny5 = mysqli_query($kapcsolat, "select * from collectibles where gameID = \"$gameid\"");
	while ($sor = $eredmeny5->fetch_assoc()) {
		$collectiblesID = $sor["id"];
		$collectiblesName = $sor["name"];
		$collectiblesRarity = $sor["rarity"];
		$collectiblesMaxValue = $sor["maxValuee"];
		$txt .= " ;" . $collectiblesName . ";" . $collectiblesRarity . ";" . $collectiblesMaxValue . ";" . $collectiblesID . "\n";
	}
	$txt .= "\n";
	$txt .= "\n";
	$txt .= "Nev;Ar;Platform;Id.\n";
}
fwrite($myfile, $txt);
fclose($myfile);
//letöltő gomb
echo '<a href=\'games/data.csv\' download><button class="btn"><i class="fa fa-download"></i> Összes adat letöltése</button></a>';
