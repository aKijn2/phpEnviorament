<?php
$host = "mysql";
$user = "root";
$pass = "root";
$db = "inkesta";
$data = $_POST["botua"];

$con = mysqli_connect($host, $user, $pass, $db);

$sql = "INSERT INTO `inkesta` (`datuak`) VALUES ('$data')";
$ejekutatua = mysqli_query($con, $sql);

if ($ejekutatua) {
  echo "<p>Datuak ondo gorde dira</p>";
} else {
  echo "<p>Errorea datuak ez dira gorde</p>";
}

mysqli_close($con);
?>