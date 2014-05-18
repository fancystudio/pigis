<?php
require_once 'HelperClass.php';
require_once '../config.php';
$pageItems = array();
$help = new Helper($config);
$result = $help->insertMailToNewsletter($_POST["mail"]);
$response_array['status'] = ($result ? "success" : "error");
header('Content-type: application/json');
echo json_encode($response_array);
?>
