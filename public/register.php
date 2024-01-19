<?php
$host = "mysql";
$user = "root";
$pass = "root";
$db = "login";

$con = mysqli_connect($host, $user, $pass, $db);

// Verificar la conexión
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Obtener datos del formulario
$izena = isset($_POST['izena']) ? mysqli_real_escape_string($con, $_POST['izena']) : '';
$abizena = isset($_POST['abizena']) ? mysqli_real_escape_string($con, $_POST['abizena']) : '';
$korreoa = isset($_POST['korreoa']) ? mysqli_real_escape_string($con, $_POST['korreoa']) : '';
$username = isset($_POST['txt_uname']) ? mysqli_real_escape_string($con, $_POST['txt_uname']) : '';
$password = isset($_POST['txt_pwd']) ? mysqli_real_escape_string($con, $_POST['txt_pwd']) : '';

// Verificar si los campos requeridos están vacíos
if (empty($izena) || empty($abizena) || empty($korreoa) || empty($username) || empty($password)) {
    echo "<p>Errore ez dago daturik.</p>";
} else {

    // Consulta preparada para insertar datos de forma segura
    $sql = "INSERT INTO `users` (`izena`, `abizena`, `korreoa`, `username`, `password`, `name`) VALUES (?, ?, ?, ?, ?, 'ValorPredeterminado')";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $izena, $abizena, $korreoa, $username, $password);
    $ejekutatua = mysqli_stmt_execute($stmt);

    if ($ejekutatua) {
        echo "<p>Datuak ondo gorde dira</p>";
    } else {
        echo "<p>Errorea datuak ez dira gorde</p>";
    }

    // Cerrar la conexión y la declaración
    mysqli_stmt_close($stmt);
}

mysqli_close($con);
?>