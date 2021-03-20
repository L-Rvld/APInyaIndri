<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/api_gizi/db_function.php';
$db = new DB_Functions();

$response = array("error" => FALSE);

if (isset($_POST['password'])) {

    $password = $_POST['password'];

    $user = $db->getadmin($password);

    if ($user != false) {
        $response["error"] = FALSE;
        echo json_encode($response);
    } else {
        $response["error"] = TRUE;
        echo json_encode($response);
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Parameter (email atau password) ada yang kurang";
    echo json_encode($response);
}
?>
