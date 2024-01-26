<?php

include 'config.php';

$response = array('status' => '', 'message' => '');

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$date = date("Y-m-d H:i:s");

// Datuen balidazioa.
$name = htmlspecialchars($name);
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$phone = htmlspecialchars($phone);
$message = htmlspecialchars($message);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response['status'] = 'error';
    $response['message'] = 'Emaila ez da baliozko.';
    echo json_encode($response);
    exit;
}


// Sql prebenitzeko preparatutako kontsulta.
$stmt = $con->prepare("INSERT INTO contact_form_data (name, email, phone, message, sent_date) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $email, $phone, $message, $date);

if ($stmt->execute()) {
    $response['status'] = 'success';
    $response['message'] = 'Zure mezua ongi bidali da.';
    $response['data'] = array(
        'id' => $stmt->insert_id,
        'sent_date' => $date
    );
} else {
    $response['status'] = 'error';
    $response['message'] = 'Errorea datuak gordetzean.';
}

$stmt->close();

// Irteera datuak borratu.
$response['message'] = htmlspecialchars($response['message']);

// Configuración de CORS
// https://developer.mozilla.org/es/docs/Web/HTTP/CORS
// https://developer.mozilla.org/es/docs/Web/HTTP/Headers/Access-Control-Allow-Origin

/*El uso compartido de recursos entre orígenes (CORS) 
es una característica de seguridad del navegador que 
restringe las solicitudes HTTP que se inician desde 
secuencias de comandos que se ejecutan en el navegador.*/

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

echo json_encode($response);

$con->close();
?>