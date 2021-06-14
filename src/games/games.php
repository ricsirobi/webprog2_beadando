<?php
//echo "játékok oldal";
?>
<html>

<head>
</head>

<body>
	<div id="keret">
		<form action="" method="POST">
			<h1> Játék hozzáadása</h1>
			<table class="table">
				<tr>
					<td><input type="text" name="gameName" placeholder="Játék címe"></td>
					<span>
						<td><input type="number" min="0" name="gameUSD" placeholder="ára">$
					</span></td>
				</tr>
				<tr>
					<td>
						<select name="gamePlatform" id="platform" class="mdb-select md-form">
							<option value="" disabled selected>Platform</option>
							<optgroup label="PC">
								<option value="Steam">Steam</option>
								<option value="Epic Games">Epic Games</option>
								<option value="EA Desktop">EA Desktop/Origin</option>
								<option value="uPlay">Ubisoft Connect</option>
								<option value="Rockstar Games">Rockstar Games</option>
								<option value="Other">Other</option>
							</optgroup>
							<optgroup label="PlayStation">
								<option value="PlayStation">Playstation</option>
								<option value="Playstation Vita">Vita</option>
								<option value="PSP">PSP</option>
								<option value="PlayStation 2">2</option>
								<option value="PlayStation 3">3</option>
								<option value="PlayStation 4">4</option>
								<option value="PlayStation 5">5</option>

							</optgroup>
							<optgroup label="Xbox">
							<option value="Xbox">Xbox</option>
							<option value="Xbox 360">360</option>
							<option value="Xbox One">One</option>
							<option value="Xbox Series X">Series X</option>
							</optgroup>
							<optgroup label="Nintendo">
							<option value="Nintendo Wii">Wii</option>
							<option value="Nintendo Wii U">Wii u</option>
							<option value="Switch"> Switch</option>

							</optgroup>
							
						</select>
					</td>
					<td><input type="submit" name="gameUpload" value="Hozzáadás"></td>
				</tr>

			</table>

		</form>
	</div>
</body>

</html>