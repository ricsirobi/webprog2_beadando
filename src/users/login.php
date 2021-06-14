<?php 
if(isset($_POST["loginName"]) && $_POST["loginName"] != "")
{
	echo "siker";
}



?>

<html> 
<head>
</head>

<body>

<div id = "loginDiv" >
<form action="" method="POST">
			Bejelentkezés:</br></br>
			Név: <input type="text" name="nev" placeholder="Felhasználónév"></br></br>
			Jelszó: <input type="text" name="jelsz" placeholder="Jelszó"></br></br>
			<input type="submit" name="belep" value="Bejelentkezés">
		</form>
</div>

<div> Ha még nincs fiókja: <button onclick="loadDoc('users/register.php')"> Regisztráció </button> </div>

</body>
</html>