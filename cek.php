<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/api_gizi/db_function.php';
$db = new DB_Functions();

$response = array("error" => FALSE);

if (isset($_POST['email'])) {

    $email = $_POST['email'];

    $user = $db->cekRegister($email);

    if ($user != false) {
        $response["error"] = FALSE;
        echo json_encode($response);
    } else {
        $response["error"] = TRUE;
        echo json_encode($response);
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Parameter ada yang kurang";
    echo json_encode($response);
}
?>
