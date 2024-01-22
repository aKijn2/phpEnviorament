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

if (isset($_POST['but_logout'])) {
    logout();
}

checkLoginStatus();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INFORMATIKA DENDA</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 20px;
            background-color: #f1f1f1;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h1 {
            font-size: 50px;
            font-family: 'Courier New', Courier, monospace;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 30px;
            font-family: 'Courier New', Courier, monospace;
            display: inline-block;
            position: relative;
            background: darkgray;
            width: 28em;
            border-radius: 25px;
            box-shadow: 0 9px #999;
        }

        h3 {
            font-size: 20px;
            font-family: 'Courier New', Courier, monospace;
            margin-bottom: 20px;
        }

        form {
            margin-top: 20px;
        }

        input[type="submit"] {
            font-size: 20px;
            font-family: 'Courier New', Courier, monospace;
            background-color: #cfcfcf;
            border: none;
            margin: 10px;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 9px #999;
            cursor: pointer;
            width: 150px;
            height: 50px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>INFORMATIKA DENDA</h1>
    <h2>Ongi etorri
        <?php echo $_SESSION['uname']; ?>
    </h2>
    <h3>Webgune honetan informazioa aurkituko duzu gure dendari buruz.</h3>
    <form method='post' action="">
        <input type="submit" value="Informazioa">
        <input type="submit" value="Produktuak">
        <input type="submit" value="Logout" name="but_logout">
    </form>
</body>

</html>