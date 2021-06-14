<?php 
require("../connect/database.php");


$eredmeny2 = mysqli_query($kapcsolat, "select * from games");
?>
<h1> Összes játék </h1>
<table style="width:100%" class="table">
  <tr>
    <th>Címe</th>
    <th>Ára</th> 
    <th>Platformja</th>
  </tr>

<?php
while ($sor = $eredmeny2->fetch_assoc()) 
{
$jateknev = $sor["name"];
$ara = $sor["priceUSD"];
$platform = $sor["platform"];


echo "<tr>";
echo "<td> $jateknev </td>";
echo "<td> $ara </td>";
echo "<td> $platform </td>";

echo "</tr>";


//echo $jateknev ." ". $ara ."$". "<br>";



}

?>
