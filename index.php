<!DOCTYPE html>
<html>
<head>
<title> Hello Ukraina </title>
</head>
<body>

<h1>Bitte Name und Adresse eingeben und auf das "Speichern" klicken! </h1>

<?php

echo date("d.m.Y H:i:s");


// Parameters:

$host = "ssamariadb-svr.mariadb.database.azure.com";
$user = "phpappuser@ssamariadb-svr";
$password = "MySQLAzure2017";
$dbname = "sampledb";

// DB connect:

$mysqli = new mysqli($host, $user, $password, $dbname);
    if(!$mysqli)  {
        echo "<br>database error";
    }else{
        echo "<br>database connection successful";
    }

echo("<br><br>");
?>
 	<form method="post" action="index.php">
		Name:<br>
		<input type="text" name="name">
		<br>
		Adresse:<br>
		<input type="text" name="adresse">
		<br>
		<input type="submit" name="save" value="Speichern">
	</form>
 
<?php
 if(isset($_POST['save']))
{	 
	 $name = $_POST['name'];
	 $adresse = $_POST['adresse'];
	 $sql = "INSERT INTO personal (name,adresse)
	 VALUES ('$name','$adresse')";
	 if (mysqli_query($mysqli, $sql)) {
		echo "Neuer Eintrag ist  $name mit der Adresse $adresse erfolgreich gespeichert !";
	 } else {
		echo "Error: " . $sql . "
" . mysqli_error($mysqli);
	 }
	 //mysqli_close($mysqli);
}
?>
<table border="1" align="center">
<tr>
  <td>NAME</td>
  <td>ADRESSE</td>
</tr>

<?php
$query = mysqli_query($mysqli, "SELECT * FROM personal")
   or die (mysqli_error($mysqli));

while ($row = mysqli_fetch_array($query)) {
  echo
   "<tr>
    <td>{$row['name']}</td>
    <td>{$row['adresse']}</td>
   </tr>\n";

}
?>
</table>
<?php
$mysqli->close();
?>
</body>
</html>