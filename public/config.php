<?php
session_start();
$host = "mysql"; /* Host name */
$user = "root"; /* User */
$password = "root"; /* Password */
$dbname = "contact_form_data"; /* Database name */

$con = mysqli_connect($host, $user, $password, $dbname);
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}