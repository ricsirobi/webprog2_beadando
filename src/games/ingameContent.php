<?php
require("../connect/database.php");
error_reporting(0); //ez csak azért szükséges mert cookie-t keres ami a legelső keresésnél nincs ott
ini_set('display_errors', 0);
?>
<html>
<head>
</head>
<body>
	<form action="" method="POST">
		<h1> Játék tartalma </h1>
		<h4> Válasszon játékot!</h4>
		<table class="table">
			<tr>
				<td>
					<span>
						<select name="whatIsInGame" id="whatIsInGame" class="mdb-select md-form" onchange="trade()">
							<?php
							$szamlalo = 0;
							$eredmeny2 = mysqli_query($kapcsolat, "select * from games");
							while ($sor = $eredmeny2->fetch_assoc()) {
								$jateknev = $sor["name"];
								if ($szamlalo == 0)
									echo "<option value='$jateknev' selected>$jateknev</option>";
								else
									echo "<option value='$jateknev'>$jateknev</option>";
								$szamlalo++;
							}
							?>
						</select>
						<input type="submit" name="whatIsInGameButton">
	</form>
	<div id="tradeTo"> </div>
	<?php
	if (!isset($_COOKIE["selectedGame"]) || !$_COOKIE["selectedGame"] == "null" || !$_COOKIE["selectedGame"] == null) {
		$selectedGame = $_COOKIE["selectedGame"];
		echo "<h1>$selectedGame</h1>";
		$selectedGameId = "";
		$eredmeny3 = mysqli_query($kapcsolat, "select * from games where name = \"$selectedGame\"");
		while ($sor = $eredmeny3->fetch_assoc()) {
			$selectedGameId = $sor["id"];
			break;
		}
		//echo "id: $selectedGameId";
		//karakterek
		$eredmeny4 = mysqli_query($kapcsolat, "select * from characters where gameID = \"$selectedGameId\"");
	?>
		<h2> Karakterek</h2>
		<table class="table">
			<tr>
				<th> Név </th>
				<th> Faj </th>
				<th> Kor </th>
				<th> Neme </th>
				<th>Ereje </th>
			</tr>
			<?php
			while ($sor = $eredmeny4->fetch_assoc()) {
				$characterID = $sor["id"];
				$characterName = $sor["name"];
				$characterSex = $sor["sex"];
				$characterAge = $sor["age"];
				$characterPower = $sor["power"];
				$characterRace = $sor["race"];
				$charactersGameID = $sor["gameID"];
				echo "
				<tr> 
				<td> $characterName</td>
				<td> $characterRace</td>
				<td> $characterAge</td>
				<td> $characterSex</td>
				<td> $characterPower</td>
				</tr>
				";
				//eqcho "whileban vagyok";
			}
			?>
		</table>
		<h2> Helyszínek</h2>
		<table class="table">
			<tr>
				<th> Elnevezés </th>
				<th> Ellenfelek száma </th>
			</tr>
			<?php
			$eredmeny5 = mysqli_query($kapcsolat, "select * from places where gameID = \"$selectedGameId\"");
			while ($sor = $eredmeny5->fetch_assoc()) {
				$placeID = $sor["id"];
				$placeName = $sor["name"];
				$placeEnemyNumber = $sor["numberOfEnemy"];
				echo "
				<tr> 
				<td> $placeName</td>
				<td> $placeEnemyNumber</td>
				</tr>
				";
			}
			?>
		</table>
		<h2> Gyűjthető dolgok</h2>
		<table class="table">
			<tr>
				<th> Elnevezés </th>
				<th> Értékesség </th>
				<th> Max érték</th>
			</tr>
			<?php
			$eredmeny5 = mysqli_query($kapcsolat, "select * from collectibles where gameID = \"$selectedGameId\"");
			while ($sor = $eredmeny5->fetch_assoc()) {
				$collectiblesID = $sor["id"];
				$collectiblesName = $sor["name"];
				$collectiblesRarity = $sor["rarity"];
				$collectiblesMaxValue = $sor["maxValuee"];
				echo "
				<tr> 
				<td> $collectiblesName</td>
				<td> $collectiblesRarity</td>
				<td> $collectiblesMaxValue</td>
				</tr>
				";
			}
			?>
		</table>
	<?php
		// itt majd kiírom a játék adatait: karaktereit stb
		$_COOKIE["selectedGame"] = "null";
	}
	?>
</body>
</html>