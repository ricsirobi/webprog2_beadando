<?php 

//echo "gamestuff upload";


?>


<html>
<form action="games/upload.php" method="post" enctype="multipart/form-data">
  <h1> Adatok feltöltése </h1>
  <h3>A fájl neve legyen az adattábla neve kérem, ahova szeretné feltölteni. Például: "collectibles.txt", "characters.txt" vagy "places.txt"<br>
  Egy sornyi adat pontosvesszővel legyen tagolva. (ezzel tagolt csv-t is elfogadok.) </h3>
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Adat feltöltése" name="submit">
</form>

</html>