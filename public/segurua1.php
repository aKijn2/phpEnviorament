<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sartutako informazioa ez dela koderik zihurtatzeko
    function ezsartu($valor)
    {
        return htmlspecialchars(trim($valor), ENT_QUOTES, 'UTF-8');
    }

    // Formularioko datuak hartu
    $textua = ezsartu($_POST["textua"]);
    $non = ezsartu($_POST["non"]);
    $genero = ezsartu($_POST["genero"]);

    // Datu basean sartu
    $consulta = $con->prepare("INSERT INTO `Formularioa` (`textua`, `non`, `genero`) VALUES (?, ?, ?)");

    if ($consulta) {
        $consulta->bind_param("sss", $textua, $non, $genero);

        // Erakutsi datuak
        if ($consulta->execute()) {
            // Ongi badoa
            echo "<h2>Emaitzak:</h2>";
            echo "<p>Datuak egoki gorde dira.</p>";
        } else {
            // Mostrar mensaje de error
            echo "<h2>Errorea:</h2>";
            echo "<p>Datuak sartzerakoan errorea: " . $consulta->error . "</p>";
        }

        // Itxi koneksioa
        $consulta->close();
    } else {
        // Mostrar mensaje de error en la preparación de la consulta
        echo "<h2>Errorea:</h2>";
        echo "<p>Errorea datu basearekin konektatzerakoan: " . $con->error . "</p>";
    }
} else {
    // Norbait sartzen saiatzen bada
    header("Location: formulario_sinplea.html");
    exit();
}

// Konexia itxi bada ez bada
if ($con) {
    $con->close();
}
?>