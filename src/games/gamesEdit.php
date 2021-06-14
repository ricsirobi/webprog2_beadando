<?php
require("../connect/database.php");
?>


<html>

<head>

</head>


<body>
	<div id="keret">
		<form action="" method="POST">
			<h1> Játék szerkesztése</h1>
			<table class="table">
				<tr>
					<td>
					<span>
					<select name="gameName" id="gameName" class="mdb-select md-form">
					<?php
					
					$eredmeny2 = mysqli_query($kapcsolat, "select * from games");
					while ($sor = $eredmeny2->fetch_assoc()) 
					{
						$jateknev = $sor["name"];

						echo "<option value='$jateknev'>$jateknev</option>";
					}

					?>
					
					
					 </select> 
					
					</span>
					
					</td>
					<span>
						<td><input type="number" min="0" name="gameUSD" placeholder="ára">$
					</span></td>
				</tr>
				<tr>
					<td>
						<select name="gamePlatform" id="platform" class="mdb-select md-form">
							<option value="" disabled selected>Platform</option>
							<optgroup label="PC">
								<option value="steam">Steam</option>
								<option value="epicgames">Epic Games</option>
								<option value="ea">EA Desktop/Origin</option>
								<option value="uplay">Ubisoft Connect</option>
								<option value="rockstargames">Rockstar Games</option>
							</optgroup>
							<optgroup label="Console">
								<option value="psn">Playstation</option>
								<option value="xbox">Xbox</option>
								<option value="nintendo">Nintendo</option>
							</optgroup>
						</select>
					</td>
					<td><input type="submit" name="gameEdit" value="Szerkesztés"></td>
				</tr>

			</table>

		</form>
	</div>
</body>


</html>