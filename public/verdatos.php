<!DOCTYPE html>
<html lang="eu">

<head>
  <title>Emaitzak inkestarena</title>
  <link rel="stylesheet" type="text/css" href="estiloa.css" />
</head>

<body>

  <h1>Emaitzak inkestarena</h1>

  <?php
  $host = "mysql";
  $user = "root";
  $pass = "root";
  $db = "inkesta";

  $con = mysqli_connect($host, $user, $pass, $db);

  $consulta = "SELECT datuak FROM inkesta";
  $resultados = mysqli_query($con, $consulta);

  $kaixo = array();
  
  while ($rowados = mysqli_fetch_assoc($resultados)) {
    $kaixo[] = $rowados['datuak'];
  }
  
  echo "Datuak: " . implode(" ", $kaixo);

  mysqli_close($con);
  ?>

  <a href="inkesta.html">Inkestara vueltatu</a>

</body>

</html>
