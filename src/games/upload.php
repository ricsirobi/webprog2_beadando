<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


// Check if file already exists
if (file_exists($target_file)) {
  echo "Ez a fájl már fel lett töltve.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "A fájl mérete túl nagy.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Hiba, a fájl nincs feltöltve.";
// if everything is ok, try to upload file
} else {
	if($_FILES["fileToUpload"]["name"] == "places.txt" || $_FILES["fileToUpload"]["name"] == "collectibles.txt" || $_FILES["fileToUpload"]["name"] == "characters.txt"|| $_FILES["fileToUpload"]["name"] == "characters.csv" || $_FILES["fileToUpload"]["name"] == "places.csv" || $_FILES["fileToUpload"]["name"] == "collectibles.csv")
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";

	setcookie("fileUp", $_FILES["fileToUpload"]["name"] , time() + (86400 * 30), "/");

	header("location:../index.php");
  } else {
    echo "Hiba a fájl feltöltése során.";
  }
}
?>