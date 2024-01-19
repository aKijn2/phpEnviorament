<?php
include "config.php";

// Verificar si la sesión está activa antes de intentar iniciarla
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar el logeo
if (isset($_POST['but_submit'])) {
    // Verificar si se enviaron los datos de usuario y contraseña
    if (isset($_POST['txt_uname'], $_POST['txt_pwd'])) {
        $uname = mysqli_real_escape_string($con, $_POST['txt_uname']);
        $password = mysqli_real_escape_string($con, $_POST['txt_pwd']);

        if ($uname != "" && $password != "") {
            // Utilizar consultas preparadas para mayor seguridad
            $sql_query = "SELECT count(*) as cntUser FROM users WHERE username=? AND password=?";
            $stmt = mysqli_prepare($con, $sql_query);
            mysqli_stmt_bind_param($stmt, "ss", $uname, $password);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $count);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);

            if ($count > 0) {
                $_SESSION['uname'] = $uname;
                header('Location: home.php');
                exit();
            } else {
                echo "Invalid username and password";
            }
        }
    }
}

// Verificar y cerrar sesión si es necesario
if (isset($_POST['but_logout'])) {
    session_destroy();
    header('Location: index.html');
    exit(); // Detener la ejecución después de redirigir
}

// Verificar el inicio de sesión
function checkLoginStatus()
{
    if (!isset($_SESSION['uname'])) {
        header('Location: index.html');
        exit(); // Detener la ejecución después de redirigir
    }
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