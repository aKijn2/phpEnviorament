<?php
include "config.php";

// Verifikatu sesioa hasita bladin badago hasi haurretik.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Sesiao hasita verifikatu.
function checkLoginStatus()
{
    if (!isset($_SESSION['uname'])) {
        header('Location: index.php');
        exit(); // Gelditu ejekuzioa redirekzioa egin ondoren
    }
}

// Sesioa amaitu
function logout()
{
    session_destroy();
    header('Location: index.php');
    exit(); // Ejekuzioa gelditua redirect egitean
}

// Login verifikazioa
if (isset($_POST['but_submit'])) {
    $uname = mysqli_real_escape_string($con, $_POST['txt_uname']);
    $password = mysqli_real_escape_string($con, $_POST['txt_pwd']);

    if ($uname != "" && $password != "") {
        $sql_query = "SELECT count(*) as cntUser FROM users WHERE username='$uname' AND password='$password'";
        $result = mysqli_query($con, $sql_query);
        $row = mysqli_fetch_array($result);
        $count = $row['cntUser'];

        if ($count > 0) {
            $_SESSION['uname'] = $uname;
            header('Location: home.php');
            exit();
        } else {
            echo "Invalid username and password";
        }
    }
}

// Verificar y cerrar sesión si es necesario
if (isset($_POST['but_logout'])) {
    logout();
}

// Verificar el inicio de sesión
checkLoginStatus();
?>

<!doctype html>
<html>

<head>
    <!-- Agrega títulos, estilos u otros elementos del encabezado si es necesario -->
    <title>Homepage</title>
</head>

<body>
    <h1>Homepage</h1>

    <!-- Formulario para cerrar sesión -->
    <form method='post' action="">
        <input type="submit" value="Logout" name="but_logout">
    </form>
</body>

</html>